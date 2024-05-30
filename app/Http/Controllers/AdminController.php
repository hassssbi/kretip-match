<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $acount = User::where('role_id', 1)->count();
        $mcount = User::where('role_id', 2)->count();
        $vcount = User::where('role_id', 3)->count();
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('admins.index')],
            ['name' => 'Dashboard', 'url' => route('admins.index')]
        ];
        return view('admins.index', compact('breadcrumbs', 'acount', 'mcount', 'vcount',));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
