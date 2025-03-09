<?php

namespace App\Swagger;

use App\Swagger\OpenApi;
class OpenApiProduct extends OpenApi
{

    /**
     * @OA\Get(
     *     path="/api/v1/products",
     *     summary="Lista dei prodotti",
     *     tags={"Products"},
     *     security={{"sanctumAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Lista prodotti",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/ProductResource"))
     *     ),
     *     @OA\Response(response=401, description="Non autenticato"),
     * )
     */
    public static function index(){}


    /**
     * @OA\Post(
     *    path="/api/v1/products",
     *    summary="Crea un nuovo prodotto",
     *    tags={"Products"},
     *    security={{"sanctumAuth":{}}},
     *    @OA\RequestBody(
     *        required=true,
     *        @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *                required={"name", "price", "description", "stock"},
     *                @OA\Property(property="name", type="string", example="Pizza Margherita", minLength=2, maxLength=55),
     *                @OA\Property(property="price", type="number", format="float", example=9.99),
     *                @OA\Property(property="description", type="string", example="Deliziosa pizza con pomodoro e mozzarella", minLength=2),
     *                @OA\Property(property="stock", type="integer", example=100),
     *                @OA\Property(
     *                    property="photo",
     *                    type="string",
     *                    format="binary",
     *                    description="File immagine del prodotto"
     *                )
     *            )
     *        )
     *    ),
     *    @OA\Response(
     *        response=201,
     *        description="Prodotto creato",
     *        @OA\JsonContent(ref="#/components/schemas/ProductResource")
     *    ),
     *    @OA\Response(response=400, description="Dati non validi"),
     *    @OA\Response(response=401, description="Non autenticato"),
     * )
     */
    public static function store(){}


    /**
    * @OA\Get(
    *     path="/api/v1/products/{id}",
    *     summary="Mostra un prodotto",
    *     tags={"Products"},
    *     security={{"sanctumAuth":{}}},
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         required=true,
    *         @OA\Schema(type="integer"),
    *         description="ID del prodotto"
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Dettagli del prodotto",
    *         @OA\JsonContent(ref="#/components/schemas/ProductResource")
    *     ),
    *     @OA\Response(response=404, description="Prodotto non trovato"),
    *     @OA\Response(response=401, description="Non autenticato"),
    * )
     */
    public static function show(){}


    /**
     * @OA\Put(
     *     path="/api/v1/products/{id}",
     *     summary="Aggiorna un prodotto",
     *     tags={"Products"},
     *     security={{"sanctumAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID del prodotto"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"name", "price", "description", "stock"},
     *                 @OA\Property(property="name", type="string", example="Pizza Margherita", minLength=2, maxLength=55),
     *                 @OA\Property(property="price", type="number", format="float", example=9.99),
     *                 @OA\Property(property="description", type="string", example="Deliziosa pizza con pomodoro e mozzarella", minLength=2),
     *                 @OA\Property(property="stock", type="integer", example=100),
     *                 @OA\Property(
     *                     property="newPhoto",
     *                     type="string",
     *                     format="binary",
     *                     nullable=true,
     *                     description="Nuova immagine del prodotto (facoltativa)"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Prodotto aggiornato",
     *         @OA\JsonContent(ref="#/components/schemas/ProductResource")
     *     ),
     *     @OA\Response(response=400, description="Dati non validi"),
     *     @OA\Response(response=404, description="Prodotto non trovato"),
     *     @OA\Response(response=401, description="Non autenticato"),
     * )
     */
    public static function update(){}

    /**
     * @OA\Delete(
     *     path="/api/v1/products/{id}",
     *     summary="Elimina un prodotto",
     *     tags={"Products"},
     *     security={{"sanctumAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID del prodotto"
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Prodotto eliminato"
     *     ),
     *     @OA\Response(response=404, description="Prodotto non trovato"),
     *     @OA\Response(response=401, description="Non autenticato"),
     * )
     */
    public static function destroy(){}
}
