@extends('layouts.app')

@section('title', 'Projets - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Projets</li>
    </ol>
</nav>

<!-- SECTION PROJETS -->
<section id="projects">
    <div class="card-custom">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="brand-font">Projets</h3>
            <div class="btn-group">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newProjectModal">
                    <i class="fas fa-plus me-2"></i>NOUVEAU PROJET
                </button>
                <button class="btn btn-outline-primary" onclick="exportProjects()">
                    <i class="fas fa-download me-2"></i>EXPORTER
                </button>
            </div>
        </div>
        
        <!-- Onglets -->
        <ul class="nav nav-tabs tab-custom mt-3">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#allProjects">Tous les projets</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#activeProjects">Actifs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#completedProjects">Terminés</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#archivedProjects">Archivés</a>
            </li>
        </ul>
        
        <div class="tab-content mt-3">
            <!-- Onglet Tous les projets -->
            <div class="tab-pane fade show active" id="allProjects">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" class="form-control" id="projectSearch" placeholder="Rechercher un projet...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex gap-2">
                            <select class="form-select" id="statusFilter">
                                <option value="">Tous les statuts</option>
                                <option value="active">Actifs</option>
                                <option value="completed">Terminés</option>
                                <option value="archived">Archivés</option>
                            </select>
                            <select class="form-select" id="sortBy">
                                <option value="name">Nom</option>
                                <option value="deadline">Date d'échéance</option>
                                <option value="progress">Progression</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row" id="projectsContainer">
                    @if(isset($projects) && $projects->count() > 0)
                        @foreach($projects as $project)
                            <div class="col-md-4 mb-4 project-item" data-status="{{ $project->status }}">
                                <div class="project-card h-100">
                                    <div class="card-header d-flex justify-content-between align-items-start">
                                        <div>
                                            <h5 class="card-title">{{ $project->name }}</h5>
                                            <p class="text-muted small mb-2">{{ $project->client }}</p>
                                            <div>
                                                @foreach($project->tags ?? [] as $tag)
                                                    <span class="tag">{{ $tag }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ route('projects.show', $project) }}"><i class="fas fa-eye me-2"></i>Voir</a></li>
                                                <li><a class="dropdown-item" href="{{ route('projects.edit', $project) }}"><i class="fas fa-edit me-2"></i>Modifier</a></li>
                                                <li><a class="dropdown-item" href="#" onclick="archiveProject({{ $project->id }})"><i class="fas fa-archive me-2"></i>Archiver</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger"><i class="fas fa-trash me-2"></i>Supprimer</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">{{ Str::limit($project->description ?? 'Aucune description', 100) }}</p>
                                        <div class="mt-3">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <span class="small">Progression</span>
                                                <span class="small fw-bold">{{ $project->progress ?? 0 }}%</span>
                                            </div>
                                            <div class="project-progress">
                                                <div class="project-progress-bar" style="width: {{ $project->progress ?? 0 }}%"></div>
                                            </div>
                                        </div>
                                        <div class="mt-3 d-flex justify-content-between align-items-center">
                                            <div class="d-flex">
                                                @if($project->users && $project->users->count() > 0)
                                                    @foreach($project->users->take(3) as $user)
                                                        @if($user->avatar)
                                                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="rounded-circle me-1" style="width: 30px; height: 30px;">
                                                        @else
                                                            <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-1" style="width: 30px; height: 30px; font-size: 0.7rem;">{{ substr($user->name, 0, 1) }}</div>
                                                        @endif
                                                    @endforeach
                                                    @if($project->users->count() > 3)
                                                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-1" style="width: 30px; height: 30px; font-size: 0.7rem;">+{{ $project->users->count() - 3 }}</div>
                                                    @endif
                                                @else
                                                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-1" style="width: 30px; height: 30px; font-size: 0.7rem;">?</div>
                                                @endif
                                            </div>
                                            <span class="small text-muted">Échéance: {{ $project->deadline ? $project->deadline->format('d/m/Y') : 'Non définie' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            <div class="text-center py-5">
                                <i class="fas fa-project-diagram fa-3x text-muted mb-3"></i>
                                <h5>Aucun projet trouvé</h5>
                                <p class="text-muted">Commencez par créer votre premier projet pour organiser vos travaux.</p>
                                <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#newProjectModal">
                                    <i class="fas fa-plus me-2"></i>Créer un projet
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Onglet Projets actifs -->
            <div class="tab-pane fade" id="activeProjects">
                <div class="row" id="activeProjectsContainer">
                    <!-- Les projets actifs seront chargés ici via JavaScript -->
                </div>
            </div>
            
            <!-- Onglet Projets terminés -->
            <div class="tab-pane fade" id="completedProjects">
                <div class="row" id="completedProjectsContainer">
                    <!-- Les projets terminés seront chargés ici via JavaScript -->
                </div>
            </div>
            
            <!-- Onglet Projets archivés -->
            <div class="tab-pane fade" id="archivedProjects">
                <div class="row" id="archivedProjectsContainer">
                    <!-- Les projets archivés seront chargés ici via JavaScript -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal pour créer un nouveau projet -->
<div class="modal fade" id="newProjectModal" tabindex="-1" aria-labelledby="newProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newProjectModalLabel">Créer un nouveau projet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('projects.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom du projet</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="client" class="form-label">Client</label>
                        <input type="text" class="form-control" id="client" name="client" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="deadline" class="form-label">Date d'échéance</label>
                                <input type="date" class="form-control" id="deadline" name="deadline" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Statut</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="active">Actif</option>
                                    <option value="completed">Terminé</option>
                                    <option value="archived">Archivé</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="users" class="form-label">Membres de l'équipe</label>
                        <select class="form-select" id="users" name="users[]" multiple>
                            @if(isset($users))
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <div class="form-text">Maintenez Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs membres.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Créer le projet</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Variables globales
let projectsData = @json(isset($projects) ? $projects->toArray() : '[]');

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    setupEventListeners();
    filterProjects();
});

// Configuration des écouteurs d'événements
function setupEventListeners() {
    // Recherche
    document.getElementById('projectSearch').addEventListener('input', filterProjects);
    
    // Filtres
    document.getElementById('statusFilter').addEventListener('change', filterProjects);
    document.getElementById('sortBy').addEventListener('change', sortProjects);
    
    // Onglets
    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
        tab.addEventListener('shown.bs.tab', function(e) {
            const target = e.target.getAttribute('href');
            if (target === '#activeProjects') {
                filterProjectsByStatus('active');
            } else if (target === '#completedProjects') {
                filterProjectsByStatus('completed');
            } else if (target === '#archivedProjects') {
                filterProjectsByStatus('archived');
            }
        });
    });
}

