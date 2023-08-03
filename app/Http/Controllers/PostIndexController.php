<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return inertia()->render('Posts/Index', [
            'posts' => PostResource::collection(Post::with('user')->latest()->get()),
            'now' => now()
        ]);
    }
}
