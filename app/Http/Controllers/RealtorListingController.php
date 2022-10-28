<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RealtorListingController extends Controller
{
    public function index()
    {
        return inertia('Realtor/Index');
    }
}
