<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // Merr të gjitha kategoritë
    public function index()
    {
        return response()->json(Category::all());
    }

    // Merr një kategori sipas ID-së
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return response()->json($category);
    }

    // Krijo një kategori të re
    public function store(Request $request)
    {
        // Validimi i të dhënave
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:categories|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        // Krijo kategorinë e re
        $category = Category::create([
            'name' => $request->name,
        ]);

        return response()->json($category, 201);
    }

    // Përditëso një kategori ekzistuese
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        // Validimi i të dhënave
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:categories,name,' . $category->id . '|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        // Përditëso kategorinë
        $category->update([
            'name' => $request->name,
        ]);

        return response()->json($category);
    }

    // Fshi një kategori
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Fshi kategorinë
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
}

