@extends('layouts.app')

@section('title', 'Charte Graphique - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Charte Graphique</li>
    </ol>
</nav>

<div class="card-custom">
    <h3 class="brand-font">13. Charte Graphique</h3>
    <p class="text-muted">Découvrez tous les éléments qui définissent l'identité visuelle de NJIEZM.FR.</p>

    <!-- Onglets -->
    <ul class="nav nav-tabs tab-custom mt-4" id="guidelinesTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="logo-tab" data-bs-toggle="tab" data-bs-target="#logo" type="button" role="tab" aria-controls="logo" aria-selected="true">
                <i class="fas fa-image me-2"></i>Logo
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="colors-tab" data-bs-toggle="tab" data-bs-target="#colors" type="button" role="tab" aria-controls="colors" aria-selected="false">
                <i class="fas fa-palette me-2"></i>Couleurs
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="typography-tab" data-bs-toggle="tab" data-bs-target="#typography" type="button" role="tab" aria-controls="typography" aria-selected="false">
                <i class="fas fa-font me-2"></i>Typographie
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="elements-tab" data-bs-toggle="tab" data-bs-target="#elements" type="button" role="tab" aria-controls="elements" aria-selected="false">
                <i class="fas fa-shapes me-2"></i>Éléments Visuels
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="applications-tab" data-bs-toggle="tab" data-bs-target="#applications" type="button" role="tab" aria-controls="applications" aria-selected="false">
                <i class="fas fa-laptop me-2"></i>Applications
            </button>
        </li>
    </ul>

    <div class="tab-content" id="guidelinesTabContent">
        
        <!-- Onglet Logo -->
        <div class="tab-pane fade show active" id="logo" role="tabpanel" aria-labelledby="logo-tab">
            <div class="mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Logo Principal</h5>
                        <button class="btn btn-sm btn-outline-primary" onclick="downloadAsset('logo-primary')">
                            <i class="fas fa-download me-1"></i> Télécharger
                        </button>
                    </div>
                    <div class="card-body text-center py-4">
                        <div class="mb-3">
                            <h1 class="brand-font" style="font-size: 48px; color: var(--nj-blue);">NJIEZM<span style="color: var(--nj-yellow);">.FR</span></h1>
                        </div>
                        <p class="text-muted">Le logo principal utilise la police Special Elite avec le bleu NJIEZM pour le nom et le jaune pour l'extension.</p>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6>Version Monochrome</h6>
                                <button class="btn btn-sm btn-outline-primary" onclick="downloadAsset('logo-monochrome')">
                                    <i class="fas fa-download me-1"></i> Télécharger
                                </button>
                            </div>
                            <div class="card-body text-center py-4">
                                <div class="mb-3">
                                    <h1 class="brand-font" style="font-size: 48px; color: black;">NJIEZM<span style="color: black;">.FR</span></h1>
                                </div>
                                <p class="text-muted">Version monochrome pour les applications en noir et blanc.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6>Version Inversée</h6>
                                <button class="btn btn-sm btn-outline-primary" onclick="downloadAsset('logo-inverse')">
                                    <i class="fas fa-download me-1"></i> Télécharger
                                </button>
                            </div>
                            <div class="card-body text-center py-4 bg-dark">
                                <div class="mb-3">
                                    <h1 class="brand-font" style="font-size: 48px; color: white;">NJIEZM<span style="color: var(--nj-yellow);">.FR</span></h1>
                                </div>
                                <p class="text-muted text-white-50">Version pour les arrière-plans sombres.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Zone de Dégagement et Taille Minimale</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-center mb-3">
                                    <div style="border: 1px dashed #ccc; padding: 20px; display: inline-block;">
                                        <div style="border: 1px dashed var(--nj-blue); padding: 20px; display: inline-block;">
                                            <h1 class="brand-font" style="font-size: 36px; color: var(--nj-blue);">NJIEZM<span style="color: var(--nj-yellow);">.FR</span></h1>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-center text-muted">La zone de dégagement doit être égale à la hauteur du "N" de NJIEZM.</p>
                            </div>
                            <div class="col-md-6">
                                <div class="text-center mb-3">
                                    <h1 class="brand-font" style="font-size: 24px; color: var(--nj-blue);">NJIEZM<span style="color: var(--nj-yellow);">.FR</span></h1>
                                </div>
                                <p class="text-center text-muted">Taille minimale recommandée : 24px pour le numérique, 15mm pour l'impression.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Utilisations Incorrectes</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 text-center mb-3">
                                <div class="p-3 border rounded">
                                    <h1 class="brand-font" style="font-size: 24px; color: var(--nj-blue); transform: skewX(15deg);">NJIEZM<span style="color: var(--nj-yellow);">.FR</span></h1>
                                </div>
                                <p class="text-muted small mt-2">Ne pas déformer</p>
                            </div>
                            <div class="col-md-3 text-center mb-3">
                                <div class="p-3 border rounded">
                                    <h1 class="brand-font" style="font-size: 24px; color: red;">NJIEZM<span style="color: green;">.FR</span></h1>
                                </div>
                                <p class="text-muted small mt-2">Ne pas changer les couleurs</p>
                            </div>
                            <div class="col-md-3 text-center mb-3">
                                <div class="p-3 border rounded">
                                    <h1 class="brand-font" style="font-size: 24px; color: var(--nj-blue);">NJIEZM</h1>
                                </div>
                                <p class="text-muted small mt-2">Ne pas supprimer l'extension</p>
                            </div>
                            <div class="col-md-3 text-center mb-3">
                                <div class="p-3 border rounded">
                                    <h1 class="brand-font" style="font-size: 24px; color: var(--nj-blue);">N J I E Z M . F R</h1>
                                </div>
                                <p class="text-muted small mt-2">Ne pas espacer les lettres</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Onglet Couleurs -->
        <div class="tab-pane fade" id="colors" role="tabpanel" aria-labelledby="colors-tab">
            <div class="mt-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Palette de Couleurs Principale</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $brandColors = [
                                ['name' => 'Bleu Principal', 'hex' => '#003366', 'rgb' => 'rgb(0, 51, 102)', 'usage' => 'Textes principaux, titres, éléments de branding'],
                                ['name' => 'Jaune Accent', 'hex' => '#FFD700', 'rgb' => 'rgb(255, 215, 0)', 'usage' => 'Boutons, icônes, points d\'attention'],
                                ['name' => 'Blanc Fond', 'hex' => '#F8F9FA', 'rgb' => 'rgb(248, 249, 250)', 'usage' => 'Arrière-plans, cartes, zones de contenu'],
                                ['name' => 'Gris Foncé', 'hex' => '#1a1a1a', 'rgb' => 'rgb(26, 26, 26)', 'usage' => 'Textes très importants, contraste maximal'],
                                ['name' => 'Gris Clair', 'hex' => '#e9ecef', 'rgb' => 'rgb(233, 236, 239)', 'usage' => 'Bordures, arrière-plans secondaires, séparateurs'],
                            ];
                        @endphp

                        <div class="row">
                            @foreach($brandColors as $color)
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card h-100 shadow-sm">
                                        <div class="card-body text-center">
                                            <div class="color-swatch mb-3 rounded" style="background-color: {{ $color['hex'] }}; height: 100px; width: 100%; border: 1px solid #dee2e6;"></div>
                                            <h6 class="card-title">{{ $color['name'] }}</h6>
                                            <p class="card-text">
                                                <strong>HEX:</strong> {{ $color['hex'] }}<br>
                                                <strong>RGB:</strong> {{ $color['rgb'] }}<br>
                                                <small class="text-muted">{{ $color['usage'] }}</small>
                                            </p>
                                            <button class="btn btn-sm btn-outline-primary" onclick="copyToClipboard('{{ $color['hex'] }}', this)">
                                                <i class="fas fa-copy me-1"></i> Copier HEX
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Palette de Couleurs Secondaire</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $secondaryColors = [
                                ['name' => 'Succès', 'hex' => '#28a745', 'usage' => 'Messages de confirmation, indicateurs positifs'],
                                ['name' => 'Danger', 'hex' => '#dc3545', 'usage' => 'Messages d\'erreur, alertes importantes'],
                                ['name' => 'Info', 'hex' => '#17a2b8', 'usage' => 'Messages d\'information, notifications'],
                                ['name' => 'Avertissement', 'hex' => '#ffc107', 'usage' => 'Avertissements, alertes modérées'],
                            ];
                        @endphp

                        <div class="row">
                            @foreach($secondaryColors as $color)
                                <div class="col-md-3 mb-4">
                                    <div class="card h-100 shadow-sm">
                                        <div class="card-body text-center">
                                            <div class="color-swatch mb-3 rounded" style="background-color: {{ $color['hex'] }}; height: 80px; width: 100%; border: 1px solid #dee2e6;"></div>
                                            <h6 class="card-title">{{ $color['name'] }}</h6>
                                            <p class="card-text">
                                                <strong>HEX:</strong> {{ $color['hex'] }}<br>
                                                <small class="text-muted">{{ $color['usage'] }}</small>
                                            </p>
                                            <button class="btn btn-sm btn-outline-primary" onclick="copyToClipboard('{{ $color['hex'] }}', this)">
                                                <i class="fas fa-copy me-1"></i> Copier
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Proportions d'Utilisation</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="progress" style="height: 30px;">
                                    <div class="progress-bar" style="width: 60%; background-color: var(--nj-blue);">60% Bleu Principal</div>
                                    <div class="progress-bar" style="width: 25%; background-color: var(--nj-yellow);">25% Jaune Accent</div>
                                    <div class="progress-bar" style="width: 10%; background-color: var(--nj-dark);">10% Gris Foncé</div>
                                    <div class="progress-bar" style="width: 5%; background-color: var(--nj-light);">5% Gris Clair</div>
                                </div>
                                <p class="text-muted mt-2">Maintenir ces proportions pour une cohérence visuelle optimale.</p>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-outline-primary w-100" onclick="downloadAsset('color-palette')">
                                    <i class="fas fa-download me-1"></i> Télécharger la Palette
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Onglet Typographie -->
        <div class="tab-pane fade" id="typography" role="tabpanel" aria-labelledby="typography-tab">
            <div class="mt-4">
                <div class="row">
                    <!-- Space Grotesk -->
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Space Grotesk</h5>
                                <p class="text-muted">Police principale pour le contenu textuel et les éléments d'interface.</p>
                                
                                <div class="font-examples mb-3">
                                    <div class="mb-3">
                                        <div class="font-weight-light" style="font-family: 'Space Grotesk', sans-serif; font-weight: 300; font-size: 24px;">
                                            Light: L'élégance dans la simplicité
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="font-weight-normal" style="font-family: 'Space Grotesk', sans-serif; font-weight: 400; font-size: 24px;">
                                            Regular: La clarté avant tout
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="font-weight-medium" style="font-family: 'Space Grotesk', sans-serif; font-weight: 500; font-size: 24px;">
                                            Medium: L'équilibre parfait
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="font-weight-bold" style="font-family: 'Space Grotesk', sans-serif; font-weight: 700; font-size: 24px;">
                                            Bold: L'impact nécessaire
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Google Fonts</small>
                                    <button class="btn btn-sm btn-outline-primary" onclick="copyToClipboard('font-family: \'Space Grotesk\', sans-serif;', this)">
                                        <i class="fas fa-copy me-1"></i> Copier CSS
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Special Elite -->
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Special Elite</h5>
                                <p class="text-muted">Police d'accent pour le branding et les titres marquants.</p>
                                
                                <div class="font-examples mb-3">
                                    <div class="mb-3">
                                        <div style="font-family: 'Special Elite', cursive; font-size: 24px;">
                                            NJIEZM.FR - L'élite du digital
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div style="font-family: 'Special Elite', cursive; font-size: 18px;">
                                            Caractère unique pour une identité forte
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div style="font-family: 'Special Elite', cursive; font-size: 14px;">
                                            Parfait pour les citations et les éléments de branding
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Google Fonts</small>
                                    <button class="btn btn-sm btn-outline-primary" onclick="copyToClipboard('font-family: \'Special Elite\', cursive;', this)">
                                        <i class="fas fa-copy me-1"></i> Copier CSS
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Hiérarchie Typographique</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h1 style="font-family: 'Space Grotesk', sans-serif; font-weight: 700;">Titre H1 - 36px</h1>
                                <h2 style="font-family: 'Space Grotesk', sans-serif; font-weight: 700;">Titre H2 - 30px</h2>
                                <h3 style="font-family: 'Space Grotesk', sans-serif; font-weight: 600;">Titre H3 - 24px</h3>
                                <h4 style="font-family: 'Space Grotesk', sans-serif; font-weight: 600;">Titre H4 - 20px</h4>
                                <h5 style="font-family: 'Space Grotesk', sans-serif; font-weight: 500;">Titre H5 - 18px</h5>
                                <h6 style="font-family: 'Space Grotesk', sans-serif; font-weight: 500;">Titre H6 - 16px</h6>
                                <p style="font-family: 'Space Grotesk', sans-serif;">Texte paragraphe - 16px</p>
                                <small style="font-family: 'Space Grotesk', sans-serif;">Texte petit - 14px</small>
                            </div>
                            <div class="col-md-6">
                                <div class="card-custom">
                                    <h3 class="brand-font">Titre de Carte</h3>
                                    <p>Contenu de la carte avec une hiérarchie claire entre le titre et le contenu.</p>
                                    <small class="text-muted">Informations supplémentaires en texte plus petit.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Onglet Éléments Visuels -->
        <div class="tab-pane fade" id="elements" role="tabpanel" aria-labelledby="elements-tab">
            <div class="mt-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Icônes et Illustrations</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Icônes</h6>
                                <p>Nous utilisons Font Awesome pour nos icônes, avec un style cohérent :</p>
                                <div class="d-flex flex-wrap">
                                    <div class="p-3 m-2 text-center">
                                        <i class="fas fa-home fa-2x" style="color: var(--nj-blue);"></i>
                                        <p class="small mt-1">Primaire</p>
                                    </div>
                                    <div class="p-3 m-2 text-center">
                                        <i class="fas fa-user fa-2x" style="color: var(--nj-yellow);"></i>
                                        <p class="small mt-1">Accent</p>
                                    </div>
                                    <div class="p-3 m-2 text-center">
                                        <i class="fas fa-cog fa-2x" style="color: var(--nj-dark);"></i>
                                        <p class="small mt-1">Foncé</p>
                                    </div>
                                    <div class="p-3 m-2 text-center">
                                        <i class="fas fa-info-circle fa-2x" style="color: var(--nj-light);"></i>
                                        <p class="small mt-1">Clair</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>Illustrations</h6>
                                <p>Nos illustrations suivent un style minimaliste avec notre palette de couleurs :</p>
                                <div class="bg-light p-3 rounded text-center">
                                    <div style="height: 150px; background-color: var(--nj-blue); border-radius: 8px; margin-bottom: 10px;"></div>
                                    <p class="text-muted">Style géométrique simple avec des coins arrondis</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Éléments d'Interface</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Boutons</h6>
                                <div class="mb-3">
                                    <button class="btn btn-primary me-2" style="background-color: var(--nj-blue); border-color: var(--nj-blue);">Primaire</button>
                                    <button class="btn btn-secondary me-2" style="background-color: var(--nj-yellow); color: var(--nj-dark); border-color: var(--nj-yellow);">Secondaire</button>
                                    <button class="btn btn-outline-primary">Contour</button>
                                </div>
                                <p class="text-muted">Les boutons utilisent nos couleurs principales avec un contraste suffisant pour l'accessibilité.</p>
                            </div>
                            <div class="col-md-6">
                                <h6>Cartes</h6>
                                <div class="card-custom mb-3">
                                    <h5 class="brand-font">Titre de Carte</h5>
                                    <p>Les cartes ont une bordure bleue et une ombre jaune pour un look unique.</p>
                                </div>
                                <p class="text-muted">Notre style de carte distinctif avec des bordures colorées et des ombres accentuées.</p>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h6>Formulaires</h6>
                                <div class="mb-3">
                                    <label for="example" class="form-label">Exemple de champ</label>
                                    <input type="text" class="form-control" id="example" placeholder="Texte d'exemple">
                                </div>
                                <p class="text-muted">Champs de formulaire avec des bordures subtiles et des états clairs.</p>
                            </div>
                            <div class="col-md-6">
                                <h6>Alertes</h6>
                                <div class="alert alert-info" role="alert">
                                    Ceci est une alerte d'information.
                                </div>
                                <div class="alert alert-warning" role="alert">
                                    Ceci est une alerte d'avertissement.
                                </div>
                                <p class="text-muted">Alertes avec des couleurs appropriées pour chaque type de message.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Grille et Espacement</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Système de Grille</h6>
                                <p>Nous utilisons une grille à 12 colonnes avec des points d'arrêt responsifs :</p>
                                <div class="bg-light p-2 rounded">
                                    <div class="row">
                                        <div class="col-12 border p-2 mb-2 text-center">12 colonnes</div>
                                        <div class="col-6 border p-2 mb-2 text-center">6 colonnes</div>
                                        <div class="col-6 border p-2 mb-2 text-center">6 colonnes</div>
                                        <div class="col-4 border p-2 mb-2 text-center">4</div>
                                        <div class="col-4 border p-2 mb-2 text-center">4</div>
                                        <div class="col-4 border p-2 mb-2 text-center">4</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>Espacement</h6>
                                <p>Nous utilisons un système d'espacement cohérent basé sur des unités de 8px :</p>
                                <div class="bg-light p-3 rounded">
                                    <div class="mb-2" style="height: 8px; background-color: var(--nj-blue);"></div>
                                    <div class="mb-2" style="height: 16px; background-color: var(--nj-blue);"></div>
                                    <div class="mb-2" style="height: 24px; background-color: var(--nj-blue);"></div>
                                    <div class="mb-2" style="height: 32px; background-color: var(--nj-blue);"></div>
                                    <div class="mb-2" style="height: 48px; background-color: var(--nj-blue);"></div>
                                    <p class="text-muted mt-2">8px, 16px, 24px, 32px, 48px</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Onglet Applications -->
        <div class="tab-pane fade" id="applications" role="tabpanel" aria-labelledby="applications-tab">
            <div class="mt-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Applications Numériques</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <img src="https://via.placeholder.com/400x250/003366/FFFFFF?text=Site+Web" class="card-img-top" alt="Site Web">
                                    <div class="card-body">
                                        <h6 class="card-title">Site Web</h6>
                                        <p class="card-text">Application de nos principes de design sur notre site web avec une navigation claire et une hiérarchie visuelle forte.</p>
                                        <button class="btn btn-sm btn-outline-primary" onclick="showGuideline('web')">
                                            <i class="fas fa-eye me-1"></i> Voir les Directives
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <img src="https://via.placeholder.com/400x250/FFD700/000000?text=Application+Mobile" class="card-img-top" alt="Application Mobile">
                                    <div class="card-body">
                                        <h6 class="card-title">Application Mobile</h6>
                                        <p class="card-text">Adaptation de notre charte pour les interfaces mobiles avec des composants tactiles optimisés.</p>
                                        <button class="btn btn-sm btn-outline-primary" onclick="showGuideline('mobile')">
                                            <i class="fas fa-eye me-1"></i> Voir les Directives
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Applications Imprimées</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <img src="https://via.placeholder.com/300x400/1a1a1a/FFFFFF?text=Carte+de+Visite" class="card-img-top" alt="Carte de Visite">
                                    <div class="card-body">
                                        <h6 class="card-title">Carte de Visite</h6>
                                        <p class="card-text">Format standard avec notre logo et informations essentielles.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <img src="https://via.placeholder.com/300x400/e9ecef/000000?text=En-tête+de+Lettre" class="card-img-top" alt="En-tête de Lettre">
                                    <div class="card-body">
                                        <h6 class="card-title">En-tête de Lettre</h6>
                                        <p class="card-text">Correspondance professionnelle avec notre branding cohérent.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <img src="https://via.placeholder.com/300x400/F8F9FA/000000?text=Brochure" class="card-img-top" alt="Brochure">
                                    <div class="card-body">
                                        <h6 class="card-title">Brochure</h6>
                                        <p class="card-text">Présentation de nos services avec notre identité visuelle.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Ressources et Téléchargements</h5>
                        <button class="btn btn-primary" onclick="downloadAllAssets()">
                            <i class="fas fa-download me-1"></i> Tout Télécharger
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-file-archive fa-2x me-3" style="color: var(--nj-blue);"></i>
                                    <div>
                                        <h6>Pack Logo Complet</h6>
                                        <p class="text-muted small">SVG, PNG, EPS</p>
                                        <button class="btn btn-sm btn-outline-primary" onclick="downloadAsset('logo-pack')">
                                            <i class="fas fa-download me-1"></i> Télécharger
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-palette fa-2x me-3" style="color: var(--nj-yellow);"></i>
                                    <div>
                                        <h6>Palette de Couleurs</h6>
                                        <p class="text-muted small">ASE, SVG</p>
                                        <button class="btn btn-sm btn-outline-primary" onclick="downloadAsset('color-palette')">
                                            <i class="fas fa-download me-1"></i> Télécharger
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-font fa-2x me-3" style="color: var(--nj-dark);"></i>
                                    <div>
                                        <h6>Polices</h6>
                                        <p class="text-muted small">TTF, OTF, WOFF</p>
                                        <button class="btn btn-sm btn-outline-primary" onclick="downloadAsset('fonts')">
                                            <i class="fas fa-download me-1"></i> Télécharger
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-images fa-2x me-3" style="color: var(--nj-light);"></i>
                                    <div>
                                        <h6>Icônes et Illustrations</h6>
                                        <p class="text-muted small">SVG, PNG</p>
                                        <button class="btn btn-sm btn-outline-primary" onclick="downloadAsset('icons')">
                                            <i class="fas fa-download me-1"></i> Télécharger
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour les directives (Optionnel) -->
<div class="modal fade" id="guidelineModal" tabindex="-1" aria-labelledby="guidelineModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="guidelineModalLabel">Directives d'Application</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="guidelineModalBody">
                <!-- Le contenu sera chargé dynamiquement -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" onclick="downloadAsset('guideline')">
                    <i class="fas fa-download me-1"></i> Télécharger les Directives
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Copier le code dans le presse-papiers
function copyToClipboard(text, buttonElement) {
    navigator.clipboard.writeText(text).then(function() {
        let originalHTML = buttonElement.innerHTML;
        buttonElement.innerHTML = '<i class="fas fa-check me-1"></i> Copié !';
        buttonElement.classList.remove('btn-outline-primary');
        buttonElement.classList.add('btn-success');

        setTimeout(function() {
            buttonElement.innerHTML = originalHTML;
            buttonElement.classList.remove('btn-success');
            buttonElement.classList.add('btn-outline-primary');
        }, 2000);
    }).catch(function(err) {
        console.error('Erreur lors de la copie : ', err);
    });
}

