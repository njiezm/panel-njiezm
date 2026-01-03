@extends('layouts.app')

@section('title', 'Générateur de Scripts et Vidéos - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Générateur de Scripts et Vidéos</li>
    </ol>
</nav>

<div class="card-custom">
    <h3 class="brand-font">16. Générateur de Scripts et Vidéos</h3>
    <p class="text-muted">Créez des scripts vidéo percutants et générez des aperçus vidéo animés avec votre logo et vos textes.</p>

    <!-- Étape 1: Configuration du Projet Vidéo -->
    <div id="step-input" class="step-container">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-video me-2"></i>1. Définissez votre Projet Vidéo</h5>
            </div>
            <div class="card-body">
                <form id="video-form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="video-type" class="form-label">Type de Vidéo</label>
                                <select class="form-select" id="video-type" required>
                                    <option value="">Sélectionnez un type</option>
                                    <option value="publicite">Publicité Produit/Service</option>
                                    <option value="tutoriel">Tutoriel / Comment-faire</option>
                                    <option value="temoignage">Témoignage Client</option>
                                    <option value="reseau-social">Vidéo pour Réseaux Sociaux (Short)</option>
                                    <option value="presentation">Vidéo d'Entreprise / Présentation</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="video-duration" class="form-label">Durée Cible</label>
                                <select class="form-select" id="video-duration" required>
                                    <option value="court">Court (15-30 secondes)</option>
                                    <option value="moyen">Moyen (1-3 minutes)</option>
                                    <option value="long">Long (3-10 minutes)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="main-subject" class="form-label">Sujet Principal / Produit</label>
                                <input type="text" class="form-control" id="main-subject" placeholder="Ex: Notre nouveau logiciel de gestion" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="key-message" class="form-label">Message Clé / Bénéfice Principal</label>
                                <input type="text" class="form-control" id="key-message" placeholder="Ex: Gagnez 10h par semaine sur vos tâches" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="target-audience" class="form-label">Public Cible</label>
                                <select class="form-select" id="target-audience">
                                    <option value="general">Grand public</option>
                                    <option value="professionnels">Professionnels / B2B</option>
                                    <option value="jeunes">Jeunes (18-25 ans)</option>
                                    <option value="etudes-sup">Étudiants / Milieu académique</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tone" class="form-label">Ton et Ambiance</label>
                                <select class="form-select" id="tone">
                                    <option value="inspirant">Inspirant et Énergique</option>
                                    <option value="professionnel">Professionnel et Confiant</option>
                                    <option value="amical">Amical et Accessible</option>
                                    <option value="urgent">Urgent et Percutant</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="call-to-action" class="form-label">Appel à l'Action (CTA) Final</label>
                        <input type="text" class="form-control" id="call-to-action" placeholder="Ex: Visitez notre site pour une démo gratuite">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-magic me-2"></i>Générer le Script
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Étape 2: Génération et Édition du Script -->
    <div id="step-script" class="step-container" style="display: none;">
        <div class="row">
            <!-- Colonne de gauche : Éditeur de Script -->
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6><i class="fas fa-edit me-2"></i>2. Affinez votre Script</h6>
                        <button class="btn btn-sm btn-outline-primary" onclick="addScene()">
                            <i class="fas fa-plus me-1"></i>Ajouter une Scène
                        </button>
                    </div>
                    <div class="card-body">
                        <!-- Titre du Concept -->
                        <div class="mb-3">
                            <label for="script-title" class="form-label">Titre du Concept</label>
                            <input type="text" class="form-control" id="script-title" placeholder="Le titre généré apparaîtra ici">
                        </div>

                        <!-- Logline (Résumé en une phrase) -->
                        <div class="mb-3">
                            <label for="script-logline" class="form-label">Logline (Résumé en une phrase)</label>
                            <input type="text" class="form-control" id="script-logline" placeholder="Le résumé généré apparaîtra ici">
                        </div>
                        
                        <!-- Scènes -->
                        <div class="mb-3">
                            <label class="form-label">Scènes</label>
                            <div id="scenes-container">
                                <!-- Les scènes seront ajoutées ici dynamiquement -->
                            </div>
                        </div>

                        <!-- Appel à l'Action -->
                        <div class="mb-3">
                            <label for="script-cta" class="form-label">Scène Finale - Appel à l'Action</label>
                            <textarea class="form-control" id="script-cta" rows="3" placeholder="Le CTA généré apparaîtra ici"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Colonne de droite : Aperçu et Actions -->
            <div class="col-lg-5">
                <!-- Aperçu du Script -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h6><i class="fas fa-eye me-2"></i>Aperçu du Script</h6>
                    </div>
                    <div class="card-body p-0" style="max-height: 500px; overflow-y: auto;">
                        <div id="script-preview" class="script-preview-content">
                            <h4 id="preview-title" class="text-center">TITRE DU SCRIPT</h4>
                            <p id="preview-logline" class="text-center fst-italic text-muted">Logline...</p>
                            <hr>
                            <div id="preview-scenes">
                                <!-- Les scènes apparaîtront ici -->
                            </div>
                            <hr>
                            <div id="preview-cta">
                                <strong>APPEL À L'ACTION :</strong>
                                <p id="preview-cta-text">...</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Détails et Estimations -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h6><i class="fas fa-chart-bar me-2"></i>Détails du Projet</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Nombre de scènes :</span>
                            <strong id="scene-count">0</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Mots approximatifs :</span>
                            <strong id="word-count">0</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Durée estimée :</span>
                            <strong id="estimated-duration">0s</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <button class="btn btn-secondary me-2" onclick="goToStep('input')">
                <i class="fas fa-arrow-left me-2"></i>Modifier la Configuration
            </button>
            <button class="btn btn-primary btn-lg" onclick="goToStep('visuals')">
                <i class="fas fa-arrow-right me-2"></i>Personnaliser la Vidéo
            </button>
        </div>
    </div>

    <!-- Étape 3: Style Visuel et Assets -->
    <div id="step-visuals" class="step-container" style="display: none;">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-palette me-2"></i>3. Choisissez le Style Visuel</h5>
            </div>
            <div class="card-body">
                <form id="visuals-form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="visual-style" class="form-label">Style Visuel</label>
                                <select class="form-select" id="visual-style" required>
                                    <option value="moderne">Moderne et Épuré</option>
                                    <option value="corporate">Corporate et Sérieux</option>
                                    <option value="dynamique">Dynamique et Énergique</option>
                                    <option value="creatifs">Créatif et Coloré</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="background-music" class="form-label">Musique d'Ambiance</label>
                                <select class="form-select" id="background-music">
                                    <option value="upbeat">Enthousiaste et Rythmée</option>
                                    <option value="corporate">Professionnelle et Inspire Confiance</option>
                                    <option value="calme">Détendue et Inspirante</option>
                                    <option value="techno">Moderne et Technologique</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="logo-upload" class="form-label">Logo (Optionnel)</label>
                        <input type="file" class="form-control" id="logo-upload" accept="image/*">
                        <small class="text-muted">Si vous n'en choisissez pas, le logo NJIEZM.FR sera utilisé.</small>
                        <div id="logo-preview" class="mt-2"></div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-secondary me-2" onclick="goToStep('script')">
                            <i class="fas fa-arrow-left me-2"></i>Retour au Script
                        </button>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-play me-2"></i>Générer la Vidéo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Étape 4: Génération et Aperçu de la Vidéo -->
    <div id="step-generation-preview" class="step-container" style="display: none;">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-cog fa-spin me-2"></i>4. Génération de la Vidéo</h5>
            </div>
            <div class="card-body text-center" id="loading-video">
                <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                    <span class="visually-hidden">Génération en cours...</span>
                </div>
                <h4 class="mt-3">Nous générons votre vidéo...</h4>
                <p class="text-muted">Assemblage des scènes, ajout des textes, animation du logo et synchronisation avec la musique.</p>
            </div>
        </div>

        <!-- Aperçu de la Vidéo -->
        <div id="video-preview-section" class="card mt-4" style="display: none;">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5><i class="fas fa-eye me-2"></i>Aperçu de votre Vidéo</h5>
                <button class="btn btn-sm btn-outline-primary" onclick="replayVideo()">
                    <i class="fas fa-redo me-1"></i>Rejouer
                </button>
            </div>
            <div class="card-body p-0">
                <div id="video-preview-container" class="mock-video-container">
                    <!-- L'animation CSS sera injectée ici -->
                </div>
            </div>
        </div>

        <!-- Actions d'Exportation -->
        <div id="export-actions" class="card mt-4" style="display: none;">
            <div class="card-header">
                <h5><i class="fas fa-download me-2"></i>Exporter et Partager</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h6>Exportation Rapide</h6>
                        <div class="d-grid gap-2">
                            <button class="btn btn-success" onclick="downloadAsMp4()">
                                <i class="fas fa-file-video me-2"></i>Télécharger en MP4 (HD)
                            </button>
                            <button class="btn btn-outline-info" onclick="generateProductionBrief()">
                                <i class="fas fa-file-alt me-2"></i>Générer le Brief de Production
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6>Exporter vers une IA Vidéo</h6>
                        <p class="small text-muted">Transférez ce projet vers une IA pour une génération avancée.</p>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary" onclick="exportToRunway()">
                                <i class="fas fa-rocket me-2"></i>Envoyer à RunwayML
                            </button>
                            <button class="btn btn-outline-secondary" onclick="exportToPika()">
                                <i class="fas fa-magic me-2"></i>Envoyer à Pika Labs
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    <button class="btn btn-outline-danger" onclick="resetGenerator()">
                        <i class="fas fa-redo me-2"></i>Recommencer un Nouveau Projet
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Styles pour l'aperçu du script */
.script-preview-content {
    font-family: 'Courier New', Courier, monospace;
    background-color: #f8f9fa;
    padding: 20px;
    font-size: 14px;
    line-height: 1.6;
    white-space: pre-wrap;
}

.scene-preview {
    margin-bottom: 20px;
    padding-left: 20px;
    border-left: 3px solid var(--nj-blue);
}

.scene-preview strong {
    color: var(--nj-blue);
}

/* NOUVEAUX Styles pour l'aperçu vidéo */
.mock-video-container {
    width: 100%;
    max-width: 800px;
    height: 450px;
    margin: 0 auto;
    background: #000;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Space Grotesk', sans-serif;
    color: white;
}

/* Styles de fond pour les thèmes */
.mock-video-container.style-moderne { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
.mock-video-container.style-corporate { background: linear-gradient(135deg, #003366 0%, #004080 100%); }
.mock-video-container.style-dynamique { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
.mock-video-container.style-creatifs { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }

.mock-video-title {
    position: absolute;
    font-size: 3rem;
    font-weight: 700;
    text-align: center;
    opacity: 0;
    transform: scale(0.8);
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    width: 80%;
}

.mock-video-key-phrase {
    position: absolute;
    font-size: 1.8rem;
    font-weight: 500;
    opacity: 0;
    transform: translateX(-50px);
    text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
}

.mock-video-logo {
    position: absolute;
    bottom: 40px;
    opacity: 0;
    transform: translateY(30px);
    font-family: 'Special Elite', cursive;
    font-size: 2.5rem;
    color: #FFD700;
}

/* Animations */
@keyframes fadeInScale {
    to {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes slideInFromLeft {
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInFromBottom {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Appliquer les animations */
.animate-title { animation: fadeInScale 1.5s ease-out forwards; }
.animate-phrase-1 { animation: slideInFromLeft 1s ease-out 2s forwards; }
.animate-phrase-2 { animation: slideInFromLeft 1s ease-out 4s forwards; }
.animate-logo { animation: slideInFromBottom 1s ease-out 6s forwards; }
</style>

<script>
let sceneCount = 0;

// Données simulées pour la génération de scripts
const videoTemplates = {
    publicite: {
        title: "Publicité : [MAIN_SUBJECT] - [KEY_MESSAGE]",
        logline: "Découvrez comment [MAIN_SUBJECT] transforme votre quotidien en vous permettant de [KEY_MESSAGE].",
        scenes: [
            {
                visuals: "PLAN D'OUVERTURE RAPIDE. Montage dynamique de personnes frustrées par un problème commun.",
                narration: "Vous en avez marre de [PROBLÈME IMPLICITE] ? Vous passez trop de temps sur des tâches répétitives ?",
                text: "Le problème, en gros plan."
            },
            {
                visuals: "PLAN MOYEN. Interface épurée et intuitive de [MAIN_SUBJECT] en action. Des curseurs flottants mettent en évidence les fonctionnalités clés.",
                narration: "Découvrez [MAIN_SUBJECT]. La solution conçue pour [KEY_MESSAGE]. Simple, rapide, efficace.",
                text: "[MAIN_SUBJECT] - Votre Nouveau Super-pouvoir."
            },
            {
                visuals: "PLAN SERRÉ sur le visage d'un utilisateur souriant, puis élargissement pour montrer son environnement de travail détendu.",
                narration: "Rejoignez les milliers de professionnels qui ont déjà changé leur façon de travailler. Essayez [MAIN_SUBJECT] aujourd'hui.",
                text: "Satisfait ou Remboursé."
            }
        ],
        cta: "Scène finale : Logo NJIEZM.FR avec un bouton clair 'Démarrer l'Essai Gratuit' et l'adresse du site web."
    },
    tutoriel: {
        title: "Tutoriel : Comment [KEY_MESSAGE] avec [MAIN_SUBJECT]",
        logline: "Un guide simple en 3 étapes pour maîtriser [MAIN_SUBJECT] et [KEY_MESSAGE] dès aujourd'hui.",
        scenes: [
            {
                visuals: "PRESENTER en studio (ou graphique animé). S'adresse directement à la caméra avec une énergie positive.",
                narration: "Bonjour et bienvenue ! Aujourd'hui, je vais vous montrer comment [KEY_MESSAGE] facilement avec notre outil [MAIN_SUBJECT]. C'est plus simple que vous ne le pensez !",
                text: "Étape 1 : La Préparation"
            },
            {
                visuals: "CAPTURE D'ÉCRAN. Flèche animée pointe vers le bouton 'Nouveau Projet'. L'interface est floutée sauf l'élément important.",
                narration: "Premièrement, connectez-vous et cliquez sur 'Nouveau Projet'. C'est ici que tout commence. Choisissez un modèle qui vous plaît.",
                text: "Cliquez ici pour commencer."
            },
            {
                visuals: "MONTAGE RAPIDE de l'utilisateur ajoutant du contenu, personnalisant des couleurs, et cliquant sur 'Publier'.",
                narration: "Ensuite, ajoutez votre contenu, personnalisez le design, et voilà ! En quelques minutes, votre travail est prêt. C'est aussi simple que ça.",
                text: "Résultat professionnel en minutes !"
            }
        ],
        cta: "Scène finale : Le présentateur sourit. 'Vous voyez ? C'est facile ! Cliquez sur le lien ci-dessous pour essayer vous-même.'"
    },
    // Ajoutez d'autres templates (temoignage, reseau-social, presentation) si nécessaire
};

// Gestionnaire d'événements pour le formulaire de configuration
document.getElementById('video-form').addEventListener('submit', function(e) {
    e.preventDefault();
    generateScript();
});

// Gestionnaire pour le formulaire de style visuel
document.getElementById('visuals-form').addEventListener('submit', function(e) {
    e.preventDefault();
    generateVideo();
});

// Gestionnaire pour l'upload du logo
document.getElementById('logo-upload').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('logo-preview');
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            preview.innerHTML = `<img src="${event.target.result}" alt="Logo" style="max-height: 60px;">`;
        }
        reader.readAsDataURL(file);
    }
});

// Fonction pour naviguer entre les étapes
function goToStep(step) {
    document.querySelectorAll('.step-container').forEach(container => {
        container.style.display = 'none';
    });
    document.getElementById(`step-${step}`).style.display = 'block';
}

// Fonction principale de génération de script
function generateScript() {
    const type = document.getElementById('video-type').value;
    const subject = document.getElementById('main-subject').value;
    const keyMessage = document.getElementById('key-message').value;
    const cta = document.getElementById('call-to-action').value;
    
    // Masquer l'étape 1, afficher le chargement
    document.getElementById('step-input').style.display = 'none';
    // Simuler un chargement court
    const loadingDiv = document.createElement('div');
    loadingDiv.className = 'text-center';
    loadingDiv.innerHTML = '<div class="spinner-border text-primary" role="status"></div><p>Génération du script...</p>';
    document.getElementById('step-script').prepend(loadingDiv);

    setTimeout(() => {
        loadingDiv.remove();
        const template = videoTemplates[type] || videoTemplates.publicite;
        
        // Remplacer les placeholders
        const processText = (text) => text
            .replace(/\[MAIN_SUBJECT\]/g, subject)
            .replace(/\[KEY_MESSAGE\]/g, keyMessage)
            .replace(/\[PROBLÈME IMPLICITE\]/g, "perdre du temps sur des tâches manuelles");
        
        // Remplir les champs éditables
        document.getElementById('script-title').value = processText(template.title);
        document.getElementById('script-logline').value = processText(template.logline);
        document.getElementById('script-cta').value = processText(template.cta);
        
        // Ajouter les scènes
        const container = document.getElementById('scenes-container');
        container.innerHTML = ''; // Vider le conteneur
        sceneCount = 0;
        template.scenes.forEach(sceneData => {
            addScene(processText(sceneData.visuals), processText(sceneData.narration), processText(sceneData.text));
        });
        
        // Afficher l'étape du script
        document.getElementById('step-script').style.display = 'block';
        
        // Mettre à jour l'aperçu et les statistiques
        updatePreview();
        updateStatistics();
        
        // Ajouter les écouteurs d'événements pour la mise à jour en temps réel
        addEditListeners();
        
    }, 1500);
}

// Ajouter une scène à l'éditeur
function addScene(visuals = '', narration = '', text = '') {
    sceneCount++;
    const container = document.getElementById('scenes-container');
    const sceneDiv = document.createElement('div');
    sceneDiv.className = 'card mb-3 scene-card';
    sceneDiv.innerHTML = `
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Scène ${sceneCount}</h6>
            <button class="btn btn-sm btn-outline-danger" onclick="this.closest('.scene-card').remove(); updatePreview(); updateStatistics();">
                <i class="fas fa-trash"></i>
            </button>
        </div>
        <div class="card-body">
            <div class="mb-2">
                <label class="form-label small">Visuels / Plan Caméra</label>
                <textarea class="form-control form-control-sm" rows="2" placeholder="Décrivez ce que l'on voit...">${visuals}</textarea>
            </div>
            <div class="mb-2">
                <label class="form-label small">Narration / Dialogue</label>
                <textarea class="form-control form-control-sm" rows="2" placeholder="Voix off ou dialogues...">${narration}</textarea>
            </div>
            <div>
                <label class="form-label small">Texte à l'écran (Super)</label>
                <input type="text" class="form-control form-control-sm" placeholder="Texte superposé à la vidéo..." value="${text}">
            </div>
        </div>
    `;
    container.appendChild(sceneDiv);
}

// Ajouter les écouteurs d'événements pour la mise à jour en temps réel
function addEditListeners() {
    document.getElementById('script-title').addEventListener('input', updatePreview);
    document.getElementById('script-logline').addEventListener('input', updatePreview);
    document.getElementById('script-cta').addEventListener('input', updatePreview);
    
    // Écouteurs pour les scènes
    document.querySelectorAll('.scene-card textarea, .scene-card input').forEach(input => {
        input.addEventListener('input', () => {
            updatePreview();
            updateStatistics();
        });
    });
}

// Mettre à jour l'aperçu du script
function updatePreview() {
    const title = document.getElementById('script-title').value;
    const logline = document.getElementById('script-logline').value;
    const cta = document.getElementById('script-cta').value;
    
    document.getElementById('preview-title').textContent = title || "TITRE DU SCRIPT";
    document.getElementById('preview-logline').textContent = logline || "Logline...";
    document.getElementById('preview-cta-text').textContent = cta || "...";
    
    // Mettre à jour les scènes
    const scenesContainer = document.getElementById('preview-scenes');
    scenesContainer.innerHTML = '';
    
    document.querySelectorAll('.scene-card').forEach((card, index) => {
        const visuals = card.querySelector('textarea').value;
        const narration = card.querySelectorAll('textarea')[1].value;
        const text = card.querySelector('input').value;
        
        const scenePreview = document.createElement('div');
        scenePreview.className = 'scene-preview';
        scenePreview.innerHTML = `
            <strong>SCÈNE ${index + 1}</strong><br>
            <strong>VISUELS :</strong> ${visuals || '...'}<br>
            <strong>NARRATION :</strong> ${narration || '...'}<br>
            <strong>TEXTE :</strong> ${text || '...'}
        `;
        scenesContainer.appendChild(scenePreview);
    });
}

// Mettre à jour les statistiques du projet
function updateStatistics() {
    const sceneCards = document.querySelectorAll('.scene-card');
    const numScenes = sceneCards.length;
    
    let totalWords = 0;
    sceneCards.forEach(card => {
        card.querySelectorAll('textarea, input').forEach(input => {
            totalWords += input.value.trim().split(/\s+/).filter(word => word.length > 0).length;
        });
    });
    
    // Estimer la durée (en supposant ~150 mots par minute)
    const estimatedDuration = Math.round((totalWords / 150) * 60); // en secondes
    
    document.getElementById('scene-count').textContent = numScenes;
    document.getElementById('word-count').textContent = totalWords;
    document.getElementById('estimated-duration').textContent = `${estimatedDuration}s`;
}

// Fonction principale de "génération" vidéo
function generateVideo() {
    // Masquer les étapes précédentes, afficher le chargement
    document.getElementById('step-visuals').style.display = 'none';
    document.getElementById('step-generation-preview').style.display = 'block';
    
    // Simuler un délai de génération plus long
    setTimeout(() => {
        // Masquer le chargement, afficher l'aperçu et les actions
        document.getElementById('loading-video').style.display = 'none';
        document.getElementById('video-preview-section').style.display = 'block';
        document.getElementById('export-actions').style.display = 'block';
        
        // Construire et jouer l'aperçu vidéo
        buildMockupVideo();
        
    }, 4000); // Délai de 4 secondes pour l'effet de "génération"
}

// Construire l'aperçu vidéo animé
function buildMockupVideo() {
    const container = document.getElementById('video-preview-container');
    const title = document.getElementById('script-title').value || "Titre de la Vidéo";
    const style = document.getElementById('visual-style').value;
    
    // Extraire les phrases clés du script
    const keyPhrases = [];
    document.querySelectorAll('.scene-card textarea').forEach(textarea => {
        const text = textarea.value.trim();
        if (text.length > 10 && keyPhrases.length < 2) {
            keyPhrases.push(text.substring(0, 50) + (text.length > 50 ? '...' : ''));
        }
    });

    // Vider le conteneur et définir le style de fond
    container.innerHTML = '';
    container.className = `mock-video-container style-${style}`;
    
    // Créer les éléments de la vidéo
    const titleEl = document.createElement('div');
    titleEl.className = 'mock-video-title';
    titleEl.textContent = title;
    container.appendChild(titleEl);
    
    if (keyPhrases[0]) {
        const phrase1El = document.createElement('div');
        phrase1El.className = 'mock-video-key-phrase';
        phrase1El.style.top = '60%';
        phrase1El.textContent = keyPhrases[0];
        container.appendChild(phrase1El);
    }

    if (keyPhrases[1]) {
        const phrase2El = document.createElement('div');
        phrase2El.className = 'mock-video-key-phrase';
        phrase2El.style.top = '75%';
        phrase2El.textContent = keyPhrases[1];
        container.appendChild(phrase2El);
    }
    
    const logoEl = document.createElement('div');
    logoEl.className = 'mock-video-logo';
    logoEl.innerHTML = 'NJIEZM<span style="color: #FFD700;">.FR</span>';
    container.appendChild(logoEl);
    
    // Déclencher les animations avec un léger délai
    setTimeout(() => {
        titleEl.classList.add('animate-title');
        if (keyPhrases[0]) container.querySelector('.mock-video-key-phrase:nth-child(2)').classList.add('animate-phrase-1');
        if (keyPhrases[1]) container.querySelector('.mock-video-key-phrase:nth-child(3)').classList.add('animate-phrase-2');
        logoEl.classList.add('animate-logo');
    }, 100);
}

// Rejouer l'animation
function replayVideo() {
    buildMockupVideo();
}

// --- FONCTIONS D'EXPORTATION ---

// Télécharger en MP4 (Simulation)
function downloadAsMp4() {
    alert("Fonction de génération MP4 en cours de développement !\n\nLa création de vidéos réelles nécessite des serveurs spécialisés. En attendant, vous pouvez :\n1. Utiliser notre 'Brief de Production' avec un monteur.\n2. Exporter ce projet vers une IA vidéo comme RunwayML ou Pika Labs.");
    generateProductionBrief(); // Propose l'alternative la plus utile
}

// Générer un brief de production complet
function generateProductionBrief() {
    const title = document.getElementById('script-title').value;
    const logline = document.getElementById('script-logline').value;
    const style = document.getElementById('visual-style').value;
    const music = document.getElementById('background-music').value;
    
    let brief = `BRIEF DE PRODUCTION VIDÉO - NJIEZM.FR\n`;
    brief += `=====================================\n\n`;
    brief += `TITRE : ${title}\n`;
    brief += `LOGLINE : ${logline}\n`;
    brief += `STYLE VISUEL : ${style}\n`;
    brief += `MUSIQUE SOUHAITÉE : ${music}\n\n`;
    brief += `SCRIPT COMPLET :\n----------------\n`;
    
    document.querySelectorAll('.scene-card').forEach((card, index) => {
        const visuals = card.querySelector('textarea').value;
        const narration = card.querySelectorAll('textarea')[1].value;
        const text = card.querySelector('input').value;
        
        brief += `SCÈNE ${index + 1}:\n`;
        brief += `- VISUELS: ${visuals}\n`;
        brief += `- NARRATION: ${narration}\n`;
        brief += `- TEXTE: ${text}\n\n`;
    });
    
    brief += `APPEL À L'ACTION:\n------------------\n${document.getElementById('script-cta').value}`;

    // Créer et télécharger le fichier
    const blob = new Blob([brief], { type: 'text/plain' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `brief_production_${Date.now()}.txt`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
    
    alert("Brief de production téléchargé ! Vous pouvez le donner à un monteur vidéo ou l'utiliser comme base.");
}

// Exporter vers RunwayML (ouvre un nouvel onglet avec le script pré-rempli)
function exportToRunway() {
    const scriptText = document.getElementById('script-logline').value;
    const url = `https://runwayml.com/video-generator?prompt=${encodeURIComponent(scriptText)}`;
    window.open(url, '_blank');
}

// Exporter vers Pika Labs (ouvre un nouvel onglet avec le script pré-rempli)
function exportToPika() {
    const scriptText = document.getElementById('script-logline').value;
    const url = `https://pika.art/?prompt=${encodeURIComponent(scriptText)}`;
    window.open(url, '_blank');
}

// Réinitialiser le générateur
function resetGenerator() {
    if (confirm('Êtes-vous sûr de vouloir recommencer ? Tout le contenu non sauvegardé sera perdu.')) {
        document.getElementById('video-form').reset();
        document.getElementById('visuals-form').reset();
        document.getElementById('logo-preview').innerHTML = '';
        document.querySelectorAll('.step-container').forEach(container => {
            container.style.display = 'none';
        });
        document.getElementById('step-input').style.display = 'block';
        sceneCount = 0;
    }
}
</script>
@endsection