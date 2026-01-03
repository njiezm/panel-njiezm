@extends('layouts.app')

@section('title', 'Générateur de Présentations - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Générateur de Présentations</li>
    </ol>
</nav>

<div class="card-custom">
    <h3 class="brand-font">17. Générateur de Présentations</h3>
    <p class="text-muted">Créez des présentations percutantes pour tous vos besoins : slides, discours, rapports et bien plus.</p>

    <!-- Étape 1: Configuration de la Présentation -->
    <div id="step-input" class="step-container">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-presentation me-2"></i>1. Définissez votre Présentation</h5>
            </div>
            <div class="card-body">
                <form id="presentation-form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="presentation-topic" class="form-label">Sujet Principal de la Présentation</label>
                                <input type="text" class="form-control" id="presentation-topic" placeholder="Ex: L'impact de l'IA sur le marketing digital" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="presentation-format" class="form-label">Format de la Présentation</label>
                                <select class="form-select" id="presentation-format" required>
                                    <option value="">Sélectionnez un format</option>
                                    <option value="powerpoint">Présentation Slides (PowerPoint/Google Slides)</option>
                                    <option value="oral">Discours / Présentation Orale</option>
                                    <option value="report">Rapport Écrit / Document (PDF/Word)</option>
                                    <option value="pitch">Pitch / Présentation Commerciale</option>
                                    <option value="educatif">Support de Cours / Tutoriel</option>
                                </select>
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
                                    <option value="etudiants">Étudiants / Milieu académique</option>
                                    <option value="investisseurs">Investisseurs / Direction</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="presentation-length" class="form-label">Longueur / Durée</label>
                                <select class="form-select" id="presentation-length">
                                    <option value="courte">Courte (5-10 slides / 5 min)</option>
                                    <option value="moyenne" "selected">Moyenne (10-20 slides / 15 min)</option>
                                    <option value="longue">Longue (20+ slides / 30+ min)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="key-objective" class="form-label">Objectif Clé (Ce que le public doit retenir)</label>
                        <input type="text" class="form-control" id="key-objective" placeholder="Ex: L'IA n'est pas une menace, mais un outil puissant pour les marketeurs">
                    </div>
                    <div class="mb-3">
                        <label for="tone" class="form-label">Ton et Style</label>
                        <select class="form-select" id="tone">
                            <option value="professionnel">Professionnel et Formel</option>
                            <option value="inspirant">Inspirant et Motivant</option>
                            <option value="pédagogique">Pédagogique et Informatif</option>
                            <option value="persuasif">Persuasif et Convaincant</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-magic me-2"></i>Générer la Structure
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Étape 2: Génération en Cours -->
    <div id="step-loading" class="step-container text-center" style="display: none;">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Chargement...</span>
        </div>
        <h4 class="mt-3">L'IA structure votre présentation...</h4>
        <p class="text-muted">Nous organisons les idées, créons un plan logique et suggérons des points clés pour un impact maximal.</p>
    </div>

    <!-- Étape 3: Édition de la Présentation -->
    <div id="step-edition" class="step-container" style="display: none;">
        <div class="row">
            <!-- Colonne de gauche : Plan de la Présentation -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6><i class="fas fa-list me-2"></i>Plan de la Présentation</h6>
                        <button class="btn btn-sm btn-outline-primary" onclick="addSlide()">
                            <i class="fas fa-plus me-1"></i>Ajouter
                        </button>
                    </div>
                    <div class="card-body p-0" style="max-height: 600px; overflow-y: auto;">
                        <div id="slides-outline">
                            <!-- Le plan des slides sera injecté ici -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Colonne de droite : Éditeur de Contenu -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6><i class="fas fa-edit me-2"></i>Éditeur de Contenu</h6>
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-outline-secondary" onclick="generateSlideContent()">
                                <i class="fas fa-magic me-1"></i>Générer
                            </button>
                            <button type="button" class="btn btn-outline-secondary" onclick="generateVisualIdea()">
                                <i class="fas fa-image me-1"></i>Idée Visuelle
                            </button>
                        </div>
                    </div>
                    <div class="card-body" id="content-editor">
                        <div class="text-center text-muted p-5">
                            <i class="fas fa-mouse-pointer fa-3x mb-3"></i>
                            <p>Sélectionnez une diapositive dans le plan à gauche pour éditer son contenu.</p>
                        </div>
                    </div>
                </div>

                <!-- Aperçu Visuel de la Diapositive -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h6><i class="fas fa-eye me-2"></i>Aperçu de la Diapositive</h6>
                    </div>
                    <div class="card-body p-0">
                        <div id="slide-preview" class="slide-preview-container">
                            <div class="slide-preview-header">
                                <span id="preview-slide-number">Diapositive 1</span>
                                <span id="preview-slide-title">Titre de la diapositive</span>
                            </div>
                            <div class="slide-preview-content" id="preview-slide-content">
                                <!-- Le contenu de la diapositive apparaîtra ici -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="text-center mt-4">
            <button class="btn btn-secondary me-2" onclick="goToStep('input')">
                <i class="fas fa-arrow-left me-2"></i>Modifier la Configuration
            </button>
            <button class="btn btn-primary btn-lg" onclick="goToStep('export')">
                <i class="fas fa-arrow-right me-2"></i>Exporter la Présentation
            </button>
        </div>
    </div>

    <!-- Étape 4: Exportation -->
    <div id="step-export" class="step-container" style="display: none;">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-download me-2"></i>4. Exportez votre Présentation</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h6>Formats Texte (Prêt à copier)</h6>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" onclick="copyFullPresentation()">
                                <i class="fas fa-copy me-2"></i>Copier la Présentation Complète
                            </button>
                            <button class="btn btn-outline-secondary" onclick="downloadAsTxt()">
                                <i class="fas fa-file-alt me-2"></i>Télécharger (.txt)
                            </button>
                            <button class="btn btn-outline-info" onclick="downloadAsMarkdown()">
                                <i class="fas fa-code me-2"></i>Télécharger (.md)
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6>Formats Documents (Simulation)</h6>
                        <p class="small text-muted">Exportation vers des formats de documents structurés.</p>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary" onclick="downloadAsDocx()">
                                <i class="fas fa-file-word me-2"></i>Télécharger (.docx)
                            </button>
                            <button class="btn btn-outline-danger" onclick="downloadAsPptx()">
                                <i class="fas fa-file-powerpoint me-2"></i>Télécharger Structure (.pptx)
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h6>Exporter pour l'Orale</h6>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-success" onclick="generateSpeakerNotes()">
                                <i class="fas fa-microphone me-2"></i>Générer les Notes du Présentateur
                            </button>
                            <button class="btn btn-outline-warning" onclick="generateOnePager()">
                                <i class="fas fa-sticky-note me-2"></i>Générer un Résumé "One-Pager"
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6>Actions</h6>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-info" onclick="saveProject()">
                                <i class="fas fa-save me-2"></i>Enregistrer le Projet
                            </button>
                            <button class="btn btn-outline-danger" onclick="resetGenerator()">
                                <i class="fas fa-redo me-2"></i>Recommencer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Styles pour le plan des slides */
.slide-outline-item {
    padding: 12px 15px;
    border-bottom: 1px solid var(--nj-light);
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.slide-outline-item:hover {
    background-color: var(--nj-white);
}

.slide-outline-item.active {
    background-color: var(--nj-blue);
    color: white;
    border-left: 4px solid var(--nj-yellow);
}

.slide-outline-item .slide-number {
    font-weight: bold;
    margin-right: 10px;
}

.slide-outline-item .slide-title {
    flex-grow: 1;
}

.slide-outline-item .slide-actions {
    opacity: 0;
    transition: opacity 0.2s;
}

.slide-outline-item:hover .slide-actions {
    opacity: 1;
}

/* Styles pour l'aperçu de la diapositive */
.slide-preview-container {
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    min-height: 350px;
    font-family: 'Space Grotesk', sans-serif;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.slide-preview-header {
    background-color: var(--nj-blue);
    color: white;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 14px;
}

.slide-preview-content {
    padding: 30px;
    min-height: 300px;
}

.slide-preview-content h2 {
    color: var(--nj-blue);
    margin-bottom: 20px;
    font-size: 28px;
}

.slide-preview-content ul {
    list-style-type: none;
    padding-left: 0;
}

.slide-preview-content ul li {
    margin-bottom: 10px;
    padding-left: 25px;
    position: relative;
}

.slide-preview-content ul li:before {
    content: '•';
    color: var(--nj-yellow);
    font-size: 20px;
    position: absolute;
    left: 0;
    top: -5px;
}

.slide-preview-content .visual-idea {
    background-color: var(--nj-light);
    border-left: 3px solid var(--nj-yellow);
    padding: 15px;
    margin-top: 20px;
    font-style: italic;
    color: #555;
}
</style>

<script>
let presentationData = {
    format: '',
    topic: '',
    slides: []
};
let currentSlideIndex = -1;

// Données simulées pour la génération de présentations
const presentationTemplates = {
    powerpoint: {
        intro: { title: "Introduction", type: "intro" },
        conclusion: { title: "Conclusion", type: "conclusion" },
        middleSections: [
            { title: "Le Contexte Actuel", type: "context" },
            { title: "La Solution Proposée", type: "solution" },
            { title: "Les Bénéfices Clés", type: "benefits" },
            { title: "Démonstration / Cas d'Usage", type: "demo" },
            { title: "Prochaines Étapes", type: "next-steps" }
        ]
    },
    oral: {
        intro: { title: "Introduction & Accroche", type: "intro" },
        conclusion: { title: "Conclusion & Appel à l'Action", type: "conclusion" },
        middleSections: [
            { title: "Point 1 : Le Problème", type: "point" },
            { title: "Point 2 : L'Opportunité", type: "point" },
            { title: "Point 3 : Notre Approche", type: "point" }
        ]
    },
    // Ajoutez d'autres templates (report, pitch, educatif) si nécessaire
};

// Gestionnaire d'événements pour le formulaire de configuration
document.getElementById('presentation-form').addEventListener('submit', function(e) {
    e.preventDefault();
    generateOutline();
});

// Fonction pour naviguer entre les étapes
function goToStep(step) {
    document.querySelectorAll('.step-container').forEach(container => {
        container.style.display = 'none';
    });
    document.getElementById(`step-${step}`).style.display = 'block';
}

// Fonction principale de génération du plan
function generateOutline() {
    const format = document.getElementById('presentation-format').value;
    const topic = document.getElementById('presentation-topic').value;
    const length = document.getElementById('presentation-length').value;
    const objective = document.getElementById('key-objective').value;
    
    // Masquer l'étape 1, afficher le chargement
    document.getElementById('step-input').style.display = 'none';
    document.getElementById('step-loading').style.display = 'block';
    
    // Simuler un délai de génération
    setTimeout(() => {
        const template = presentationTemplates[format] || presentationTemplates.powerpoint;
        
        // Préparer les données de la présentation
        presentationData.format = format;
        presentationData.topic = topic;
        presentationData.slides = [];
        
        // Ajouter l'introduction
        presentationData.slides.push({
            ...template.intro,
            content: '',
            visualIdea: ''
        });

        // Ajouter les sections du milieu en fonction de la longueur
        const numMiddleSlides = length === 'courte' ? 2 : (length === 'moyenne' ? 4 : 6);
        for (let i = 0; i < numMiddleSlides && i < template.middleSections.length; i++) {
            presentationData.slides.push({
                ...template.middleSections[i],
                content: '',
                visualIdea: ''
            });
        }
        
        // Ajouter la conclusion
        presentationData.slides.push({
            ...template.conclusion,
            content: '',
            visualIdea: ''
        });

        // Masquer le chargement, afficher l'étape d'édition
        document.getElementById('step-loading').style.display = 'none';
        document.getElementById('step-edition').style.display = 'block';
        
        // Construire l'interface du plan et de l'éditeur
        buildOutlineUI();
        
    }, 2000);
}

// Construire l'interface du plan des slides
function buildOutlineUI() {
    const outlineContainer = document.getElementById('slides-outline');
    outlineContainer.innerHTML = ''; // Vider le conteneur
    
    presentationData.slides.forEach((slide, index) => {
        const slideItem = document.createElement('div');
        slideItem.className = 'slide-outline-item';
        slideItem.dataset.index = index;
        
        slideItem.innerHTML = `
            <div>
                <span class="slide-number">${index + 1}.</span>
                <span class="slide-title">${slide.title}</span>
            </div>
            <div class="slide-actions">
                <button class="btn btn-sm btn-outline-secondary" onclick="moveSlide(${index}, 'up')"><i class="fas fa-arrow-up"></i></button>
                <button class="btn btn-sm btn-outline-secondary" onclick="moveSlide(${index}, 'down')"><i class="fas fa-arrow-down"></i></button>
                <button class="btn btn-sm btn-outline-danger" onclick="deleteSlide(${index})"><i class="fas fa-trash"></i></button>
            </div>
        `;
        
        slideItem.addEventListener('click', (e) => {
            // Ne pas sélectionner si on clique sur un bouton d'action
            if (!e.target.closest('.slide-actions')) {
                selectSlide(index);
            }
        });
        
        outlineContainer.appendChild(slideItem);
    });
    
    // Sélectionner la première diapositive par défaut
    if (presentationData.slides.length > 0) {
        selectSlide(0);
    }
}

// Sélectionner une diapositive pour l'édition
function selectSlide(index) {
    currentSlideIndex = index;
    const slide = presentationData.slides[index];
    
    // Mettre à jour l'UI du plan
    document.querySelectorAll('.slide-outline-item').forEach(item => {
        item.classList.remove('active');
    });
    document.querySelector(`.slide-outline-item[data-index="${index}"]`).classList.add('active');
    
    // Mettre à jour l'éditeur de contenu
    const editor = document.getElementById('content-editor');
    editor.innerHTML = `
        <h4>Éditer la Diapositive ${index + 1} : ${slide.title}</h4>
        <div class="mb-3">
            <label class="form-label">Titre de la Diapositive</label>
            <input type="text" class="form-control" id="edit-slide-title" value="${slide.title}">
        </div>
        <div class="mb-3">
            <label class="form-label">Contenu (Points clés)</label>
            <textarea class="form-control" id="edit-slide-content" rows="8" placeholder="Utilisez des puces (un point par ligne) pour lister les idées...">${slide.content}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Idée Visuelle</label>
            <input type="text" class="form-control" id="edit-slide-visual" value="${slide.visualIdea}" placeholder="Ex: Graphique en barres montrant la croissance...">
        </div>
    `;
    
    // Ajouter les écouteurs pour la mise à jour en temps réel
    document.getElementById('edit-slide-title').addEventListener('input', (e) => {
        presentationData.slides[index].title = e.target.value;
        document.querySelector(`.slide-outline-item[data-index="${index}"] .slide-title`).textContent = e.target.value;
        updatePreview();
    });
    
    document.getElementById('edit-slide-content').addEventListener('input', (e) => {
        presentationData.slides[index].content = e.target.value;
        updatePreview();
    });
    
    document.getElementById('edit-slide-visual').addEventListener('input', (e) => {
        presentationData.slides[index].visualIdea = e.target.value;
        updatePreview();
    });
    
    updatePreview();
}

// Mettre à jour l'aperçu de la diapositive
function updatePreview() {
    if (currentSlideIndex === -1) return;
    
    const slide = presentationData.slides[currentSlideIndex];
    const preview = document.getElementById('slide-preview');
    
    document.getElementById('preview-slide-number').textContent = `Diapositive ${currentSlideIndex + 1}`;
    document.getElementById('preview-slide-title').textContent = slide.title;
    
    let contentHtml = `<h2>${slide.title}</h2>`;
    
    if (slide.content) {
        const points = slide.content.split('\n').filter(p => p.trim());
        if (points.length > 0) {
            contentHtml += '<ul>';
            points.forEach(point => {
                contentHtml += `<li>${point.trim()}</li>`;
            });
            contentHtml += '</ul>';
        }
    }
    
    if (slide.visualIdea) {
        contentHtml += `<div class="visual-idea"><strong>Idée Visuelle :</strong> ${slide.visualIdea}</div>`;
    }
    
    document.getElementById('preview-slide-content').innerHTML = contentHtml || '<p class="text-muted">Le contenu de cette diapositive apparaîtra ici...</p>';
}

// --- Fonctions d'action sur les slides ---

function addSlide() {
    const newSlide = {
        title: `Nouvelle Diapositive ${presentationData.slides.length + 1}`,
        type: 'custom',
        content: '',
        visualIdea: ''
    };
    presentationData.slides.push(newSlide);
    buildOutlineUI();
    selectSlide(presentationData.slides.length - 1);
}

function deleteSlide(index) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette diapositive ?')) {
        presentationData.slides.splice(index, 1);
        buildOutlineUI();
        if (currentSlideIndex >= presentationData.slides.length) {
            selectSlide(presentationData.slides.length - 1);
        } else {
            selectSlide(currentSlideIndex);
        }
    }
}

function moveSlide(index, direction) {
    const newIndex = direction === 'up' ? index - 1 : index + 1;
    if (newIndex < 0 || newIndex >= presentationData.slides.length) return;
    
    // Échanger les slides dans le tableau
    [presentationData.slides[index], presentationData.slides[newIndex]] = [presentationData.slides[newIndex], presentationData.slides[index]];
    
    buildOutlineUI();
    selectSlide(newIndex);
}

// --- Fonctions de génération de contenu IA (simulées) ---

function generateSlideContent() {
    if (currentSlideIndex === -1) return;
    const slide = presentationData.slides[currentSlideIndex];
    
    // Simuler une génération de contenu basée sur le type de slide
    const simulatedContent = {
        intro: `- Accroche pour capter l'attention\n- Présentation du sujet : ${presentationData.topic}\n- Annonce du plan de la présentation`,
        context: `- État des lieux actuel\n- Les défis à relever\n- Les opportunités identifiées`,
        solution: `- Présentation de notre solution\n- Ses caractéristiques principales\n- Pourquoi elle est unique`,
        benefits: `- Bénéfice 1 : Efficacité accrue\n- Bénéfice 2 : Économie de temps\n- Bénéfice 3 : Meilleur ROI`,
        conclusion: `- Récapitulatif des points clés\n- Rappel de l'objectif principal\n- Appel à l'action final`
    };
    
    const content = simulatedContent[slide.type] || "Contenu généré pour cette diapositive.";
    document.getElementById('edit-slide-content').value = content;
    presentationData.slides[currentSlideIndex].content = content;
    updatePreview();
}

function generateVisualIdea() {
    if (currentSlideIndex === -1) return;
    const slide = presentationData.slides[currentSlideIndex];
    
    const visualIdeas = {
        intro: "Image de haute qualité représentant le sujet, avec le titre en surimpression.",
        context: "Infographie ou graphique montrant des statistiques ou données chiffrées.",
        solution: "Schéma ou diagramme expliquant le fonctionnement de la solution.",
        benefits: "Icônes illustratives pour chaque bénéfice, avec des couleurs vives.",
        conclusion: "Image forte et mémorable avec le logo de l'entreprise et le CTA."
    };
    
    const idea = visualIdeas[slide.type] || "Graphique simple et épuré pour illustrer le point.";
    document.getElementById('edit-slide-visual').value = idea;
    presentationData.slides[currentSlideIndex].visualIdea = idea;
    updatePreview();
}

// --- Fonctions d'exportation ---

function copyFullPresentation() {
    let fullText = `# ${presentationData.topic}\n\n`;
    
    presentationData.slides.forEach((slide, index) => {
        fullText += `## ${index + 1}. ${slide.title}\n\n`;
        if (slide.content) {
            fullText += slide.content + '\n\n';
        }
        if (slide.visualIdea) {
            fullText += `*Idée Visuelle : ${slide.visualIdea}*\n\n`;
        }
    });
    
    navigator.clipboard.writeText(fullText).then(() => {
        alert('Présentation copiée dans le presse-papiers ! Vous pouvez la coller dans PowerPoint, Google Docs, etc.');
    });
}

function downloadAsTxt() {
    let fullText = `# ${presentationData.topic}\n\n`;
    
    presentationData.slides.forEach((slide, index) => {
        fullText += `## ${index + 1}. ${slide.title}\n\n`;
        if (slide.content) {
            fullText += slide.content + '\n\n';
        }
        if (slide.visualIdea) {
            fullText += `*Idée Visuelle : ${slide.visualIdea}*\n\n`;
        }
    });
    
    const blob = new Blob([fullText], { type: 'text/plain' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `presentation_${Date.now()}.txt`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
}

function downloadAsMarkdown() {
    let markdownText = `# ${presentationData.topic}\n\n`;
    
    presentationData.slides.forEach((slide, index) => {
        markdownText += `---\n\n## ${index + 1}. ${slide.title}\n\n`;
        if (slide.content) {
            markdownText += slide.content.split('\n').map(line => `- ${line.trim()}`).join('\n') + '\n\n';
        }
        if (slide.visualIdea) {
            markdownText += `> **Idée Visuelle :** ${slide.visualIdea}\n\n`;
        }
    });
    
    const blob = new Blob([markdownText], { type: 'text/markdown' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `presentation_${Date.now()}.md`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
}

function downloadAsDocx() {
    alert("Fonctionnalité de génération .docx en cours de développement !\n\nPour l'instant, utilisez l'option 'Télécharger (.txt)' et copiez le contenu dans Microsoft Word.");
}

function downloadAsPptx() {
    alert("La génération directe de fichiers .pptx est complexe.\n\nNous vous recommandons d'utiliser 'Copier la Présentation Complète' et de la coller diapositive par diapositive dans PowerPoint pour un résultat optimal.");
}

function generateSpeakerNotes() {
    let notes = `# Notes du Présentateur - ${presentationData.topic}\n\n`;
    notes += `**Objectif principal :** ${document.getElementById('key-objective').value}\n\n`;
    notes += `**Public :** ${document.getElementById('target-audience').options[document.getElementById('target-audience').selectedIndex].text}\n\n`;
    notes += `**Ton :** ${document.getElementById('tone').options[document.getElementById('tone').selectedIndex].text}\n\n---\n\n`;
    
    presentationData.slides.forEach((slide, index) => {
        notes += `### Diapositive ${index + 1} : ${slide.title}\n\n`;
        notes += `**À dire :**\n${slide.content.replace(/^- /g, '').replace(/\n/g, ' ')}\n\n`;
        if (slide.visualIdea) {
            notes += `**Cue Visuelle :** "Pendant que je parle, regardez ce ${slide.visualIdea.toLowerCase()}."\n\n`;
        }
        notes += `**(Pause) - Transition vers la diapositive suivante.\n\n---\n\n`;
    });
    
    const blob = new Blob([notes], { type: 'text/plain' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `notes_presentateur_${Date.now()}.txt`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
    
    alert("Notes du présentateur générées et téléchargées !");
}

function generateOnePager() {
    let onePager = `# ${presentationData.topic} - Résumé Exécutif\n\n`;
    onePager += `**Objectif :** ${document.getElementById('key-objective').value}\n\n`;
    onePager += `**Points Clés :**\n`;
    
    presentationData.slides.forEach((slide, index) => {
        if (slide.type !== 'intro' && slide.type !== 'conclusion') {
            onePager += `- **${slide.title}** : ${slide.content.split('\n')[0].replace(/^- /, '')}\n`;
        }
    });
    
    onePager += `\n**Conclusion :** ${presentationData.slides[presentationData.slides.length - 1].content.split('\n')[0].replace(/^- /, '')}`;
    
    const blob = new Blob([onePager], { type: 'text/plain' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `onepager_${Date.now()}.txt`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
    
    alert("Résumé 'One-Pager' généré et téléchargé !");
}

function saveProject() {
    alert('Projet de présentation enregistré ! (Fonctionnalité de sauvegarde à venir)');
}

function resetGenerator() {
    if (confirm('Êtes-vous sûr de vouloir recommencer ? Tout le contenu non sauvegardé sera perdu.')) {
        document.getElementById('presentation-form').reset();
        document.querySelectorAll('.step-container').forEach(container => {
            container.style.display = 'none';
        });
        document.getElementById('step-input').style.display = 'block';
        presentationData = { format: '', topic: '', slides: [] };
        currentSlideIndex = -1;
    }
}
</script>
@endsection