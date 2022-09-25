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
        // dd(Listing::where('beds', '>=', 4)->orderBy('price', 'asc')->first());
        // Make sure to copy the code below, but WITHOUT comments, so uncomment it
        // first (remove // from the beginning of 3 lines below, then copy)
        // Listing::create([
        //     'beds' => 2, 'baths' => 2, 'area' => 100, 'city' => 'North', 'street' => 'Tinker st', 'street_nr' => 20, 'code' => 'TS', 'price' => 200_000
        // ])
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
