@extends('layouts.app')

@section('title', 'Équipe & Permissions - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Équipe & Permissions</li>
    </ol>
</nav>

<div class="card-custom">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="brand-font">23. Équipe & Permissions</h3>
        <div class="btn-group">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#teamModal">
                <i class="fas fa-plus me-2"></i>Nouvelle équipe
            </button>
            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#userModal">
                <i class="fas fa-user-plus me-2"></i>Ajouter un membre
            </button>
        </div>
    </div>
    
    <!-- Onglets -->
    <ul class="nav nav-tabs tab-custom mt-3">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#teams">Équipes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#members">Membres</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#permissions">Permissions</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#activity">Activité</a>
        </li>
    </ul>
    
    <div class="tab-content mt-3">
        <!-- Onglet Équipes -->
        <div class="tab-pane fade show active" id="teams">
            <div class="row">
                @foreach($teams ?? [] as $team)
                <div class="col-md-4 mb-3">
                    <div class="card h-100 team-card">
                        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: {{ $team->color }}20; border-left: 4px solid {{ $team->color }};">
                            <h5 class="mb-0">{{ $team->name }}</h5>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('teams.edit', $team->id) }}"><i class="fas fa-edit me-2"></i>Modifier</a></li>
                                    <li><a class="dropdown-item text-danger" href="#" onclick="confirmDeleteTeam({{ $team->id }})"><i class="fas fa-trash me-2"></i>Supprimer</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $team->description ?? 'Aucune description' }}</p>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-users me-2"></i>
                                <span>{{ $team->users->count() }} membre{{ $team->users->count() > 1 ? 's' : '' }}</span>
                            </div>
                            <div class="team-members">
                                @foreach($team->users->take(4) as $member)
                                <div class="team-member-avatar" title="{{ $member->name }}">
                                    {{ substr($member->name, 0, 1) }}
                                </div>
                                @endforeach
                                @if($team->users->count() > 4)
                                <div class="team-member-avatar more" title="Plus de membres">
                                    +{{ $team->users->count() - 4 }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="{{ route('teams.show', $team->id) }}" class="btn btn-sm btn-outline-primary w-100">Voir les détails</a>
                        </div>
                    </div>
                </div>
                @endforeach
                
                @if(!isset($teams) || $teams->isEmpty())
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                        <h5>Aucune équipe créée</h5>
                        <p class="text-muted">Commencez par créer votre première équipe pour organiser vos collaborateurs.</p>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#teamModal">
                            <i class="fas fa-plus me-2"></i>Créer une équipe
                        </button>
                    </div>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Onglet Membres -->
        <div class="tab-pane fade" id="members">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Membre</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Statut</th>
                            <th>Équipes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users ?? [] as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-2" style="background-color: {{ $user->role === 'admin' ? 'var(--nj-blue)' : 'var(--nj-light)' }};">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $user->name }}</div>
                                        <small class="text-muted">Membre depuis {{ $user->created_at->format('d/m/Y') }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'designer' ? 'info' : ($user->role === 'developer' ? 'success' : ($user->role === 'marketing' ? 'warning' : 'secondary'))) }}">
                                    {{ $user->role === 'admin' ? 'Administrateur' : ($user->role === 'designer' ? 'Designer' : ($user->role === 'developer' ? 'Développeur' : ($user->role === 'marketing' ? 'Marketing' : ($user->role === 'sales' ? 'Commercial' : 'Client')))) }}
                                </span>
                            </td>
                            <td>
                                <span class="status-indicator status-{{ $user->status }}"></span>
                                {{ $user->status === 'online' ? 'En ligne' : ($user->status === 'offline' ? 'Hors ligne' : 'Occupé') }}
                            </td>
                            <td>
                                <div class="d-flex flex-wrap">
                                    @foreach($user->teams->take(2) as $team)
                                    <span class="badge me-1 mb-1" style="background-color: {{ $team->color }}20; color: {{ $team->color }};">
                                        {{ $team->name }}
                                    </span>
                                    @endforeach
                                    @if($user->teams->count() > 2)
                                    <span class="badge me-1 mb-1 bg-secondary">+{{ $user->teams->count() - 2 }}</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-outline-primary" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-secondary" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDeleteUser({{ $user->id }})" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        
                        @if(!isset($users) || $users->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="fas fa-user-friends fa-2x text-muted mb-2"></i>
                                <p class="mb-0">Aucun membre trouvé</p>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Onglet Permissions -->
        <div class="tab-pane fade" id="permissions">
            <div class="row">
                <div class="col-md-6">
                    <h5>Permissions par rôle</h5>
                    <div class="accordion" id="permissionsAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="adminHeading">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#adminCollapse" aria-expanded="true" aria-controls="adminCollapse">
                                    <i class="fas fa-user-shield me-2 text-danger"></i>Administrateur
                                </button>
                            </h2>
                            <div id="adminCollapse" class="accordion-collapse collapse show" aria-labelledby="adminHeading" data-bs-parent="#permissionsAccordion">
                                <div class="accordion-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Gestion des utilisateurs
                                            <i class="fas fa-check text-success"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Gestion des équipes
                                            <i class="fas fa-check text-success"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Gestion des projets
                                            <i class="fas fa-check text-success"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Gestion des ressources de marque
                                            <i class="fas fa-check text-success"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Gestion des documents
                                            <i class="fas fa-check text-success"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Accès aux statistiques
                                            <i class="fas fa-check text-success"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Configuration du système
                                            <i class="fas fa-check text-success"></i>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="designerHeading">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#designerCollapse" aria-expanded="false" aria-controls="designerCollapse">
                                    <i class="fas fa-palette me-2 text-info"></i>Designer
                                </button>
                            </h2>
                            <div id="designerCollapse" class="accordion-collapse collapse" aria-labelledby="designerHeading" data-bs-parent="#permissionsAccordion">
                                <div class="accordion-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Gestion des ressources de marque
                                            <i class="fas fa-check text-success"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Création de modèles
                                            <i class="fas fa-check text-success"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Génération de contenu visuel
                                            <i class="fas fa-check text-success"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Participation aux projets
                                            <i class="fas fa-check text-success"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Gestion des documents
                                            <i class="fas fa-check text-success"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Accès limité aux statistiques
                                            <i class="fas fa-check text-success"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Configuration du système
                                            <i class="fas fa-times text-danger"></i>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="developerHeading">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#developerCollapse" aria-expanded="false" aria-controls="developerCollapse">
                                    <i class="fas fa-code me-2 text-success"></i>Développeur
                                </button>
                            </h2>
                            <div id="developerCollapse" class="accordion-collapse collapse" aria-labelledby="developerHeading" data-bs-parent="#permissionsAccordion">
                                <div class="accordion-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Gestion des ressources techniques
                                            <i class="fas fa-check text-success"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Développement de fonctionnalités
                                            <i class="fas fa-check text-success"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Participation aux projets
                                            <i class="fas fa-check text-success"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Gestion des documents techniques
                                            <i class="fas fa-check text-success"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Accès aux statistiques techniques
                                            <i class="fas fa-check text-success"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Gestion des intégrations
                                            <i class="fas fa-check text-success"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Configuration du système
                                            <i class="fas fa-times text-danger"></i>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="marketingHeading">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#marketingCollapse" aria-expanded="false" aria-controls="marketingCollapse">
                                    <i class="fas fa-bullhorn me-2 text-warning"></i>Marketing
                                </button>
                            </h2>
                            <div id="marketingCollapse" class="accordion-collapse collapse" aria-labelledby="marketingHeading" data-bs-parent="#permissionsAccordion">
                                <div class="accordion-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Gestion des campagnes marketing
                                            <i class="fas fa-check text-success"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Création de contenu pour réseaux sociaux
                                            <i class="fas fa-check text-success"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Participation aux projets
                                            <i class="fas fa-check text-success"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Gestion des documents marketing
                                            <i class="fas fa-check text-success"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Accès aux statistiques marketing
                                            <i class="fas fa-check text-success"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Gestion des intégrations marketing
                                            <i class="fas fa-check text-success"></i>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Configuration du système
                                            <i class="fas fa-times text-danger"></i>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <h5>Permissions par ressource</h5>
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#projectsTab">Projets</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#assetsTab">Ressources</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#documentsTab">Documents</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="projectsTab">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Rôle</th>
                                                <th>Lecture</th>
                                                <th>Écriture</th>
                                                <th>Suppression</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Administrateur</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Designer</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Développeur</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Marketing</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Client</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="assetsTab">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Rôle</th>
                                                <th>Lecture</th>
                                                <th>Écriture</th>
                                                <th>Suppression</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Administrateur</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Designer</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Développeur</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Marketing</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Client</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="documentsTab">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Rôle</th>
                                                <th>Lecture</th>
                                                <th>Écriture</th>
                                                <th>Suppression</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Administrateur</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Designer</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Développeur</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Marketing</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Client</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <h5>Actions rapides</h5>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary" onclick="showPermissionModal()">
                                <i class="fas fa-key me-2"></i>Modifier les permissions par défaut
                            </button>
                            <button class="btn btn-outline-secondary" onclick="exportPermissions()">
                                <i class="fas fa-download me-2"></i>Exporter les permissions
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Onglet Activité -->
        <div class="tab-pane fade" id="activity">
            <div class="activity-timeline">
                @foreach($activities ?? [] as $activity)
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas {{ $activity->type === 'user_created' ? 'fa-user-plus' : ($activity->type === 'team_created' ? 'fa-users' : 'fa-edit') }}"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-header">
                            <h6>{{ $activity->title }}</h6>
                            <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                        </div>
                        <p>{{ $activity->description }}</p>
                        <div class="activity-footer">
                            <span class="badge bg-light text-dark">Par {{ $activity->user->name }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
                
                @if(!isset($activities) || $activities->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-history fa-3x text-muted mb-3"></i>
                    <h5>Aucune activité récente</h5>
                    <p class="text-muted">Les activités de votre équipe apparaîtront ici.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal pour créer une équipe -->
<div class="modal fade" id="teamModal" tabindex="-1" aria-labelledby="teamModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="teamModalLabel">Créer une nouvelle équipe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('teams.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="teamName" class="form-label">Nom de l'équipe</label>
                        <input type="text" class="form-control" id="teamName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="teamDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="teamDescription" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="teamColor" class="form-label">Couleur</label>
                        <input type="color" class="form-control form-control-color" id="teamColor" name="color" value="#003366">
                    </div>
                    <div class="mb-3">
                        <label for="teamMembers" class="form-label">Membres</label>
                        <select class="form-select" id="teamMembers" name="users[]" multiple>
                            @foreach($users ?? [] as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        <div class="form-text">Maintenez Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs membres.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Créer l'équipe</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal pour ajouter un utilisateur -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Ajouter un nouveau membre</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="userName" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="userName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="userEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="userEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="userPassword" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="userPassword" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="userPasswordConfirmation" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" id="userPasswordConfirmation" name="password_confirmation" required>
                    </div>
                    <div class="mb-3">
                        <label for="userRole" class="form-label">Rôle</label>
                        <select class="form-select" id="userRole" name="role" required>
                            <option value="admin">Administrateur</option>
                            <option value="designer">Designer</option>
                            <option value="developer">Développeur</option>
                            <option value="marketing">Marketing</option>
                            <option value="sales">Commercial</option>
                            <option value="client">Client</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="userStatus" class="form-label">Statut</label>
                        <select class="form-select" id="userStatus" name="status" required>
                            <option value="online">En ligne</option>
                            <option value="offline">Hors ligne</option>
                            <option value="busy">Occupé</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter le membre</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de confirmation de suppression d'équipe -->
<div class="modal fade" id="deleteTeamModal" tabindex="-1" aria-labelledby="deleteTeamModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteTeamModalLabel">Confirmation de suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer cette équipe ? Cette action est irréversible.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form id="deleteTeamForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation de suppression d'utilisateur -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Confirmation de suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form id="deleteUserForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Variables globales
let teamToDelete = null;
let userToDelete = null;

// Fonction pour confirmer la suppression d'une équipe
function confirmDeleteTeam(teamId) {
    teamToDelete = teamId;
    const deleteForm = document.getElementById('deleteTeamForm');
    deleteForm.action = `/teams/${teamId}`;
    
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteTeamModal'));
    deleteModal.show();
}

// Fonction pour confirmer la suppression d'un utilisateur
function confirmDeleteUser(userId) {
    userToDelete = userId;
    const deleteForm = document.getElementById('deleteUserForm');
    deleteForm.action = `/users/${userId}`;
    
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteUserModal'));
    deleteModal.show();
}

// Fonction pour afficher le modal de modification des permissions
function showPermissionModal() {
    // Implémenter la logique pour afficher un modal de modification des permissions
    alert('Fonctionnalité à développer');
}

// Fonction pour exporter les permissions
function exportPermissions() {
    // Implémenter la logique pour exporter les permissions
    alert('Fonctionnalité à développer');
}
</script>

<style>
.team-card {
    transition: transform 0.2s;
}

.team-card:hover {
    transform: translateY(-5px);
}

.team-members {
    display: flex;
    margin-top: 10px;
}

.team-member-avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: var(--nj-light);
    color: var(--nj-dark);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: bold;
    margin-right: -5px;
    border: 2px solid white;
}

.team-member-avatar.more {
    background-color: var(--nj-secondary);
    color: white;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

.status-indicator {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    display: inline-block;
    margin-right: 5px;
}

.status-online { background: var(--nj-success); }
.status-offline { background: #6c757d; }
.status-busy { background: var(--nj-danger); }

.activity-timeline {
    position: relative;
    padding-left: 30px;
}

.activity-timeline:before {
    content: '';
    position: absolute;
    left: 10px;
    top: 0;
    height: 100%;
    width: 2px;
    background: var(--nj-light);
}

.activity-item {
    position: relative;
    margin-bottom: 20px;
    padding-bottom: 10px;
}

.activity-item:before {
    content: '';
    position: absolute;
    left: -25px;
    top: 5px;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: var(--nj-blue);
}

.activity-icon {
    position: absolute;
    left: -25px;
    top: 0;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: var(--nj-blue);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
}

.activity-content {
    background: white;
    border: 1px solid var(--nj-light);
    border-radius: 8px;
    padding: 15px;
}

.activity-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 5px;
}

.activity-header h6 {
    margin: 0;
}
</style>
@endsection