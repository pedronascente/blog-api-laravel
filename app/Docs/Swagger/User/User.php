<?php

namespace App\Docs\Swagger\User;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/v1/users",
 *     tags={"User"},
 *     summary="Lista usuários",
 *     description="Retorna todos os usuários cadastrados",
 *     @OA\Response(
 *         response=200,
 *         description="Lista de usuários",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="João Silva"),
 *                 @OA\Property(property="email", type="string", example="joao@exemplo.com")
 *             )
 *         )
 *     )
 * )
 */
class User
{
    // Apenas documentação
}
