<?php

namespace App\Swagger;

use OpenApi\Annotations as OA;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         title="API Orders",
 *         description="Effettuando la chiamata `POST /api/v1/login`, il token della risposta verrà salvato automaticamente e utilizzato per autenticare le richieste protette.",
 *         version="1.0.0",
 *     ),
 *     @OA\Components(
 *         @OA\SecurityScheme(
 *             securityScheme="sanctumAuth",
 *             type="http",
 *             scheme="bearer"
 *         )
 *     )
 * )
 */
class OpenApi {}
