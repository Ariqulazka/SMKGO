<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{

    /**
     * Show the application index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke()
    {
        return view('index');
    }
}