<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EventController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('event', [
            'latestEvent' => Event::published()->latest('published_at')->take(9)->get()
        ]);
    }
//
//    public function event()
//    {
//        return view('events.index');
//    }
//
//    public function events(Request $request)
//    {
//        $events = Event::all(); // Fetch all events from the database
//
//        return view('events.index')
//            ->with('events', $events)
//            ->with('events_json', $events->toJson());
//    }

//    public function getEvents()
//    {
//        $events = Event::all(); // Fetch all events from the database
//        return response()->json($events); // Return events as JSON
//    }

//    public function calendar()
//    {
//        return view('calendar');
//    }
//
//    public function events()
//    {
//        $events = Event::all(); // Fetch all events from the database
//        return response()->json($events);
//    }

    public function index()
    {
        // Retrieve events from the database
        $events = Event::all();

        // Pass events data to the view
        return view('events.index', compact('events'));
    }

}
