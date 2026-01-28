<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckTimeAccess;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class ProductController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            CheckTimeAccess::class
        ];
    }

    public function index()
    {
        $title = "Product List";
        return view('product.index', [
            "title" => $title,
            "products" => [
                [
                    'id' => 1,
                    'name' => 'Product 1',
                    'price' => 100,
                    'description' => 'Description 1',
                ],
                [
                    'id' => 2,
                    'name' => 'Product 2',
                    'price' => 100,
                    'description' => 'Description 2',
                ],
                [
                    'id' => 3,
                    'name' => 'Product 3',
                    'price' => 100,
                    'description' => 'Description 3',
                ],
                [
                    'id' => 4,
                    'name' => 'Product 4',
                    'price' => 100,
                    'description' => 'Description 4',
                ],
                [
                    'id' => 5,
                    'name' => 'Product 5',
                    'price' => 100,
                    'description' => 'Description 5',
                ],
                [
                    'id' => 6,
                    'name' => 'Product 6',
                    'price' => 100,
                    'description' => 'Description 6',
                ],
            ]

        ]);
    }
    public function getDetail(string $id = "123")
    {
        return view('product.detail', ['id' => $id]);
    }
    public function add()
    {
        return view('product.add');
    }

    public function store(Request $request)
    {
        return $request->all();
    }
}
