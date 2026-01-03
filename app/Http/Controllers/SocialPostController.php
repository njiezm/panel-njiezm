<?php

namespace App\Http\Controllers;

use App\Models\SocialPost;
use Illuminate\Http\Request;

class SocialPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $socialPosts = SocialPost::all();
        return view('social-posts.index', compact('socialPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('social-posts.create');
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
            'title' => 'required|string|max:255',
            'platform' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'content' => 'required|string',
            'scheduled_date' => 'nullable|date|after:today',
            'status' => 'required|in:draft,scheduled,published',
            'metadata' => 'nullable|array',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('social-posts', 'public');
            $validated['image_path'] = $path;
        }

        $socialPost = SocialPost::create([
            'title' => $validated['title'],
            'platform' => $validated['platform'],
            'type' => $validated['type'],
            'content' => $validated['content'],
            'image_path' => $validated['image_path'] ?? null,
            'scheduled_date' => $validated['scheduled_date'] ?? null,
            'status' => $validated['status'],
            'metadata' => $validated['metadata'] ?? null,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('social-posts.index')
                         ->with('success', 'Post réseau social créé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SocialPost  $socialPost
     * @return \Illuminate\View\View
     */
    public function show(SocialPost $socialPost)
    {
        return view('social-posts.show', compact('socialPost'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SocialPost  $socialPost
     * @return \Illuminate\View\View
     */
    public function edit(SocialPost $socialPost)
    {
        return view('social-posts.edit', compact('socialPost'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SocialPost  $socialPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SocialPost $socialPost)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'platform' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'content' => 'required|string',
            'scheduled_date' => 'nullable|date|after:today',
            'status' => 'required|in:draft,scheduled,published',
            'metadata' => 'nullable|array',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('social-posts', 'public');
            $validated['image_path'] = $path;
        }

        $socialPost->update($validated);

        return redirect()->route('social-posts.index')
                         ->with('success', 'Post réseau social mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SocialPost  $socialPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialPost $socialPost)
    {
        $socialPost->delete();

        return redirect()->route('social-posts.index')
                         ->with('success', 'Post réseau social supprimé avec succès.');
    }

    /**
 * Affiche le générateur de posts Instagram
 *
 * @return \Illuminate\View\View
 */
public function instagramGenerator()
{
    return view('social-posts.instagram-generator');
}

/**
 * Affiche le générateur de posts LinkedIn
 *
 * @return \Illuminate\View\View
 */
public function linkedinGenerator()
{
    return view('social-posts.linkedin-generator');
}

/**
 * Stocke un post réseau social via API
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\JsonResponse
 */
public function apiStore(Request $request)
{
    $validated = $request->validate([
        'platform' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'content' => 'required|string',
        'hashtags' => 'nullable|string',
        'cta' => 'nullable|string',
        'url' => 'nullable|url',
        'tone' => 'nullable|string',
        'format' => 'nullable|string',
        'image' => 'nullable|string',
        'metadata' => 'nullable|array',
    ]);

    $socialPost = SocialPost::create([
        'title' => 'Post ' . $validated['platform'] . ' - ' . $validated['type'],
        'platform' => $validated['platform'],
        'type' => $validated['type'],
        'content' => $validated['content'],
        'image_path' => $validated['image'] ?? null,
        'status' => 'draft',
        'metadata' => $validated,
        'user_id' => auth()->id(),
    ]);

    return response()->json(['success' => true, 'id' => $socialPost->id]);
}

/**
 * Récupère les posts réseau sociaux via API
 *
 * @return \Illuminate\Http\JsonResponse
 */
public function apiIndex()
{
    $socialPosts = SocialPost::where('user_id', auth()->id())->get();
    return response()->json($socialPosts);
}
}