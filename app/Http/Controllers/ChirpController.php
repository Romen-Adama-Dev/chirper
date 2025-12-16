<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Inertia\Inertia;

class ChirpController extends Controller
{
    public function index()
    {
        $chirps = Chirp::with('user')
            ->latest()
            ->take(50)
            ->get()
            ->map(fn ($c) => [
                'id' => $c->id,
                'author' => $c->user?->name ?? 'Anonymous',
                'message' => $c->message,
                'created_at' => $c->created_at->diffForHumans(),
            ]);

        return Inertia::render('Home', [
            'chirps' => $chirps,
        ]);
    }
}