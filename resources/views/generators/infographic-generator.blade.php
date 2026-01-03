@extends('layouts.app')

@section('title', 'Générateur d\'infographie - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Générateur d'infographie</li>
    </ol>
</nav>

<div class="card-custom">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="brand-font">18. Générateur d'infographie</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newInfographicModal">
            <i class="fas fa-plus me-2"></i>Nouvelle infographie
        </button>
    </div>
    
    <!-- Onglets -->
    <ul class="nav nav-tabs tab-custom mt-3">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#templates">Modèles</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#create">Créer</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#library">Bibliothèque</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#analytics">Analytiques</a>
        </li>
    </ul>
    
    <div class="tab-content mt-3">
        <!-- Onglet Modèles -->
        <div class="tab-pane fade show active" id="templates">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Rechercher des modèles..." id="templateSearch">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="categoryFilter">
                        <option value="">Toutes les catégories</option>
                        <option value="business">Affaires</option>
                        <option value="marketing">Marketing</option>
                        <option value="education">Éducation</option>
                        <option value="technology">Technologie</option>
                        <option value="social">Social Media</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="styleFilter">
                        <option value="">Tous les styles</option>
                        <option value="modern">Moderne</option>
                        <option value="classic">Classique</option>
                        <option value="minimalist">Minimaliste</option>
                        <option value="colorful">Coloré</option>
                        <option value="corporate">Entreprise</option>
                    </select>
                </div>
            </div>
            
            <div class="row" id="templatesContainer">
                <!-- Modèle 1 -->
                <div class="col-md-4 mb-4 template-item" data-category="business" data-style="modern">
                    <div class="card h-100">
                        <img src="https://picsum.photos/seed/infographic1/400/250.jpg" class="card-img-top" alt="Modèle d'infographie">
                        <div class="card-body">
                            <h5 class="card-title">Rapport annuel</h5>
                            <p class="card-text">Idéal pour présenter les résultats annuels de votre entreprise avec des graphiques et statistiques.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-primary">Affaires</span>
                                <span class="badge bg-secondary">Moderne</span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <button class="btn btn-primary w-100" onclick="useTemplate(1)">Utiliser ce modèle</button>
                        </div>
                    </div>
                </div>
                
                <!-- Modèle 2 -->
                <div class="col-md-4 mb-4 template-item" data-category="marketing" data-style="colorful">
                    <div class="card h-100">
                        <img src="https://picsum.photos/seed/infographic2/400/250.jpg" class="card-img-top" alt="Modèle d'infographie">
                        <div class="card-body">
                            <h5 class="card-title">Campagne marketing</h5>
                            <p class="card-text">Présentez votre stratégie marketing avec ce modèle coloré et dynamique.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-success">Marketing</span>
                                <span class="badge bg-warning text-dark">Coloré</span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <button class="btn btn-primary w-100" onclick="useTemplate(2)">Utiliser ce modèle</button>
                        </div>
                    </div>
                </div>
                
                <!-- Modèle 3 -->
                <div class="col-md-4 mb-4 template-item" data-category="education" data-style="minimalist">
                    <div class="card h-100">
                        <img src="https://picsum.photos/seed/infographic3/400/250.jpg" class="card-img-top" alt="Modèle d'infographie">
                        <div class="card-body">
                            <h5 class="card-title">Processus éducatif</h5>
                            <p class="card-text">Expliquez des concepts complexes avec ce modèle éducatif minimaliste.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-info">Éducation</span>
                                <span class="badge bg-dark">Minimaliste</span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <button class="btn btn-primary w-100" onclick="useTemplate(3)">Utiliser ce modèle</button>
                        </div>
                    </div>
                </div>
                
                <!-- Modèle 4 -->
                <div class="col-md-4 mb-4 template-item" data-category="technology" data-style="modern">
                    <div class="card h-100">
                        <img src="https://picsum.photos/seed/infographic4/400/250.jpg" class="card-img-top" alt="Modèle d'infographie">
                        <div class="card-body">
                            <h5 class="card-title">Technologie et innovation</h5>
                            <p class="card-text">Présentez les dernières tendances technologiques avec ce modèle moderne.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-danger">Technologie</span>
                                <span class="badge bg-primary">Moderne</span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <button class="btn btn-primary w-100" onclick="useTemplate(4)">Utiliser ce modèle</button>
                        </div>
                    </div>
                </div>
                
                <!-- Modèle 5 -->
                <div class="col-md-4 mb-4 template-item" data-category="social" data-style="colorful">
                    <div class="card h-100">
                        <img src="https://picsum.photos/seed/infographic5/400/250.jpg" class="card-img-top" alt="Modèle d'infographie">
                        <div class="card-body">
                            <h5 class="card-title">Statistiques des réseaux sociaux</h5>
                            <p class="card-text">Partagez vos statistiques de réseaux sociaux avec ce modèle coloré.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-warning text-dark">Social Media</span>
                                <span class="badge bg-warning text-dark">Coloré</span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <button class="btn btn-primary w-100" onclick="useTemplate(5)">Utiliser ce modèle</button>
                        </div>
                    </div>
                </div>
                
                <!-- Modèle 6 -->
                <div class="col-md-4 mb-4 template-item" data-category="business" data-style="corporate">
                    <div class="card h-100">
                        <img src="https://picsum.photos/seed/infographic6/400/250.jpg" class="card-img-top" alt="Modèle d'infographie">
                        <div class="card-body">
                            <h5 class="card-title">Organigramme d'entreprise</h5>
                            <p class="card-text">Structurez votre organisation avec ce modèle d'organigramme d'entreprise.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-primary">Affaires</span>
                                <span class="badge bg-secondary">Entreprise</span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <button class="btn btn-primary w-100" onclick="useTemplate(6)">Utiliser ce modèle</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <button class="btn btn-outline-primary">Charger plus de modèles</button>
            </div>
        </div>
        
        <!-- Onglet Créer -->
        <div class="tab-pane fade" id="create">
            <div class="row">
                <div class="col-md-8">
                    <div class="canvas-container">
                        <div class="canvas-header d-flex justify-content-between align-items-center mb-3">
                            <h5>Zone de création</h5>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-secondary" onclick="undoAction()">
                                    <i class="fas fa-undo"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-secondary" onclick="redoAction()">
                                    <i class="fas fa-redo"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-secondary" onclick="zoomIn()">
                                    <i class="fas fa-search-plus"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-secondary" onclick="zoomOut()">
                                    <i class="fas fa-search-minus"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-secondary" onclick="resetZoom()">
                                    <i class="fas fa-compress"></i>
                                </button>
                            </div>
                        </div>
                        <div class="canvas-wrapper bg-light" style="height: 500px; border: 1px solid #ddd; position: relative; overflow: hidden;">
                            <canvas id="infographicCanvas" width="800" height="500"></canvas>
                            <div class="canvas-overlay position-absolute top-0 start-0 w-100 h-100" style="pointer-events: none;">
                                <div class="position-absolute top-50 start-50 translate-middle text-center">
                                    <i class="fas fa-magic fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Commencez par sélectionner un modèle ou créez à partir de zéro</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="tools-panel">
                        <h5 class="mb-3">Outils</h5>
                        
                        <!-- Outils de base -->
                        <div class="mb-4">
                            <h6>Éléments</h6>
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-secondary btn-sm" onclick="addText()">
                                    <i class="fas fa-font me-2"></i>Ajouter du texte
                                </button>
                                <button class="btn btn-outline-secondary btn-sm" onclick="addShape()">
                                    <i class="fas fa-shapes me-2"></i>Ajouter une forme
                                </button>
                                <button class="btn btn-outline-secondary btn-sm" onclick="addImage()">
                                    <i class="fas fa-image me-2"></i>Ajouter une image
                                </button>
                                <button class="btn btn-outline-secondary btn-sm" onclick="addChart()">
                                    <i class="fas fa-chart-bar me-2"></i>Ajouter un graphique
                                </button>
                                <button class="btn btn-outline-secondary btn-sm" onclick="addIcon()">
                                    <i class="fas fa-icons me-2"></i>Ajouter une icône
                                </button>
                            </div>
                        </div>
                        
                        <!-- Couleurs -->
                        <div class="mb-4">
                            <h6>Couleurs</h6>
                            <div class="mb-2">
                                <label class="form-label">Couleur de fond</label>
                                <input type="color" class="form-control form-control-color" id="bgColor" value="#ffffff">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Couleur principale</label>
                                <input type="color" class="form-control form-control-color" id="primaryColor" value="#003366">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Couleur secondaire</label>
                                <input type="color" class="form-control form-control-color" id="secondaryColor" value="#FFD700">
                            </div>
                        </div>
                        
                        <!-- Typographie -->
                        <div class="mb-4">
                            <h6>Typographie</h6>
                            <div class="mb-2">
                                <label class="form-label">Police</label>
                                <select class="form-select" id="fontFamily">
                                    <option value="Arial">Arial</option>
                                    <option value="Helvetica">Helvetica</option>
                                    <option value="Times New Roman">Times New Roman</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Verdana">Verdana</option>
                                    <option value="Special Elite">Special Elite</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Taille</label>
                                <input type="range" class="form-range" id="fontSize" min="8" max="72" value="16">
                                <small class="text-muted">16px</small>
                            </div>
                        </div>
                        
                        <!-- Actions -->
                        <div class="mb-4">
                            <h6>Actions</h6>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary btn-sm" onclick="saveInfographic()">
                                    <i class="fas fa-save me-2"></i>Enregistrer
                                </button>
                                <button class="btn btn-outline-primary btn-sm" onclick="previewInfographic()">
                                    <i class="fas fa-eye me-2"></i>Aperçu
                                </button>
                                <button class="btn btn-outline-success btn-sm" onclick="downloadInfographic()">
                                    <i class="fas fa-download me-2"></i>Télécharger
                                </button>
                                <button class="btn btn-outline-info btn-sm" onclick="shareInfographic()">
                                    <i class="fas fa-share me-2"></i>Partager
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Onglet Bibliothèque -->
        <div class="tab-pane fade" id="library">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Rechercher dans votre bibliothèque..." id="librarySearch">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="libraryTypeFilter">
                        <option value="">Tous les types</option>
                        <option value="infographic">Infographies</option>
                        <option value="chart">Graphiques</option>
                        <option value="template">Modèles personnalisés</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="librarySort">
                        <option value="date_desc">Plus récents</option>
                        <option value="date_asc">Plus anciens</option>
                        <option value="name_asc">Nom (A-Z)</option>
                        <option value="name_desc">Nom (Z-A)</option>
                    </select>
                </div>
            </div>
            
            <div class="row" id="libraryContainer">
                <!-- Élément 1 -->
                <div class="col-md-4 mb-4 library-item" data-type="infographic">
                    <div class="card h-100">
                        <img src="https://picsum.photos/seed/library1/400/250.jpg" class="card-img-top" alt="Infographie enregistrée">
                        <div class="card-body">
                            <h5 class="card-title">Rapport trimestriel Q1</h5>
                            <p class="card-text">Créé le 15/03/2024</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-primary">Infographie</span>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-primary" onclick="editLibraryItem(1)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success" onclick="downloadLibraryItem(1)">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="deleteLibraryItem(1)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Élément 2 -->
                <div class="col-md-4 mb-4 library-item" data-type="chart">
                    <div class="card h-100">
                        <img src="https://picsum.photos/seed/library2/400/250.jpg" class="card-img-top" alt="Graphique enregistré">
                        <div class="card-body">
                            <h5 class="card-title">Statistiques des ventes 2024</h5>
                            <p class="card-text">Créé le 10/03/2024</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-success">Graphique</span>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-primary" onclick="editLibraryItem(2)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success" onclick="downloadLibraryItem(2)">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="deleteLibraryItem(2)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Élément 3 -->
                <div class="col-md-4 mb-4 library-item" data-type="template">
                    <div class="card h-100">
                        <img src="https://picsum.photos/seed/library3/400/250.jpg" class="card-img-top" alt="Modèle personnalisé">
                        <div class="card-body">
                            <h5 class="card-title">Modèle de présentation NJIEZM</h5>
                            <p class="card-text">Créé le 05/03/2024</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-info">Modèle</span>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-primary" onclick="editLibraryItem(3)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success" onclick="downloadLibraryItem(3)">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="deleteLibraryItem(3)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <button class="btn btn-outline-primary">Charger plus d'éléments</button>
            </div>
        </div>
        
        <!-- Onglet Analytiques -->
        <div class="tab-pane fade" id="analytics">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Infographies créées</h5>
                            <h2 class="text-primary">24</h2>
                            <p class="card-text">
                                <small class="text-success"><i class="fas fa-arrow-up"></i> 12% ce mois</small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Téléchargements</h5>
                            <h2 class="text-success">156</h2>
                            <p class="card-text">
                                <small class="text-success"><i class="fas fa-arrow-up"></i> 8% ce mois</small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Partages</h5>
                            <h2 class="text-info">89</h2>
                            <p class="card-text">
                                <small class="text-danger"><i class="fas fa-arrow-down"></i> 3% ce mois</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Activité mensuelle</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="activityChart" height="300"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Modèles populaires</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Rapport annuel</span>
                                <span class="badge bg-primary">42 utilisations</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Campagne marketing</span>
                                <span class="badge bg-primary">38 utilisations</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Processus éducatif</span>
                                <span class="badge bg-primary">31 utilisations</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Technologie et innovation</span>
                                <span class="badge bg-primary">28 utilisations</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Statistiques réseaux sociaux</span>
                                <span class="badge bg-primary">25 utilisations</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour créer une nouvelle infographie -->
<div class="modal fade" id="newInfographicModal" tabindex="-1" aria-labelledby="newInfographicModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newInfographicModalLabel">Créer une nouvelle infographie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Titre de l'infographie</label>
                            <input type="text" class="form-control" id="infographicTitle" placeholder="Entrez un titre">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" id="infographicDescription" rows="3" placeholder="Décrivez votre infographie"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Catégorie</label>
                            <select class="form-select" id="infographicCategory">
                                <option value="business">Affaires</option>
                                <option value="marketing">Marketing</option>
                                <option value="education">Éducation</option>
                                <option value="technology">Technologie</option>
                                <option value="social">Social Media</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Type de création</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="creationType" id="fromTemplate" checked>
                                <label class="form-check-label" for="fromTemplate">
                                    À partir d'un modèle
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="creationType" id="fromScratch">
                                <label class="form-check-label" for="fromScratch">
                                    À partir de zéro
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dimensions</label>
                            <select class="form-select" id="infographicDimensions">
                                <option value="square">Carré (1080x1080)</option>
                                <option value="portrait">Portrait (1080x1920)</option>
                                <option value="landscape">Paysage (1920x1080)</option>
                                <option value="a4">A4 (2480x3508)</option>
                                <option value="custom">Personnalisé</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Palette de couleurs</label>
                            <select class="form-select" id="infographicPalette">
                                <option value="brand">Marque NJIEZM</option>
                                <option value="modern">Moderne</option>
                                <option value="vibrant">Vibrant</option>
                                <option value="pastel">Pastel</option>
                                <option value="monochrome">Monochrome</option>
                                <option value="custom">Personnalisé</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="createInfographic()">Créer l'infographie</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal d'aperçu -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">Aperçu de l'infographie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="https://picsum.photos/seed/preview/800/600.jpg" class="img-fluid" alt="Aperçu de l'infographie">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" onclick="downloadInfographic()">Télécharger</button>
            </div>
        </div>
    </div>
</div>

<script>
// Variables globales
let currentTemplate = null;
let infographicCanvas = null;
let infographicContext = null;
let currentZoom = 1;
let infographicHistory = [];
let infographicHistoryStep = -1;

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser le canvas
    infographicCanvas = document.getElementById('infographicCanvas');
    infographicContext = infographicCanvas.getContext('2d');
    
    // Initialiser le graphique d'activité
    initActivityChart();
    
    // Ajouter les écouteurs d'événements
    setupEventListeners();
});

