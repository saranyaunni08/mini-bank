<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Credit API
     */
    public function credit(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|min:1'
        ]);

        $customer = Customer::find($request->customer_id);
        $customer->balance += $request->amount;
        $customer->save();

        // Store transaction
        Transaction::create([
            'customer_id' => $customer->id,
            'type' => 'credit',
            'amount' => $request->amount,
        ]);

        return response()->json([
            'message' => 'Amount credited successfully!',
            'balance' => $customer->balance
        ], 200, [], JSON_NUMERIC_CHECK);
        
    }

    /**
     * Debit API with transaction limit
     */
    public function debit(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|min:1'
        ]);

        $customer = Customer::find($request->customer_id);

        // Check if customer has enough balance
        if ($customer->balance < $request->amount) {
            return response()->json([
                'message' => 'Insufficient balance!'
            ], 400);
        }

        // Check daily transaction limit
        $today = Carbon::today();
        $transactionCount = Transaction::where('customer_id', $customer->id)
            ->where('type', 'debit')
            ->whereDate('created_at', $today)
            ->count();

        if ($transactionCount >= 5) {
            return response()->json([
                'message' => 'Daily debit transaction limit reached (Max: 5 per day).'
            ], 400);
        }

        // Deduct amount
        $customer->balance -= $request->amount;
        $customer->save();

        // Store transaction
        Transaction::create([
            'customer_id' => $customer->id,
            'type' => 'debit',
            'amount' => $request->amount,
        ]);

        return response()->json([
            'message' => 'Amount debited successfully!',
            'balance' => $customer->balance
        ], 200);
    }
}
