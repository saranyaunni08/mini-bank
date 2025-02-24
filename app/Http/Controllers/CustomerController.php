<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::withCount('transactions')->get();
        $totalCustomers = Customer::count();
        $totalRevenue = Customer::sum('balance'); // Assuming 'balance' is the column storing the customer's balance

        return view('customers', compact('customers','totalCustomers','totalRevenue')); // Matches `customers.blade.php`
    }

    public function create()
    {
        return view('add-customer'); // Matches `add-customer.blade.php`
    }

    public function store(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:customers,email',
        'phone' => 'required|string|max:20',
    ]);

    Customer::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'phone' => $request->phone,
    ]);

    return redirect()->back()->with('success', 'Customer added successfully!');
}

    public function show($id)
    {
        $customer = Customer::with('transactions')->findOrFail($id);
        return view('customers', compact('customer'));
    }
}
