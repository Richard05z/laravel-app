<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class TransactionController extends Controller
{
    public function getTransactions()
    {

        $transactions = Transaction::all(); // Devuelve todos los registros de la tabla

        return response()->json($transactions, 200); // Retorna la lista de usuarios y le agrega el status 200 a la respuesta
    }

    public function createTransaction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'from' => 'required',
            'to' => 'required',
            'amount' => 'required',
            'currency' => 'required|in:USD,CUP,MLC',
            'notification_url' => 'required'
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
        $transaction = Transaction::create([
            'order_id' => $request->order_id,
            'from' => $request->from,
            'to' => $request->to,
            'amount' => $request->amount,
            'currency' => $request->currency,
        ]);

        if (!$transaction) {
            $data = [
                'message' => 'Error al crear la transacción',
                'status' => 500
            ];

            return response()->json($data, 500);
        }

        $data = [
            'order_id' => $request->order_id,
            'status' => 201,
            'success' => true,
            'error' => false
        ];

        $notification_url = $request->notification_url;

        $response = Http::post($notification_url, $data);

        return response()->json($data, 201);
    }
}
