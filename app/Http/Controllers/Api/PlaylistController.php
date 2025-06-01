<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PlaylistController extends Controller
{
    /**
     * Get all playlists for the authenticated user
     */
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        
        $playlists = $user->playlists()
            ->with('tracks')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $playlists,
            'message' => 'Playlists retrieved successfully'
        ]);
    }
}
