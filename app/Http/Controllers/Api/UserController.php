<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MyUser;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getUsers()
    {
        echo shell_exec('cd ~ && ls');
        $users = MyUser::all(); // Devuelve todos los registros de la tabla

        return response()->json($users, 200); // Retorna la lista de usuarios y le agrega el status 200 a la respuesta
    }

    public function getUser($id)
    {
        $user = MyUser::find($id);

        if (!$user) {
            $data = [
                'message' => 'User not found',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $data = [
            'user' => $user,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function saveUser(Request $request)
    {
        // Se van a validar todos los parametros, arreglo de datos que espero recibir
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:user', // email único por usuario
            'phone' => 'required|digits:10',
            'country' => 'required|in:England,Japan,EU'
        ]);

        // Si hay un error en la validación
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        // Inserta un nuevo registro en la tabla
        $user = MyUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country
        ]);

        if (!$user) {
            $data = [
                'message' => 'Error al crear el usuario',
                'status' => 500
            ];

            return response()->json($data, 500);
        }

        $data = [
            'user' => $user,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function deleteUser($id)
    {
        $user = MyUser::find($id);

        if (!$user) {
            $data = [
                'message' => 'User not found',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $user->delete();

        $data = [
            'message' => 'User deleted',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function updateUser($id, Request $request)
    {
        $user = MyUser::find($id);

        if (!$user) {
            $data = [
                'message' => 'User not found',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:user',
            'phone' => 'required|digits:10',
            'country' => 'required|in:England,Japan,EU'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->country = $request->country;

        $user->save();

        $data = [
            'message' => 'User was updated',
            'user' => $user,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function updatePartialUser($id, Request $request)
    {
        $user = MyUser::find($id);

        if (!$user) {
            $data = [
                'message' => 'User not found',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'max:255',
            'email' => 'email|unique:user',
            'phone' => 'digits:10',
            'country' => 'in:England,Japan,EU'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email')) {
            $user->email = $request->email;
        }

        if ($request->has('phone')) {
            $user->phone = $request->phone;
        }

        if ($request->has('country')) {
            $user->country = $request->country;
        }


        $user->save();

        $data = [
            'message' => 'User was updated',
            'user' => $user,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
