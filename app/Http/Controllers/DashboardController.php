<?php

namespace App\Http\Controllers;

use App\Models\IncomeCategory;
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

    public function getIncomesPerMonth()
    {
        // Query untuk mengambil total pendapatan per bulan
        $incomesPerMonth = Incomes::select(DB::raw('YEAR(date) as year, DATE_FORMAT(date, "%M") as month'), DB::raw('SUM(amount) as total'))
            ->groupBy('year', 'month')
            ->get();

        return response()->json($incomesPerMonth);
    }

    public function getIncomeByCategory()
    {
        // Mengambil total seuluruh kategori
        $totalByCategory = Incomes::select('category_id', DB::raw('COUNT(*) as total'))
            ->groupBy('category_id')
            ->get();

        return response()->json($totalByCategory);
    }

    public function getCategoryName($categoryId)
    {
        $category = IncomeCategory::find($categoryId);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        return response()->json(['name' => $category->name]);
    }
}
