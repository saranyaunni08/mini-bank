<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $customers = Customer::with('transactions')->get(); // Load transactions for count
        return view('customers', compact('customers')); // Pass $customers to the view
    }
    

    public function credit(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|min:1',
        ]);

        $transaction = Transaction::create([
            'customer_id' => $request->customer_id,
            'amount' => $request->amount,
            'type' => 'credit',
        ]);

        return response()->json(['message' => 'Amount credited successfully', 'transaction' => $transaction], 200);
    }

    // Debit API with 5 transactions/day limit
    public function debit(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|min:1',
        ]);

        $customer = Customer::find($request->customer_id);
        
        // Check balance
        $totalCredit = Transaction::where('customer_id', $request->customer_id)
            ->where('type', 'credit')
            ->sum('amount');

        $totalDebit = Transaction::where('customer_id', $request->customer_id)
            ->where('type', 'debit')
            ->sum('amount');

        $balance = $totalCredit - $totalDebit;

        if ($request->amount > $balance) {
            return response()->json(['message' => 'Insufficient balance'], 400);
        }

        // Check transaction limit (max 5 per day)
        $todayDebitCount = Transaction::where('customer_id', $request->customer_id)
            ->where('type', 'debit')
            ->whereDate('created_at', Carbon::today())
            ->count();

        if ($todayDebitCount >= 5) {
            return response()->json(['message' => 'Transaction limit reached (5 per day)'], 400);
        }

        $transaction = Transaction::create([
            'customer_id' => $request->customer_id,
            'amount' => $request->amount,
            'type' => 'debit',
        ]);

        return response()->json(['message' => 'Amount debited successfully', 'transaction' => $transaction], 200);
    }
    
    public function create(Customer $customer)
    {
        return view('transaction', compact('customer'));
    }

    public function store(Request $request, Customer $customer)
    {
        $request->validate([
            'type' => 'required|in:credit,debit',
            'amount' => 'required|numeric|min:1',
        ]);

        $amount = $request->amount;
        $type = $request->type;

        if ($type === 'debit' && $customer->balance < $amount) {
            return back()->with('error', 'Insufficient balance for this transaction.');
        }

        if ($type === 'debit') {
            $customer->balance -= $amount;
        } else {
            $customer->balance += $amount;
        }

        $customer->save();

        Transaction::create([
            'customer_id' => $customer->id,
            'type' => $type,
            'amount' => $amount,
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', ucfirst($type) . " of $".$amount." was successful.");
    }
    public function transaction(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'type' => 'required|in:credit,debit',
        ]);

        $user = Auth::user();
        $today = Carbon::now()->toDateString();

        // Check for debit transaction limit (5 per day)
        if ($request->type === 'debit') {
            $dailyDebits = Transaction::where('user_id', $user->id)
                ->where('type', 'debit')
                ->whereDate('created_at', $today)
                ->count();

            if ($dailyDebits >= 5) {
                return response()->json([
                    'message' => 'Transaction limit exceeded. Only 5 debit transactions are allowed per day.'
                ], 403);
            }
        }

        // Store the transaction
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'type' => $request->type,
        ]);

        return response()->json([
            'message' => 'Transaction successful',
            'transaction' => $transaction
        ], 201);
    }

}
