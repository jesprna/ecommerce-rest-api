<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\ApiController;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionSellerController extends ApiController
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('client.credentials')->only(['index']);
        $this->middleware('can:view,transaction')->only('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Transaction $transaction)
    {
        // $seller = $transaction->products()->with('seller')
        //         ->get()
        //         ->pluck('seller')
        //         ->unique()
        //         ->values();
        $seller = $transaction->product->seller;

        return $this->showOne($seller);
    }


}
