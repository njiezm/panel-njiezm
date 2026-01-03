@extends('layouts.app')

@section('title', 'Modèles & Templates - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Modèles & Templates</li>
    </ol>
</nav>

<div class="card-custom">
    <h3 class="brand-font">7. Modèles & Templates</h3>
    
    <ul class="nav nav-tabs tab-custom">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#presentations">Présentations</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#emails">Emails</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#documents">Documents</a>
        </li>
    </ul>
    
    <div class="tab-content mt-3">
        <div class="tab-pane fade show active" id="presentations">
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="preview-box" style="height: 200px;">
                        <img src="https://picsum.photos/seed/presentation1/300/200.jpg" alt="Modèle présentation" style="width: 100%; height: 100%; object-fit: cover;">
                        <div class="text-center mt-2">
                            <h5>Présentation commerciale</h5>
                            <p class="text-muted">Présentation</p>
                        </div>
                    </div>
                </div>
                <div class="create-template">
                    <button class="btn btn-outline-primary w-100" onclick="createTemplate('presentation')">CRÉERER UN MODÈLE</button>
                </div>
            </div>
            
            <div class="tab-pane fade" id="emails">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Nouveau email marketing</h6>
                        <p class="small">Email marketing professionnel</p>
                        <div class="mb-3">
                            <label class="form-label">Objet</label>
                            <input type="text" class="form-control" placeholder="Objet de l'email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Template</label>
                            <select class="form-select">
                                <option>Email professionnel</option>
                                <option>Newsletter</option>
                                <option>Email promotionnel</option>
                                <option>Email de confirmation</option>
                            </select>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <h6>Aperçu</h6>
                        <div class="preview-box" style="height: 400px; background: white; text-align: left; padding: 20px;">
                            <div style="font-family: 'Special Elite'; font-size: 1.5rem; color: var(--nj-blue); margin-bottom: 10px;">NJIEZM<span style="color: var(--nj-yellow);">.FR</span></div>
                            <p style="font-size: 0.8rem; color: var(--nj-dark);">Cher Jean Dupont</p>
                            <p style="font-size: 0.8rem; color: var(--nj-dark);">j.dupont@njiezm.fr</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="tab-pane fade" id="documents">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Nouveau email</h6>
                        <p class="small">Email marketing</p>
                        <div class="mb-3">
                            <label class="form-label">Objet</label>
                            <input type="text" class="form-control" placeholder="Objet de l'email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Template</label>
                            <select class="form-select">
                                <option>Email professionnel</option>
                                <option>Email promotionnel</option>
                                <option>Email de confirmation</option>
                            </select>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <h6>Aperçu</h6>
                        <div class="preview-box" style="height: 400px; background: white; text-align: left; padding: 20px;">
                            <div style="font-family: 'Special Elite'; font-size: 1.5rem; color: var(--nj-blue); margin-bottom: 10px;">NJIEZM<span style="color: var(--nj-yellow);">.FR</span></div>
                            <p style="font-size: 0.8rem; color: var(--nj-dark);">Cher Jean Dupont</p>
                            <p style="font-size: 0.8rem; color: var(--nj-dark);">j.dupont@njiezm.fr</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Fonction pour créer un modèle
function createTemplate() {
    const templateName = prompt("Nom du modèle");
    if (!templateName) return;
    
    const template = {
        name: templateName,
        type: document.getElementById('template-type').value,
        category: document.getElementById('template-category').value,
        content: document.getElementById('template-content').value,
        thumbnail: null,
        is_public: document.getElementById('template-public') ? true : false,
        user_id: auth()->id
    };
    
    // Envoyer les données au serveur pour la création
    fetch('/api/templates', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(template)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Modèle créé avec succès !', 'success');
            
            // Fermer le modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('template-modal'));
            modal.hide();
            
            // Réinitialiser le formulaire
            document.getElementById('template-name').value = '';
            document.getElementById('template-category').value = '';
            document.getElementById('template-content').value = '';
            
            // Fermer le modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('template-modal'));
            modal.hide();
        } else {
            showNotification('Erreur lors de la création du modèle', 'danger');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        showNotification('Erreur lors de la création du modèle', 'danger');
    }
}

// Afficher le modal de création de modèle
document.addEventListener('DOMContentLoaded', function() {
    const modal = bootstrap.Modal.getInstance(document.getElementById('template-modal'));
    modal.show();
});
</script>
@endsection