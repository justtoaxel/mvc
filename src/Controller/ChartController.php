<?php
// ...
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use App\Entity\Persontransport;
use App\Entity\Renewable;
use App\Repository\PersontransportRepository;
use App\Repository\RenewableRepository;
use Doctrine\Persistence\ManagerRegistry;

class ChartController extends AbstractController
{
    #[Route('proj', name: 'proj')]
    public function chartHome(ChartBuilderInterface $chartBuilder): Response
    {
        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);

        $chart->setData([
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'data' => [0, 10, 5, 2, 20, 30, 45],
                    'backgroundColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                      ],
                      'hoverOffset' => '4',
                      'borderWidth' => '1'
                ],
            ],
        ]);

        $data = [
            'chart' => $chart
        ];

        return $this->render('proj/home.html.twig', $data);
    }
    #[Route('proj/show', name: 'proj_show', methods: ['GET'])]
    public function showAllProj(
        RenewableRepository $renewableRepository,
        ChartBuilderInterface $chartBuilder
    ): Response {
        
            $person = $renewableRepository->find(3);
            $bio = $person->getBiobransle();
            $chart = $chartBuilder->createChart(Chart::TYPE_LINE);
            print_r($bio);
            $chart->setData([
                'labels' => ['2015', '2016', '2017', 'April', 'May', 'June', 'July'],
                'datasets' => [
                    [
                        'label' => 'My First dataset',
                        'data' => [$bio, 10, 5, 2, 20, 30, 45],
                        'backgroundColor' => [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)'
                        ],
                        'hoverOffset' => '4',
                        'borderWidth' => '1'
                    ],
                ],
            ]);

            $data = [
                'chart' => $chart
            ];

        return $this->render('proj/show.html.twig', $data);
    }
    

    #[Route("/proj/api", name: "proj_api", methods: ['GET'])]
    public function projAPI(
        SessionInterface $session
    ): Response {


        $data = [
        "test" => 'test',
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
        $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('proj/about', name: 'proj_about')]
    public function index(ChartBuilderInterface $chartBuilder): Response
    {
        

        $data = [
            'chart' => $chart
        ];

        return $this->render('proj/home.html.twig', $data);
    }

}