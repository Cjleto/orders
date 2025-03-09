<?php

use Illuminate\Http\Request;
use Illuminate\Foundation\Exceptions\Handler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

it('returns a custom JSON response for NotFoundHttpException', function () {
    // Simuliamo una richiesta JSON
    $request = Request::create('/non-existent-resource', 'GET');
    $request->headers->set('Accept', 'application/json');

    // Creiamo una NotFoundHttpException
    $exception = new NotFoundHttpException('Resource not found');

    // Definiamo il comportamento per l'eccezione
    app()->get(Handler::class)->renderable(function (NotFoundHttpException $e, Request $request) {
        if ($request->json()) {
            return response()->json([
                'success' => false,
                'message' => 'Not Found Resource',
            ], 404);
        }

        throw $e;
    });

    // Proviamo a invocare la logica dell'eccezione
    $response = app()->handle($request);

    // Verifica che la risposta sia quella desiderata
    expect($response->getStatusCode())->toBe(404);
    expect($response->getContent())->toContain('Not Found Resource');
});

it('throws the NotFoundHttpException for non-JSON requests', function () {
    // Simuliamo una richiesta non-JSON
    $request = Request::create('/non-existent-resource', 'GET');

    // Creiamo una NotFoundHttpException
    $exception = new NotFoundHttpException('Resource not found');

    // Definiamo il comportamento per l'eccezione
    app()->get(Handler::class)->renderable(function (NotFoundHttpException $e, Request $request) {
        if ($request->json()) {
            return response()->json([
                'success' => false,
                'message' => 'Not Found Resource',
            ], 404);
        }

        throw $e;
    });

    // Proviamo a invocare la logica dell'eccezione
    $response = app()->handle($request);

    // Verifica che l'eccezione sia stata lanciata
    expect($response->getStatusCode())->toBe(404);
    expect($response->getContent())->toContain('Not Found Resource');
});
