<?php

namespace App\Http\Controllers\Api;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostsResource;

class PostController extends Controller
{

    /**
     * index
     *
     * @return PostsResource
     */
    public function index()
    {
        $posts = Post::paginate(env('POST_PER_PAGE'));
        return new PostsResource($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $post = Post::findOrfail($id);
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function GetPostComments($id)
    {
        $post = Post::find($id);
        $comments = $post->comments()->paginate(env('COMMENT_PER_PAGE'));

        return new \App\Http\Resources\CommentsResource($comments);
    }
}
