<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RiderController extends BaseController
{
    public function index()
    {
        $riders = User::whereRoleIs('rider')->get();
        return $this->sendResponse($riders, 'Fetch All Riders.');
    }
}
