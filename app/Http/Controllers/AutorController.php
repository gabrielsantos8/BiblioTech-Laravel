<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Exception;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function store(Request $request)
    {
        try {
            $autor = new Autor();
            $autor->nome = $request->nome;
            $autor->endereco = $request->endereco;
            $autor->uf = $request->uf;
            $autor->cidade = $request->cidade;
            $autor->telefone = $request->telefone;
            if ($autor->save()) {
                return response()->json(['success' => true, 'message' => "Autor cadastrado!", 'dados' => $autor], 200);
            }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function list()
    {
        $autores = Autor::all();
        return response()->json(['success' => true, 'message' => "", "dados" => $autores], 200);
    }

    public function show(string $id)
    {
        $autor = Autor::find($id);
        return response()->json(['success' => true, 'message' => !empty($autor) ? "" : "Autor não encontrado!", "dados" => $autor], !empty($autor) ? 200 : 404);
    }


    public function update(Request $request)
    {
        try {
            $dados = $request->except('id');
            $autor = Autor::find($request->id);
            $autor->update($dados);
            return response()->json(['success' => true, 'message' => 'Autor Atualizado!'], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function destroy(Request $request)
    {
        try {
            $autor = Autor::find($request->id);
            $autor->delete();
            return response()->json(['success' => true, 'message' => "Autor Excluído!"], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
