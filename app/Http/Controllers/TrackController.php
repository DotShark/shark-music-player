<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class TrackController extends Controller
{
    public function index()
    {
        return Inertia::render('tracks/index');
    }
}
