<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{
    public function store(Request $request)
    {
        try {
            $reserva = new Reserva();
            $reserva->aluno_id = $request->aluno_id;
            $reserva->livro_id = $request->livro_id;
            $reserva->datainicio = $request->datainicio;
            $reserva->datafim = $request->datafim;
            $reserva->observacao = $request->observacao;
            if ($reserva->save()) {
                return response()->json(['success' => true, 'message' => "Reserva cadastrada!", 'dados' => $reserva], 200);
            }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function list()
    {
        $reservas = DB::table('reservas')
        ->join('livros', 'reservas.livro_id', '=', 'livros.id')
        ->join('alunos', 'reservas.aluno_id', '=', 'alunos.id')
        ->select('reservas.*', 'livros.titulo as livro', 'alunos.nome as aluno')
        ->get();
        return response()->json(['success' => true, 'message' => "", "dados" => $reservas], 200);
    }

    public function show(string $id)
    {
        $reserva = Reserva::find($id);
        return response()->json(['success' => true, 'message' => !empty($reserva) ? "" : "Reserva não encontrada!", "dados" => $reserva], !empty($reserva) ? 200 : 404);
    }


    public function update(Request $request)
    {
        try {
            $dados = $request->except('id');
            $reserva = Reserva::find($request->id);
            $reserva->update($dados);
            return response()->json(['success' => true, 'message' => 'Reserva Atualizada!'], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function destroy(Request $request)
    {
        try {
            $reserva = Reserva::find($request->id);
            $reserva->delete();
            return response()->json(['success' => true, 'message' => "Reserva Excluída!"], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
