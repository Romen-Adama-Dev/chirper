<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    public function index()
    {
        $chirps = Chirp::with('user')
            ->latest()
            ->take(50)
            ->get()
            ->map(fn ($chirp) => [
                'id' => $chirp->id,
                'author' => $chirp->user?->name ?? 'Anonymous',
                'email' => $chirp->user?->email,
                'message' => $chirp->message,
                'created_at' => $chirp->created_at->diffForHumans(),
                'edited' => $chirp->updated_at->gt($chirp->created_at->copy()->addSeconds(5)),
            ]);

        return inertia('Home', [
            'chirps' => $chirps,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'message' => ['required', 'string', 'max:255'],
            ],
            [
                'message.required' => 'Please write something to chirp!',
                'message.max' => 'Chirps must be 255 characters or less.',
            ]
        );

        Chirp::create([
            'message' => $validated['message'],
        ]);

        return redirect('/')->with('success', 'Your chirp has been posted!');
    }

    public function edit(Chirp $chirp)
    {
        return inertia('Chirps/Edit', [
            'chirp' => [
                'id' => $chirp->id,
                'message' => $chirp->message,
            ],
        ]);
    }

    public function update(Request $request, Chirp $chirp)
    {
        $validated = $request->validate(
            [
                'message' => ['required', 'string', 'max:255'],
            ],
            [
                'message.required' => 'Please write something to chirp!',
                'message.max' => 'Chirps must be 255 characters or less.',
            ]
        );

        $chirp->update([
            'message' => $validated['message'],
        ]);

        return redirect('/')->with('success', 'Chirp updated!');
    }

    public function destroy(Chirp $chirp)
    {
        $chirp->delete();

        return redirect('/')->with('success', 'Chirp deleted!');
    }
}