<?php

namespace App\Http\Controllers;

use App\Models\Track;
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
}