// Configuration des écouteurs d'événements
function setupEventListeners() {
    // Recherche de modèles
    document.getElementById('templateSearch').addEventListener('input', filterTemplates);
    
    // Filtres de modèles
    document.getElementById('categoryFilter').addEventListener('change', filterTemplates);
    document.getElementById('styleFilter').addEventListener('change', filterTemplates);
    
    // Recherche dans la bibliothèque
    document.getElementById('librarySearch').addEventListener('input', filterLibrary);
    
    // Filtres de bibliothèque
    document.getElementById('libraryTypeFilter').addEventListener('change', filterLibrary);
    document.getElementById('librarySort').addEventListener('change', sortLibrary);
    
    // Changement de taille de police
    document.getElementById('fontSize').addEventListener('input', function() {
        document.querySelector('#fontSize + small').textContent = this.value + 'px';
    });
}

// Filtrer les modèles
function filterTemplates() {
    const searchTerm = document.getElementById('templateSearch').value.toLowerCase();
    const categoryFilter = document.getElementById('categoryFilter').value;
    const styleFilter = document.getElementById('styleFilter').value;
    
    const templates = document.querySelectorAll('.template-item');
    
    templates.forEach(template => {
        const title = template.querySelector('.card-title').textContent.toLowerCase();
        const description = template.querySelector('.card-text').textContent.toLowerCase();
        const category = template.dataset.category;
        const style = template.dataset.style;
        
        const matchesSearch = title.includes(searchTerm) || description.includes(searchTerm);
        const matchesCategory = !categoryFilter || category === categoryFilter;
        const matchesStyle = !styleFilter || style === styleFilter;
        
        if (matchesSearch && matchesCategory && matchesStyle) {
            template.style.display = '';
        } else {
            template.style.display = 'none';
        }
    });
}

