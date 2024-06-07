<?php

namespace App\Http\Controllers;

use App\Models\Moderator;
use App\Models\Application;
use App\Models\Feedback;
use Illuminate\Http\Request;

class ModeratorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = Application::with(['user', 'event'])->latest()->get();
        $feedbacks = Feedback::with(['user', 'event'])->latest()->get();

        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('moderators.index')],
            ['name' => 'Dashboard', 'url' => route('moderators.index')]
        ];
        return view('moderators.index', compact('breadcrumbs', 'applications', 'feedbacks'));
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
    public function show(Moderator $moderator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Moderator $moderator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Moderator $moderator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Moderator $moderator)
    {
        //
    }
}
