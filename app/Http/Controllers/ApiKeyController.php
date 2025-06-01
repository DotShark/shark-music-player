<?php

namespace App\Http\Controllers;

use App\Models\ApiKey;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ApiKeyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        $apiKeys = $user->apiKeys()->orderBy('created_at', 'desc')->get();

        return Inertia::render('apiKeys/Index', [
            'apiKeys' => $apiKeys,
            'newApiKey' => session('newApiKey'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('apiKeys/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        /** @var User $user */
        $user = Auth::user();
        $apiKey = $user->apiKeys()->create([
            'name' => $request->name,
        ]);

        return redirect()->route('api-keys.index')
            ->with('success', 'API key created successfully.')
            ->with('newApiKey', [
                'id' => $apiKey->id,
                'name' => $apiKey->name,
                'key' => $apiKey->key, // Show key only at creation
                'uuid' => $apiKey->uuid,
                'created_at' => $apiKey->created_at,
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApiKey $apiKey)
    {
        // Check that the key belongs to the authenticated user
        if ($apiKey->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $apiKey->delete();

        return redirect()->route('api-keys.index')
            ->with('success', 'API key deleted successfully.');
    }
}
