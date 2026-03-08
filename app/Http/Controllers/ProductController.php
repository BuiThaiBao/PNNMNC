<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::where('is_delete', 0);

        // Lọc theo keyword
        if ($request->has('keyword') && $request->keyword != '') {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        // Lọc theo category
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->get();
        $categories = Category::where('is_delete', 0)->get();

        return view("admin.product.index", [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('is_delete', 0)->get();
        return view("admin.product.add", [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lte:price',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        if (empty($data['category_id'])) {
            $data['category_id'] = null;
        }

        // Upload ảnh
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('pricture'), $fileName);
            $data['image'] = 'pricture/' . $fileName;
        }

        Product::create($data);
        return redirect()->route("product");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $categories = Category::where('is_delete', 0)->get();
        return view("admin.product.edit", [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lte:price',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        if (empty($data['category_id'])) {
            $data['category_id'] = null;
        }

        // Upload ảnh mới
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('pricture'), $fileName);
            $data['image'] = 'pricture/' . $fileName;
        } else {
            unset($data['image']);
        }

        $product->update($data);
        return redirect()->route("product");
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->is_delete = 1;
        $product->save();
        return redirect()->route("product");
    }

    /**
     * Toggle active status.
     */
    public function active(Request $request, string $id)
    {
        $product = Product::find($id);
        $product->is_active = !$product->is_active;
        $product->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'is_active' => $product->is_active,
            ]);
        }

        return redirect()->route("product");
    }
}