// Filtrer les projets
function filterProjects() {
    const searchTerm = document.getElementById('projectSearch').value.toLowerCase();
    const statusFilter = document.getElementById('statusFilter').value;
    
    const projectItems = document.querySelectorAll('.project-item');
    
    projectItems.forEach(item => {
        const title = item.querySelector('.card-title').textContent.toLowerCase();
        const client = item.querySelector('.text-muted').textContent.toLowerCase();
        const status = item.dataset.status;
        
        const matchesSearch = title.includes(searchTerm) || client.includes(searchTerm);
        const matchesStatus = !statusFilter || status === statusFilter;
        
        if (matchesSearch && matchesStatus) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
}

// Filtrer les projets par statut
function filterProjectsByStatus(status) {
    const container = document.getElementById(status + 'ProjectsContainer');
    container.innerHTML = '';
    
    const filteredProjects = projectsData.filter(project => project.status === status);
    
    if (filteredProjects.length === 0) {
        container.innerHTML = `
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                    <h5>Aucun projet ${status === 'active' ? 'actif' : (status === 'completed' ? 'terminé' : 'archivé')}</h5>
                    <p class="text-muted">Aucun projet ${status === 'active' ? 'actif' : (status === 'completed' ? 'terminé' : 'archivé')} trouvé.</p>
                </div>
            </div>
        `;
        return;
    }
    
    filteredProjects.forEach(project => {
        const projectHtml = createProjectCard(project);
        container.innerHTML += projectHtml;
    });
}

// Trier les projets
function sortProjects() {
    const sortBy = document.getElementById('sortBy').value;
    
    let sortedProjects = [...projectsData];
    
    switch (sortBy) {
        case 'name':
            sortedProjects.sort((a, b) => a.name.localeCompare(b.name));
            break;
        case 'deadline':
            sortedProjects.sort((a, b) => new Date(a.deadline) - new Date(b.deadline));
            break;
        case 'progress':
            sortedProjects.sort((a, b) => (b.progress || 0) - (a.progress || 0));
            break;
    }
    
    projectsData = sortedProjects;
    filterProjects();
}

// Créer une carte de projet
function createProjectCard(project) {
    const tags = project.tags ? project.tags.map(tag => `<span class="tag">${tag}</span>`).join('') : '';
    const users = project.users ? project.users.map(user => 
        user.avatar 
            ? `<img src="/storage/${user.avatar}" alt="${user.name}" class="rounded-circle me-1" style="width: 30px; height: 30px;">`
            : `<div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-1" style="width: 30px; height: 30px; font-size: 0.7rem;">${user.name.charAt(0)}</div>`
    ).join('') : '<div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-1" style="width: 30px; height: 30px; font-size: 0.7rem;">?</div>';
    
    const moreUsers = project.users && project.users.length > 3 
        ? `<div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-1" style="width: 30px; height: 30px; font-size: 0.7rem;">+${project.users.length - 3}</div>`
        : '';
    
    return `
        <div class="col-md-4 mb-4 project-item" data-status="${project.status}">
            <div class="project-card h-100">
                <div class="card-header d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title">${project.name}</h5>
                        <p class="text-muted small mb-2">${project.client}</p>
                        <div>${tags}</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/projects/${project.id}"><i class="fas fa-eye me-2"></i>Voir</a></li>
                            <li><a class="dropdown-item" href="/projects/${project.id}/edit"><i class="fas fa-edit me-2"></i>Modifier</a></li>
                            <li><a class="dropdown-item" href="#" onclick="archiveProject(${project.id})"><i class="fas fa-archive me-2"></i>Archiver</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="/projects/${project.id}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="dropdown-item text-danger"><i class="fas fa-trash me-2"></i>Supprimer</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">${project.description ? project.description.substring(0, 100) + '...' : 'Aucune description'}</p>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="small">Progression</span>
                            <span class="small fw-bold">${project.progress || 0}%</span>
                        </div>
                        <div class="project-progress">
                            <div class="project-progress-bar" style="width: ${project.progress || 0}%"></div>
                        </div>
                    </div>
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <div class="d-flex">
                            ${users}${moreUsers}
                        </div>
                        <span class="small text-muted">Échéance: ${project.deadline ? new Date(project.deadline).toLocaleDateString('fr-FR') : 'Non définie'}</span>
                    </div>
                </div>
            </div>
        </div>
    `;
}

// Archiver un projet
function archiveProject(projectId) {
    if (confirm('Êtes-vous sûr de vouloir archiver ce projet ?')) {
        // Envoyer une requête pour archiver le projet
        fetch(`/projects/${projectId}/archive`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('Projet archivé avec succès', 'success');
                location.reload();
            } else {
                showNotification('Erreur lors de l\'archivage du projet', 'danger');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showNotification('Erreur lors de l\'archivage du projet', 'danger');
        });
    }
}

// Exporter les projets
function exportProjects() {
    // Créer le contenu à exporter
    let content = 'Projets - NJIEZM.FR\n\n';
    
    projectsData.forEach(project => {
        content += `Nom: ${project.name}\n`;
        content += `Client: ${project.client}\n`;
        content += `Statut: ${project.status}\n`;
        content += `Progression: ${project.progress || 0}%\n`;
        content += `Échéance: ${project.deadline ? new Date(project.deadline).toLocaleDateString('fr-FR') : 'Non définie'}\n`;
        content += `Description: ${project.description || 'Aucune description'}\n\n`;
    });
    
    // Créer et télécharger le fichier
    const blob = new Blob([content], { type: 'text/plain' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.download = 'projets_njiezm.txt';
    link.click();
    URL.revokeObjectURL(url);
    
    showNotification('Projets exportés avec succès', 'success');
}

// Afficher une notification
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    notification.style.top = '20px';
    notification.style.right = '20px';
    notification.style.zIndex = '9999';
    notification.style.minWidth = '300px';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.remove('alert-show');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 150);
    }, 3000);
}
</script>

<style>
.project-card {
    transition: transform 0.2s;
}

.project-card:hover {
    transform: translateY(-5px);
}

.project-progress {
    height: 8px;
    background-color: #e9ecef;
    border-radius: 4px;
    overflow: hidden;
    margin-top: 5px;
}

.project-progress-bar {
    height: 100%;
    background-color: var(--nj-blue);
    transition: width 0.3s ease;
}

.tag {
    display: inline-block;
    padding: 2px 8px;
    background-color: var(--nj-light);
    border-radius: 12px;
    font-size: 0.7rem;
    margin-right: 5px;
    margin-bottom: 5px;
}

.search-box {
    position: relative;
}

.search-box i {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
}

.search-box input {
    padding-left: 35px;
}
</style>
@endsection