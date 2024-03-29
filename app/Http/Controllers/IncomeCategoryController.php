<?php

namespace App\Http\Controllers;

use App\Models\IncomeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Duit Saku';
        $user = Auth::user();
        $userDetails = $user->userDetails;
        $incomeCategories = IncomeCategory::all();
        return view('pages.IncomeCategory.index', compact('title', 'userDetails', 'incomeCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Duit Saku';
        $user = Auth::user();
        $userDetails = $user->userDetails;

        return view('pages.IncomeCategory.create', compact('title', 'userDetails'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:20',
            'description' => 'nullable',
        ], [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must be at least 3 characters.',
            'name.max' => 'The name may not be greater than 20 characters.',
        ]);

        try {
            IncomeCategory::create($request->all());
            return redirect()->route('IncomeCategory')->with('success', 'Income category created successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'Failed to create activity: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(IncomeCategory $incomeCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IncomeCategory $incomeCategory)
    {
        $title = 'Duit Saku';
        $user = Auth::user();
        $userDetails = $user->userDetails;

        return view('pages.IncomeCategory.edit', compact('title', 'userDetails', 'incomeCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IncomeCategory $incomeCategory)
    {
        $request->validate([
            'name' => 'required|min:3|max:20',
            'description' => 'nullable',
        ], [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must be at least 3 characters.',
            'name.max' => 'The name may not be greater than 20 characters.',
        ]);

        try {
            $incomeCategory->update($request->all());
            return redirect()->route('IncomeCategory')->with('success', 'Income category updated successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'Failed to create activity: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IncomeCategory $incomeCategory)
    {
        try {
            $incomeCategory->delete();
            return response()->json(['message' => 'Incomes category deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete the record'], 500);
        }
    }
}
