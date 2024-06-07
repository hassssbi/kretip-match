<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Event;
use App\Models\EventAssigned;
use App\Models\User;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Event $event)
    {
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('moderators.index')],
            ['name' => 'Events', 'url' => route('moderators.events')],
            ['name' => 'View Event', 'url' => route('moderators.viewEvent', $event->id)],
            ['name' => 'Applications', 'url' => route('moderators.applications', $event->id)],
        ];

        $eventSkills = $event->skills()->implode('name', ', ');

        $applications = Application::with(['event', 'user'])->where('event_id', $event->id)->get();
        return view('applications.index', compact('breadcrumbs', 'applications', 'event', 'eventSkills'));
    }

    public function statusList($status = null)
    {
        $user = auth()->user();
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('volunteers.index')],
            ['name' => 'Applications Status', 'url' => route('volunteers.status')],
        ];

        $query = Application::where('user_id', $user->id);

        if ($status) {
            $query->where('status', $status);
        }

        $applications = $query->latest()->with('event')->get();

        return view('applications.statusList', compact('breadcrumbs', 'applications', 'status'));
    }

    public function statusDetails(Application $application)
    {
        $user = auth()->user();
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('volunteers.index')],
            ['name' => 'Applications Status', 'url' => route('volunteers.status')],
            ['name' => 'Applications Details', 'url' => route('volunteers.statusDetails', $application->id)],
        ];

        return view('applications.statusDetails', compact('breadcrumbs', 'application'));
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
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'user_id'  => 'required|exists:users,id',
            'message'  => 'required',
            'mod_id'   => 'required|exists:users,id',
        ]);

        Application::create([
            'event_id' => $request->event_id,
            'user_id' => $request->user_id,
            'status' => 'Pending', // default status
            'message' => $request->message, // default message
            'mod_id' => $request->mod_id,
        ]);

        return redirect()->back()->with('success', 'You have successfully applied for the event!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        //
    }

    public function accept($id)
    {
        $application = Application::findOrFail($id);
        $application->status = 'Accepted';
        $application->save();

        // Create an entry in EventAssigned
        EventAssigned::create([
            'user_id' => $application->user_id,
            'event_id' => $application->event_id,
        ]);

        return redirect()->back()->with('success', 'Application accepted successfully.');
    }

    public function reject($id)
    {
        $application = Application::findOrFail($id);
        $application->status = 'Rejected';
        $application->save();

        return redirect()->back()->with('success', 'Application rejected successfully.');
    }

    public function cancelApplication(Application $application)
    {
        $application = Application::find($application->id);

        if ($application->status === 'Accepted') {
            // Remove from EventAssigned model
            EventAssigned::where('event_id', $application->event_id)
                        ->where('user_id', $application->user_id)
                        ->delete();
        }

        $application->status = 'Canceled';
        $application->save();

        return redirect()->route('volunteers.status')->with('success', 'Your application has been canceled.');
    }



}
