<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = Customer::count();
        $totalRevenue = 2000; // Replace this with actual calculation
        return view('dashboard', compact('totalUsers', 'totalRevenue'));
    }
}
