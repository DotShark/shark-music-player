<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ApiKey;
use Illuminate\Support\Facades\Auth;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('x-api-key');

        if (!$apiKey) {
            return response()->json([
                'error' => 'API key is required',
                'message' => 'Please provide a valid API key in the x-api-key header'
            ], 401);
        }

        $apiKeyModel = ApiKey::where('key', $apiKey)->first();

        if (!$apiKeyModel) {
            return response()->json([
                'error' => 'Invalid API key',
                'message' => 'The provided API key is not valid'
            ], 401);
        }

        // Set the authenticated user for the request
        Auth::setUser($apiKeyModel->user);
        $request->setUserResolver(function () use ($apiKeyModel) {
            return $apiKeyModel->user;
        });

        return $next($request);
    }
}
