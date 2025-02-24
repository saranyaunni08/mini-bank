<?php

namespace App\Http\Controllers\Api;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function transaction(Request $request)
    {
        $request->validate([
            'type' => 'required|in:credit,debit',
            'amount' => 'required|numeric|min:1',
        ]);

        $customer = $request->user();
        $type = $request->type;
        $amount = $request->amount;

        if ($type == 'debit') {
            $todayTransactions = Transaction::where('customer_id', $customer->id)
                ->whereDate('created_at', today())
                ->where('type', 'debit')
                ->count();

            if ($todayTransactions >= 5) {
                return response()->json(['message' => 'Transaction limit exceeded'], 403);
            }

            if ($customer->balance < $amount) {
                return response()->json(['message' => 'Insufficient balance'], 400);
            }

            $customer->balance -= $amount;
        } else {
            $customer->balance += $amount;
        }

        $customer->save();

        $transaction = Transaction::create([
            'customer_id' => $customer->id,
            'type' => $type,
            'amount' => $amount,
        ]);

        return response()->json(['message' => ucfirst($type) . ' successful', 'transaction' => $transaction]);
    }
}
