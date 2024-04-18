<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Duit Saku';
        $user = Auth::user();
        $userDetails = $user->userDetails;
        $paymentTypes = PaymentType::all();
        return view('pages.PaymentType.index', compact('title', 'userDetails', 'paymentTypes'));
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

        return view('pages.PaymentType.create', compact('title', 'userDetails', 'expenseCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:expense_categories,id',
            'name' => 'required|min:3|max:20',
            'description' => 'nullable',
        ], [
            'category_id.required' => 'The expense category field is required.',
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must be at least 3 characters.',
            'name.max' => 'The name may not be greater than 20 characters.',
        ]);

        try {
            PaymentType::create($request->all());
            return redirect()->route('PaymentType')->with('success', 'Payment type created successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'Failed to create payment type: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentType $paymentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentType $paymentType)
    {
        $title = 'Duit Saku';
        $user = Auth::user();
        $userDetails = $user->userDetails;
        $expenseCategory = ExpenseCategory::all();
        $paymentType = PaymentType::with('expenseCategory')->findOrFail($paymentType->id);

        return view('pages.PaymentType.edit', compact('title', 'userDetails', 'paymentType', 'expenseCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentType $paymentType)
    {
        $request->validate([
            'category_id' => 'required|exists:expense_categories,id',
            'name' => 'required|min:3|max:20',
            'description' => 'nullable',
        ], [
            'category_id.required' => 'The expense category field is required.',
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must be at least 3 characters.',
            'name.max' => 'The name may not be greater than 20 characters.',
        ]);

        try {
            $paymentType->update($request->all());
            return redirect()->route('PaymentType')->with('success', 'Payment type updated successfully');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'Failed to create payment type: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentType $paymentType)
    {
        try {
            $paymentType->delete();
            return response()->json(['message' => 'Payment type deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete the record'], 500);
        }
    }

    /**
     * Endpoint get payment types.
     */
    public function getPaymentTypes(Request $request)
    {
        $category_id = $request->category_id;

        // Ambil jenis pembayaran dari database berdasarkan id kategori
        $paymentTypes = PaymentType::where('category_id', $category_id)->get();

        // Kembalikan respons dalam format JSON
        return response()->json(['payment_types' => $paymentTypes]);
    }
}
