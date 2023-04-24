<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class LuckyControllerJson
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
}
