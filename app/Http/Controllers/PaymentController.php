<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Utliza o método GET
        $payments = Payment::all();

        return response()->json($payments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Utiliza o método Post
        $validated = $request->validate([
            "amount" => 'required|integer|min:1',
            "status" => 'in:pending,approved,failed',
        ]);

            // Adiciona um ID para transação (transaction_id)
            $validated['transaction_id'] = Str::uuid();

            // Salva no banco
            $payment = Payment::create($validated);

            // Retorna o Json
            return response()->json($payment, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //Route Model Binding já entende que estou buscando um por um e já faz
        //esse filtro automaticamente so preciso retornar o Json
        return response()->json($payment);
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
