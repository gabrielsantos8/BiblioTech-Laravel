<?php

namespace App\Http\Controllers;

use App\Models\Editora;
use Exception;
use Illuminate\Http\Request;

class EditoraController extends Controller
{
    public function store(Request $request)
    {
        try {
            $editora = new Editora();
            $editora->nome = $request->nome;
            $editora->endereco = $request->endereco;
            $editora->uf = $request->uf;
            $editora->cidade = $request->cidade;
            $editora->telefone = $request->telefone;
            if ($editora->save()) {
                return response()->json(['success' => true, 'message' => "Editora cadastrada!", 'dados' => $editora], 200);
            }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function list()
    {
        $editoras = Editora::all();
        return response()->json(['success' => true, 'message' => "", "dados" => $editoras], 200);
    }

    public function show(string $id)
    {
        $editora = Editora::find($id);
        return response()->json(['success' => true, 'message' => !empty($editora) ? "" : "Editora não encontrada!", "dados" => $editora], !empty($editora) ? 200 : 404);
    }


    public function update(Request $request)
    {
        try {
            $dados = $request->except('id');
            $editora = Editora::find($request->id);
            $editora->update($dados);
            return response()->json(['success' => true, 'message' => 'Editora Atualizada!'], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function destroy(Request $request)
    {
        try {
            $editora = Editora::find($request->id);
            $editora->delete();
            return response()->json(['success' => true, 'message' => "Editora Excluída!"], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
