<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class GameLibAPIController extends AbstractController
{
    #[Route('/api/game', name: 'api_game', methods: ['GET'])]
    public function jsonGame(
        SessionInterface $session
    ): Response {
        $session->get('deck');
        $cardDeck = $session->get('cardDeck');
        $cardHand = $session->get('cardHand');
        $sumHand = $session->get('sumHand');
        $bankHand = $session->get('bankHand');
        $sumBank = $session->get('sumBank');

        $data = [
        'Kortlek' => $cardDeck,
        'Korthand Spelare' => $cardHand,
        'Value Spelare' => $sumHand,
        'Korthand Bank' => $bankHand,
        'Value Bank' => $sumBank,
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );

        return $response;
    }

    #[Route('api/library/books', name: 'book_show_all_api')]
    public function showAllBookApi(
        BookRepository $bookRepository
    ): Response {
        $books = $bookRepository
            ->findAll();

        $response = $this->json($books);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );

        return $response;
    }

    #[Route('api/library/book/{isbn<\d+>}', name: 'book_by_id_api')]
    public function showBookByIdApi(
        BookRepository $bookRepository,
        int $isbn
    ): Response {
        $book = $bookRepository->findOneBySomeField($isbn);

        $response = $this->json($book);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );

        return $response;
    }
}
