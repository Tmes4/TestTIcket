<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::Where('date', '>=', Carbon::Today())->orderby('date')->get();
        return view('home')
            ->with(compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required',
            'location' => 'required',
            'time' => 'required',
            'date' => 'required',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image',
            'description' => 'required',
        ]);

        $event = new Event();

        $event->title = $request->title;
        $event->location = $request->location;
        $event->time = $request->time;
        $event->date = $request->date;
        $event->price = $request->price;
        if ($request->hasFile('image')) {
            Storage::makeDirectory('public/images');
            $src = Storage::putFile('public/images', $request->file('image'));
            $src = str_replace('public', 'storage', $src);
            $event->image = $src;
        }
        $event->description = $request->description;

        $event->save();
        return redirect()->route('admin.index', $event);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        // $event = Event::where('event_id', $event->id);
        return view('event.index')
            ->with(compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('admin.edit')
            ->with(compact('event'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $this->validate(request(), [
            'title' => 'required',
            'location' => 'required',
            'time' => 'required',
            'date' => 'required',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image',
            'description' => 'required',
        ]);

        $event->title = $request->title;
        $event->location = $request->location;
        $event->time = $request->time;
        $event->date = $request->date;
        $event->price = $request->price;
        if ($request->hasFile('image')) {
            Storage::makeDirectory('public/images');
            $src = Storage::putFile('public/images', $request->file('image'));
            $src = str_replace('public', 'storage', $src);
            $event->image = $src;
        }
        $event->description = $request->description;

        $event->save();
        return redirect()->route('admin.index', $event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.index');
    }

    public function adminIndex()
    { {
            $events = Event::where('date', '>=', Carbon::today())->orderby("date")->get();
            return view('admin.events.index')
                ->with(compact('events'));
        }
    }
}
