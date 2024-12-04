<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

// use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function index(): JsonResponse
    {
        $users = User::orderBy('id', 'DESC')->paginate(10);

        return response()->json([
            'status' => true,
            'users' => $users
        ], 200);
    }

    /**
     *
     * @param \App\Models\User
     * @return \Illuminate\Http\JsonResponse
     */

    public function show(User $user): JsonResponse
    {
        return response()->json([
            'status' => true,
            'user' => $user
        ], 200);
    }

    /**
     *
     * @param \App\Models\User
     * @return \Illuminate\JsonResponse
     */

    public function store(UserRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Success',
                'user' => $user
            ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Erro ao cadastrar usuário.'
            ], 400);
            // throw $th;
        }
    }

    /**
     *
     *
     *
     */
    public function update(UserRequest $request, User $user): JsonResponse
    {

        DB::beginTransaction();

        try {

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Usuário atuallizado com sucesso',
                'user' => $user
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Erro ao editar usuário.'
            ], 400);
        }
        return response()->json([]);
    }

    /**
     *
     *
     *
     */
    public function destroy(User $user): JsonResponse
    {

        try {

            $user->delete($user->id);

            return response()->json([
                'status' => true,
                'message' => 'Usuário apagado com sucesso'
            ]);
        } catch (\Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => 'Erro ao apagar usuário'
            ], 400);
        }
    }
}
