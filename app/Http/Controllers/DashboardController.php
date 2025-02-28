<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class DashboardController extends Controller
{
    public function index()
    {
        $customers = Customer::withCount('transactions')->get();
        $totalCustomers = Customer::count();
        $totalRevenue = Customer::sum('balance'); // Assuming 'balance' is the column storing the customer's balance

        return view('index', compact('customers','totalCustomers','totalRevenue')); // Matches `customers.blade.php`
    }
}
