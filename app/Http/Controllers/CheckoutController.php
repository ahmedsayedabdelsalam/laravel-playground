<?php

namespace App\Http\Controllers;

use App\Checkout;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $checkouts = Checkout::query()
            ->whereBorrowedThisWeek()
            ->orderByDate()
            ->orderBy('name')
            ->paginate();

        return view('checkouts.index', compact('checkouts'));
    }
}
