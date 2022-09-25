<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        // Uncomment the code below
        // And write all the examples inside dd() call
        // then visit http://127.0.0.1:8000 (or whatever php artisan serve suggests)
        // to see the output
        // dd(Listing::all());
        return inertia(
            'Index/Index',
            [
                'message' => 'Hello from Laravel!'
            ]
        );
    }

    public function show()
    {
        return inertia('Index/Show');
    }
}
