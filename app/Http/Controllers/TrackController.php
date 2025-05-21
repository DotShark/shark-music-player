<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrackRequest;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class TrackController extends Controller
{
    public function index()
    {
        $tracks = Track::where('displayed', true)->get();

        return Inertia::render('tracks/index', [
            'tracks' => $tracks,
        ]);
    }

    public function create()
    {
        return Inertia::render('tracks/create');
    }

    public function store(StoreTrackRequest $request)
    {
        $validated = $request->validated();
        
        $uuid = Str::uuid();
        
        $fileName = null;
        if ($request->hasFile('file')) {
            $fileName = $uuid . '.' . $request->file('file')->getClientOriginalExtension();
            $request->file('file')->storeAs('tracks', $fileName);
        }
        
        if ($request->hasFile('image')) {
            $imageName = $uuid . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('track-images', $imageName);
        }
        
        Track::create([
            'uuid' => $uuid,
            'title' => $validated['title'],
            'artist' => $validated['artist'],
            'displayed' => $validated['displayed'],
            'file_name' => $fileName,
            'image' => $imageName,
            'play_count' => 0,
        ]);
        
        return redirect()->route('tracks.index')
            ->with('message', 'Track created successfully');
    }

    public function edit(Track $track)
    {
        return Inertia::render('tracks/edit', ['track' => $track]);
    }

    public function update(Request $request, Track $track)
    {
        $validated = $request->validate([
            'title' => ['sometimes', 'string', 'max:255'],
            'artist' => ['sometimes', 'string', 'max:255'],
            'displayed' => ['sometimes', 'boolean'],
        ]);

        if ($validated['title']) $track->title = $validated['title'];
        if ($validated['artist']) $track->artist = $validated['artist'];
        if ($validated['displayed']) $track->displayed = $validated['displayed'];

        $track->save();

        return redirect()->route('tracks.index')
            ->with('message', 'Track updated successfully');
    }
}
