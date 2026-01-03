<?php

namespace App\Http\Controllers;

use App\Models\BrandAsset;
use Illuminate\Http\Request;

class BrandAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $brandAssets = BrandAsset::all();
        return view('brand-assets.index', compact('brandAssets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('brand-assets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'file_path' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'metadata' => 'nullable|array',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('brand-assets', 'public');
            $validated['file_path'] = $path;
        }

        $brandAsset = BrandAsset::create([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'category' => $validated['category'],
            'file_path' => $validated['file_path'] ?? null,
            'description' => $validated['description'] ?? null,
            'metadata' => $validated['metadata'] ?? null,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('brand-assets.index')
                         ->with('success', 'Ressource de marque créée avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BrandAsset  $brandAsset
     * @return \Illuminate\View\View
     */
    public function show(BrandAsset $brandAsset)
    {
        return view('brand-assets.show', compact('brandAsset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BrandAsset  $brandAsset
     * @return \Illuminate\View\View
     */
    public function edit(BrandAsset $brandAsset)
    {
        return view('brand-assets.edit', compact('brandAsset'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BrandAsset  $brandAsset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BrandAsset $brandAsset)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'file_path' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'metadata' => 'nullable|array',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('brand-assets', 'public');
            $validated['file_path'] = $path;
        }

        $brandAsset->update($validated);

        return redirect()->route('brand-assets.index')
                         ->with('success', 'Ressource de marque mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BrandAsset  $brandAsset
     * @return \Illuminate\Http\Response
     */
    public function destroy(BrandAsset $brandAsset)
    {
        $brandAsset->delete();

        return redirect()->route('brand-assets.index')
                         ->with('success', 'Ressource de marque supprimée avec succès.');
    }
}