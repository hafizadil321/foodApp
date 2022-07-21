<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends BaseController
{
    public function get_product_by_category(Request $request)
    {
        $products = Product::where('category_id', $request->category_id)->get();
        return $this->sendResponse($products, 'Fetch All Products By Category.');
    }
}
