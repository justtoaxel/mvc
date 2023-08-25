<?php

// ...

namespace App\Controller;

use App\Repository\PersontransportRepository;
use App\Repository\RenewableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class ChartController extends AbstractController
{
    #[Route('proj', name: 'proj', methods: ['GET'])]
    public function showAllProj(
        RenewableRepository $renewableRepository,
        PersontransportRepository $persontransportRepository,
        ChartBuilderInterface $chartBuilder
    ): Response {
        $renewables = $renewableRepository
        ->findAll();
        $biobransle = array_column($renewables, 'biobransle');
        $vattenkraft = array_column($renewables, 'vattenkraft');
        $varmepumpar = array_column($renewables, 'varmepumpar');
        $solenergi = array_column($renewables, 'solenergi');
        $totalgron = array_column($renewables, 'totalgron');
        $totalenergi = array_column($renewables, 'totalenergi');

        $transports = $persontransportRepository
        ->findAll();
        $vagtrafik = array_column($transports, 'vagtrafik');
        $bantrafik = array_column($transports, 'bantrafik');
        $sjofart = array_column($transports, 'sjofart');
        $luftfart = array_column($transports, 'luftfart');

        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
            'labels' => ['2005', '2006', '2007', '2008', '2009', '2010', '2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018', '2019'],
            'datasets' => [
                [
                    'label' => 'Biobränsle',
                    'backgroundColor' => 'rgb(120, 161, 187, 0.5)',
                    'borderColor' => 'rgb(120, 161, 187, 0.5)',
                    'data' => array_reverse($biobransle),
                ],
                [
                    'label' => 'Vattenkraft',
                    'backgroundColor' => 'rgb(219, 80, 74, 0.5)',
                    'borderColor' => 'rgb(219, 80, 74, 0.5)',
                    'data' => array_reverse($vattenkraft),
                ],
                [
                    'label' => 'Värmepumpar',
                    'backgroundColor' => 'rgb(147, 196, 139, 0.5)',
                    'borderColor' => 'rgb(147, 196, 139, 0.5)',
                    'data' => array_reverse($varmepumpar),
                ],
                [
                    'label' => 'Solenergi',
                    'backgroundColor' => 'rgb(252, 191, 73, 0.5)',
                    'borderColor' => 'rgb(252, 191, 73, 0.5)',
                    'data' => array_reverse($solenergi),
                ],
            ],
        ]);

        $chart2 = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart2->setData([
            'labels' => ['2005', '2006', '2007', '2008', '2009', '2010', '2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018', '2019'],
            'datasets' => [
                [
                    'label' => 'Total Energi Grön',
                    'backgroundColor' => 'rgb(147, 196, 139, 0.5)',
                    'borderColor' => 'rgb(147, 196, 139, 0.5)',
                    'data' => array_reverse($totalgron),
                ],
                [
                    'label' => 'Total Energi',
                    'backgroundColor' => 'rgb(252, 191, 73, 0.5)',
                    'borderColor' => 'rgb(252, 191, 73, 0.5)',
                    'data' => array_reverse($totalenergi),
                ],
            ],
        ]);

        $chart3 = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart3->setData([
            'labels' => ['2015', '2016', '2017', '2018', '2019', '2020'],
            'datasets' => [
                [
                    'label' => 'Vägtrafik',
                    'backgroundColor' => 'rgb(120, 161, 187, 0.5)',
                    'borderColor' => 'rgb(120, 161, 187, 0.5)',
                    'data' => array_reverse($vagtrafik),
                ],
                [
                    'label' => 'Bantrafik',
                    'backgroundColor' => 'rgb(219, 80, 74, 0.5)',
                    'borderColor' => 'rgb(219, 80, 74, 0.5)',
                    'data' => array_reverse($bantrafik),
                ],
                [
                    'label' => 'Sjöfart',
                    'backgroundColor' => 'rgb(147, 196, 139, 0.5)',
                    'borderColor' => 'rgb(147, 196, 139, 0.5)',
                    'data' => array_reverse($sjofart),
                ],
                [
                    'label' => 'Luftfart',
                    'backgroundColor' => 'rgb(252, 191, 73, 0.5)',
                    'borderColor' => 'rgb(252, 191, 73, 0.5)',
                    'data' => array_reverse($luftfart),
                ],
            ],
        ]);
        $data = [
            'chart' => $chart,
            'chart2' => $chart2,
            'chart3' => $chart3,
        ];

        return $this->render('proj/show.html.twig', $data);
    }

    #[Route('proj/about', name: 'proj_about')]
    public function projAbout(
    ): Response {
        return $this->render('proj/home.html.twig');
    }

    #[Route('proj/about/database', name: 'proj_about_database')]
    public function projDatabase(
    ): Response {
        return $this->render('proj/about_db.html.twig');
    }
}
