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
     * store
     *
     * @param Request $request
     * @return new PostResource
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required'
        ]);
        
        $user = $request->user();

        $post = new Post();
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->category_id = $request->get('category_id');
        $post->user_id = $user->id;
        $post->votes_up = 0;
        $post->votes_down = 0;

        if($request->hasFile('featured_image')) {
            $featured_image = $request->file('featured_image');
            $filename = time().$featured_image->getClientOriginalName();
            $path = url('/') . '/public/images/' . $filename;
            Storage::disk('public/images/')->putFileAs(
                $path,
                $featured_image,
                $filename
            );
            $post->featured_image = $path;
        }

        $post->save();

        return new PostResource($post);
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

    /**
     * GetPostComments
     *
     * @param mixed $id
     * @return new \App\Http\Resources\CommentsResource
     */
    public function GetPostComments($id)
    {
        $post = Post::find($id);
        $comments = $post->comments()->paginate(env('COMMENT_PER_PAGE'));

        return new \App\Http\Resources\CommentsResource($comments);
    }
}
