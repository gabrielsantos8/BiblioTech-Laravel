<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LivroController extends Controller
{
    public function list(int $idtipo, int $aluno_id)
    {
        $query = "SELECT 
                         l.*
                        ,a.nome as autor
                        ,e.nome as editora
                  FROM livros l 
                  LEFT JOIN autors a on a.id = l.autor_id
                  LEFT JOIN editoras e on e.id = l.editora_id
                  WHERE CASE WHEN ? = 1 THEN NOT EXISTS (select 1 from reservas r where r.aluno_id = ? and r.livro_id = l.id)
                             WHEN ? = 2 THEN EXISTS (select 1 from reservas r where r.aluno_id = ? and r.livro_id = l.id)
                        END";
        $bindings = [$idtipo, $aluno_id, $idtipo, $aluno_id];
        $livros = DB::select($query, $bindings);
        return response()->json(['success' => true, 'message' => count($livros) > 0 ? "" : "Nenhum livro reservado!", "dados" => $livros], count($livros) > 0 ? 200 : 404);
    }

    public function show(string $id)
    {
        $livro = DB::table('livros')
            ->join('autors', 'livros.autor_id', '=', 'autors.id')
            ->join('editoras', 'livros.editora_id', '=', 'editoras.id')
            ->select('livros.*', 'autors.nome as autor', 'autors.id as autor_id', 'editoras.nome as editora', 'editoras.id as editora_id')
            ->where([['livros.id', '=', $id]])
            ->get();
        return response()->json(['success' => true, 'message' => $livro->count() > 0 ? "" : "Livro não encontrado!", "dados" => $livro],  $livro->count() > 0 ? 200 : 404);
    }

    public function store(Request $request)
    {
        try {
            $livro = new Livro();
            $livro->titulo = $request->titulo;
            $livro->subtitulo = $request->subtitulo;
            $livro->isbn = $request->isbn;
            $livro->autor_id = $request->autor_id;
            $livro->editora_id = $request->editora_id;
            $livro->local = $request->local;
            $livro->ano = $request->ano;

            if ($livro->save()) {
                return response()->json(['success' => true, 'message' => "Livro cadastrado!", 'dados' => $livro], 200);
            }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $dados = $request->except('id');
            $livro = Livro::find($request->id);
            $livro->update($dados);
            return response()->json(['success' => true, 'message' => "Livro Atualizado!", 'dados' => $livro], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $livro = Livro::find($request->id);
            $livro->delete();
            return response()->json(['success' => true, 'message' => "Livro Excluído!"], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
