<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('order_by')->get();
        return view('backend.modules.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.modules.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'order_by' => 'required',
        ]);

        // $category = Category::create($request->all());
        $category = new Category();
        $category->name = $request->name;
        $category->slug = str_slug($request->name);
        $category->order_by = $request->order_by;
        $category->status = $request->status;
        $category->save();

        toastr()->success( 'Category created successfully!');

        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        return view('backend.modules.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('backend.modules.category.edit', compact('category'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'order_by' => 'required',
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = str_slug($request->name);
        $category->order_by = $request->order_by;
        $category->status = $request->status;
        $category->save();

        toastr()->success( 'Category updated successfully!');

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::find($id)->delete();
        // $category->delete();
        toastr()->success( 'Category deleted!');

        return redirect()->route('category.index');
    }
    public function status($id){
        $category = Category::find($id);
        $category->status = true;
        $category->save();

        toastr()->success( 'Category Posted!');
        return redirect()->back();
    }
}
