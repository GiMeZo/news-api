<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UsersResource;
use App\Http\Resources\AuthorPostsResource;
use App\Http\Resources\AuthorCommentsResource;

class UserController extends Controller
{

    /**
     * index
     *
     * @return UsersResource
     */
    public function index()
    {
        $users = User::paginate(env('AUTHOR_PER_PAGE'));
        return new UsersResource($users);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = \Illuminate\Support\Facades\Hash::make($request->get('password'));

        $user->save();

        return new \App\Http\Resources\UserResource($user);
    }

    /**
     * show
     *
     * @param mixed $id
     * @return UserResource
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return new UserResource($user);
    }

    /**
     * update
     *
     * @param Request $request
     * @param mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * destroy
     *
     * @param mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //
    }

    /**
     * GetAuthorPosts
     *
     * @param mixed $id
     * @return AuthorPostsResource
     */
    public function GetAuthorPosts($id)
    {
        $user = User::findOrfail($id);
        $posts = $user->posts()->paginate(env('POST_PER_PAGE'));

        return new AuthorPostsResource($posts);
    }

    /**
     * GetAuthorComments
     *
     * @param mixed $id
     * @return AuthorCommentsResource
     */
    public function GetAuthorComments($id)
    {
        $user = User::findOrfail($id);
        $comments = $user->comments()->paginate(env('COMMENT_PER_PAGE'));

        return new AuthorCommentsResource($comments);
    }

    /**
     * getToken
     *
     * @param Request $request
     * @return \App\Http\Resources\TokenResource
     */
    public function getToken(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)) {
            $user = User::where('email', $request->get('email'))->first();
            return new \App\Http\Resources\TokenResource(['token' => $user->api_token]);
        }

        return new \App\Http\Resources\TokenResource(['Message' => 'Not Found']);
    }
}
