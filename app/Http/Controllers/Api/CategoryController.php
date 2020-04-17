<?php

namespace App\Http\Controllers\Api;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\PostsResource;

class CategoryController extends Controller
{

    /**
     * index
     *
     * @return CategoriesResource
     */
    public function index()
    {
        $categories = Category::paginate(env('CATEGORY_PER_PAGE'));
        return new CategoriesResource($categories);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $category = Category::FindOrFail($id);
        return new CategoryResource($category);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    /**
     * GetCategoryPosts
     *
     * @param mixed $id
     * @return CategoryPostsResource
     */
    public function GetCategoryPosts($id)
    {
        $category = Category::findOrFail($id);
        $posts = $category->posts()->paginate(env('POST_PER_PAGE'));

        return new PostsResource($posts);
    } 

}
