<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
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
        $sub_categories = SubCategory ::orderBy('order_by')->get();
        return view('backend.modules.sub_category.index', compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.modules.sub_category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, SubCategory $sub_category)
    {
        $validated = $request->validate([
            'category_id' => 'required',
            'name' => 'required|min:3|max:255',
            'order_by' => 'required',
            'status' => 'required',

        ]);

        
        $sub_category_data = $request->all();
        $sub_category_data['slug'] = str_slug($request->input('slug'));

        $sub_category->update($sub_category_data);

        toastr()->success( 'Sub-Category Created!');

        return redirect()->route('sub-category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sub_category = SubCategory ::find($id);
        return view('backend.modules.sub_category.show', compact('sub_category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sub_category = SubCategory ::find($id);
        $categories = Category::all();
        return view('backend.modules.sub_category.edit', compact('sub_category', 'categories'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $sub_category)
    {
        $validated = $request->validate([
            'category_id' => 'required',
            'name' => 'required|min:3|max:255',
            'order_by' => 'required',
            'status' => 'required',
        ]);

        $sub_category_data = $request->all();
        $sub_category_data['slug'] = str_slug($request->input('slug'));

        $sub_category->update($sub_category_data);

        toastr()->success( 'Sub-Category Updated!');

        return redirect()->route('sub-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SubCategory ::find($id)->delete();
        // $category->delete();
        toastr()->success( 'Sub-Category Deleted!');

        return redirect()->route('sub-category.index');
    }
    public function status($id){
        $sub_category = SubCategory::find($id);
        $sub_category->status = true;
        $sub_category->save();

        toastr()->success( 'Sub-Category Posted!');
        return redirect()->back();
    }
    public function getSubCategoryByCategoryId($id){
        $sub_categories = SubCategory::select('id', 'name')->where('category_id', $id)->get();

        return response()->json($sub_categories);
    }
}
