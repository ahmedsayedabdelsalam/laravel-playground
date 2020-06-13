<?php

namespace App\Http\Controllers;

use App\Feature;
use App\Login;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->select('id', 'name', 'company_id')
            ->withLastLogin()
            ->with('company:id,name')
            // ->orderBy('name')
            ->paginate(100);

        $features_count = Feature::toBase()
            ->selectRaw('COUNT(CASE WHEN TYPE = "pending" THEN 1 END) AS pending')
            ->selectRaw('COUNT(CASE WHEN TYPE = "accepted" THEN 1 END) AS accepted')
            ->selectRaw('COUNT(CASE WHEN TYPE = "rejected" THEN 1 END) AS rejected')
            ->first();

        return view('users.index', compact('users', 'features_count'));
    }
}
