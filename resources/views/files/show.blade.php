@extends('layouts.app')

@section('title', '{{ $file->name }} - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item"><a href="{{ route('files.index') }}">Gestionnaire de fichiers</a></li>
        @if($file->folder !== 'root')
            <li class="breadcrumb-item"><a href="{{ route('files.folder', $file->folder) }}">{{ $file->folder }}</a></li>
        @endif
        <li class="breadcrumb-item active">{{ $file->name }}</li>
    </ol>
</nav>

<div class="card-custom">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="brand-font">{{ $file->name }}</h3>
        <div class="btn-group">
            <a href="{{ route('files.edit', $file->id) }}" class="btn btn-outline-secondary">
                <i class="fas fa-edit me-2"></i>Modifier
            </a>
            <a href="{{ route('files.download', $file->id) }}" class="btn btn-outline-info">
                <i class="fas fa-download me-2"></i>Télécharger
            </a>
            <button type="button" class="btn btn-outline-success" onclick="shareFile({{ $file->id }})">
                <i class="fas fa-share me-2"></i>Partager
            </button>
            <button type="button" class="btn btn-outline-danger" onclick="confirmDelete({{ $file->id }})">
                <i class="fas fa-trash me-2"></i>Supprimer
            </button>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-8">
            @if($file->isImage())
                <div class="text-center mb-4">
                    <img src="{{ asset('storage/' . $file->path) }}" alt="{{ $file->name }}" class="img-fluid" style="max-height: 500px;">
                </div>
            @elseif($file->isPdf())
                <div class="text-center mb-4">
                    <iframe src="{{ asset('storage/' . $file->path) }}" width="100%" height="500px"></iframe>
                </div>
            @else
                <div class="text-center mb-4">
                    <i class="fas fa-file fa-5x text-muted"></i>
                    <p class="mt-3">Aperçu non disponible pour ce type de fichier.</p>
                    <a href="{{ route('files.download', $file->id) }}" class="btn btn-primary">
                        <i class="fas fa-download me-2"></i>Télécharger pour afficher
                    </a>
                </div>
            @endif
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6>Informations sur le fichier</h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <th>Nom original</th>
                            <td>{{ $file->original_name }}</td>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td>{{ $file->mime_type }}</td>
                        </tr>
                        <tr>
                            <th>Taille</th>
                            <td>{{ $file->size }}</td>
                        </tr>
                        <tr>
                            <th>Dossier</th>
                            <td>
                                @if($file->folder !== 'root')
                                    <a href="{{ route('files.folder', $file->folder) }}">{{ $file->folder }}</a>
                                @else
                                    Racine
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Propriétaire</th>
                            <td>{{ $file->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Date d'ajout</th>
                            <td>{{ $file->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Dernière modification</th>
                            <td>{{ $file->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Visibilité</th>
                            <td>
                                @if($file->is_public)
                                    <span class="badge bg-success">Public</span>
                                @else
                                    <span class="badge bg-secondary">Privé</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                    
                    @if($file->description)
                        <div class="mt-3">
                            <h6>Description</h6>
                            <p>{{ $file->description }}</p>
                        </div>
                    @endif
                    
                    @if($file->share_token)
                        <div class="mt-3">
                            <h6>Lien de partage</h6>
                            <div class="input-group">
                                <input type="text" class="form-control" value="{{ route('shared.file', $file->share_token) }}" readonly>
                                <button class="btn btn-outline-secondary" onclick="copyShareLink()">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-4">
        <a href="{{ $file->folder !== 'root' ? route('files.folder', $file->folder) : route('files.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Retour
        </a>
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

<script>
// Variable globale pour le fichier à supprimer
let fileToDelete = null;

// Fonction pour confirmer la suppression
function confirmDelete(fileId) {
    fileToDelete = fileId;
    const deleteForm = document.getElementById('delete-form');
    deleteForm.action = `/files/${fileId}`;
    
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}

// Fonction pour copier le lien de partage
function copyShareLink() {
    const shareLink = document.querySelector('input[readonly]').value;
    navigator.clipboard.writeText(shareLink).then(() => {
        alert('Lien de partage a été copié dans votre presse-papiers !');
    });
}

// Fonction pour partager un fichier
function shareFile(fileId) {
    fetch(`/files/${fileId}/share`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Fichier partagé avec succès !');
            // Recharger la page pour afficher le lien de partage
            location.reload();
        } else {
            alert('Une erreur est survenue lors du partage du fichier.');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Une erreur est survenue lors du partage du fichier.');
    });
}
</script>
@endsection