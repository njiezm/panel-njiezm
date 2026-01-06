@extends('layouts.app')

@section('title', 'Paramètres - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Paramètres</li>
    </ol>
</nav>

<div class="card-custom">
    <h3 class="brand-font mb-4">Paramètres</h3>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- ONGLETS -->
    <ul class="nav nav-tabs tab-custom" id="settingsTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">
                <i class="fas fa-user me-2"></i> Profil
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button" role="tab" aria-controls="security" aria-selected="false">
                <i class="fas fa-shield-alt me-2"></i> Sécurité
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="notifications-tab" data-bs-toggle="tab" data-bs-target="#notifications" type="button" role="tab" aria-controls="notifications" aria-selected="false">
                <i class="fas fa-bell me-2"></i> Notifications
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="appearance-tab" data-bs-toggle="tab" data-bs-target="#appearance" type="button" role="tab" aria-controls="appearance" aria-selected="false">
                <i class="fas fa-palette me-2"></i> Apparence
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="company-tab" data-bs-toggle="tab" data-bs-target="#company" type="button" role="tab" aria-controls="company" aria-selected="false">
                <i class="fas fa-building me-2"></i> Entreprise
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="privacy-tab" data-bs-toggle="tab" data-bs-target="#privacy" type="button" role="tab" aria-controls="privacy" aria-selected="false">
                <i class="fas fa-lock me-2"></i> Confidentialité
            </button>
        </li>
    </ul>

    <div class="tab-content mt-4" id="settingsTabContent">
        <!-- ONGLET PROFIL -->
        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <h5 class="mb-4">Informations du profil</h5>
            <form action="{{ route('settings.update.profile') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-3 text-center">
                        <img src="https://picsum.photos/seed/{{ $user->id }}/150/150.jpg" alt="Avatar" class="rounded-circle mb-3" width="150" height="150">
                        <div>
                            <button type="button" class="btn btn-outline-primary btn-sm">Changer l'avatar</button>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nom complet</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Adresse email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Téléphone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="{{ $user->phone ?? '' }}">
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea class="form-control" id="bio" name="bio" rows="3">{{ $user->bio ?? '' }}</textarea>
                            @error('bio')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- ONGLET SÉCURITÉ -->
        <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
            <h5 class="mb-4">Sécurité du compte</h5>
            
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="card-title">Changer le mot de passe</h6>
                    <form action="{{ route('settings.update.password') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Mot de passe actuel</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                            @error('current_password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Nouveau mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <div class="progress mt-2" style="height: 5px;">
                                <div class="progress-bar" id="passwordStrengthBar" style="width: 0%;"></div>
                            </div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmer le nouveau mot de passe</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Mettre à jour le mot de passe</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Authentification à deux facteurs (2FA)</h6>
                            <p class="card-text text-muted small">Ajoutez une couche de sécurité supplémentaire à votre compte.</p>
                        </div>
                        <div>
                            <span class="badge bg-danger me-2">Désactivé</span>
                            <button type="button" class="btn btn-success" onclick="alert('Fonctionnalité 2FA à implémenter')">Activer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ONGLET NOTIFICATIONS -->
        <div class="tab-pane fade" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
            <h5 class="mb-4">Préférences de notification</h5>
            
            <form action="{{ route('settings.update.notifications') }}" method="POST">
                @csrf
                <h6 class="mt-4 mb-3">Notifications par email</h6>
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="emailInvoice" name="emailInvoice" {{ $user->getSetting('notifications.email_invoice', true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="emailInvoice">
                        Nouvelle facture créée
                    </label>
                </div>
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="emailProject" name="emailProject" {{ $user->getSetting('notifications.email_project', true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="emailProject">
                        Mise à jour d'un projet
                    </label>
                </div>
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="emailMention" name="emailMention" {{ $user->getSetting('notifications.email_mention', true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="emailMention">
                        Quand on me mentionne
                    </label>
                </div>
                
                <h6 class="mt-4 mb-3">Notifications dans l'application</h6>
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="appTask" name="appTask" {{ $user->getSetting('notifications.app_task', true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="appTask">
                        Nouvelle tâche assignée
                    </label>
                </div>
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="appMessage" name="appMessage" {{ $user->getSetting('notifications.app_message', true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="appMessage">
                        Nouveau message reçu
                    </label>
                </div>
                
                <button type="submit" class="btn btn-primary mt-4">Enregistrer les préférences</button>
            </form>
        </div>

        <!-- ONGLET APPARENCE -->
        <div class="tab-pane fade" id="appearance" role="tabpanel" aria-labelledby="appearance-tab">
            <h5 class="mb-4">Personnalisation de l'interface</h5>
            
            <form action="{{ route('settings.update.appearance') }}" method="POST">
                @csrf
                <h6 class="mb-3">Thème</h6>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="theme" id="lightTheme" value="light" {{ $user->getSetting('appearance.theme', 'dark') === 'light' ? 'checked' : '' }}>
                    <label class="form-check-label" for="lightTheme">
                        <i class="fas fa-sun me-2"></i> Clair
                    </label>
                </div>
                <div class="form-check mb-4">
                    <input class="form-check-input" type="radio" name="theme" id="darkTheme" value="dark" {{ $user->getSetting('appearance.theme', 'dark') === 'dark' ? 'checked' : '' }}>
                    <label class="form-check-label" for="darkTheme">
                        <i class="fas fa-moon me-2"></i> Sombre
                    </label>
                </div>

                <h6 class="mb-3">Langue</h6>
                <select class="form-select mb-4" name="language">
                    <option value="fr" {{ $user->getSetting('appearance.language', 'fr') === 'fr' ? 'selected' : '' }}>Français</option>
                    <option value="en" {{ $user->getSetting('appearance.language', 'fr') === 'en' ? 'selected' : '' }}>English</option>
                </select>

                <h6 class="mb-3">Fuseau horaire</h6>
                <select class="form-select" name="timezone">
                    <option value="Europe/Paris" {{ $user->getSetting('appearance.timezone', 'Europe/Paris') === 'Europe/Paris' ? 'selected' : '' }}>Europe/Paris (UTC+1)</option>
                    <option value="America/New_York" {{ $user->getSetting('appearance.timezone', 'Europe/Paris') === 'America/New_York' ? 'selected' : '' }}>America/New_York (UTC-5)</option>
                </select>

                <button type="submit" class="btn btn-primary mt-4">Enregistrer les préférences</button>
            </form>
        </div>

        <!-- ONGLET ENTREPRISE -->
        <div class="tab-pane fade" id="company" role="tabpanel" aria-labelledby="company-tab">
            <h5 class="mb-4">Informations de l'entreprise</h5>
            <form action="{{ route('settings.update.company') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="companyName" class="form-label">Nom de l'entreprise</label>
                        <input type="text" class="form-control" id="companyName" name="companyName" value="{{ $user->getSetting('company.name', 'NJIEZM.FR') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="companySiret" class="form-label">SIRET</label>
                        <input type="text" class="form-control" id="companySiret" name="companySiret" value="{{ $user->getSetting('company.siret', '99939612000019') }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="companyAddress" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="companyAddress" name="companyAddress" value="{{ $user->getSetting('company.address', '123 Rue de la République, 75001 Paris') }}">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="companyPhone" class="form-label">Téléphone</label>
                        <input type="tel" class="form-control" id="companyPhone" name="companyPhone" value="{{ $user->getSetting('company.phone', '+33 1 23 45 67 89') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="companyEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="companyEmail" name="companyEmail" value="{{ $user->getSetting('company.email', 'contact@njiezm.fr') }}">
                    </div>
                </div>
                
                <h6 class="mt-4 mb-3">Logo de l'entreprise</h6>
                <div class="d-flex align-items-center">
                    <img src="https://via.placeholder.com/100x40/003366/FFFFFF?text=NJIEZM.FR" alt="Logo" class="me-3 border">
                    <div>
                        <button type="button" class="btn btn-outline-primary btn-sm">Téléverser un nouveau logo</button>
                        <p class="text-muted small mb-0">Format recommandé : PNG ou JPG, max 2MB.</p>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-4">Enregistrer les informations</button>
            </form>
        </div>

        <!-- ONGLET CONFIDENTIALITÉ -->
        <div class="tab-pane fade" id="privacy" role="tabpanel" aria-labelledby="privacy-tab">
            <h5 class="mb-4">Confidentialité et données</h5>
            
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="card-title">Télécharger vos données</h6>
                    <p class="card-text">Téléchargez une copie de toutes vos données personnelles associées à votre compte.</p>
                    <button type="button" class="btn btn-outline-primary" onclick="alert('Demande de téléchargement envoyée. Vous recevrez un email sous 24h.')">
                        <i class="fas fa-download me-2"></i> Demander mes données
                    </button>
                </div>
            </div>

            <div class="card border-danger">
                <div class="card-body">
                    <h6 class="card-title text-danger">Zone de danger</h6>
                    <p class="card-text">La suppression de votre compte est permanente et irréversible. Toutes vos données seront effacées.</p>
                    <button type="button" class="btn btn-danger" onclick="if(confirm('Êtes-vous ABSOLUMENT certain de vouloir supprimer votre compte ? Cette action ne peut être annulée.')) { alert('Compte supprimé (simulation).'); }">
                        <i class="fas fa-trash-alt me-2"></i> Supprimer mon compte
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Simple password strength checker
document.getElementById('password')?.addEventListener('input', function() {
    const password = this.value;
    let strength = 0;
    if (password.length > 7) strength++;
    if (password.match(/[a-z]+/)) strength++;
    if (password.match(/[A-Z]+/)) strength++;
    if (password.match(/[0-9]+/)) strength++;
    if (password.match(/[$@#&!]+/)) strength++;

    const bar = document.getElementById('passwordStrengthBar');
    bar.style.width = (strength * 20) + '%';
    
    if (strength < 2) {
        bar.className = 'progress-bar bg-danger';
    } else if (strength < 4) {
        bar.className = 'progress-bar bg-warning';
    } else {
        bar.className = 'progress-bar bg-success';
    }
});
</script>
@endsection