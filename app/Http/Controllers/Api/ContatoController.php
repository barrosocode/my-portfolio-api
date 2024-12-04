<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContatoRequest;
use App\Models\Contato;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ContatoController extends Controller
{
    public function store(ContatoRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {

            $contato = Contato::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'msg' => $request->msg
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Sucesso',
                'contato' => $contato
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Erro ao enviar mensagem'
            ]);
        }
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => 'Bem vindo à api'
        ]);
    }
}
