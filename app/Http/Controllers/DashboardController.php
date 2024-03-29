<?php

namespace App\Http\Controllers;

use App\Models\Incomes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Duit Saku';
        $user = Auth::user();
        $userDetails = $user->userDetails;

        // Ambil total pendapatan dari semua entri pendapatan
        $incomes = Incomes::sum('amount');

        return view('pages.dashboard', compact(
            'title',
            'userDetails',
            'incomes'
        ));
    }
}
