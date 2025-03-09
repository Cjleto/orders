<?php

namespace App\Swagger;

use App\Swagger\OpenApi;

class OpenApiOrder extends OpenApi
{

    /**
     * @OA\Tag(
     *     name="Orders",
     *     description="Gestione degli ordini"
     * )
     *
     * @OA\Get(
     *     path="/api/v1/orders",
     *     summary="Recupera la lista degli ordini",
     *     tags={"Orders"},
     *     security={{"sanctumAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Lista degli ordini",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/OrderResource"))
     *     ),
     *     @OA\Response(response=401, description="Non autenticato")
     * )
     */
    public static function index()
    {
        // Implementazione del metodo per recuperare la lista degli ordini
    }

    /**
     * @OA\Post(
     *     path="/api/v1/orders",
     *     summary="Crea un nuovo ordine",
     *     tags={"Orders"},
     *     security={{"sanctumAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreOrderApiRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Ordine creato con successo",
     *         @OA\JsonContent(ref="#/components/schemas/OrderResource")
     *     ),
     *     @OA\Response(response=400, description="Dati non validi"),
     *     @OA\Response(response=401, description="Non autenticato")
     * )
     */
    public static function create()
    {
        // Implementazione del metodo per creare un nuovo ordine
    }

    /**
     * @OA\Get(
     *     path="/api/v1/orders/{id}",
     *     summary="Mostra un ordine specifico",
     *     tags={"Orders"},
     *     security={{"sanctumAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string", format="uuid"),
     *         description="ID dell'ordine"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Dettagli dell'ordine",
     *         @OA\JsonContent(ref="#/components/schemas/OrderResource")
     *     ),
     *     @OA\Response(response=401, description="Non autenticato"),
     *     @OA\Response(response=404, description="Ordine non trovato")
     * )
     */
    public static function show($id)
    {
        // Implementazione del metodo per mostrare un ordine specifico
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/orders/{id}",
     *     summary="Elimina un ordine",
     *     tags={"Orders"},
     *     security={{"sanctumAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string", format="uuid"),
     *         description="UUID dell'ordine da eliminare"
     *     ),
     *     @OA\Response(response=200, description="Ordine eliminato con successo"),
     *     @OA\Response(response=401, description="Non autenticato"),
     *     @OA\Response(response=404, description="Ordine non trovato")
     * )
     */
    public static function destroy($id)
    {
        // Implementazione del metodo per eliminare un ordine
    }
}
