<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Document;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        
        // Statistiques
        $stats = [
            'invoices' => Document::where('type', 'invoice')->whereMonth('created_at', now()->month)->count(),
            'clients' => User::where('role', 'client')->count(),
            'projects' => Project::where('status', 'active')->count(),
            'revenue' => Document::where('type', 'invoice')->where('status', 'paid')->sum('amount'),
        ];
        
        // Activités récentes
        $activities = Activity::with('user')
                            ->orderBy('created_at', 'desc')
                            ->limit(10)
                            ->get();
        
        // Projets récents
        $projects = Project::with('users')
                         ->orderBy('created_at', 'desc')
                         ->limit(5)
                         ->get();
        
        return view('dashboard.index', compact('stats', 'activities', 'projects'));
    }
}