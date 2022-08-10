<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // dd('Migration');
        $title = 'Dashboard';
        return view('admin.pages.dashboard',compact('title'));
    }
}
