<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Resources\PostResourceCollection;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return PostResourceCollection
     */
    public function index() : PostResourceCollection
    {
        return new PostResourceCollection(Post::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PostResource
     */
    public function store(Request $request) : PostResource
    {
        $request->validate([
            'user_id'   => 'required',
            'title'     => 'required',
            'body'      => 'required',
        ]);

        $post = Post::create($request->all());

        return new PostResource($post);
    }

    /**
     * Return the specified resource.
     *
     * @param  Post $post
     * @return PostResource
     */
    public function show(Post $post) : PostResource
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post   // id of the post to be updated
     * @return PostResource
     */
    public function update(Request $request, Post $post) : PostResource
    {
        $post->update($request->all());

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post   // id of the post to be updated
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json();
    }
}
