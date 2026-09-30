<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //Get all categories
    $categories = Category::get();

    return response()->json([
      'status' => 'success',
      'count' => count($categories),
      'data' => $categories,
    ], 200);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //Validate Input
    $validator = Validator::make($request->all(), [
      'name' => 'required|max:255',
      'description' => 'nullable',
    ]);

    if ($validator->fails()) {
      return  response()->json([
        'status' => 'fail',
        'message' => $validator->errors()
      ], 400);
    }

    $data['name'] = $request->name;
    $data['slug'] = Str::slug($request->slug);
    $data['description'] = $request->description;

    //Create new record in DB
    Category::create($data);

    return response()->json([
      'status' => 'success',
      'message' => 'Category created successfully'
    ], 201);
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //Validate Input
    $validator = Validator::make($request->all(), [
      'name' => 'required|max:255',
      'description' => 'nullable',
    ]);

    if ($validator->fails()) {
      return  response()->json([
        'status' => 'fail',
        'message' => $validator->errors()
      ], 400);
    }

    $category = Category::find($id); // Checking if data exists

    if ($category) {
      $category->name = $request->name;
      $category->slug = Str::slug($request->name);
      $category->description = $request->description;
      $category->save();

      return response()->json([
        'status' => 'success',
        'message' => 'Category created successfully'
      ], 201);
    } else {
      return response()->json([
        'status' => 'fail',
        'message' => 'Category Not Found'
      ], 404);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
    $category = Category::find($id);

    if ($category) {
      Category::destroy($id); // Delete the data from DB

      return response()->json([
        'status' => 'success',
        'message' => 'Category deleted successfully'
      ], 201);
    } else {
      return response()->json([
        'status' => 'fail',
        'message' => 'Category Not Found'
      ], 404);
    }
  }
}
