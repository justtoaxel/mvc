<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\card\Card;
use App\card\Deck;

class CardGameController extends AbstractController
{
    #[Route("/card", name: "card_start")]
    public function home(): Response
    {
        return $this->render('card/home.html.twig');
    }

    #[Route("/card/deck", name: "card_deck")]
    public function showDeck(): Response
    {

        $deck = new Deck();

        $data = [
            'getDeck' => $deck,
        ];

        $response = new JsonResponse($data);
        $response->setContent(json_encode($data, JSON_UNESCAPED_UNICODE));
        $response->setEncodingOptions(
        $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );

        return $this->render('card/deck.html.twig', $data);

    }

        #[Route("card/deck/draw", name: "card_draw")]
        public function draw(): Response
        {
            $card = new Card();
    
            $data = [
                "card" => $card->draw(),
                "cardString" => $card->getAsString(),
            ];

        return $this->render('card/draw.html.twig', $data);

        }

        #[Route("/card/deck/draw/{num<\d+>}", name: "test_roll_num_dices")]
    public function drawNumber(int $num): Response
    {
        if ($num > 99) {
            throw new \Exception("Can not roll more than 99 dices!");
        }

        $diceRoll = [];
        for ($i = 1; $i <= $num; $i++) {
            $die = new Dice();
            $die->roll();
            $diceRoll[] = $die->getAsString();
        }

        $data = [
            "num_dices" => count($diceRoll),
            "diceRoll" => $diceRoll,
        ];

        return $this->render('pig/test/roll_many.html.twig', $data);

    }
    
}