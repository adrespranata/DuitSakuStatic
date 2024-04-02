<?php

namespace App\Http\Controllers;

use App\Models\IncomeCategory;
use App\Models\Incomes;
use App\Models\Incomess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Duit Saku';
        $user = Auth::user();
        $userDetails = $user->userDetails;
        $incomes = Incomes::with('category')
        ->orderBy('date', 'desc') 
        ->get();
        return view('pages.incomes.index', compact('title', 'userDetails', 'incomes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Duit Saku';
        $user = Auth::user();
        $userDetails = $user->userDetails;
        $incomeCategory = IncomeCategory::all();
        return view('pages.incomes.create', compact('title', 'userDetails', 'incomeCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge(['amount' => str_replace('.', '', $request->amount)]);
        
        $request->validate([
            'category_id' => 'required|exists:income_categories,id',
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ], [
            'category_id.required' => 'The income category field is required.',
            'date.required' => 'The date field is required.',
            'date.date' => 'The date must be a valid date.',
            'amount.required' => 'The amount field is required.',
            'amount.numeric' => 'The amount must be a number.',
            'amount.min' => 'The amount must be at least 0.',
        ]);

        try {
            Incomes::create($request->all());
            return redirect()->route('Incomes')->with('success', 'Incomes created successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'Failed to create activity: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Incomes $incomes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Incomes $incomes)
    {
        $title = 'Duit Saku';
        $user = Auth::user();
        $userDetails = $user->userDetails;
        $incomeCategory = IncomeCategory::all();
        $incomes = Incomes::with('category')->findOrFail($incomes->id);
        return view('pages.incomes.edit', compact('title', 'userDetails', 'incomeCategory', 'incomes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Incomes $incomes)
    {
        $request->merge(['amount' => str_replace('.', '', $request->amount)]);

        $request->validate([
            'category_id' => 'required|exists:income_categories,id',
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
        ], [
            'category_id.required' => 'The income category field is required.',
            'date.required' => 'The date field is required.',
            'date.date' => 'The date must be a valid date.',
            'amount.required' => 'The amount field is required.',
            'amount.numeric' => 'The amount must be a number.',
        ]);

        try {
            $incomes->update($request->all());
            return redirect()->route('Incomes')->with('success', 'Incomes updated successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'Failed to create incomes: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Incomes $incomes)
    {
        try {
            $incomes->delete();
            return response()->json(['message' => 'Incomes deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete the record'], 500);
        }
    }
}
