<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Event $event)
    {
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('moderators.index')],
            ['name' => 'Completed Events', 'url' => route('moderators.completedEvents')],
            ['name' => 'View Completed Events', 'url' => route('moderators.viewCompletedEvent', $event->id)],
            ['name' => 'Feedbacks', 'url' => route('moderators.feedbacks', $event->id)],
        ];

        $feedbacks = Feedback::with(['user', 'event'])->where('event_id', $event->id)->latest()->get();
        return view('feedbacks.index', compact('breadcrumbs', 'event', 'feedbacks'));
    }

    public function submitFeedback(Event $event)
    {
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('volunteers.index')],
            ['name' => 'Assigned Events', 'url' => route('volunteers.assignedEvents')],
            ['name' => 'View Assigned Events', 'url' => route('volunteers.assignedEventsDetails', $event->id)],
            ['name' => 'Submit Feedback', 'url' => route('volunteers.submitFeedback', $event->id)],
        ];

        return view('feedbacks.submit', compact('breadcrumbs', 'event'));
    }

    public function storeFeedback(Request $request, Event $event)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required|string|max:1000',
        ]);

        Feedback::create([
            'event_id' => $event->id,
            'user_id' => auth()->user()->id,
            'rating' => $request->input('rating'),
            'message' => $request->input('message'),
        ]);

        return redirect()->route('volunteers.assignedEventsDetails', $event->id)->with('success', 'Feedback submitted successfully.');
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
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
