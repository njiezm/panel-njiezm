@extends('layouts.app')

@section('title', 'Générateur de communiqué de presse - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Générateur de communiqué de presse</li>
    </ol>
</nav>

<div class="card-custom">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="brand-font">19. Générateur de communiqué de presse</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newPressReleaseModal">
            <i class="fas fa-plus me-2"></i>Nouveau communiqué
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
            <a class="nav-link" data-bs-toggle="tab" href="#distribution">Distribution</a>
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
                        <option value="product">Lancement de produit</option>
                        <option value="event">Événement</option>
                        <option value="partnership">Partenariat</option>
                        <option value="award">Prix et récompenses</option>
                        <option value="company">Actualités entreprise</option>
                        <option value="crisis">Communication de crise</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="toneFilter">
                        <option value="">Tous les tons</option>
                        <option value="formal">Formel</option>
                        <option value="casual">Décontracté</option>
                        <option value="technical">Technique</option>
                        <option value="promotional">Promotionnel</option>
                    </select>
                </div>
            </div>
            
            <div class="row" id="templatesContainer">
                <!-- Modèle 1 -->
                <div class="col-md-6 mb-4 template-item" data-category="product" data-tone="formal">
                    <div class="card h-100">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Lancement de produit</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Modèle professionnel pour annoncer le lancement d'un nouveau produit ou service. Idéal pour les entreprises technologiques et les startups.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-primary">Produit</span>
                                <span class="badge bg-secondary">Formel</span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <button class="btn btn-primary w-100" onclick="useTemplate(1)">Utiliser ce modèle</button>
                        </div>
                    </div>
                </div>
                
                <!-- Modèle 2 -->
                <div class="col-md-6 mb-4 template-item" data-category="event" data-tone="casual">
                    <div class="card h-100">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Événement spécial</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Parfait pour annoncer un événement, une conférence ou un webinar. Ton décontracté et engageant pour attirer l'attention.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-success">Événement</span>
                                <span class="badge bg-warning text-dark">Décontracté</span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <button class="btn btn-primary w-100" onclick="useTemplate(2)">Utiliser ce modèle</button>
                        </div>
                    </div>
                </div>
                
                <!-- Modèle 3 -->
                <div class="col-md-6 mb-4 template-item" data-category="partnership" data-tone="formal">
                    <div class="card h-100">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">Partenariat stratégique</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Communiquez sur un nouveau partenariat ou une collaboration. Structure formelle pour les relations B2B et institutionnelles.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-info">Partenariat</span>
                                <span class="badge bg-secondary">Formel</span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <button class="btn btn-primary w-100" onclick="useTemplate(3)">Utiliser ce modèle</button>
                        </div>
                    </div>
                </div>
                
                <!-- Modèle 4 -->
                <div class="col-md-6 mb-4 template-item" data-category="award" data-tone="promotional">
                    <div class="card h-100">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0">Prix et reconnaissance</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Mettez en avant vos succès et récompenses. Ton promotionnel pour valoriser vos accomplissements.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-warning text-dark">Prix</span>
                                <span class="badge bg-success">Promotionnel</span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <button class="btn btn-primary w-100" onclick="useTemplate(4)">Utiliser ce modèle</button>
                        </div>
                    </div>
                </div>
                
                <!-- Modèle 5 -->
                <div class="col-md-6 mb-4 template-item" data-category="company" data-tone="formal">
                    <div class="card h-100">
                        <div class="card-header bg-danger text-white">
                            <h5 class="mb-0">Actualités entreprise</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Annoncez les nouvelles de votre entreprise : recrutement, expansion, nouvelles fonctionnalités, etc.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-danger">Entreprise</span>
                                <span class="badge bg-secondary">Formel</span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <button class="btn btn-primary w-100" onclick="useTemplate(5)">Utiliser ce modèle</button>
                        </div>
                    </div>
                </div>
                
                <!-- Modèle 6 -->
                <div class="col-md-6 mb-4 template-item" data-category="crisis" data-tone="formal">
                    <div class="card h-100">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0">Communication de crise</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Gérez les situations délicates avec ce modèle de communication de crise. Ton formel et rassurant.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-dark">Crise</span>
                                <span class="badge bg-secondary">Formel</span>
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
                    <div class="editor-container">
                        <div class="editor-header d-flex justify-content-between align-items-center mb-3">
                            <h5>Éditeur de communiqué de presse</h5>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-secondary" onclick="formatText('bold')">
                                    <i class="fas fa-bold"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-secondary" onclick="formatText('italic')">
                                    <i class="fas fa-italic"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-secondary" onclick="formatText('underline')">
                                    <i class="fas fa-underline"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-secondary" onclick="insertList()">
                                    <i class="fas fa-list"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-secondary" onclick="insertLink()">
                                    <i class="fas fa-link"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="editor-toolbar mb-3">
                            <div class="btn-group me-2">
                                <button class="btn btn-sm btn-outline-primary" onclick="insertHeading('h1')">
                                    Titre
                                </button>
                                <button class="btn btn-sm btn-outline-primary" onclick="insertHeading('h2')">
                                    Sous-titre
                                </button>
                            </div>
                            <div class="btn-group me-2">
                                <button class="btn btn-sm btn-outline-info" onclick="insertQuote()">
                                    <i class="fas fa-quote-left me-1"></i>Citation
                                </button>
                                <button class="btn btn-sm btn-outline-info" onclick="insertContact()">
                                    <i class="fas fa-address-card me-1"></i>Contact
                                </button>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-success" onclick="saveDraft()">
                                    <i class="fas fa-save me-1"></i>Brouillon
                                </button>
                            </div>
                        </div>
                        
                        <div id="pressReleaseEditor" class="editor-content border rounded p-3" contenteditable="true" style="min-height: 500px; background: white;">
                            <h1>TITRE DU COMMUNIQUÉ DE PRESSE</h1>
                            <p><strong>VILLE, PAYS</strong> – Date – Commencez par une phrase d'accroche percutante qui résume l'actualité principale.</p>
                            
                            <h2>Contexte</h2>
                            <p>Fournissez le contexte nécessaire pour que les journalistes comprennent l'importance de cette actualité. Incluez des informations pertinentes sur votre entreprise ou l'organisation.</p>
                            
                            <h2>Détails de l'actualité</h2>
                            <p>Développez les points clés de votre actualité. Utilisez des faits, des chiffres et des citations pour renforcer votre message.</p>
                            
                            <blockquote>
                                <p>"Cette actualité représente une étape importante pour notre entreprise et nos clients," a déclaré [Nom], [Titre] chez [Entreprise].</p>
                            </blockquote>
                            
                            <h2>À propos de [Entreprise]</h2>
                            <p>Incluez une brève description de votre entreprise, sa mission et ses principaux accomplissements.</p>
                            
                            <h2>Contact presse</h2>
                            <p><strong>Nom du contact</strong><br>
                            Titre<br>
                            Email<br>
                            Téléphone<br>
                            Site web</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="tools-panel">
                        <h5 class="mb-3">Outils et assistants</h5>
                        
                        <!-- Assistant IA -->
                        <div class="mb-4">
                            <h6>Assistant IA</h6>
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" id="aiPrompt" placeholder="Demandez à l'IA...">
                                <button class="btn btn-primary" onclick="askAI()">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                            <div class="d-grid gap-1">
                                <button class="btn btn-sm btn-outline-secondary" onclick="generateHeadline()">
                                    Générer un titre
                                </button>
                                <button class="btn btn-sm btn-outline-secondary" onclick="generateSummary()">
                                    Générer un résumé
                                </button>
                                <button class="btn btn-sm btn-outline-secondary" onclick="improveText()">
                                    Améliorer le texte
                                </button>
                            </div>
                        </div>
                        
                        <!-- Guide de style -->
                        <div class="mb-4">
                            <h6>Guide de style</h6>
                            <div class="alert alert-info">
                                <small>
                                    <strong>Conseils :</strong><br>
                                    • Titre : 60-70 caractères<br>
                                    • Sous-titre : 100-120 caractères<br>
                                    • Paragraphes : 2-3 phrases<br>
                                    • Ton : Professionnel et factuel<br>
                                    • Format : Inversé (pyramide)
                                </small>
                            </div>
                        </div>
                        
                        <!-- Mots-clés -->
                        <div class="mb-4">
                            <h6>Mots-clés SEO</h6>
                            <input type="text" class="form-control mb-2" id="keywords" placeholder="Ajoutez des mots-clés...">
                            <div id="keywordsList" class="d-flex flex-wrap gap-1">
                                <!-- Les mots-clés seront ajoutés ici -->
                            </div>
                        </div>
                        
                        <!-- Actions -->
                        <div class="mb-4">
                            <h6>Actions</h6>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary btn-sm" onclick="previewPressRelease()">
                                    <i class="fas fa-eye me-2"></i>Aperçu
                                </button>
                                <button class="btn btn-outline-primary btn-sm" onclick="validatePressRelease()">
                                    <i class="fas fa-check me-2"></i>Valider
                                </button>
                                <button class="btn btn-outline-success btn-sm" onclick="downloadPressRelease()">
                                    <i class="fas fa-download me-2"></i>Télécharger
                                </button>
                                <button class="btn btn-outline-info btn-sm" onclick="scheduleDistribution()">
                                    <i class="fas fa-calendar me-2"></i>Programmer
                                </button>
                            </div>
                        </div>
                        
                        <!-- Statistiques -->
                        <div class="mb-4">
                            <h6>Statistiques</h6>
                            <div class="small">
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Mots :</span>
                                    <span id="wordCount">0</span>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Caractères :</span>
                                    <span id="charCount">0</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Lecture estimée :</span>
                                    <span id="readTime">0 min</span>
                                </div>
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
                    <select class="form-select" id="libraryStatusFilter">
                        <option value="">Tous les statuts</option>
                        <option value="draft">Brouillons</option>
                        <option value="published">Publié</option>
                        <option value="scheduled">Programmé</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="librarySort">
                        <option value="date_desc">Plus récents</option>
                        <option value="date_asc">Plus anciens</option>
                        <option value="title_asc">Titre (A-Z)</option>
                        <option value="title_desc">Titre (Z-A)</option>
                    </select>
                </div>
            </div>
            
            <div class="row" id="libraryContainer">
                <!-- Élément 1 -->
                <div class="col-md-6 mb-4 library-item" data-status="published">
                    <div class="card h-100">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0">Lancement nouvelle plateforme NJIEZM</h6>
                        </div>
                        <div class="card-body">
                            <p class="card-text">NJIEZM.FR annonce le lancement de sa nouvelle plateforme de gestion de marque...</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-success">Publié</span>
                                <small class="text-muted">15/03/2024</small>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="btn-group w-100">
                                <button class="btn btn-sm btn-outline-primary" onclick="editLibraryItem(1)">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-success" onclick="downloadLibraryItem(1)">
                                    <i class="fas fa-download"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-info" onclick="shareLibraryItem(1)">
                                    <i class="fas fa-share"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" onclick="deleteLibraryItem(1)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Élément 2 -->
                <div class="col-md-6 mb-4 library-item" data-status="draft">
                    <div class="card h-100">
                        <div class="card-header bg-secondary text-white">
                            <h6 class="mb-0">Partenariat avec TechCorp</h6>
                        </div>
                        <div class="card-body">
                            <p class="card-text">NJIEZM.FR et TechCorp annoncent un partenariat stratégique pour...</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-secondary">Brouillon</span>
                                <small class="text-muted">12/03/2024</small>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="btn-group w-100">
                                <button class="btn btn-sm btn-outline-primary" onclick="editLibraryItem(2)">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-success" onclick="downloadLibraryItem(2)">
                                    <i class="fas fa-download"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-info" onclick="shareLibraryItem(2)">
                                    <i class="fas fa-share"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" onclick="deleteLibraryItem(2)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Onglet Distribution -->
        <div class="tab-pane fade" id="distribution">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Liste de diffusion</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Journalistes et médias</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="techMedia" checked>
                                    <label class="form-check-label" for="techMedia">
                                        TechMedia (25 contacts)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="businessNews">
                                    <label class="form-check-label" for="businessNews">
                                        Business News (18 contacts)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="localPress">
                                    <label class="form-check-label" for="localPress">
                                        Presse locale (32 contacts)
                                    </label>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Influenceurs et blogueurs</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="techInfluencers">
                                    <label class="form-check-label" for="techInfluencers">
                                        Influenceurs tech (15 contacts)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="businessBloggers">
                                    <label class="form-check-label" for="businessBloggers">
                                        Blogueurs business (12 contacts)
                                    </label>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Contacts personnalisés</label>
                                <textarea class="form-control" rows="3" placeholder="Ajoutez des emails personnalisés (un par ligne)"></textarea>
                            </div>
                            
                            <button class="btn btn-primary w-100" onclick="sendPressRelease()">
                                <i class="fas fa-paper-plane me-2"></i>Envoyer le communiqué
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Statistiques de distribution</h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-4">
                                    <h4 class="text-primary">156</h4>
                                    <small>Envoyés</small>
                                </div>
                                <div class="col-4">
                                    <h4 class="text-success">89</h4>
                                    <small>Ouverts</small>
                                </div>
                                <div class="col-4">
                                    <h4 class="text-info">23</h4>
                                    <small>Clics</small>
                                </div>
                            </div>
                            
                            <hr>
                            
                            <h6>Dernières distributions</h6>
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Lancement plateforme</strong><br>
                                        <small>Envoyé il y a 2 jours</small>
                                    </div>
                                    <span class="badge bg-success">78% ouvert</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Partenariat TechCorp</strong><br>
                                        <small>Envoyé il y a 1 semaine</small>
                                    </div>
                                    <span class="badge bg-warning">45% ouvert</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Nouveau design</strong><br>
                                        <small>Envoyé il y a 2 semaines</small>
                                    </div>
                                    <span class="badge bg-success">82% ouvert</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour créer un nouveau communiqué -->
<div class="modal fade" id="newPressReleaseModal" tabindex="-1" aria-labelledby="newPressReleaseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newPressReleaseModalLabel">Créer un nouveau communiqué de presse</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Titre du communiqué</label>
                    <input type="text" class="form-control" id="pressReleaseTitle" placeholder="Entrez un titre percutant">
                </div>
                <div class="mb-3">
                    <label class="form-label">Catégorie</label>
                    <select class="form-select" id="pressReleaseCategory">
                        <option value="product">Lancement de produit</option>
                        <option value="event">Événement</option>
                        <option value="partnership">Partenariat</option>
                        <option value="award">Prix et récompenses</option>
                        <option value="company">Actualités entreprise</option>
                        <option value="crisis">Communication de crise</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Date de publication</label>
                    <input type="date" class="form-control" id="pressReleaseDate">
                </div>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="createPressRelease()">Créer le communiqué</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal d'aperçu -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">Aperçu du communiqué de presse</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="previewContent" class="press-release-preview">
                    <!-- Le contenu de l'aperçu sera inséré ici -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" onclick="downloadPressRelease()">Télécharger</button>
            </div>
        </div>
    </div>
</div>

<script>
// Variables globales
let currentTemplate = null;
let pressReleaseEditor = null;

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    pressReleaseEditor = document.getElementById('pressReleaseEditor');
    
    // Ajouter les écouteurs d'événements
    setupEventListeners();
    
    // Mettre à jour les statistiques
    updateStats();
    
    // Définir la date du jour par défaut
    document.getElementById('pressReleaseDate').valueAsDate = new Date();
});

