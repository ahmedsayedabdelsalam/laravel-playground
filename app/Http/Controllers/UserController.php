<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->select('id', 'name', 'company_id')
            ->with('company:id,name')
            ->orderBy('name')
            ->paginate(100);

        return view('users.index', compact('users'));
    }
}
