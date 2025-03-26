<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransactionController extends Controller
{
    // Mostrar las transacciones pendientes
    public function index()
    {
        $transactions = Transaction::where('status', 'pendiente')->get();

        return view('admin.verify-transactions', compact('transactions'));
    }

    // Aceptar transacción
    public function accept(Transaction $transaction)
    {
        $transaction->status = 'completado';
        $transaction->save();

        $property = Property::find($transaction->property_id);
        $property->status = 'finalizado';
        $property->save();

        return redirect()->route('admin.verify-transactions')->with('success', 'Transacción completada y propiedad finalizada.');
    }

    // Cancelar transacción
    public function cancel(Transaction $transaction)
    {
        $transaction->delete();

        $property = Property::find($transaction->property_id);
        $property->status = 'disponible';
        $property->save();

        return redirect()->route('admin.verify-transactions')->with('success', 'Transacción cancelada y propiedad disponible.');
    }

    public function store(Property $property)
    {
        $userId = Auth::id();

        if ($property->status !== 'disponible') {
            return redirect()->route('properties.index')->with('error', 'Esta propiedad ya no está disponible.');
        }

        if ($property->user_id == $userId) {
            return redirect()->route('properties.index')->with('error', 'No puedes comprar o alquilar tu propia propiedad.');
        }

        DB::beginTransaction();

        try {
            Transaction::create([
                'property_id' => $property->id,
                'buyer_id' => $userId,
                'seller_id' => $property->user_id,
                'price' => $property->price,
                'transaction_date' => Carbon::now(),
                'type' => $property->type,
                'status' => 'pendiente',
            ]);

            $property->update(['status' => 'reservado']);

            DB::commit();

            return redirect()->route('properties.index')->with('success', 'Propiedad reservada con éxito. La transacción está pendiente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('properties.index')->with('error', 'Error al procesar la compra.');
        }
    }
}