// Télécharger un asset (simulation)
function downloadAsset(assetType) {
    // Dans une vraie application, ceci déclencherait le téléchargement d'un fichier réel
    alert(`Téléchargement de ${assetType} - Dans une vraie application, ceci téléchargerait le fichier correspondant.`);
}

// Télécharger tous les assets
function downloadAllAssets() {
    alert('Téléchargement de tous les assets - Dans une vraie application, ceci téléchargerait un fichier ZIP avec toutes les ressources.');
}

// Afficher les directives (simulation)
function showGuideline(type) {
    const modal = new bootstrap.Modal(document.getElementById('guidelineModal'));
    const modalBody = document.getElementById('guidelineModalBody');
    
    // Contenu différent selon le type
    if (type === 'web') {
        modalBody.innerHTML = `
            <h6>Directives pour le Site Web</h6>
            <ul>
                <li>Utiliser le logo principal dans l'en-tête</li>
                <li>Maintenir une hiérarchie claire avec les titres H1-H6</li>
                <li>Utiliser nos couleurs principales pour les éléments interactifs</li>
                <li>Assurer un contraste suffisant pour l'accessibilité</li>
                <li>Utiliser notre grille à 12 colonnes pour la mise en page</li>
            </ul>
        `;
    } else if (type === 'mobile') {
        modalBody.innerHTML = `
            <h6>Directives pour l'Application Mobile</h6>
            <ul>
                <li>Adapter le logo pour les petites tailles d'écran</li>
                <li>Utiliser des zones tactiques d'au moins 44px</li>
                <li>Optimiser les espacements pour les écrans tactiles</li>
                <li>Utiliser notre palette de couleurs avec un contraste accru</li>
                <li>Simplifier la navigation pour une utilisation mobile</li>
            </ul>
        `;
    }
    
    modal.show();
}
</script>
@endsection