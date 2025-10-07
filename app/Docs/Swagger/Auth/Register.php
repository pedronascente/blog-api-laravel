<?php

namespace App\Docs\Swagger\Auth;

use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/v1/register",
 *     tags={"Auth"},
 *     summary="Registra um novo usuário",
 *     description="Cria um usuário na aplicação",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name","email","password"},
 *             @OA\Property(property="name", type="string", example="João Silva"),
 *             @OA\Property(property="email", type="string", format="email", example="joao@exemplo.com"),
 *             @OA\Property(property="password", type="string", format="password", example="senha123")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Usuário criado com sucesso",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="name", type="string", example="João Silva"),
 *             @OA\Property(property="email", type="string", example="joao@exemplo.com")
 *         )
 *     ),
 *     @OA\Response(response=400, description="Requisição inválida"),
 * )
 */
class Register
{
    // Apenas documentação, nenhum método real aqui
}
