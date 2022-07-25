<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Product;
use App\Models\BranchProduct;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::all();
    
        return view('admin.pages.branches.index',compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.branches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo "<pre>"; print_r($request->all()); exit('poikk');
        $request->validate([
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'address' => 'required',
        ]);
        
        $input = $request->all();
        if ($image = $request->file('image')) {
            $destinationPath = 'images/branches/';
            $branchImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $branchImage);
            $input['image'] = "$branchImage";
        }
    
        $branch = Branch::create($input);
        $products = Product::all();
        foreach ($products as $key => $value) {
            BranchProduct::create([
                'product_id' => $value->id,
                'branch_id' => $branch->id,
                'status'  => 1,
            ]);
        }
        return redirect()->route('branches.index')
                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.pages.branches.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        // $branches = Branch::all();/
        return view('admin.pages.branches.edit',compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        // echo "<pre>"; print_r($request->all()); exit('poikkk');
        $request->validate([
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'address' => 'required',
        ]);
  
        $input = $request->all();
  
        if ($image = $request->file('image')) {
            $destinationPath = 'images/branches/';
            $branchImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $branchImage);
            $input['image'] = "$branchImage";
        }else{
            unset($input['image']);
        }
          
        $branch->update($input);
    
        return redirect()->route('branches.index')
                        ->with('success','Branch updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
     
        return redirect()->route('branches.index')
                        ->with('success','Branch deleted successfully');
    }

    public function branch_products($id)
    {
        $products = Branch::with('products')->where('id', $id)->first();
        // dd($products);
        return view('admin.pages.branches.branch_products',compact('products'));
    }
}
