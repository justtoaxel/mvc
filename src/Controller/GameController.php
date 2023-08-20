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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class GameController extends AbstractController
{
    #[Route("game", name: "card_game")]
    public function cardGameHome(): Response
    {
        return $this->render('card/game_home.html.twig');
    }

    #[Route("game/doc", name: "card_game_doc")]
    public function cardGameDoc(): Response
    {
        return $this->render('card/card_game_doc.html.twig');
    }

    #[Route("game/init", name: "card_game_init", methods: ['GET'])]
    public function cardGameInit(
        SessionInterface $session
    ): Response {

        $stand = false;
        $session->set("stand", $stand);

        $deck = new DeckOfCards();
        for ($i = 1; $i <= 52; $i++) {
            $card = new CardGraphic();
            $cardString = $card->getAsRepresentation($i);
            $deck->addCard($cardString);
        }
        //Initilize CardDeck
        $deck->shuffleDeck();
        $deck->makeValueDeck();
        $remainingDeck = $deck->drawCard(1);

        //Initilize PlayerHand
        $hand = new Hand();
        $hand->addCards($deck->drawnCards());
        $cardHand = $hand->getHand();
        $sumHand = $hand->getSum();

        //Set Session for Player
        $session->set("deck", $deck);
        $session->set("cardDeck", $remainingDeck);
        $session->set("cardHand", $cardHand);
        $session->set("sumHand", $sumHand);

        //Initilize Bank
        $deck = $session->get("deck");
        $remainingDeck = $deck->drawCard(1);

        $bHand = new BankHand();
        $bankHand = $bHand->addCards($deck->drawnCards());
        
        $sumBank = $bHand->getSum();

        //Set Session for Bank & Update Deck
        $session->set("cardDeck", $remainingDeck);
        $session->set("bankHand", $bankHand);
        $session->set("sumBank", $sumBank);

        return $this->redirectToRoute('card_game_play');

    }

    #[Route("game/play", name: "card_game_play", methods: ['GET'])]
    public function cardGameStart(
        SessionInterface $session
    ): Response {

        $session->get("deck");
        $session->get("cardDeck");
        $cardHand = $session->get("cardHand");
        $sumHand = $session->get("sumHand");
        $bankHand = $session->get("bankHand");
        $sumBank = $session->get("sumBank");

        print_r($bankHand);
        $stand = $session->get("stand");
        if ($sumHand > 21) {
            $this->addFlash(
                'warning',
                'Du fick över 21 och har förlorat rundan'
            );
        } elseif ($sumBank > 21) {
            $this->addFlash(
                'success',
                'Banken fick över 21 och har förlorat rundan'
            );
        } elseif ($stand == true) {
            if ($sumBank >= $sumHand) {
                $this->addFlash(
                    'warning',
                    'Du förlorade rundan, Banken fick mest poäng'
                );
            } else {
                $this->addFlash(
                    'Success',
                    'Du vann rundan, Du fick mest poäng'
                );
            }
        } else {
            $this->addFlash(
                'notice',
                'Vill du dra ett till kort?'
            );
        }

        $data = [
            "remainingDeck" => array_keys($cardHand),
            "cardValues" => $cardHand,
            "sumHand" => $sumHand
        ];

        return $this->render('card/card_game_play.html.twig', $data);

    }

    #[Route("game/draw", name: "game_draw", methods: ['POST'])]
    public function gameDraw(
        SessionInterface $session
    ): Response {

        $deck = $session->get("deck");
        $remainingDeck = $deck->drawCard(1);

        $hand = new Hand();
        $cardHand = $session->get("cardHand");
        $hand->setHand($cardHand);
        $cardHand = $hand->addCards($deck->drawnCards());

        $session->set("cardDeck", $remainingDeck);
        $session->set("cardHand", $cardHand);
        $session->set("sumHand", $hand->getSum());

        $sumBank = $session->get("sumBank");
        if ($sumBank >= 17) {
        } else {
            //Initilize Bank
            $deck = $session->get("deck");
            $remainingDeck = $deck->drawCard(1);

            $bHand = new BankHand();
            $bankHand = $session->get("bankHand");
            $bHand->setBank($bankHand);
            $bankHand = $bHand->addCards($deck->drawnCards());

            //Set Session for Bank & Update Deck
            $session->set("cardDeck", $remainingDeck);
            $session->set("bankHand", $bankHand);
            $session->set("sumBank", $bHand->getSum());
        }

        return $this->redirectToRoute('card_game_play');
    }

    #[Route("game/stand", name: "game_stand", methods: ['POST'])]
    public function gameStand(
        SessionInterface $session
    ): Response {
        $sumBank = $session->get("sumBank");
        if ($sumBank >= 17) {
        } else {
            //Initilize Bank
            $deck = $session->get("deck");
            $remainingDeck = $deck->drawCard(1);

            $bHand = new BankHand();
            $bankHand = $session->get("bankHand");
            $bHand->setBank($bankHand);
            $bankHand = $bHand->addCards($deck->drawnCards());

            //Set Session for Bank & Update Deck
            $session->set("cardDeck", $remainingDeck);
            $session->set("bankHand", $bankHand);
            $session->set("sumBank", $bHand->getSum());
        }

        $stand = true;
        $session->set("stand", $stand);

        return $this->redirectToRoute('card_game_play');
    }

    #[Route("game/restart", name: "game_restart", methods: ['POST'])]
    public function gameRestart(): Response
    {
        return $this->redirectToRoute('card_game');
    }

}
