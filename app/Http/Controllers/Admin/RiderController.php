<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Branch;

class RiderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $riders = User::with('branch')->whereRoleIs('rider')->get();
        // dd($riders);
        return view('admin.pages.riders.index',compact('riders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::all();
        return view('admin.pages.riders.create', compact('branches'));
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
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20048',
        ]);

        $imageName = "";
        if ($image = $request->file('image')) {
            $destinationPath = 'images/riders/';
            $riderImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $riderImage);
            $imageName = $riderImage;
        }
    
        $rider = User::create([
            'branch_id'   => $request->branch_id, 
            'name'        => $request->name, 
            'email'       => $request->email, 
            'password'    => bcrypt($request['password']),
            'image'       => $imageName, 
            'phone'       => $request->name, 
        ]);
        $rider->attachRole('rider');
     
        return redirect()->route('riders.index')
                        ->with('success','Rider created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
