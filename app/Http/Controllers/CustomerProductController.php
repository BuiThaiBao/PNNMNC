<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CustomerProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_delete', 0)->where('is_active', 1);

        if ($request->has('keyword') && $request->keyword != '') {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->get();
        $categories = Category::where('is_delete', 0)->where('is_active', 1)->get();

        return view('customer.product.index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
