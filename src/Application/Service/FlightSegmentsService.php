<?php

namespace App\Application\Service;

use DateTimeImmutable;
use App\Application\DTO\SegmentDTO;
use App\Application\DTO\SegmentMapper;
use App\Domain\Entity\Segment\Segment;

/**
 * Class FlightSegmentsService
 * @package App\Application\Service
 */
final class FlightSegmentsService
{
    private $segmentMapper;

    public function __construct(
        SegmentMapper $segmentMapper
    ) {
        $this->segmentMapper = $segmentMapper;
    }

    /**
     * Obtiene los elementos FlightSegment del XML y los convierte a una Entidad Segment
     * @Param $as_array permite retonar la lista como un array asociativo
     */
    public function getSegmentList($body, $as_array = FALSE)
    {
        $segments = [];

        //navega hasta los FlightSegmentList
        $flightSegmentList = $body
            ->AirShoppingRS
            ->DataLists
            ->FlightSegmentList;

        //se convierte a array para facilitar la navegacion entre los nodos
        $flightSegmentList = json_decode(json_encode($flightSegmentList), TRUE);

        foreach ($flightSegmentList['FlightSegment'] as $flight) {

            $segmentDTO = new SegmentDTO(
                'AGP',
                $flight['Departure']['AirportName'],
                $flight['Arrival']['AirportCode'],
                $flight['Arrival']['AirportName'],
                new DateTimeImmutable($flight['Arrival']['Date'] . ' ' . $flight['Arrival']['Time']),
                new DateTimeImmutable($flight['Arrival']['Date'] . ' ' . $flight['Arrival']['Time']),
                $flight['MarketingCarrier']['FlightNumber'],
                $flight['MarketingCarrier']['AirlineID'],
                $flight['MarketingCarrier']['Name']
            );

            //se retorna la lista en formato array de valores o array de objetos
            //para el caso actual siempre utilizaremos el array formateado, ya que no persistimos la entidad
            //pero dejo el metodo para su conocimiento
            $segments[] = ($as_array) ? $segmentDTO->formattedArray() : $this->segmentMapper->createEntity($segmentDTO);
        }

        return $segments;
    }

}
