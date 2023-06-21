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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
