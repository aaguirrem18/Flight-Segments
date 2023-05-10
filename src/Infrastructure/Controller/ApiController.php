<?php

namespace App\Infrastructure\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Infrastructure\Service\XmlReaderService;
use App\Application\Service\FlightSegmentsService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class ApiController
 * @package App\Infrastructure\Controller
 * @Route("/api", name="api_")
 */
final class ApiController extends AbstractController
{
    private $xmlReader;
    private $flightSegments;

    public function __construct(
        XmlReaderService $xmlReader,
        FlightSegmentsService $flightSegments
    )
    {
        $this->xmlReader = $xmlReader;
        $this->flightSegments = $flightSegments;
    }

    /**
     * @Route("/", name="segment_index", methods={"GET"})
     */
    public function index()
    {
        return new JsonResponse(["message"=>"api working !!"], JsonResponse::HTTP_OK);
    }
    
    /**
     * @Route("/avail", name="avail_test", methods={"GET"})
     */
    public function avail()
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
            
        return new JsonResponse($segments, JsonResponse::HTTP_OK);
    }
}
