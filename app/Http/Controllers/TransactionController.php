<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Rules\CheckBalanceRule;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transaction.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       /* if($request->transaction_type==="transaction"){
            $balance = \App\Models\Transaction::where(['user_id'=>Auth::user()->id])->get()->sum('amount');
            $request->validate([
                'transaction_type' => 'required',
                'amount' => 'required|min:1|max:'.$balance,
                'description' => 'required'
            ],['amount.max'=>'you dont have enought balance']);
        } else {
            $balance = 0;
            $request->validate([
                'transaction_type' => 'required',
                'amount' => 'required|min:1|max:999999999',
                'description' => 'required'
            ]);
        }*/
        $balance = \App\Models\Transaction::where(['user_id'=>Auth::user()->id])->get()->sum('amount');
            $request->validate([
                'transaction_type' => 'required',
                'amount' => ['required','min:1',new CheckBalanceRule($balance,$request->transaction_type)],
                'description' => 'required'
            ]);
        
        $amount = (($request->transaction_type=="transaction")?-$request->amount:$request->amount);
        $cur_balance = (($request->transaction_type=="transaction")?$balance-$request->amount:$balance+$request->amount);
        \App\Models\Transaction::create([
            'transaction_type' => $request->transaction_type,
            'amount' => $amount,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
            'balance'=>$cur_balance
        ]);
        return redirect()->route('dashboard')
        ->withSuccess('You have successfully created a data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
