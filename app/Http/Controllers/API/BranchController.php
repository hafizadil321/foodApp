<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends BaseController
{
    public function index()
    {
        $branches = Branch::all();
        return $this->sendResponse($branches, 'All Branches.');
    }
}
