<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $user = User::all();
        return response()->json($user);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);
        return response()->json(['message' => 'Usuário criado com sucesso', 'user' => $user], 201);
    }

    public function show($id) {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|unique:users|max:255',
            'password' => 'string|min:6',
        ]);
    
        // Encontre o usuário pelo ID
        $user = User::findOrFail($id);
    
        // Verifique se o usuário existe
        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }
    
        // Atualize os dados do usuário com base nos dados validados
        $user->update($validatedData);
    
        // Retorne uma resposta adequada, por exemplo, um JSON com os dados do usuário atualizado
        return response()->json(['message' => 'Usuário atualizado com sucesso', 'user' => $user]);
        
    }

    public function destroy(String $id) {
        $user = User::findOrfail($id);
        $user->delete();

        return response()->json([],204);
    }
}
