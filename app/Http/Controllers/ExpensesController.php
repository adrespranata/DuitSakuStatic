<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use App\Models\Expenses;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Duit Saku';
        $user = Auth::user();
        $userDetails = $user->userDetails;
        $expenses = Expenses::with('category', 'paymentType')
            ->orderBy('date', 'desc')
            ->get();

        return view('pages.expenses.index', compact('title', 'userDetails', 'expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Duit Saku';
        $user = Auth::user();
        $userDetails = $user->userDetails;
        $expenseCategory = ExpenseCategory::all();
        return view('pages.expenses.create', compact('title', 'userDetails', 'expenseCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:expense_categories,id',
            // 'payment_type_id ' => 'required|exists:payment_types,id',
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ], [
            'category_id.required' => 'The expense category field is required.',
            // 'payment_type_id.required' => 'The payment type field is required.',
            // 'payment_type_id.exists' => 'The selected payment type is invalid.',
            'date.required' => 'The date field is required.',
            'date.date' => 'The date must be a valid date.',
            'amount.required' => 'The amount field is required.',
            'amount.numeric' => 'The amount must be a number.',
            'amount.min' => 'The amount must be at least 0.',
        ]);
        // dd($request->all());
        try {
            Expenses::create($request->all());
            return redirect()->route('Expenses')->with('success', 'Expenses created successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'Failed to create activity: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Expenses $expenses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expenses $expenses)
    {
        $title = 'Duit Saku';
        $user = Auth::user();
        $userDetails = $user->userDetails;
        $expenseCategory = ExpenseCategory::all();
        $paymentType = PaymentType::all();
        $expenses = Expenses::with('category', 'paymentType')->findOrFail($expenses->id);
        return view('pages.expenses.edit', compact('title', 'userDetails', 'expenseCategory', 'paymentType', 'expenses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expenses $expenses)
    {
        $request->validate([
            'category_id' => 'required|exists:expense_categories,id',
            // 'payment_type_id ' => 'required|exists:payment_types,id',
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'description' => 'nullable|string',
        ], [
            'category_id.required' => 'The expense category field is required.',
            // 'payment_type_id.required' => 'The payment type field is required.',
            'date.required' => 'The date field is required.',
            'date.date' => 'The date must be a valid date.',
            'amount.required' => 'The amount field is required.',
            'amount.numeric' => 'The amount must be a number.',
        ]);

        try {
            $request->merge(['amount' => str_replace('.', '', $request->amount)]);
            $expenses->update($request->all());
            return redirect()->route('Expenses')->with('success', 'Expenses updated successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'Failed to create expenses: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expenses $expenses)
    {
        try {
            $expenses->delete();
            return response()->json(['message' => 'Expenses deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete the record'], 500);
        }
    }
}
