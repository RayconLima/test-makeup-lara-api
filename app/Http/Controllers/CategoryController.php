<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\{StoreCategoryRequest, UpdateCategoryRequest};
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate();
        return CategoryResource::collection($categories);
    }

    public function store(StoreCategoryRequest  $request)
    {
        $category = Category::create($request->validated());
        return CategoryResource::make($category);        
    }
    
    public function update(Category $category, UpdateCategoryRequest  $request)
    {
        $category->update($request->validated());
        return CategoryResource::make($category);        
    }

    public function destroy(Category $category)
    {
        $category->delete();
    }
}
