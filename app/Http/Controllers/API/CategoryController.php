<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends BaseController
{
    public function get_categories()
    {
        $categories = Category::all();
        return $this->sendResponse($categories, 'Fetch All Categories.');
    }
}
