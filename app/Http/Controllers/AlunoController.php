<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Normalizer\UniqueSlugNormalizer;

class AlunoController extends Controller
{

    public function login(string $ra)
    {
        $aluno = DB::table('alunos')
            ->join('cursos', 'alunos.curso_id', '=', 'cursos.id')
            ->select('alunos.*', 'cursos.nome as curso', 'cursos.id')
            ->where([['ra', '=', $ra]])
            ->get();
        return response()->json(['success' => true, 'message' => $aluno->count() > 0 ? "" : "Aluno não encontrado!", "dados" => $aluno], !empty($aluno) ? 200 : 404);
    }

    public function list()
    {
        $alunos = DB::table('alunos')
            ->join('cursos', 'alunos.curso_id', '=', 'cursos.id')
            ->select('alunos.*', 'cursos.nome as curso', 'cursos.id')
            ->get();
        return response()->json(['success' => true, 'message' => "", "dados" => $alunos], 200);
    }

    public function show(string $id)
    {
        $aluno = DB::table('alunos')
            ->join('cursos', 'alunos.curso_id', '=', 'cursos.id')
            ->select('alunos.*', 'cursos.nome as curso', 'cursos.id')
            ->where([['alunos.id', '=', $id]])
            ->get();
        return response()->json(['success' => true, 'message' => $aluno->count() > 0 ? "" : "Aluno não encontrado!", "dados" => $aluno], !empty($aluno) ? 200 : 404);
    }

    public function store(Request $request)
    {
        try {
            $aluno = new Aluno();
            $aluno->nome = $request->nome;
            $aluno->ra = $request->ra;
            $aluno->endereco = $request->endereco;
            $aluno->cidade = $request->cidade;
            $aluno->uf = $request->uf;
            $aluno->telefone = $request->telefone;
            $aluno->curso_id = $request->curso_id;

            if ($aluno->save()) {
                return response()->json(['success' => true, 'message' => "Aluno cadastrado!", 'dados' => $aluno], 200);
            }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $dados = $request->except('id');
            $aluno = Aluno::find($request->id);
            $aluno->update($dados);
            return response()->json(['success' => true, 'message' => "Aluno Atualizado!", 'dados' => $aluno], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $aluno = Aluno::find($request->id);
            $aluno->delete();
            return response()->json(['success' => true, 'message' => "Aluno Excluído!"], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
