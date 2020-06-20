<?php

namespace App\Http\Controllers;

use App\Book;
use App\Checkout;
use App\User;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::query()
            // ->select('books.*')
            // ->join('checkout', 'books.id', '=', 'checkout.book_id')
            // ->groupBy('books.id')
            // ->orderByRaw('MAX(checkout.borrowed_at) desc')

            // ->orderByDesc(
            //     Checkout::select('borrowed_at')
            //         ->whereColumn('checkout.book_id', '=', 'books.id')
            //         ->latest('borrowed_at')
            //         ->take(1)
            // )

            // ->orderByDesc(function ($query) {
            //     return $query->select('borrowed_at')
            //         ->from('checkout')
            //         ->whereColumn('checkout.book_id', '=', 'books.id')
            //         ->latest('borrowed_at')
            //         ->take(1);
            // })

            // ->orderBy(
            //     User::select('name')
            //         ->join('checkout', 'checkout.user_id', '=', 'users.id')
            //         ->whereColumn('books.id', '=', 'checkout.book_id')
            //         ->latest('checkout.borrowed_at')
            //         ->take(1)
            // )

            // with huge data this will not be the best approach adding a caching column (last_checkout_id) to books table
            // and keeping updating this column every time a book checked out will introduce better performance

            ->orderByNullsLast('author')
            ->withLastCheckout()
            ->with('lastCheckout.user')
            ->paginate();

        $books_natsort = Book::orderByRaw('naturalSort(name)')->paginate();

        return view('books.index', compact('books', 'books_natsort'));
    }
}
