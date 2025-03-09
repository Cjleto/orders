<?php

namespace App\Swagger;

use App\Swagger\OpenApi;
class OpenApiCustomer extends OpenApi
{

    /**
     * @OA\Get(
     *     path="/api/v1/customers",
     *     summary="Lista dei clienti",
     *     tags={"Customers"},
     *     security={{"sanctumAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Lista clienti",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/CustomerResource"))
     *     ),
     *     @OA\Response(response=401, description="Non autenticato"),
     * )
     */
    public static function index(){}


    /**
     * @OA\Post(
     *     path="/api/v1/customers",
     *     summary="Memorizza un nuovo cliente",
     *     description="Questo metodo convalida la richiesta in arrivo, converte i dati convalidati in un Data Transfer Object (DTO) e quindi utilizza il servizio clienti per memorizzare il nuovo cliente. Infine, restituisce una risposta di successo con la risorsa del cliente appena creato.",
     *     operationId="storeCustomer",
     *     tags={"Customers"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreCustomer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/CustomerResource")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public static function store (){}


    /**
     * @OA\Get(
     *     path="/api/v1/customers/{id}",
     *     summary="Mostra un cliente",
     *     tags={"Customers"},
     *     security={{"sanctumAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID del cliente"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Dettagli cliente",
     *         @OA\JsonContent(ref="#/components/schemas/CustomerResource")
     *     ),
     *     @OA\Response(response=401, description="Non autenticato"),
     *     @OA\Response(response=404, description="Cliente non trovato")
     * )
     */
    public static function show(){}



    /**
     * @OA\Put(
     *     path="/api/v1/customers/{id}",
     *     summary="Aggiorna un cliente",
     *     tags={"Customers"},
     *     security={{"sanctumAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID del cliente"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateCustomer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operazione riuscita",
     *         @OA\JsonContent(ref="#/components/schemas/CustomerResource")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Non autenticato"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cliente non trovato"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Errore di validazione"
     *     )
     * )
     */
    public static function update(){}

    /**
     * @OA\Delete(
     *     path="/api/v1/customers/{id}",
     *     summary="Elimina un cliente",
     *     tags={"Customers"},
     *     security={{"sanctumAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID del cliente"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operazione riuscita"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Non autenticato"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cliente non trovato"
     *     )
     * )
     */
    public static function destroy(string $id){}
}
