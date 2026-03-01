<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorys = Category::where('is_delete', 0)->get();
        return view("admin.category.index", [
            'categorys' => $categorys,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view("admin.category.add", [
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
            'parent_id' => 'nullable|exists:categories,id',
        ]);


        $data = $request->all();
        if (empty($data['parent_id'])) {
            $data['parent_id'] = null;
        }

        Category::create($data);
        return redirect()->route("category");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view("admin.category.detail", [
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);

        // Lấy tất cả ID con cháu để loại khỏi dropdown (chống vòng lặp)
        $descendantIds = $category->getAllDescendantIds();
        // Loại bỏ chính nó và tất cả con cháu khỏi danh sách parent
        $excludeIds = $descendantIds->push($category->id);
        $categories = Category::whereNotIn('id', $excludeIds)->get();

        return view("admin.category.edit", [
            'category' => $category,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        // Chống vòng lặp: không cho chọn chính nó hoặc con cháu của nó
        $parentId = $request->parent_id;
        if ($parentId) {
            $descendantIds = $category->getAllDescendantIds();
            if ($parentId == $category->id || $descendantIds->contains($parentId)) {
                return back()->withErrors(['parent_id' => 'Không thể chọn chính nó hoặc danh mục con làm danh mục cha!'])->withInput();
            }
        }

        $data = $request->all();
        if (empty($data['parent_id'])) {
            $data['parent_id'] = null;
        }

        $category->update($data);
        return redirect()->route("category");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->is_delete = 1;
        $category->save();
        return redirect()->route("category");
    }
    public function active(Request $request, string $id)
    {
        $category = Category::find($id);
        $category->is_active = !$category->is_active;
        $category->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'is_active' => $category->is_active,
            ]);
        }

        return redirect()->route("category");
    }
}
