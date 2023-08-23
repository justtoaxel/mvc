<?php

namespace App\Project;

use App\Entity\Persontransport;
use App\Entity\Renewable;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class CsvImportCommand
 * @package AppBundle\ConsoleCommand
 */
class CsvImportCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * CsvImportCommand constructor.
     *
     * @param EntityManagerInterface $em
     *
     * @throws \Symfony\Component\Console\Exception\LogicException
     */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();

        $this->em = $em;
    }

    /**
     * Configure
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('csv:import')
            ->setDescription('Imports the mock CSV data file')
        ;
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return void
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Attempting import of Feed...');

        $reader = Reader::createFromPath('%kernel.root_dir%/../src/Project/tableData.csv');
        $results = $reader->setHeaderOffset(0); //explicitly sets the CSV document header record
        // https://github.com/thephpleague/csv/issues/208
        $results = $reader->getRecords();

        $io->progressStart(iterator_count($results));

        foreach ($results as $row) {

            // do a look up for existing person matching first + last + dob
            // or create new person$
            $persontransport = (new Persontransport())
                ->setVagtrafik($row['vagtrafik'])
                ->setBantrafik($row['bantrafik'])
                ->setSjofart($row['sjofart'])
                ->setLuftfart($row['luftfart'])
            ;

            $this->em->persist($persontransport);

            // do a lookup for existing renewable matching some combination of fields
            $renewable = $this->em->getRepository(Renewable::class)
                ->findOneBy([
                    'biobransle' => $row['biobransle'],
                    'vattenkraft' => $row['vattenkraft'],
                    'vindkraft' => $row['vindkraft'],
                    'varmepumpar' => $row['varmepumpar'],
                    'solenergi' => $row['solenergi'],
                    'totalgron' => $row['totalgron'],
                    'totalenergi' => $row['totalenergi']
                ]);

            if ($renewable === null) {
                // or create new renewable
                $renewable = (new Renewable())
                    ->setBiobransle($row['biobransle'])
                    ->setVattenkraft($row['vattenkraft'])
                    ->setVindkraft($row['vindkraft'])
                    ->setVarmepumpar($row['varmepumpar'])
                    ->setSolenergi($row['solenergi'])
                    ->setTotalgron($row['totalgron'])
                    ->setTotalenergi($row['totalenergi'])
                ;

                $this->em->persist($renewable);
            }

            $io->progressAdvance();
        }

        $this->em->flush();

        $io->progressFinish();
        $io->success('Command exited cleanly!');
    }
}
