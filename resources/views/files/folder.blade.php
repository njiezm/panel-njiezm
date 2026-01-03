@extends('layouts.app')

@section('title', 'Dossier ' . $folder . ' - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item"><a href="{{ route('files.index') }}">Gestionnaire de fichiers</a></li>
        <li class="breadcrumb-item active">{{ $folder }}</li>
    </ol>
</nav>

<div class="card-custom">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="brand-font">Dossier : {{ $folder }}</h3>
        <div class="btn-group">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
                <i class="fas fa-upload me-2"></i>Télécharger un fichier
            </button>
            <a href="{{ route('files.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Retour à la racine
            </a>
        </div>
    </div>
    
    <!-- Dossiers -->
    @if($folders->count() > 0)
        <div class="row mb-4">
            <div class="col-12">
                <h5 class="brand-font">
                    <i class="fas fa-folder-open me-2"></i>Dossiers
                </h5>
                <div class="row">
                    @foreach($folders as $f)
                        @if($f !== $folder)
                        <div class="col-md-2 col-sm-3 col-4 mb-3">
                            <a href="{{ route('files.folder', $f) }}" class="folder-card">
                                <div class="card h-100 text-center folder-item">
                                    <div class="card-body">
                                        <i class="fas fa-folder fa-3x mb-2 folder-icon"></i>
                                        <p class="card-text folder-name">{{ $f }}</p>
                                        <div class="folder-info">
                                            <small class="text-muted">
                                                {{ \App\Models\File::where('user_id', Auth::id())->where('folder', $f)->count() }} fichiers
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    
    <!-- Fichiers dans le dossier -->
    <div class="row">
        <div class="col-12">
            <h5 class="brand-font">
                <i class="fas fa-file me-2"></i>Fichiers dans {{ $folder }}
            </h5>
            @if($files->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Type</th>
                                <th>Taille</th>
                                <th>Date de modification</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($files as $file)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($file->isImage())
                                                <img src="{{ asset('storage/' . $file->path) }}" alt="{{ $file->name }}" class="me-2 file-preview" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                                            @elseif($file->isPdf())
                                                <i class="fas fa-file-pdf fa-2x me-2 file-icon-pdf"></i>
                                            @else
                                                <i class="fas fa-file fa-2x me-2 file-icon-default"></i>
                                            @endif
                                            <div>
                                                <div class="file-name">{{ $file->name }}</div>
                                                <small class="text-muted">{{ $file->original_name }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $file->getExtension() }}</span>
                                    </td>
                                    <td>{{ $file->formatted_size }}</td>
                                    <td>{{ $file->updated_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('files.show', $file->id) }}" class="btn btn-outline-primary" title="Voir">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('files.edit', $file->id) }}" class="btn btn-outline-secondary" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('files.download', $file->id) }}" class="btn btn-outline-info" title="Télécharger">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-success" onclick="shareFile({{ $file->id }})" title="Partager">
                                                <i class="fas fa-share"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-danger" onclick="confirmDelete({{ $file->id }})" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5 empty-state">
                    <i class="fas fa-folder-open fa-4x mb-3 text-muted"></i>
                    <p class="text-muted">Aucun fichier dans ce dossier.</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
                        <i class="fas fa-upload me-2"></i>Télécharger un fichier
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal pour télécharger un fichier -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Télécharger un fichier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="file" class="form-label">Choisir un fichier</label>
                        <input type="file" class="form-control" id="file" name="file" required>
                        <div class="form-text">Taille maximale : 10MB</div>
                    </div>
                    <div class="mb-3">
                        <label for="folder" class="form-label">Dossier (Optionnel)</label>
                        <select class="form-select" id="folder" name="folder">
                            <option value="">Racine</option>
                            @foreach($folders as $f)
                                <option value="{{ $f }}" {{ $f === $folder ? 'selected' : '' }}>{{ $f }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description (Optionnel)</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_public" name="is_public" value="1">
                        <label class="form-check-label" for="is_public">
                            Rendre ce fichier public
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Télécharger</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer ce fichier ? Cette action est irréversible.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form id="delete-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Styles pour les dossiers */
.folder-card {
    text-decoration: none;
    color: inherit;
}

.folder-card:hover {
    text-decoration: none;
}

.folder-item {
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    overflow: hidden;
}

.folder-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    border-color: var(--nj-blue);
}

.folder-icon {
    color: var(--nj-blue);
    transition: color 0.3s ease;
}

.folder-item:hover .folder-icon {
    color: var(--nj-dark);
}

.folder-name {
    font-weight: 500;
    margin-bottom: 5px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.folder-info {
    font-size: 0.75rem;
    margin-top: 5px;
}

/* Styles pour les fichiers */
.file-preview {
    border: 1px solid #e9ecef;
}

.file-icon-pdf {
    color: #dc3545;
}

.file-icon-default {
    color: #6c757d;
}

.file-name {
    font-weight: 500;
}

/* État vide */
.empty-state {
    padding: 40px 0;
}
</style>

<script>
// Fonction pour confirmer la suppression d'un fichier
function confirmDelete(fileId) {
    const deleteForm = document.getElementById('delete-form');
    deleteForm.action = '/files/' + fileId;
    
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}

// Fonction pour partager un fichier
function shareFile(fileId) {
    // Implémenter la fonctionnalité de partage ici
    fetch('/files/' + fileId + '/share', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Afficher une notification avec le lien de partage
            showNotification('Fichier partagé avec succès. Lien : ' + data.share_url, 'success');
        } else {
            showNotification('Erreur lors du partage du fichier', 'danger');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        showNotification('Erreur lors du partage du fichier', 'danger');
    });
}

// Fonction pour afficher une notification
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
        notification.classList.remove('show');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 150);
    }, 3000);
}
</script>
@endsection