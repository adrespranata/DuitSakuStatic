<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Activity Based Costing';
        $user = Auth::user();
        $userDetails = $user->userDetails;
        return view('pages.dashboard', compact('title', 'userDetails'));
    }
}
