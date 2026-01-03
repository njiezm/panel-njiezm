@extends('layouts.app')

@section('title', 'Tableau de bord - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="#">Accueil</a></li>
        <li class="breadcrumb-item active">Tableau de bord</li>
    </ol>
</nav>

<!-- SECTION TABLEAU DE BORD -->
<section id="dashboard">
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="dashboard-stat">
                <i class="fas fa-file-invoice"></i>
                <h3>{{ $stats['invoices'] }}</h3>
                <p>Factures ce mois</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-stat">
                <i class="fas fa-users"></i>
                <h3>{{ $stats['clients'] }}</h3>
                <p>Clients actifs</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-stat">
                <i class="fas fa-project-diagram"></i>
                <h3>{{ $stats['projects'] }}</h3>
                <p>Projets en cours</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-stat">
                <i class="fas fa-euro-sign"></i>
                <h3>{{ number_format($stats['revenue'], 1, ',', ' ') }}k</h3>
                <p>Chiffre d'affaires</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
                  <div class="card-custom">
    <h3 class="brand-font">Activité récente</h3>
    <div class="activity-timeline">
        @foreach($activities->take(4) as $activity)
            <div class="activity-item">
                <div class="d-flex justify-content-between">
                    <div>
                        <strong>{{ $activity->title }}</strong>
                        <p class="text-muted small mb-0">{{ $activity->description }}</p>
                    </div>
                    <span class="text-muted small">{{ $activity->created_at->diffForHumans() }}</span>
                </div>
            </div>
        @endforeach
    </div>
    
</div>

      

            <div class="card-custom">
                <h3 class="brand-font">Projets récents</h3>
                @foreach($projects as $project)
                    <div class="project-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5>{{ $project->name }}</h5>
                                <p class="text-muted small mb-2">{{ $project->client }}</p>
                                <div>
                                    <span class="tag">Design</span>
                                    <span class="tag">Développement</span>
                                    <span class="tag">Urgent</span>
                                </div>
                            </div>
                            <div class="text-center">
                                <div class="progress-ring">
                                    <svg width="120" height="120">
                                        <circle cx="60" cy="60" r="54" stroke="#e9ecef" stroke-width="8" fill="none"></circle>
                                        <circle cx="60" cy="60" r="54" stroke="#003366" stroke-width="8" fill="none" 
                                                stroke-dasharray="339.292" stroke-dashoffset="{{ 339.292 - (339.292 * $project->progress / 100) }}"></circle>
                                    </svg>
                                    <div style="margin-top: -80px;">{{ $project->progress }}%</div>
                                </div>
                            </div>
                        </div>
                        <div class="project-progress">
                            <div class="project-progress-bar" style="width: {{ $project->progress }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-custom">
                <h3 class="brand-font">Calendrier</h3>
                <div class="calendar-widget">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <button class="btn btn-sm"><i class="fas fa-chevron-left"></i></button>
                        <h5 class="mb-0">{{ now()->format('F Y') }}</h5>
                        <button class="btn btn-sm"><i class="fas fa-chevron-right"></i></button>
                    </div>
                    <div class="d-flex flex-wrap">
                        <div class="calendar-day">L</div>
                        <div class="calendar-day">M</div>
                        <div class="calendar-day">M</div>
                        <div class="calendar-day">J</div>
                        <div class="calendar-day">V</div>
                        <div class="calendar-day">S</div>
                        <div class="calendar-day">D</div>
                        @for($day = 1; $day <= now()->daysInMonth; $day++)
                            <div class="calendar-day {{ $day == now()->day ? 'today' : '' }} {{ $day == 13 || $day == 18 ? 'has-event' : '' }}">{{ $day }}</div>
                        @endfor
                    </div>
                </div>
            </div>
            
            <style>

                .quick-action {
    background: white;
    border: 1px solid var(--nj-light);
    border-radius: 5px;
    padding: 15px;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s;
    color: var(--nj-dark);
    display: block;
}

.quick-action:hover {
    border-color: var(--nj-yellow);
    transform: translateY(-3px);
    color: var(--nj-dark);
    text-decoration: none;
}

.quick-action i {
    font-size: 24px;
    color: var(--nj-blue);
    margin-bottom: 10px;
}
</style>
            <div class="card-custom">
    <h3 class="brand-font">Actions rapides</h3>
    <div class="row">
        <div class="col-6">
            <a href="{{ route('projects.index') }}" class="quick-action text-decoration-none">
                <i class="fas fa-plus-circle"></i>
                <p class="mb-0">Nouveau projet</p>
            </a>
        </div>
        <div class="col-6">
            <a href="{{ route('documents.index') }}" class="quick-action text-decoration-none">
                <i class="fas fa-file-invoice"></i>
                <p class="mb-0">Créer facture</p>
            </a>
        </div>
        <div class="col-6">
            <a href="{{ route('team') }}" class="quick-action text-decoration-none">
                <i class="fas fa-users"></i>
                <p class="mb-0">Inviter membre</p>
            </a>
        </div>
        <div class="col-6">
            <a href="{{ route('calendar.index') }}" class="quick-action text-decoration-none">
                <i class="fas fa-calendar-plus"></i>
                <p class="mb-0">Nouvel événement</p>
            </a>
        </div>
    </div>
</div>
        </div>
    </div>
</section>
@endsection