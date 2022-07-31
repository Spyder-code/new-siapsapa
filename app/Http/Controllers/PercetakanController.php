<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class PercetakanController extends Controller
{
    public function index()
    {
        $cards = Transaction::whereHas('transactionDetail', function ($query) {
            $query->where('status', 2);
        })->where('status_percetakan', request('status'))->get();
        return view('admin.percetakan.index', compact('cards'));
    }
}
