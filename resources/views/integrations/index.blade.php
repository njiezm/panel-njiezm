@extends('layouts.app')

@section('title', 'Intégrations - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Intégrations</li>
    </ol>
</nav>

<div class="card-custom">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="brand-font mb-0">Intégrations</h3>
        <div class="search-box" style="width: 300px;">
            <i class="fas fa-search"></i>
            <input type="text" class="form-control" id="integrationSearch" placeholder="Rechercher une intégration...">
        </div>
    </div>
    
    <p class="text-muted">Connectez vos outils préférés pour automatiser votre flux de travail et centraliser vos données.</p>

    <!-- PRODUCTIVITÉ -->
    <h5 class="mt-5 mb-3"><i class="fas fa-rocket me-2 text-primary"></i>Productivité</h5>
    <div class="row g-4 mb-5" id="productivity-row">
        <div class="col-md-6 col-lg-4 integration-card" data-name="Google Workspace">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/google/google-original.svg" alt="Google" width="40" height="40" class="me-3">
                        <div>
                            <h6 class="card-title mb-0">Google Workspace</h6>
                            <small class="text-muted">Drive, Docs, Agenda</small>
                        </div>
                    </div>
                    <p class="card-text small">Importez des documents depuis Drive et synchronisez vos événements.</p>
                    <ul class="list-unstyled small text-muted mt-auto">
                        <li><i class="fas fa-check text-success me-1"></i> Importer des fichiers</li>
                        <li><i class="fas fa-check text-success me-1"></i> Synchroniser le calendrier</li>
                    </ul>
                    <div class="mt-3">
                        <span class="badge bg-secondary me-2">Non connecté</span>
                        <button class="btn btn-sm btn-primary float-end" onclick="connectIntegration('Google Workspace')">Se connecter</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 integration-card" data-name="Trello">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/trello/trello-plain.svg" alt="Trello" width="40" height="40" class="me-3">
                        <div>
                            <h6 class="card-title mb-0">Trello</h6>
                            <small class="text-muted">Gestion de projet</small>
                        </div>
                    </div>
                    <p class="card-text small">Liez vos projets à des tableaux Trello pour un suivi visuel.</p>
                    <ul class="list-unstyled small text-muted mt-auto">
                        <li><i class="fas fa-check text-success me-1"></i> Créer des cartes</li>
                        <li><i class="fas fa-check text-success me-1"></i> Suivre l'avancement</li>
                    </ul>
                    <div class="mt-3">
                        <span class="badge bg-success me-2">Connecté</span>
                        <button class="btn btn-sm btn-outline-secondary float-end" onclick="manageIntegration('Trello')">Gérer</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 integration-card" data-name="Slack">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/slack/slack-original.svg" alt="Slack" width="40" height="40" class="me-3">
                        <div>
                            <h6 class="card-title mb-0">Slack</h6>
                            <small class="text-muted">Communication d'équipe</small>
                        </div>
                    </div>
                    <p class="card-text small">Recevez des notifications et partagez des mises à jour directement sur Slack.</p>
                    <ul class="list-unstyled small text-muted mt-auto">
                        <li><i class="fas fa-check text-success me-1"></i> Notifications de projet</li>
                        <li><i class="fas fa-check text-success me-1"></i> Rapports automatisés</li>
                    </ul>
                    <div class="mt-3">
                        <span class="badge bg-secondary me-2">Non connecté</span>
                        <button class="btn btn-sm btn-primary float-end" onclick="connectIntegration('Slack')">Se connecter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- STOCKAGE -->
    <h5 class="mt-5 mb-3"><i class="fas fa-hdd me-2 text-info"></i>Stockage et Fichiers</h5>
    <div class="row g-4 mb-5" id="storage-row">
        <div class="col-md-6 col-lg-4 integration-card" data-name="Dropbox">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/dropbox/dropbox-original.svg" alt="Dropbox" width="40" height="40" class="me-3">
                        <div>
                            <h6 class="card-title mb-0">Dropbox</h6>
                            <small class="text-muted">Cloud Storage</small>
                        </div>
                    </div>
                    <p class="card-text small">Sauvegardez et accédez à vos fichiers de marque depuis Dropbox.</p>
                    <ul class="list-unstyled small text-muted mt-auto">
                        <li><i class="fas fa-check text-success me-1"></i> Sauvegarde automatique</li>
                        <li><i class="fas fa-check text-success me-1"></i> Partage de liens</li>
                    </ul>
                    <div class="mt-3">
                        <span class="badge bg-secondary me-2">Non connecté</span>
                        <button class="btn btn-sm btn-primary float-end" onclick="connectIntegration('Dropbox')">Se connecter</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 integration-card" data-name="OneDrive">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/onedrive/onedrive-original.svg" alt="OneDrive" width="40" height="40" class="me-3">
                        <div>
                            <h6 class="card-title mb-0">OneDrive</h6>
                            <small class="text-muted">Microsoft Cloud</small>
                        </div>
                    </div>
                    <p class="card-text small">Intégrez vos fichiers OneDrive pour un accès universel.</p>
                    <ul class="list-unstyled small text-muted mt-auto">
                        <li><i class="fas fa-check text-success me-1"></i> Synchronisation de dossiers</li>
                        <li><i class="fas fa-check text-success me-1"></i> Versioning des fichiers</li>
                    </ul>
                    <div class="mt-3">
                        <span class="badge bg-secondary me-2">Non connecté</span>
                        <button class="btn btn-sm btn-primary float-end" onclick="connectIntegration('OneDrive')">Se connecter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MARKETING -->
    <h5 class="mt-5 mb-3"><i class="fas fa-bullhorn me-2 text-warning"></i>Marketing et Communication</h5>
    <div class="row g-4 mb-5" id="marketing-row">
        <div class="col-md-6 col-lg-4 integration-card" data-name="Mailchimp">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mailchimp/mailchimp-original.svg" alt="Mailchimp" width="40" height="40" class="me-3">
                        <div>
                            <h6 class="card-title mb-0">Mailchimp</h6>
                            <small class="text-muted">Email Marketing</small>
                        </div>
                    </div>
                    <p class="card-text small">Synchronisez vos listes de contacts et lancez des campagnes.</p>
                    <ul class="list-unstyled small text-muted mt-auto">
                        <li><i class="fas fa-check text-success me-1"></i> Synchroniser les contacts</li>
                        <li><i class="fas fa-check text-success me-1"></i> Créer des campagnes</li>
                    </ul>
                    <div class="mt-3">
                        <span class="badge bg-secondary me-2">Non connecté</span>
                        <button class="btn btn-sm btn-primary float-end" onclick="connectIntegration('Mailchimp')">Se connecter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- AUTOMATISATION -->
    <h5 class="mt-5 mb-3"><i class="fas fa-magic me-2 text-danger"></i>Automatisation</h5>
    <div class="row g-4" id="automation-row">
        <div class="col-md-6 col-lg-4 integration-card" data-name="Zapier">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/zapier/zapier-original.svg" alt="Zapier" width="40" height="40" class="me-3">
                        <div>
                            <h6 class="card-title mb-0">Zapier</h6>
                            <small class="text-muted">Automatisation sans code</small>
                        </div>
                    </div>
                    <p class="card-text small">Connectez NJIEZM.FR à 5000+ applications pour créer des workflows personnalisés.</p>
                    <ul class="list-unstyled small text-muted mt-auto">
                        <li><i class="fas fa-check text-success me-1"></i> Déclencheurs sur mesure</li>
                        <li><i class="fas fa-check text-success me-1"></i> Actions multi-apps</li>
                    </ul>
                    <div class="mt-3">
                        <span class="badge bg-secondary me-2">Non connecté</span>
                        <button class="btn btn-sm btn-primary float-end" onclick="connectIntegration('Zapier')">Se connecter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de gestion d'intégration -->
<div class="modal fade" id="manageIntegrationModal" tabindex="-1" aria-labelledby="manageIntegrationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manageIntegrationModalLabel">Gérer l'intégration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="modal-integration-name"></p>
                <div class="mb-3">
                    <label for="syncFrequency" class="form-label">Fréquence de synchronisation</label>
                    <select class="form-select" id="syncFrequency">
                        <option value="realtime">En temps réel</option>
                        <option value="hourly">Toutes les heures</option>
                        <option value="daily" selected>Quotidienne</option>
                        <option value="weekly">Hebdomadaire</option>
                    </select>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="enableNotifications" checked>
                    <label class="form-check-label" for="enableNotifications">
                        Activer les notifications pour cette intégration
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="disconnectIntegration()">Déconnecter</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="saveIntegrationSettings()">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<script>
let currentIntegrationName = '';

// Fonction de recherche
document.getElementById('integrationSearch').addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    const cards = document.querySelectorAll('.integration-card');

    cards.forEach(card => {
        const name = card.getAttribute('data-name').toLowerCase();
        if (name.includes(searchTerm)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
});

// Fonction pour se connecter à une intégration
function connectIntegration(name) {
    if (confirm(`Vous allez être redirigé pour autoriser l'accès à ${name}. Continuer ?`)) {
        // Simulation de redirection OAuth
        alert(`Redirection vers la page d'autorisation de ${name}...`);
        // Ici, vous redirigeriez vers la route OAuth du service
        // window.location.href = `/integrations/${name.toLowerCase().replace(' ', '-')}/authorize`;
    }
}

// Fonction pour gérer une intégration
function manageIntegration(name) {
    currentIntegrationName = name;
    document.getElementById('modal-integration-name').textContent = `Paramètres pour l'intégration : ${name}`;
    const modal = new bootstrap.Modal(document.getElementById('manageIntegrationModal'));
    modal.show();
}

// Fonction pour déconnecter une intégration
function disconnectIntegration() {
    if (confirm(`Êtes-vous sûr de vouloir déconnecter ${currentIntegrationName} ?`)) {
        alert(`${currentIntegrationName} a été déconnecté.`);
        // Ici, vous feriez un appel AJAX à votre backend
        const modal = bootstrap.Modal.getInstance(document.getElementById('manageIntegrationModal'));
        modal.hide();
        // Recharger la page ou mettre à jour l'UI
        location.reload();
    }
}

// Fonction pour sauvegarder les paramètres
function saveIntegrationSettings() {
    const frequency = document.getElementById('syncFrequency').value;
    const notifications = document.getElementById('enableNotifications').checked;
    alert(`Paramètres pour ${currentIntegrationName} enregistrés :\n- Fréquence: ${frequency}\n- Notifications: ${notifications ? 'Activées' : 'Désactivées'}`);
    // Ici, vous feriez un appel AJAX pour sauvegarder en BDD
    const modal = bootstrap.Modal.getInstance(document.getElementById('manageIntegrationModal'));
    modal.hide();
}
</script>
@endsection