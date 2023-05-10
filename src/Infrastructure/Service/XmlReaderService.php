<?php

namespace App\Infrastructure\Service;

use SimpleXMLElement;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

/**
 * Class XmlReaderService
 * @package App\Infrastructure\Service;
 */
final class XmlReaderService
{
    private $client;

    public function __construct() {

        $this->client = new Client([
            'base_uri' => 'https://testapi.lleego.com/prueba-tecnica/',
            'timeout'  => 2.0
        ]);
    }

    /**
     * Permite iniciar la busqueda en el xml
     * se puede enviar a otro servicio del cual SegmentService extienda
     * @param string $path ruta donde esta el contenido 
     * @param array $params parametros a enviar en la peticion
     */
    public function getBody(string $path, array $params): SimpleXMLElement
    {
        // Realiza una petición GET a la API
        $response = $this->client->get($path, [RequestOptions::QUERY => $params]);     

        // Obtiene el cuerpo de la respuesta
        $xmlString = $response->getBody()->getContents();

        // Procesa la respuesta como XML
        $xml = simplexml_load_string($xmlString);

        //navega hasta el el nodo body
        $body = $xml->xpath('/soap:Envelope/soap:Body');

        return $body[0];
    }

}