// Filtrer la bibliothèque
function filterLibrary() {
    const searchTerm = document.getElementById('librarySearch').value.toLowerCase();
    const typeFilter = document.getElementById('libraryTypeFilter').value;
    
    const items = document.querySelectorAll('.library-item');
    
    items.forEach(item => {
        const title = item.querySelector('.card-title').textContent.toLowerCase();
        const description = item.querySelector('.card-text').textContent.toLowerCase();
        const type = item.dataset.type;
        
        const matchesSearch = title.includes(searchTerm) || description.includes(searchTerm);
        const matchesType = !typeFilter || type === typeFilter;
        
        if (matchesSearch && matchesType) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
}

// Trier la bibliothèque
function sortLibrary() {
    const sortBy = document.getElementById('librarySort').value;
    const container = document.getElementById('libraryContainer');
    const items = Array.from(container.querySelectorAll('.library-item'));
    
    items.sort((a, b) => {
        const aTitle = a.querySelector('.card-title').textContent;
        const bTitle = b.querySelector('.card-title').textContent;
        const aDate = a.querySelector('.card-text').textContent;
        const bDate = b.querySelector('.card-text').textContent;
        
        switch (sortBy) {
            case 'name_asc':
                return aTitle.localeCompare(bTitle);
            case 'name_desc':
                return bTitle.localeCompare(aTitle);
            case 'date_asc':
                return aDate.localeCompare(bDate);
            case 'date_desc':
                return bDate.localeCompare(aDate);
            default:
                return 0;
        }
    });
    
    items.forEach(item => container.appendChild(item));
}

// Utiliser un modèle
function useTemplate(templateId) {
    currentTemplate = templateId;
    
    // Fermer le modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('newInfographicModal'));
    if (modal) modal.hide();
    
    // Passer à l'onglet de création
    const createTab = new bootstrap.Tab(document.querySelector('[data-bs-toggle="tab"][href="#create"]'));
    createTab.show();
    
    // Charger le modèle dans le canvas
    loadTemplate(templateId);
    
    // Afficher une notification
    showNotification('Modèle chargé avec succès', 'success');
}

// Charger un modèle dans le canvas
function loadTemplate(templateId) {
    // Implémenter le chargement du modèle
    console.log('Chargement du modèle', templateId);
}

// Créer une infographie
function createInfographic() {
    const title = document.getElementById('infographicTitle').value;
    const description = document.getElementById('infographicDescription').value;
    const category = document.getElementById('infographicCategory').value;
    const dimensions = document.getElementById('infographicDimensions').value;
    const palette = document.getElementById('infographicPalette').value;
    const creationType = document.querySelector('input[name="creationType"]:checked').id;
    
    if (!title) {
        showNotification('Veuillez entrer un titre pour votre infographie', 'warning');
        return;
    }
    
    // Fermer le modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('newInfographicModal'));
    modal.hide();
    
    // Passer à l'onglet de création
    const createTab = new bootstrap.Tab(document.querySelector('[data-bs-toggle="tab"][href="#create"]'));
    createTab.show();
    
    // Initialiser le canvas en fonction des dimensions
    setupCanvas(dimensions);
    
    // Appliquer la palette de couleurs
    applyColorPalette(palette);
    
    // Afficher une notification
    showNotification('Infographie créée avec succès', 'success');
}

// Configurer le canvas
function setupCanvas(dimensions) {
    let width, height;
    
    switch (dimensions) {
        case 'square':
            width = height = 1080;
            break;
        case 'portrait':
            width = 1080;
            height = 1920;
            break;
        case 'landscape':
            width = 1920;
            height = 1080;
            break;
        case 'a4':
            width = 2480;
            height = 3508;
            break;
        default:
            width = 1920;
            height = 1080;
    }
    
    infographicCanvas.width = width;
    infographicCanvas.height = height;
    
    // Adapter le zoom pour que le canvas tienne dans le conteneur
    const container = document.querySelector('.canvas-wrapper');
    const containerWidth = container.clientWidth;
    const containerHeight = container.clientHeight;
    
    const scaleX = containerWidth / width;
    const scaleY = containerHeight / height;
    currentZoom = Math.min(scaleX, scaleY, 1);
    
    infographicCanvas.style.transform = `scale(${currentZoom})`;
    infographicCanvas.style.transformOrigin = 'top left';
    
    // Masquer l'overlay
    document.querySelector('.canvas-overlay').style.display = 'none';
}

// Appliquer une palette de couleurs
function applyColorPalette(palette) {
    // Implémenter l'application de la palette de couleurs
    console.log('Application de la palette', palette);
}

// Ajouter du texte
function addText() {
    // Implémenter l'ajout de texte
    console.log('Ajout de texte');
}

// Ajouter une forme
function addShape() {
    // Implémenter l'ajout de forme
    console.log('Ajout de forme');
}

// Ajouter une image
function addImage() {
    // Implémenter l'ajout d'image
    console.log('Ajout d\'image');
}

// Ajouter un graphique
function addChart() {
    // Implémenter l'ajout de graphique
    console.log('Ajout de graphique');
}

// Ajouter une icône
function addIcon() {
    // Implémenter l'ajout d'icône
    console.log('Ajout d\'icône');
}

// Annuler l'action
function undoAction() {
    if (infographicHistoryStep > 0) {
        infographicHistoryStep--;
        restoreCanvas(infographicHistory[infographicHistoryStep]);
    }
}

// Rétablir l'action
function redoAction() {
    if (infographicHistoryStep < infographicHistory.length - 1) {
        infographicHistoryStep++;
        restoreCanvas(infographicHistory[infographicHistoryStep]);
    }
}

// Zoom avant
function zoomIn() {
    currentZoom = Math.min(currentZoom + 0.1, 2);
    infographicCanvas.style.transform = `scale(${currentZoom})`;
}

// Zoom arrière
function zoomOut() {
    currentZoom = Math.max(currentZoom - 0.1, 0.5);
    infographicCanvas.style.transform = `scale(${currentZoom})`;
}

// Réinitialiser le zoom
function resetZoom() {
    currentZoom = 1;
    infographicCanvas.style.transform = `scale(${currentZoom})`;
}

// Sauvegarder l'infographie
function saveInfographic() {
    // Sauvegarder l'état actuel du canvas dans l'historique
    saveCanvasState();
    
    // Implémenter la sauvegarde
    showNotification('Infographie sauvegardée avec succès', 'success');
}

// Aperçu de l'infographie
function previewInfographic() {
    const modal = new bootstrap.Modal(document.getElementById('previewModal'));
    modal.show();
}

// Télécharger l'infographie
function downloadInfographic() {
    const link = document.createElement('a');
    link.download = 'infographie.png';
    link.href = infographicCanvas.toDataURL();
    link.click();
    
    showNotification('Téléchargement commencé', 'success');
}

// Partager l'infographie
function shareInfographic() {
    // Implémenter le partage
    showNotification('Fonctionnalité de partage à venir', 'info');
}

// Modifier un élément de la bibliothèque
function editLibraryItem(itemId) {
    // Implémenter la modification
    console.log('Modification de l\'élément', itemId);
}

// Télécharger un élément de la bibliothèque
function downloadLibraryItem(itemId) {
    // Implémenter le téléchargement
    console.log('Téléchargement de l\'élément', itemId);
    showNotification('Téléchargement commencé', 'success');
}

// Supprimer un élément de la bibliothèque
function deleteLibraryItem(itemId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) {
        // Implémenter la suppression
        console.log('Suppression de l\'élément', itemId);
        showNotification('Élément supprimé avec succès', 'success');
    }
}

// Sauvegarder l'état du canvas
function saveCanvasState() {
    if (infographicHistoryStep < infographicHistory.length - 1) {
        infographicHistory.length = infographicHistoryStep + 1;
    }
    infographicHistory.push(infographicCanvas.toDataURL());
    infographicHistoryStep++;
}

// Restaurer l'état du canvas
function restoreCanvas(dataUrl) {
    const img = new Image();
    img.src = dataUrl;
    img.onload = function() {
        infographicContext.clearRect(0, 0, infographicCanvas.width, infographicCanvas.height);
        infographicContext.drawImage(img, 0, 0);
    };
}

// Initialiser le graphique d'activité
function initActivityChart() {
    const ctx = document.getElementById('activityChart').getContext('2d');
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun'],
            datasets: [{
                label: 'Infographies créées',
                data: [12, 19, 8, 15, 22, 18],
                borderColor: 'var(--nj-blue)',
                backgroundColor: 'rgba(0, 51, 102, 0.1)',
                tension: 0.4,
                fill: true
            }, {
                label: 'Téléchargements',
                data: [45, 62, 38, 55, 78, 65],
                borderColor: 'var(--nj-yellow)',
                backgroundColor: 'rgba(255, 215, 0, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

// Afficher une notification
function showNotification(message, type = 'info') {
    // Créer une notification
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
    
    // Supprimer la notification après 3 secondes
    setTimeout(() => {
        notification.classList.remove('alert-show');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 150);
    }, 3000);
}
</script>

<style>
.template-item, .library-item {
    transition: transform 0.2s;
}

.template-item:hover, .library-item:hover {
    transform: translateY(-5px);
}

.canvas-container {
    position: relative;
}

.canvas-wrapper {
    position: relative;
    overflow: auto;
    max-height: 500px;
}

.canvas-overlay {
    background-color: rgba(255, 255, 255, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
}

.tools-panel {
    background-color: #f8f9fa;
    border-radius: 8px;
    padding: 15px;
    height: 100%;
}

.tools-panel h6 {
    color: var(--nj-blue);
    border-bottom: 1px solid #dee2e6;
    padding-bottom: 5px;
    margin-bottom: 10px;
}
</style>
@endsection