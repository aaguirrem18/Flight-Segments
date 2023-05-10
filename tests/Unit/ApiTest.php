<?php

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use PHPUnit\Framework\TestCase;
use App\Application\DTO\SegmentDTO;

class ApiTest extends TestCase
{
    protected $client;

    protected function setUp(): void
    {
        $this->client = new Client([
            'base_uri' => 'https://testapi.lleego.com/prueba-tecnica/',
            'timeout'  => 2.0,
        ]);
    }

    public function testFormatedDTOtoArray()
    {
        $segmentDTO = new SegmentDTO(
            'MAD',
            'Madrid Airport',
            'BIO',
            'Bilbao Airport',
            new DateTimeImmutable('2022-06-01 12:00:00'),
            new DateTimeImmutable('2022-06-01 12:00:00'),
            'IB1234',
            'IB',
            'Iberia'
        );
        
        $dtoFormated = $segmentDTO->formattedArray();

        $expectedArray = [
            'MAD',
            'Madrid Airport',
            'BIO',
            'Bilbao Airport',
            '2022-06-01 12:00:00',
            '2022-06-01 12:00:00',
            'IB1234',
            'IB',
            'Iberia'
        ];

        $this->assertContains('IB', $expectedArray );
        $this->assertEquals($dtoFormated, $expectedArray);

        $this->assertIsArray(
            $expectedArray,
            "assert variable is array or not"
        );

    }

    public function testApiReturns200()
    {
        $response = $this->client->get('availability-price?origin=MAD&destination=BIO&date=2022-06-01');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testApiReturnsValidXml()
    {
        $response = $this->client->get('availability-price?origin=MAD&destination=BIO&date=2022-06-01');
        $xml = simplexml_load_string($response->getBody()->getContents());
        $this->assertTrue($xml instanceof \SimpleXMLElement);
    }

    public function testApiReturnsFlightSegmentNode()
    {
        $response = $this->client->get('availability-price?origin=MAD&destination=BIO&date=2022-06-01');
        $xml = simplexml_load_string($response->getBody()->getContents());
        $this->assertNotNull($xml->FlightSegment);
    }

    public function testApiValidateXpathBase()
    {
        $response = $this->client->get('availability-price', [
            RequestOptions::QUERY => [
                'origin' => 'MAD',
                'destination' => 'BIO',
                'date' => '2022-06-01',
            ],
        ]);
        
        $xml = simplexml_load_string($response->getBody()->getContents());
        $body = $xml->xpath('/soap:Envelope/soap:Body');
        $this->assertNotNull($body);
    }

    public function testCreateSegmentDto()
    {
        $segmentDTO = new SegmentDTO(
            'MAD',
            'Madrid Airport',
            'BIO',
            'Bilbao Airport',
            new DateTimeImmutable('2022-06-01 12:00:00'),
            new DateTimeImmutable('2022-06-01 12:00:00'),
            'IB1234',
            'IB',
            'Iberia'
        );

        $this->assertEquals('MAD', $segmentDTO->getOriginCode());
        $this->assertEquals('Madrid Airport', $segmentDTO->getOriginName());
        $this->assertEquals('BIO', $segmentDTO->getDestinationCode());
        $this->assertEquals('Bilbao Airport', $segmentDTO->getDestinationName());
        $this->assertEquals('IB1234', $segmentDTO->getTransportNumber());
        $this->assertEquals('IB', $segmentDTO->getCompanyCode());
        $this->assertEquals('Iberia', $segmentDTO->getCompanyName());
    }

}
