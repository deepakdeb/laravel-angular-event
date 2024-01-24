<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Event;
use App\Models\User;



class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $per_page = 20;
        $events = Event::with(['createdBy', 'updatedBy'])->latest()->paginate($per_page);

        return view('dashboard.events.index', compact('events'))->with('i', (request()->input('event', 1) - 1) * $per_page);
    } //end function index


    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('dashboard.events.event');
    } //end function create


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return View
     */
    public function show(Event $event)
    {
        return redirect()->route('events.edit', $event->id);
        //return view('dashboard.events.show', compact('event'));
    } //end function show


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return View
     */
    public function edit(Event $event): View
    {
        return view('dashboard.events.event', compact('event'));
    } //end function edit


    /**
     * Store/Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  \App\Models\Event  $event
     */
    public function storeOrUpdate(Request $request, Event $event): RedirectResponse
    {
        $input = $request->all();

        if ($request->id) {
            request()->validate([
                'title' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'registration_start_date' => 'required',
                'registration_end_date' => 'required',
                'status' => 'required',
            ]);
        }else{
            request()->validate([
                'title' => 'required|string|max:255',
            ]);
        }

        if ($request->id) {
            $input['id'] = $request->id;
            $success_msg = 'Event updated successfully';
        } else {
            $success_msg = 'Event created successfully';
        }


        try {
            $storeOrUpdatedEvent = Event::updateOrCreate(['id' => $request->id], $input);

            return redirect()->route('events.edit', $storeOrUpdatedEvent->id)->with('success', $success_msg);
        } catch (\Exception $e) {
            return redirect()->route('events.index')->with('error', $e->getMessage());
        }
    } //end function update


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     */
    public function destroy(Event $event): RedirectResponse
    {
        try {
            $event->delete();
            return redirect()->route('events.index')->with('success', 'Event deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('events.index')->with('error', $e->getMessage());
        }
    } //end function destroy


    /**
     * event list for front.
     *
     * @param  \App\Models\Event  $event
     */
    public function list(Event $event): View
    {
        $per_page = 5;
        $events = Event::where('status', 1)->latest()->paginate($per_page);

        return view('frontend.event_list', compact('events'))->with('i', (request()->input('event', 1) - 1) * $per_page);
    } //end function list

    /**
     * get specified event from slug.
     *
     * @param Request $request
     * @return View
     */
    public function get_event(Request $request)
    {
        try {
            $event = Event::where('slug', $request->slug)->first();
        } catch (\Exception $e) {
            return abort(500);
        }

        if ($event) {
            return view('frontend.event_single', compact('event', 'registration'));
        } else {
            return abort(404);
        }
    } //end function get_event
} //end class EventController