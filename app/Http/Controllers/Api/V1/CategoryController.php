<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Resources\Api\V1\PostResource;
use App\Http\Resources\Api\V1\CategoryResource;
use App\Http\Requests\Api\V1\StoreCategoryRequest;
use App\Http\Requests\Api\V1\UpdateCategoriesRequest;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::all());
    }

    public function show(Category $category)
    {
        return PostResource::collection($category->posts()->with('user', 'category')->get());
    }

   // Criar categoria
    public function store(StoreCategoryRequest $request)
    {
        // Dados validados
        $data = $request->validated();

        // Criar categoria
        $category = Category::create([
            'name' => $data['name'],
            'slug' => \Str::slug($data['name']),
        ]);

        // Retornar categoria criada em JSON
        return new CategoryResource($category);
    }

    public function update(UpdateCategoriesRequest $request, Category $category)
    {
        $data = $request->validated();
        $category->update($data);

        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'message' => 'Categoria deletada com sucesso'
        ], 200);
    }
}