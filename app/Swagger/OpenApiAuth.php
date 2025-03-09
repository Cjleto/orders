<?php

namespace App\Swagger;

use App\Swagger\OpenApi;
class OpenApiAuth extends OpenApi
{

    /**
     * @OA\Post(
     *     path="/api/v1/login",
     *     summary="Effettua il login e ottiene il token",
     *     description="Effettua il login dell'utente e restituisce un token che può essere utilizzato per tutte le richieste successive.",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email", example="admin@admin.com"),
     *             @OA\Property(property="password", type="string", format="password", example="Qwerty7-")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successo: restituisce il token",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string", example="1|abc123xyz456")
     *         )
     *     ),
     *     @OA\Response(response=401, description="Credenziali errate")
     * )
     */
    public static function login(){}

    /**
     * @OA\Post(
     *     path="/api/v1/logout",
     *     summary="Effettua il logout",
     *     description="Effettua il logout dell'utente e invalida il token.",
     *     security={{"sanctumAuth":{}}},
     *     tags={"Auth"},
     *     @OA\Response(
     *         response=200,
     *         description="Successo: logout effettuato"
     *     ),
     *     @OA\Response(response=401, description="Token non valido o mancante")
     * )
     */
    public static function logout (){}

}
