<?php

namespace App\Infrastructure\Shared\EventListener;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use App\Infrastructure\Shared\Responses\APIResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent  $event)
    {
        $exception = $event->getThrowable();

        if ($exception instanceof NotFoundHttpException) {
            // Crear una respuesta con el código de estado 404
            $response = new Response('La página solicitada no se encontró', Response::HTTP_NOT_FOUND);
            // Asignar la respuesta al evento
            $event->setResponse($response);
        } elseif ($exception instanceof \Symfony\Component\ErrorHandler\Error\ClassNotFoundError) {
            // Convertir la excepción en una instancia de Exception
            $exception = new Exception($exception->getMessage(), $exception->getCode(), $exception);
        }

        // Crear una respuesta de API para la excepción
        $response = $this->createApiResponse($exception);
        
        $response = $this->createApiResponse($exception);
        $event->setResponse($response);
    }
    
    private function createApiResponse(Exception $exception)
    {
        $statusCode = $exception instanceof NotFoundHttpException ? $exception->getStatusCode() : Response::HTTP_INTERNAL_SERVER_ERROR;
        $errors     = [];

        return new APIResponse($exception->getMessage(), null, $errors, $statusCode);
    }
}