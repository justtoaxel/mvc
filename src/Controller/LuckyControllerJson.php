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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LuckyControllerJson extends AbstractController
{
    #[Route("/api/lucky/number")]
    public function jsonNumber(): Response
    {
        $number = random_int(0, 100);

        $myArray = ["“Learn as if you will live forever, live like you will die tomorrow.”", "“Experience is a hard teacher because she gives the test first, the lesson afterwards.”", "“To know how much there is to know is the beginning of learning to live.”"];

        $data = [
            'lucky-number' => $number,
            'lucky-message' => 'Hi there!',
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/api/quote", name: "quote")]
    public function jsonQuote(): Response
    {

        $number = random_int(0, 100);

        $today = $date = date('Y-m-d H:i:s');

        $quotesArray = array(
            0 => 'Learn as if you will live forever, live like you will die tomorrow.',
            1 => 'Experience is a hard teacher because she gives the test first, the lesson afterwards.',
            2 => 'To know how much there is to know is the beginning of learning to live.'
        );

        $quoteIndex = array_rand($quotesArray, 1);
        $quote = $quotesArray[$quoteIndex];

        $data = [
            'Quote' => $quote,
            'Message' => 'Quote of the day',
            'This quote was generated:' => $today,
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("api", name: "api")]
    public function home(): Response
    {
        return $this->render('api/home.html.twig');
    }

    #[Route("/api/deck", name: "api_deck")]
    public function jsonDeck(
        Request $request,
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

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/api/deck/shuffle", name: "api_shuffle", methods: ['POST'])]
    public function jsonShuffle(
        Request $request,
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

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/api/deck/draw", name: "api_drawOne", methods: ['POST'])]
    public function jsonDrawOne(
        Request $request,
        SessionInterface $session
    ): Response {

        $hand = new Hand();
        $cardHand = $hand->getHand();

        $shuffledDeck = $session->get("cardDeck");

        $remainingDeck = array_splice($shuffledDeck, 1);
        $session->set("cardDeck", $remainingDeck);

        $hand = ($shuffledDeck);

        $deckQuantity = count($remainingDeck);


        $data = [
            "drawnCards" => $hand,
            "deckQuantity" => $deckQuantity
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/api/deck/draw/{num<\d+>}", name: "api_drawSeveral", methods: ['POST'])]
    public function jsonDrawSeveral(
        int $num,
        Request $request,
        SessionInterface $session
    ): Response {
        if ($num > 52) {
            throw new \Exception("Can not draw more than 52 cards!");
        }

        $hand = new Hand();
        $cardHand = $hand->getHand();

        $shuffledDeck = $session->get("cardDeck");

        $remainingDeck = array_splice($shuffledDeck, $num);
        $session->set("cardDeck", $remainingDeck);

        $hand = ($shuffledDeck);

        $deckQuantity = count($remainingDeck);


        $data = [
            "drawnCards" => $hand,
            "deckQuantity" => $deckQuantity
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/api/game", name: "api_game", methods: ['GET'])]
    public function jsonGame(
        Request $request,
        SessionInterface $session
    ): Response {
        
        $deck = $session->get("deck");
        $cardDeck = $session->get("cardDeck");
        $cardHand = $session->get("cardHand");
        $sumHand = $session->get("sumHand");
        $bankHand = $session->get("bankHand");
        $sumBank = $session->get("sumBank");

        $data = [
         "Kortlek" => $cardDeck,
         "Korthand Spelare" => $cardHand,
         "Value Spelare" => $sumHand,
            "Korthand Bank" => $bankHand,
          "Value Bank" => $sumBank
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

}
