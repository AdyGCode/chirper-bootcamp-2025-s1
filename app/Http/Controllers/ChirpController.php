<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $chirps = Chirp::latest()->get();

        return view('chirps.index', compact(['chirps',]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $validated = $request->validate([
           'message' => [
               'required',
               'string',
               'min:5',
               'max:192',
           ]
        ]);

        $request->user()->chirps()->create($validated);

        return redirect( route('chirps.index') );

    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp):View
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp):View
    {
        return view('chirps.edit', compact(['chirp']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp):RedirectResponse
    {
        $validated = $request->validate([
            'message' => [
                'required',
                'string',
                'min:5',
                'max:192',
            ]
        ]);

        $chirp->update($validated);

        return redirect( route('chirps.index') );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp):RedirectResponse
    {
        $chirp->delete();
        return redirect(route('chirps.index'));
    }
}
