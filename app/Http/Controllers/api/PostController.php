<?php

namespace App\Http\Controllers\api;

use App\Events\NewPost;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::latest()->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $data = $request->only(["title", "content", "website_id"]);
        $data["slug"] = Str::slug($data["title"]);

        $post = Post::create($data);

        // notify subscribers of new posts
        NewPost::dispatch($post);

        return response()->json([
            "message" => "Post created successfully",
            "data" => $post
        ]);
    }
}
