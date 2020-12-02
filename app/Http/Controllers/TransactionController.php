<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTransaction;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::latest()->with('client')->paginate(10);

        return $transactions;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransaction $request)
    {
        $requestData = $request->all();
        Transaction::create($requestData);

        return response()->json('Transaction created successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTransaction $request, Transaction $transaction)
    {
        $requestData = $request->all();
        $transaction->update($requestData);
  
        return response()->json('Transaction updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return response()->json('Transaction deleted successfully');
    }
}
