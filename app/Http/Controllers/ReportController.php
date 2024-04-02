<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Models\Incomes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{

    public function index(Request $request)
    {
        $title = 'Duit Saku';
        $user = Auth::user();
        $userDetails = $user->userDetails;
        $year = $request->input('year');
        $month = $request->input('month');
        $incomeReport = Incomes::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->sum('amount');
        $expensesReport = Expenses::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->sum('amount');

        return view('pages.reports.index', compact(
            'title',
            'userDetails',
            'incomeReport',
            'expensesReport'
        ));
    }

    public function store(Request $request)
    {
        $title = 'Duit Saku';
        $user = Auth::user();
        $userDetails = $user->userDetails;

        $year = $request->input('year');
        $month = $request->input('month');

        $incomeReport = Incomes::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->sum('amount');
        $expensesReport = Expenses::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->sum('amount');

        return view('pages.reports.index', compact(
            'title',
            'userDetails',
            'incomeReport',
            'expensesReport'
        ));
    }
}