// Configuration des écouteurs d'événements
function setupEventListeners() {
    // Recherche de modèles
    document.getElementById('templateSearch').addEventListener('input', filterTemplates);
    
    // Filtres de modèles
    document.getElementById('categoryFilter').addEventListener('change', filterTemplates);
    document.getElementById('toneFilter').addEventListener('change', filterTemplates);
    
    // Recherche dans la bibliothèque
    document.getElementById('librarySearch').addEventListener('input', filterLibrary);
    
    // Filtres de bibliothèque
    document.getElementById('libraryStatusFilter').addEventListener('change', filterLibrary);
    document.getElementById('librarySort').addEventListener('change', sortLibrary);
    
    // Éditeur de contenu
    pressReleaseEditor.addEventListener('input', updateStats);
    pressReleaseEditor.addEventListener('paste', function(e) {
        e.preventDefault();
        const text = e.clipboardData.getData('text/plain');
        document.execCommand('insertText', false, text);
        updateStats();
    });
    
    // Mots-clés
    document.getElementById('keywords').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            addKeyword(this.value);
            this.value = '';
        }
    });
}

// Filtrer les modèles
function filterTemplates() {
    const searchTerm = document.getElementById('templateSearch').value.toLowerCase();
    const categoryFilter = document.getElementById('categoryFilter').value;
    const toneFilter = document.getElementById('toneFilter').value;
    
    const templates = document.querySelectorAll('.template-item');
    
    templates.forEach(template => {
        const title = template.querySelector('.card-title').textContent.toLowerCase();
        const description = template.querySelector('.card-text').textContent.toLowerCase();
        const category = template.dataset.category;
        const tone = template.dataset.tone;
        
        const matchesSearch = title.includes(searchTerm) || description.includes(searchTerm);
        const matchesCategory = !categoryFilter || category === categoryFilter;
        const matchesTone = !toneFilter || tone === toneFilter;
        
        if (matchesSearch && matchesCategory && matchesTone) {
            template.style.display = '';
        } else {
            template.style.display = 'none';
        }
    });
}

