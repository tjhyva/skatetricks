<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

class CategoryController extends Controller
{
  public function index() {
    $categories = Category::all();
  return view ("home")->with('categories', $categories);
  }
}
