<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
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
        $tags = Tag::orderBy('order_by')->get();
        return view('backend.modules.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.modules.tag.create');
        
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

        $tag = new Tag();
        $tag->name = $request->name;
        $tag->slug = str_slug($request->name);
        $tag->order_by = $request->order_by;
        $tag->status = false;
        $tag->save();

        // session()->flash('cls', 'success');
        // session()->flash('msg', 'Tag created successfully!');
          // toastr Allert use
          toastr()->success('Data has been save successfully!', 'Save');

        return redirect()->route('tag.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tag = Tag::find($id);
        return view('backend.modules.tag.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag = Tag::find($id);
        return view('backend.modules.tag.edit', compact('tag'));
        
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

        $tag = Tag::find($id);
        $tag->name = $request->name;
        $tag->slug = str_slug($request->name);
        $tag->order_by = $request->order_by;
        $tag->status = false;
        $tag->save();

        // session()->flash('cls', 'success');
        // session()->flash('msg', 'Tag updated successfully!');
          // toastr Allert use
          toastr()->success('Data has been update successfully!', 'Update');

        return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Tag::find($id)->delete();
        // $tag->delete();
        session()->flash('cls', 'danger');
        session()->flash('msg', 'Tag delete successfully!');
          // toastr Allert use
          toastr()->success('Data has been delete successfully!', 'Delete');

        return redirect()->route('tag.index');
    }
    public function status($id){
        $tag = Tag::find($id);
        $tag->status = true;
        $tag->save();

        // session()->flash('cls', 'success');
        // session()->flash('msg', 'Tag post successfully!');
        toastr()->success('Data has been post successfully!', 'Post');
        return redirect()->back();
    }
}
