<?php

// ...

namespace App\Controller;

use App\Repository\PersontransportRepository;
use App\Repository\RenewableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChartAPIController extends AbstractController
{
    #[Route('proj/api', name: 'proj_api', methods: ['GET'])]
    public function projAPI(
    ): Response {
        return $this->render('api/chart_home.html.twig');
    }

    #[Route('api/proj/transports', name: 'proj_transports')]
    public function showTransports(
        PersontransportRepository $persontransportRepository
    ): Response {
        $transport = $persontransportRepository
            ->findAll();

        $response = $this->json($transport);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );

        return $response;
    }

    #[Route('api/proj/renewables', name: 'proj_renewables')]
    public function showRenewables(
        RenewableRepository $renewablesRepository
    ): Response {
        $renewables = $renewablesRepository
            ->findAll();

        $response = $this->json($renewables);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );

        return $response;
    }

    #[Route('api/proj/renewables/', name: 'renewable_by_type')]
    public function showVattenkraft(
        RenewableRepository $renewableRepository
    ): Response {
        $renewables = $renewableRepository
        ->findAll();


        $vattenkraft = array_column($renewables, 'vattenkraft');
        //print_r($vattenkraft);
        
        $response = $this->json($vattenkraft);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );

        return $response;
    }
}
