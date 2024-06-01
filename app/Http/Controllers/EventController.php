<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('moderators.index')],
            ['name' => 'Events', 'url' => route('moderators.events')],
        ];
        $events = Event::all();
        return view('events.index', compact('events', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('moderators.index')],
            ['name' => 'Events', 'url' => route('moderators.events')],
            ['name' => 'Add New Event', 'url' => route('moderators.createEvent')],
        ];

        return view('events.create', compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title'             => ['required', 'string', 'max:255'],
            'description'       => ['required', 'string'],
            'num_of_needed_vol' => ['required', 'integer', 'min:1'],
            'start_date'        => ['required', 'date'],
            'end_date'          => ['required', 'date', 'after_or_equal:start_date'],
            'start_time'        => ['required', 'date_format:H:i'],
            'end_time'          => ['required', 'date_format:H:i', 'after:start_time'],
            'location'          => ['required', 'string', 'max:255'],
            'poster'            => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        // Handle file upload for poster if it exists
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('public/posters');
            $validatedData['poster'] = "posters/".basename($posterPath);
        }

        $validatedData['status'] = 'Pending';
        $validatedData['user_id'] = $user->id;

        // Create a new event with the validated data
        Event::create($validatedData);

        // Redirect to the events page with a success message
        return redirect()->route('moderators.events')->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('moderators.index')],
            ['name' => 'Events', 'url' => route('moderators.events')],
            ['name' => 'View Event', 'url' => route('moderators.viewEvent', $event->id)],
        ];

        return view('events.view', compact('event', 'breadcrumbs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('moderators.index')],
            ['name' => 'Events', 'url' => route('moderators.events')],
            ['name' => 'Edit Event', 'url' => route('moderators.editEvent', $event->id)],
        ];
        // Retrieve the event and pass it to the edit view
        return view('events.edit', compact('event', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title'             => ['required', 'string', 'max:255'],
            'description'       => ['required', 'string'],
            'num_of_needed_vol' => ['required', 'integer', 'min:1'],
            'start_date'        => ['required', 'date'],
            'end_date'          => ['required', 'date', 'after_or_equal:start_date'],
            'start_time'        => ['required', 'date_format:H:i'],
            'end_time'          => ['required', 'date_format:H:i', 'after:start_time'],
            'location'          => ['required', 'string', 'max:255'],
            'poster'            => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        // Handle file upload for poster if it exists
        if ($request->hasFile('poster')) {
            // Delete the old poster if it exists
            if ($event->poster) {
                Storage::delete('public/posters/' . $event->poster);
            }

            $posterPath = $request->file('poster')->store('public/posters');
            $validatedData['poster'] = "posters/".basename($posterPath);
        }

        // Update the event with the validated data
        $event->update($validatedData);

        // Redirect to the events page with a success message
        return redirect()->route('moderators.events')->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        // Delete the student
        $event->delete();

        // Reset the auto-increment value
        $maxId = \DB::table('events')->max('id') + 1;

        // Check if the table is empty. If it is, reset the auto-increment to 1
        if ($maxId == 1) {
            \DB::statement("ALTER TABLE events AUTO_INCREMENT = 1");
        } else {
            \DB::statement("ALTER TABLE events AUTO_INCREMENT = $maxId");
        }

        // Redirect with success message
        return redirect()->route('moderators.events')->with('success', 'Event deleted successfully!');
    }

    public function completedEventsList()
    {
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('moderators.index')],
            ['name' => 'Completed Events', 'url' => route('moderators.completedEvents')],
        ];

        $events = Event::where('status', 'Completed')->get();
        $events = Event::all();

        return view('events.completed', compact('breadcrumbs', 'events'));
    }

    public function viewCompletedEvent(Event $event)
    {
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('moderators.index')],
            ['name' => 'Completed Events', 'url' => route('moderators.completedEvents')],
            ['name' => 'View Completed Events', 'url' => route('moderators.viewCompletedEvent', $event->id)],
        ];

        return view('events.viewCompleted', compact('breadcrumbs', 'event'));
    }
}
