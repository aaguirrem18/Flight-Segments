<?php

namespace App\Infrastructure\Command;

use DateTimeImmutable;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Command\Command;
use App\Infrastructure\Service\XmlReaderService;
use App\Application\Service\FlightSegmentsService;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LleegoAvailCommand extends Command
{
    protected static $defaultName = 'lleego:avail';
    protected static $defaultDescription = 'Add a short description for your command';
    private $xmlReader;

    private $flightSegments;

    public function __construct(
        XmlReaderService $xmlReader,
        FlightSegmentsService $flightSegments
    )
    {
        parent::__construct();
        $this->xmlReader = $xmlReader;
        $this->flightSegments = $flightSegments;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
           //obtiene el body del xml
           $xmlBody = $this->xmlReader->getBody(
            'availability-price',
            [
                'origin' => 'MA',
                'destination' => 'BI',
                'date' => '2027-06-01',
            ],
        );

        $segments = $this->flightSegments->getSegmentList($xmlBody ,true);

        $segments = array_map(function($item) {
            foreach ($item as $key => $value) {
                if ($value instanceof DateTimeImmutable) {
                    $item[$key] = $value->format('Y-m-d H:i:s');
                }
            }
            return $item;
        }, $segments);

        $table = new Table($output);
        $table->setHeaders(array_keys(reset($segments)));
        // Agregar filas con los datos del array
        foreach ($segments as $row) {
            $table->addRow($row);
        }

        $table->render();

        /*
        'originCode' => $flight['Departure']['AirportCode'],
        'originName' => $flight['Departure']['AirportName'],
        'destinationCode' => $flight['Arrival']['AirportCode'],
        'destinationName' => $flight['Arrival']['AirportName'],
        'start' => $flight['Arrival']['Date'] . ' ' . $flight['Arrival']['Time'],
        'end' => $flight['Arrival']['Date'] . ' ' . $flight['Arrival']['Time'],
        'transportNumber' => $flight['MarketingCarrier']['FlightNumber'],
        'companyCode' => $flight['MarketingCarrier']['AirlineID'],
        'companyName' => $flight['MarketingCarrier']['Name']
        */

        return Command::SUCCESS;
    }
}
