<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function list()
    {
        $users = User::all();
        return response()->json(['success' => true, 'message' => "", "dados" => $users], 200);
    }

    public function show(string $id)
    {
        $user = User::find($id);
        return response()->json(['success' => true, 'message' => !empty($user) ? "" : "Usuário não encontrado!", "dados" => $user], !empty($user) ? 200 : 404);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            $user = User::where('email', '=', $credentials['email'])->get();
            return response()->json(['success' => true, 'message' => "Usuário autenticado!", 'dados' => $user], 200);
        }
        return response()->json(['success' => false, 'message' => "Usuário não autenticado!"], 404);
    }

    public function store(Request $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            if ($user->save()) {
                return response()->json(['success' => true, 'message' => "Usuário cadastrado!", 'dados' => $user], 200);
            }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $user = User::find($request->id);
            $user->update(['name' => $request->name, 'email' => $request->email, 'password' => bcrypt($request->password)]);
            return response()->json(['success' => true, 'message' => "Usuário Atualizado!", 'dados' => $user], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $user = User::find($request->id);
            $user->delete();
            return response()->json(['success' => true, 'message' => "Usuário Excluído!"], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
