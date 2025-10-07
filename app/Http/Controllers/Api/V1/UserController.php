<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Resources\Api\V1\UserResource;
use App\Http\Requests\Api\V1\UpdateUserRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $users = User::all();
        return UserResource::collection($users);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        // Dados validados
        $data = $request->validated();

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        
        $user->update($data);

        return new UserResource($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Usuário deletado com sucesso']);
    }

    public function me()
    {
        return new UserResource(auth('api')->user());
    }
}
