<?php

namespace App\Http\Controllers;

use App\Models\Urlshort;
use App\Models\Urlvisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UrlshortController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $urls = Urlshort::where('created_by', Auth::user()->id)->latest()->paginate(50);

        return view('urls.index',compact('urls'))->with((request()->input('page', 1) - 1) * 50);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('urls.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'input_url' => 'required|string|max:255',
        ]);

        $validated['created_by'] = Auth::id();
        Urlshort::create($validated);

        return redirect()->route('url.index')->with('success', 'url saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Urlshort $urlshort)
    {
        $visits = Urlvisit::where('url_id', $urlshort->id)->latest()->paginate(50);

        $total_visit = Urlvisit::where('url_id', $urlshort->id)->count();

        return view('urls.show',compact('urlshort','visits','total_visit'))
                ->with((request()->input('page', 1) - 1) * 50);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Urlshort $urlshort)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Urlshort $urlshort)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Urlshort $urlshort)
    {
        $urlshort->delete();
           
        return redirect()->route('url.index') ->with('success','url deleted successfully');
    }
}