// Filtrer la bibliothèque
function filterLibrary() {
    const searchTerm = document.getElementById('librarySearch').value.toLowerCase();
    const statusFilter = document.getElementById('libraryStatusFilter').value;
    
    const items = document.querySelectorAll('.library-item');
    
    items.forEach(item => {
        const title = item.querySelector('.card-title').textContent.toLowerCase();
        const description = item.querySelector('.card-text').textContent.toLowerCase();
        const status = item.dataset.status;
        
        const matchesSearch = title.includes(searchTerm) || description.includes(searchTerm);
        const matchesStatus = !statusFilter || status === statusFilter;
        
        if (matchesSearch && matchesStatus) {
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
        const aDate = a.querySelector('.text-muted').textContent;
        const bDate = b.querySelector('.text-muted').textContent;
        
        switch (sortBy) {
            case 'title_asc':
                return aTitle.localeCompare(bTitle);
            case 'title_desc':
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
    const modal = bootstrap.Modal.getInstance(document.getElementById('newPressReleaseModal'));
    if (modal) modal.hide();
    
    // Passer à l'onglet de création
    const createTab = new bootstrap.Tab(document.querySelector('[data-bs-toggle="tab"][href="#create"]'));
    createTab.show();
    
    // Charger le modèle dans l'éditeur
    loadTemplate(templateId);
    
    // Afficher une notification
    showNotification('Modèle chargé avec succès', 'success');
}

// Charger un modèle dans l'éditeur
function loadTemplate(templateId) {
    const templates = {
        1: {
            title: "NJIEZM.FR LANCECE SA NOUVELLE PLATEFORME DE GESTION DE MARQUE",
            content: `<h1>NJIEZM.FR LANCECE SA NOUVELLE PLATEFORME DE GESTION DE MARQUE</h1>
<p><strong>PARIS, FRANCE</strong> – ${new Date().toLocaleDateString('fr-FR')} – NJIEZM.FR, leader français des solutions de gestion de marque, annonce aujourd'hui le lancement de sa nouvelle plateforme révolutionnaire destinée aux entreprises et aux créateurs.</p>
<h2>Une innovation au service de la marque</h2>
<p>La nouvelle plateforme NJIEZM.FR offre des outils avancés pour la gestion complète de l'identité visuelle, incluant la création de logos, la génération de contenu pour les réseaux sociaux, et la gestion des documents juridiques.</p>
<h2>Caractéristiques principales</h2>
<p>• Gestion centralisée de l'identité visuelle<br>
• Générateur de contenu IA<br>
• Outils de collaboration d'équipe<br>
• Bibliothèque de modèles personnalisables</p>
<blockquote>
<p>"Cette plateforme représente une étape majeure dans notre mission d'accompagner les entreprises dans leur transformation digitale," déclare Jean Dupont, CEO de NJIEZM.FR.</p>
</blockquote>
<h2>À propos de NJIEZM.FR</h2>
<p>NJIEZM.FR est une entreprise française spécialisée dans les solutions de gestion de marque pour les PME et les grands comptes.</p>`
        },
        // Ajouter d'autres modèles ici...
    };
    
    if (templates[templateId]) {
        pressReleaseEditor.innerHTML = templates[templateId].content;
        updateStats();
    }
}

// Créer un communiqué de presse
function createPressRelease() {
    const title = document.getElementById('pressReleaseTitle').value;
    const category = document.getElementById('pressReleaseCategory').value;
    const date = document.getElementById('pressReleaseDate').value;
    const creationType = document.querySelector('input[name="creationType"]:checked').id;
    
    if (!title) {
        showNotification('Veuillez entrer un titre pour votre communiqué', 'warning');
        return;
    }
    
    // Fermer le modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('newPressReleaseModal'));
    modal.hide();
    
    // Passer à l'onglet de création
    const createTab = new bootstrap.Tab(document.querySelector('[data-bs-toggle="tab"][href="#create"]'));
    createTab.show();
    
    // Initialiser l'éditeur
    if (creationType === 'fromScratch') {
        pressReleaseEditor.innerHTML = `<h1>${title.toUpperCase()}</h1>
<p><strong>VILLE, PAYS</strong> – ${new Date(date).toLocaleDateString('fr-FR')} – [Commencez par une phrase d'accroche percutante]</p>
<h2>Contexte</h2>
<p>[Fournissez le contexte nécessaire]</p>
<h2>Détails</h2>
<p>[Développez les points clés]</p>
<h2>À propos de [Entreprise]</h2>
<p>[Description de l'entreprise]</p>
<h2>Contact presse</h2>
<p>[Informations de contact]</p>`;
    } else {
        loadTemplate(1); // Charger le modèle par défaut
    }
    
    // Afficher une notification
    showNotification('Communiqué de presse créé avec succès', 'success');
}

// Mettre à jour les statistiques
function updateStats() {
    const content = pressReleaseEditor.innerText || pressReleaseEditor.textContent;
    const words = content.trim().split(/\s+/).length;
    const chars = content.length;
    const readTime = Math.ceil(words / 200); // 200 mots par minute
    
    document.getElementById('wordCount').textContent = words;
    document.getElementById('charCount').textContent = chars;
    document.getElementById('readTime').textContent = readTime + ' min';
}

// Formatter le texte
function formatText(command) {
    document.execCommand(command, false, null);
    pressReleaseEditor.focus();
}

// Insérer un titre
function insertHeading(tag) {
    const selection = window.getSelection();
    const range = selection.getRangeAt(0);
    const heading = document.createElement(tag);
    heading.textContent = 'Titre';
    range.insertNode(heading);
    range.selectNodeContents(heading);
    selection.removeAllRanges();
    selection.addRange(range);
}

// Insérer une liste
function insertList() {
    document.execCommand('insertUnorderedList', false, null);
    pressReleaseEditor.focus();
}

// Insérer un lien
function insertLink() {
    const url = prompt('Entrez l\'URL du lien:');
    if (url) {
        document.execCommand('createLink', false, url);
    }
    pressReleaseEditor.focus();
}

// Insérer une citation
function insertQuote() {
    const selection = window.getSelection();
    const range = selection.getRangeAt(0);
    const blockquote = document.createElement('blockquote');
    blockquote.innerHTML = '<p>Citation</p>';
    range.insertNode(blockquote);
    pressReleaseEditor.focus();
}

// Insérer les informations de contact
function insertContact() {
    const contactInfo = `<h2>Contact presse</h2>
<p><strong>Nom du contact</strong><br>
Titre<br>
Email<br>
Téléphone<br>
Site web</p>`;
    
    document.execCommand('insertHTML', false, contactInfo);
    pressReleaseEditor.focus();
}

// Ajouter un mot-clé
function addKeyword(keyword) {
    if (keyword.trim()) {
        const keywordsList = document.getElementById('keywordsList');
        const keywordTag = document.createElement('span');
        keywordTag.className = 'badge bg-primary me-1 mb-1';
        keywordTag.textContent = keyword;
        keywordsList.appendChild(keywordTag);
    }
}

// Demander à l'IA
function askAI() {
    const prompt = document.getElementById('aiPrompt').value;
    if (!prompt) return;
    
    // Simuler une réponse de l'IA
    setTimeout(() => {
        const response = "Voici une suggestion basée sur votre demande : " + generateAISuggestion(prompt);
        document.execCommand('insertText', false, response);
        document.getElementById('aiPrompt').value = '';
        updateStats();
    }, 1000);
}

// Générer une suggestion IA
function generateAISuggestion(prompt) {
    const suggestions = {
        'titre': 'Titre percutant et professionnel pour votre communiqué',
        'résumé': 'Résumé concis des points clés de votre actualité',
        'améliorer': 'Version améliorée de votre texte avec un ton plus professionnel',
        'default': 'Suggestion basée sur votre demande'
    };
    
    return suggestions[prompt.toLowerCase()] || suggestions['default'];
}

// Générer un titre
function generateHeadline() {
    document.getElementById('aiPrompt').value = 'titre';
    askAI();
}

// Générer un résumé
function generateSummary() {
    document.getElementById('aiPrompt').value = 'résumé';
    askAI();
}

// Améliorer le texte
function improveText() {
    document.getElementById('aiPrompt').value = 'améliorer';
    askAI();
}

// Sauvegarder le brouillon
function saveDraft() {
    const content = pressReleaseEditor.innerHTML;
    localStorage.setItem('pressReleaseDraft', content);
    showNotification('Brouillon sauvegardé', 'success');
}

// Aperçu du communiqué
function previewPressRelease() {
    const previewContent = document.getElementById('previewContent');
    previewContent.innerHTML = pressReleaseEditor.innerHTML;
    
    const modal = new bootstrap.Modal(document.getElementById('previewModal'));
    modal.show();
}

// Valider le communiqué
function validatePressRelease() {
    const content = pressReleaseEditor.innerText || pressReleaseEditor.textContent;
    const words = content.trim().split(/\s+/).length;
    
    if (words < 100) {
        showNotification('Le communiqué semble trop court. Visez au moins 100 mots.', 'warning');
        return;
    }
    
    if (!content.includes('Contact presse')) {
        showNotification('N\'oubliez pas d\'ajouter les informations de contact presse.', 'warning');
        return;
    }
    
    showNotification('Le communiqué semble bien structuré !', 'success');
}

// Télécharger le communiqué
function downloadPressRelease() {
    const content = pressReleaseEditor.innerHTML;
    const blob = new Blob([content], { type: 'text/html' });
    const url = URL.createObjectURL(blob);
    
    const link = document.createElement('a');
    link.download = 'communique-de-presse.html';
    link.href = url;
    link.click();
    
    URL.revokeObjectURL(url);
    showNotification('Téléchargement commencé', 'success');
}

// Programmer la distribution
function scheduleDistribution() {
    showNotification('Fonctionnalité de programmation à venir', 'info');
}

// Envoyer le communiqué
function sendPressRelease() {
    showNotification('Communiqué envoyé avec succès', 'success');
}

// Modifier un élément de la bibliothèque
function editLibraryItem(itemId) {
    showNotification('Fonctionnalité de modification à venir', 'info');
}

// Télécharger un élément de la bibliothèque
function downloadLibraryItem(itemId) {
    showNotification('Téléchargement commencé', 'success');
}

// Partager un élément de la bibliothèque
function shareLibraryItem(itemId) {
    showNotification('Fonctionnalité de partage à venir', 'info');
}

// Supprimer un élément de la bibliothèque
function deleteLibraryItem(itemId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce communiqué ?')) {
        showNotification('Communiqué supprimé avec succès', 'success');
    }
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
.template-item, .library-item {
    transition: transform 0.2s;
}

.template-item:hover, .library-item:hover {
    transform: translateY(-5px);
}

.editor-container {
    background: white;
    border-radius: 8px;
    padding: 15px;
}

.editor-content {
    min-height: 500px;
    font-family: 'Times New Roman', serif;
    line-height: 1.6;
    border: 1px solid #ddd !important;
}

.editor-content:focus {
    outline: none;
    border-color: var(--nj-blue) !important;
    box-shadow: 0 0 0 0.2rem rgba(0, 51, 102, 0.25);
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

.press-release-preview {
    font-family: 'Times New Roman', serif;
    line-height: 1.6;
    padding: 20px;
    background: white;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.press-release-preview h1 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    text-align: center;
}

.press-release-preview h2 {
    font-size: 18px;
    font-weight: bold;
    margin-top: 20px;
    margin-bottom: 10px;
}

.press-release-preview blockquote {
    border-left: 3px solid var(--nj-blue);
    padding-left: 15px;
    margin: 15px 0;
    font-style: italic;
}
</style>
@endsection