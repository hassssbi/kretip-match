<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $breadcrumbs = [
            ['name' => 'Home', 'url' => url('/')],
            ['name' => 'Dashboard', 'url' => '#']
        ];
        return view('home', compact('breadcrumbs'));
    }

    public function landingPage()
    {
        $breadcrumbs = [
            ['name' => 'Home', 'url' => url('/')],
            ['name' => 'Landing Page', 'url' => route('landingPage')]
        ];

        return view('landingPage', compact('breadcrumbs'));
    }
    public function aboutUs()
    {
        $breadcrumbs = [
            ['name' => 'Home', 'url' => url('/')],
            ['name' => 'About Us', 'url' => route('aboutUs')]
        ];

        return view('aboutUs', compact('breadcrumbs'));
    }
}
