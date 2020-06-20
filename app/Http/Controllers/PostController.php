<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()
            ->when(request('search'), function($query, $search) {
                $query->selectRaw('*, match(title, body) against(? in boolean mode) as score', [$search])
                    ->whereRaw('match(title, body) against(? in boolean mode)', [$search]);
            }, function ($query) {
                $query->latest('published_at');
            })
            ->paginate(100);

        return view('posts.index', compact('posts'));
    }
}
