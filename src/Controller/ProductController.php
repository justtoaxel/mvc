<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/library', name: 'book_library')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    #[Route('/library/create', name: 'book_create')]
    public function createProduct(
    ): Response {
        return $this->render('product/create.html.twig');
    }

    #[Route('/library/create/test', name: 'book_create_test', methods: ['POST'])]
    public function createProductConfirm(
        ManagerRegistry $doctrine,
        Request $request
    ): Response {
        $name = $request->request->get('name');
        $author = $request->request->get('author');
        $isbn = $request->request->get('isbn');
        $img = $request->request->get('img');

        $entityManager = $doctrine->getManager();

        $product = new Book();
        $product->setName($name);
        $product->setAuthor($author);
        $product->setISBN($isbn);
        $product->setImg($img);

        // tell Doctrine you want to (eventually) save the Product
        // (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return $this->redirectToRoute('book_show_all');
    }

    #[Route('/library/show', name: 'book_show_all')]
    public function showAllBook(
        BookRepository $bookRepository
    ): Response {
        $books = $bookRepository
            ->findAll();

        $data = [
            'bookArray' => $books,
        ];

        return $this->render('product/show.html.twig', $data);
    }

    #[Route('/library/show/{id}', name: 'book_by_id', methods: ['GET'])]
    public function showBookById(
        BookRepository $bookRepository,
        int $id
    ): Response {
        $book = $bookRepository->find($id);

        $name = $book->getName();
        $author = $book->getAuthor();
        $isbn = $book->getIsbn();
        $img = $book->getImg();
        $data = [
            'name' => $name,
            'author' => $author,
            'ISBN' => $isbn,
            'img' => $img,
        ];

        return $this->render('product/show_one.html.twig', $data);
    }

    #[Route('/library/delete', name: 'book_delete_by_id', methods: ['POST'])]
    public function deleteBookById(
        ManagerRegistry $doctrine,
        Request $request
    ): Response {
        $id = $request->request->get('id');
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);

        print_r($id);
        if (!$book) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }

        $entityManager->remove($book);
        $entityManager->flush();

        // return $this->render('product/show.html.twig');
        return $this->redirectToRoute('book_show_all');
    }

    #[Route('/library/update/{id}', name: 'product_update')]
    public function updateForm(
        BookRepository $bookRepository,
        int $id
    ): Response {
        $book = $bookRepository
            ->find($id);

        $id = $book->getId();
        $name = $book->getName();
        $author = $book->getAuthor();
        $isbn = $book->getIsbn();
        $img = $book->getImg();
        $data = [
            'id' => $id,
            'name' => $name,
            'author' => $author,
            'ISBN' => $isbn,
            'img' => $img,
        ];

        return $this->render('product/update.html.twig', $data);
    }

    #[Route('/library/update', name: 'book_update_confirm', methods: ['POST'])]
    public function updateProduct(
        ManagerRegistry $doctrine,
        Request $request
    ): Response {
        $id = $request->request->get('id');
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);

        $name = $request->request->get('name');
        $author = $request->request->get('author');
        $isbn = $request->request->get('isbn');
        $img = $request->request->get('img');

        if (!$book) {
            throw $this->createNotFoundException('No book found for id '.$id);
        }

        $book->setName($name);
        $book->setAuthor($author);
        $book->setIsbn($isbn);
        $book->setImg($img);

        $entityManager->flush();

        return $this->redirectToRoute('book_show_all');
    }
}
