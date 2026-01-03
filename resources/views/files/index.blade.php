@extends('layouts.app')

@section('title', 'Gestionnaire de fichiers - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Gestionnaire de fichiers</li>
    </ol>
</nav>

<div class="card-custom">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="brand-font">Gestionnaire de fichiers</h3>
        <div class="btn-group">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
                <i class="fas fa-upload me-2"></i>Télécharger un fichier
            </button>
            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#createFolderModal">
                <i class="fas fa-folder-plus me-2"></i>Créer un dossier
            </button>
        </div>
    </div>
    
    <!-- Barre de navigation des dossiers -->
    <div class="folder-navigation mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('files.index') }}">
                        <i class="fas fa-home me-1"></i>Racine
                    </a>
                </li>
                @if(isset($currentFolder))
                    <li class="breadcrumb-item active">{{ $currentFolder }}</li>
                @endif
            </ol>
        </nav>
    </div>
    
    <!-- Dossiers -->
@if($folders->count() > 0)
    <div class="row mb-4">
        <div class="col-12">
            <h5 class="brand-font">
                <i class="fas fa-folder-open me-2"></i>Dossiers
            </h5>
            <div class="row">
                @foreach($folders as $folder)
                    <div class="col-md-2 col-sm-3 col-4 mb-3">
                        <a href="{{ route('files.folder', $folder->name) }}" class="folder-card">
                            <div class="card h-100 text-center folder-item">
                                <div class="card-body">
                                    <i class="fas fa-folder fa-3x mb-2 folder-icon"></i>
                                    <p class="card-text folder-name">{{ $folder->name }}</p>
                                    <div class="folder-info">
                                        <small class="text-muted">
                                            {{ \App\Models\File::where('user_id', Auth::id())->where('folder', $folder->name)->files()->count() }} fichiers
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
    
    <!-- Fichiers à la racine -->
    <div class="row">
        <div class="col-12">
            <h5 class="brand-font">
                <i class="fas fa-file me-2"></i>Fichiers
                @if(isset($currentFolder))
                    dans {{ $currentFolder }}
                @else
                    à la racine
                @endif
            </h5>
            @if($rootFiles->count() > 0)
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
                            @foreach($rootFiles as $file)
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
                    <p class="text-muted">
                        @if(isset($currentFolder))
                            Aucun fichier dans ce dossier.
                        @else
                            Aucun fichier dans le dossier racine.
                        @endif
                    </p>
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
                            @foreach($folders as $folder)
                                <option value="{{ $folder }}" @if(isset($currentFolder) && $currentFolder === $folder) selected @endif>{{ $folder }}</option>
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

<!-- Modal pour créer un dossier -->
<div class="modal fade" id="createFolderModal" tabindex="-1" aria-labelledby="createFolderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createFolderModalLabel">Créer un dossier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="createFolderForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="folder_name" class="form-label">Nom du dossier</label>
                        <input type="text" 
                               class="form-control" 
                               id="folder_name" 
                               name="folder_name" 
                               required 
                               pattern="[a-zA-Z0-9_-]+"
                               title="Lettres, chiffres, tirets et underscores uniquement"
                               placeholder="ex: Mes_Documents">
                        <div class="invalid-feedback">
                            Veuillez entrer un nom de dossier valide.
                        </div>
                    </div>
                    <div class="alert alert-info d-none" id="folder-success-message">
                        <i class="fas fa-check-circle me-2"></i>
                        Dossier créé avec succès !
                    </div>
                    <div class="alert alert-danger d-none" id="folder-error-message">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <span id="error-text">Ce dossier existe déjà.</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Créer</button>
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
.folder-navigation {
    background-color: #f8f9fa;
    padding: 10px 15px;
    border-radius: 5px;
    margin-bottom: 20px;
}

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

/* Animation pour le bouton de soumission */
.btn:disabled {
    opacity: 0.65;
    cursor: not-allowed;
}

/* Messages d'alerte avec animations */
.alert {
    animation: slideIn 0.3s ease-out;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Validation des champs */
.form-control.is-invalid {
    border-color: var(--nj-danger);
}

.form-control.is-invalid:focus {
    border-color: var(--nj-danger);
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}

/* Messages d'alerte améliorés */
#folder-success-message {
    border-left: 4px solid var(--nj-success);
    background-color: rgba(40, 167, 69, 0.1);
    color: var(--nj-success);
}

#folder-error-message {
    border-left: 4px solid var(--nj-danger);
    background-color: rgba(220, 53, 69, 0.1);
    color: var(--nj-danger);
}
</style>

<script>
// Fonction pour formater la taille des fichiers
function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

// Gestionnaire d'événements pour le formulaire de création de dossier
document.getElementById('createFolderForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitButton = this.querySelector('button[type="submit"]');
    const successMessage = document.getElementById('folder-success-message');
    const errorMessage = document.getElementById('folder-error-message');
    const folderNameInput = document.getElementById('folder_name');
    
    // Masquer les messages d'alerte
    successMessage.classList.add('d-none');
    errorMessage.classList.add('d-none');
    
    // Désactiver le bouton pendant le traitement
    submitButton.disabled = true;
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Création en cours...';
    
    fetch('/files/create-folder', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erreur réseau: ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        // Réactiver le bouton
        submitButton.disabled = false;
        submitButton.innerHTML = 'Créer';
        
        if (data.success) {
            // Afficher le message de succès
            successMessage.classList.remove('d-none');
            successMessage.textContent = 'Dossier "' + data.folder + '" créé avec succès !';
            
            // Vider le champ de saisie
            folderNameInput.value = '';
            
            // Fermer le modal après un court délai
            setTimeout(() => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('createFolderModal'));
                modal.hide();
                
                // Rafraîchir la page pour voir le nouveau dossier
                window.location.reload();
            }, 1500);
        } else {
            // Afficher le message d'erreur
            errorMessage.classList.remove('d-none');
            errorMessage.textContent = data.message || 'Ce dossier existe déjà.';
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        
        // Réactiver le bouton
        submitButton.disabled = false;
        submitButton.innerHTML = 'Créer';
        
        // Afficher un message d'erreur générique
        errorMessage.classList.remove('d-none');
        errorMessage.textContent = 'Une erreur est survenue lors de la création du dossier. Veuillez réessayer.';
    });
});

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