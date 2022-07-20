<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->paginate(5);
    
        return view('admin.pages.categories.index',compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cat_icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  
        $input = $request->all();
  
        if ($image = $request->file('image')) {
            $destinationPath = 'images/category_image';
            $catImage = date('YmdHis') . "_image." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $catImage);
            $input['image'] = "$catImage";
        }
        if ($image = $request->file('cat_icon')) {
            $destinationPath = 'images/category_icon';
            $catIcon = date('YmdHis') . "_icon." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $catIcon);
            $input['cat_icon'] = "$catIcon";
        }
    
        Category::create($input);
     
        return redirect()->route('categories.index')
                        ->with('success','category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.pages.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.pages.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'color' => 'required'
        ]);
  
        $input = $request->all();
  
        if ($image = $request->file('image')) {
            $destinationPath = 'images/category_image';
            $profileImage = date('YmdHis') . "_image." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
            File::delete($destinationPath.'/'.$category->image);
        }else{
            unset($input['image']);
        }
        if ($image = $request->file('cat_icon')) {
            $destinationPath = 'images/category_icon';
            $profileImage = date('YmdHis') . "_icon." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['cat_icon'] = "$profileImage";
            File::delete($destinationPath.'/'.$category->cat_icon);
        }else{
            unset($input['cat_icon']);
        }
          
        $category->update($input);
    
        return redirect()->route('categories.index')
                        ->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
     
        return redirect()->route('categories.index')
                        ->with('success','Category deleted successfully');
    }
}
