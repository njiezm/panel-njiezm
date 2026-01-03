<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $projects = Project::with('users')->get();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users = User::all();
        return view('projects.create', compact('users'));
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
            'description' => 'nullable|string',
            'client' => 'required|string|max:255',
            'deadline' => 'required|date',
            'users' => 'nullable|array',
            'users.*' => 'exists:users,id',
        ]);

        $project = Project::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'client' => $validated['client'],
            'deadline' => $validated['deadline'],
            'user_id' => auth()->id(),
        ]);

        if (isset($validated['users'])) {
            $project->users()->attach($validated['users']);
        }

        // Créer une activité seulement si le modèle existe
        if (class_exists('App\Models\Activity')) {
            \App\Models\Activity::create([
                'title' => 'Nouveau projet créé',
                'description' => $project->name . ' pour ' . $project->client,
                'type' => 'project_created',
                'user_id' => auth()->id(),
                'activitable_id' => $project->id,
                'activitable_type' => Project::class,
            ]);
        }

        return redirect()->route('projects.index')
                         ->with('success', 'Projet créé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\View\View
     */
    public function show(Project $project)
    {
        $project->load('users');
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\View\View
     */
    public function edit(Project $project)
    {
        $users = User::all();
        return view('projects.edit', compact('project', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client' => 'required|string|max:255',
            'status' => 'required|in:active,completed,archived',
            'progress' => 'required|integer|min:0|max:100',
            'deadline' => 'required|date',
            'users' => 'nullable|array',
            'users.*' => 'exists:users,id',
        ]);

        $project->update($validated);

        if (isset($validated['users'])) {
            $project->users()->sync($validated['users']);
        }

        return redirect()->route('projects.index')
                         ->with('success', 'Projet mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')
                         ->with('success', 'Projet supprimé avec succès.');
    }
}