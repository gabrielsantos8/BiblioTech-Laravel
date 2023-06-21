<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Exception;
use Illuminate\Http\Request;

class CursoController extends Controller
{

    public function store(Request $request)
    {
        try {
            $curso = new Curso();
            $curso->nome = $request->nome;
            $curso->coordenador = $request->coordenador;
            $curso->duracao = $request->duracao;
            if ($curso->save()) {
                return response()->json(['success' => true, 'message' => "Curso cadastrado!", 'dados' => $curso], 200);
            }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function list()
    {
        $cursos = Curso::all();
        return response()->json(['success' => true, 'message' => "", "dados" => $cursos], 200);
    }

    public function show(string $id)
    {
        $curso = Curso::find($id);
        return response()->json(['success' => true, 'message' => !empty($curso) ? "" : "Curso não encontrado!", "dados" => $curso], !empty($curso) ? 200 : 404);
    }


    public function update(Request $request)
    {
        try {
            $dados = $request->except('id');
            $curso = Curso::find($request->id);
            $curso->update($dados);
            return response()->json(['success' => true, 'message' => 'Curso Atualizado!'], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function destroy(Request $request)
    {
        try {
            $curso = Curso::find($request->id);
            $curso->delete();
            return response()->json(['success' => true, 'message' => "Curso Excluído!"], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
