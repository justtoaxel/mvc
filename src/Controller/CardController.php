<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\DeckOfCards;
use App\Card\Hand;
use App\Card\BankHand;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CardController extends AbstractController
{
    #[Route("card", name: "card_start")]
    public function home(): Response
    {
        return $this->render('card/home.html.twig');
    }

    #[Route("card/deck", name: "show_deck", methods: ['GET'])]
    public function deckShow(
        SessionInterface $session
    ): Response {

        $deck = new DeckOfCards();
        for ($i = 1; $i <= 52; $i++) {
            $card = new CardGraphic();
            $cardString = $card->getAsRepresentation($i);
            $deck->addCard($cardString);
        }

        $cardDeck = $deck->getDeckOfCards();
        $cardQuantity = $deck->getNumberCards();


        $session->set("cardDeck", $cardDeck);
        $session->set("cardQuantity", $cardQuantity);

        $data = [
            "cardDeck" => $cardDeck
        ];


        return $this->render('card/deck.html.twig', $data);
    }

    #[Route("card/shuffle", name: "shuffle_deck", methods: ['GET'])]
    public function deckShuffle(
        SessionInterface $session
    ): Response {

        $deck = new DeckOfCards();
        for ($i = 1; $i <= 52; $i++) {
            $card = new CardGraphic();
            $cardString = $card->getAsRepresentation($i);
            $deck->addCard($cardString);
        }

        $cardDeck = $deck->getDeckOfCards();
        $cardQuantity = $deck->getNumberCards();


        $session->set("cardDeck", $cardDeck);
        $session->set("cardQuantity", $cardQuantity);


        $unshuffledDeck = $session->get("cardDeck");
        $shuffledDeck = $unshuffledDeck;
        shuffle($shuffledDeck);

        $session->set("cardDeck", $shuffledDeck);



        $data = [
            "cardDeck" => $shuffledDeck
        ];

        return $this->render('card/deck_shuffle.html.twig', $data);

    }

    #[Route("card/draw", name: "draw_one", methods: ['GET'])]
    public function drawOne(
        SessionInterface $session
    ): Response {

        $hand = new Hand();
        $hand->getHand();

        $shuffledDeck = $session->get("cardDeck");

        $remainingDeck = array_splice($shuffledDeck, 1);
        $session->set("cardDeck", $remainingDeck);

        $hand = ($shuffledDeck);

        $deckQuantity = count($remainingDeck);


        $data = [
            "drawnCards" => $hand,
            "deckQuantity" => $deckQuantity
        ];

        return $this->render('card/draw.html.twig', $data);

    }

    #[Route("card/draw/{num<\d+>}", name: "draw_several", methods: ['GET'])]
    public function drawSeveral(
        int $num,
        SessionInterface $session
    ): Response {

        if ($num > 52) {
            throw new Exception("Can not draw more than 52 cards!");
        }

        $hand = new Hand();
        $hand->getHand();

        $shuffledDeck = $session->get("cardDeck");

        $remainingDeck = array_splice($shuffledDeck, $num);
        $session->set("cardDeck", $remainingDeck);

        $hand = ($shuffledDeck);

        $deckQuantity = count($remainingDeck);


        $data = [
            "drawnCards" => $hand,
            "deckQuantity" => $deckQuantity
        ];

        return $this->render('card/draw.html.twig', $data);

    }

}
