@extends('layouts.app')

@section('title', 'Générateur d\'Articles de Blog - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Générateur d'Articles de Blog</li>
    </ol>
</nav>

<div class="card-custom">
    <h3 class="brand-font">14. Générateur d'Articles de Blog</h3>
    <p class="text-muted">Rédigez des articles de blog percutants en quelques clics avec l'aide de notre IA.</p>

    <!-- Étape 1: Saisie des Informations -->
    <div id="step-input" class="step-container">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-lightbulb me-2"></i>1. Définissez votre Sujet</h5>
            </div>
            <div class="card-body">
                <form id="article-form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="topic" class="form-label">Sujet ou Mots-clés de l'article</label>
                                <textarea class="form-control" id="topic" rows="3" placeholder="Ex: Les avantages du marketing digital pour les PME" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tone" class="form-label">Ton de l'article</label>
                                <select class="form-select" id="tone">
                                    <option value="professionnel">Professionnel</option>
                                    <option value="informatif">Informatif</option>
                                    <option value="persuasif">Persuasif</option>
                                    <option value="casual">Décontracté</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="audience" class="form-label">Public Cible</label>
                                <select class="form-select" id="audience">
                                    <option value="debutant">Débutants</option>
                                    <option value="intermediaire">Intermédiaires</option>
                                    <option value="expert">Experts</option>
                                    <option value="general">Grand public</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="length" class="form-label">Longueur Approximative</label>
                                <select class="form-select" id="length">
                                    <option value="court">Court (300-500 mots)</option>
                                    <option value="moyen" selected>Moyen (500-800 mots)</option>
                                    <option value="long">Long (800-1200 mots)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="keywords" class="form-label">Mots-clés SEO (séparés par des virgules)</label>
                                <input type="text" class="form-control" id="keywords" placeholder="marketing, digital, PME">
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-magic me-2"></i>Générer l'Article
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
        <h4 class="mt-3">L'IA rédige votre article...</h4>
        <p class="text-muted">Cela ne prendra qu'un instant. Nous analysons votre sujet pour créer un contenu unique et pertinent.</p>
    </div>

    <!-- Étape 3: Résultat et Édition -->
    <div id="step-result" class="step-container" style="display: none;">
        <div class="row">
            <!-- Colonne de gauche : Éditeur -->
            <div class="col-lg-8">
                <!-- Titre -->
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6><i class="fas fa-heading me-2"></i>Titre</h6>
                        <small class="text-muted" id="char-count-title">0/60 caractères</small>
                    </div>
                    <div class="card-body">
                        <input type="text" class="form-control form-control-lg" id="article-title" placeholder="Votre titre généré apparaîtra ici">
                    </div>
                </div>

                <!-- Introduction -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h6><i class="fas fa-pen me-2"></i>Introduction</h6>
                    </div>
                    <div class="card-body">
                        <textarea class="form-control" id="article-intro" rows="4" placeholder="L'introduction générée apparaîtra ici"></textarea>
                    </div>
                </div>

                <!-- Corps de l'article -->
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6><i class="fas fa-align-left me-2"></i>Corps de l'Article</h6>
                        <button class="btn btn-sm btn-outline-primary" onclick="addParagraph()">
                            <i class="fas fa-plus me-1"></i>Ajouter un Paragraphe
                        </button>
                    </div>
                    <div class="card-body" id="article-body-container">
                        <!-- Les paragraphes seront ajoutés ici dynamiquement -->
                    </div>
                </div>

                <!-- Conclusion -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h6><i class="fas fa-flag-checkered me-2"></i>Conclusion</h6>
                    </div>
                    <div class="card-body">
                        <textarea class="form-control" id="article-conclusion" rows="4" placeholder="La conclusion générée apparaîtra ici"></textarea>
                    </div>
                </div>
            </div>

            <!-- Colonne de droite : Actions et Métadonnées -->
            <div class="col-lg-4">
                <!-- Statistiques -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h6><i class="fas fa-chart-bar me-2"></i>Statistiques</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Mots :</span>
                            <strong id="word-count">0</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Caractères :</span>
                            <strong id="char-count">0</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Temps de lecture estimé :</span>
                            <strong id="reading-time">0 min</strong>
                        </div>
                    </div>
                </div>

                <!-- Métadonnées SEO -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h6><i class="fas fa-search me-2"></i>Métadonnées SEO</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="meta-title" class="form-label">Meta Titre</label>
                            <input type="text" class="form-control" id="meta-title" maxlength="60">
                            <small class="text-muted">Idéalement 50-60 caractères</small>
                        </div>
                        <div class="mb-3">
                            <label for="meta-description" class="form-label">Meta Description</label>
                            <textarea class="form-control" id="meta-description" rows="3" maxlength="160"></textarea>
                            <small class="text-muted">Idéalement 150-160 caractères</small>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="card">
                    <div class="card-header">
                        <h6><i class="fas fa-tools me-2"></i>Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" onclick="copyArticle()">
                                <i class="fas fa-copy me-2"></i>Copier l'Article
                            </button>
                            <button class="btn btn-outline-secondary" onclick="downloadAsText()">
                                <i class="fas fa-file-alt me-2"></i>Télécharger (.txt)
                            </button>
                            <button class="btn btn-outline-info" onclick="downloadAsPdf()">
                                <i class="fas fa-file-pdf me-2"></i>Télécharger (.pdf)
                            </button>
                            <button class="btn btn-outline-success" onclick="saveArticle()">
                                <i class="fas fa-save me-2"></i>Enregistrer le Brouillon
                            </button>
                            <hr>
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

<script>
// Données simulées pour la génération
const articleTemplates = {
    professionnel: {
        intro: "Dans un environnement professionnel en constante évolution, il est crucial de comprendre les enjeux liés à [TOPIC]. Cette analyse approfondie vise à fournir aux décideurs les informations nécessaires pour naviguer efficacement dans ce domaine complexe.",
        body: [
            "Premièrement, il est essentiel de considérer l'impact stratégique de [TOPIC] sur les opérations commerciales actuelles. Les entreprises qui adoptent une approche proactive constatent souvent des améliorations significatives en termes de productivité et d'efficacité.",
            "De plus, l'intégration de [TOPIC] dans les processus existants nécessite une planification minutieuse. Une mise en œuvre progressive permet de minimiser les perturbations tout en maximisant les bénéfices à long terme.",
            "Enfin, la mesure des performances et l'ajustement continu sont fondamentaux pour le succès. Les indicateurs clés de performance doivent être définis dès le départ pour évaluer l'efficacité des initiatives mises en place."
        ],
        conclusion: "En conclusion, [TOPIC] représente un levier stratégique majeur pour les organisations modernes. Une approche réfléchie et bien exécutée peut transformer significativement les performances opérationnelles et créer un avantage concurrentiel durable."
    },
    informatif: {
        intro: "Le domaine de [TOPIC] suscite de plus en plus d'intérêt, et pour cause. Comprendre ses fondamentaux est essentiel pour quiconque souhaite se familiariser avec ce sujet fascinant.",
        body: [
            "Pour bien appréhender [TOPIC], il faut commencer par définir ses concepts clés. Ces fondations permettent de construire une compréhension solide et d'éviter les interprétations erronées.",
            "Les applications pratiques de [TOPIC] sont nombreuses et variées. De l'industrie technologique au secteur des services, ses principes peuvent être adaptés pour répondre à des besoins spécifiques.",
            "Les dernières avancées dans le domaine ouvrent de nouvelles perspectives passionnantes. Les chercheurs et professionnels explorent continuellement de nouvelles façons d'appliquer ces connaissances."
        ],
        conclusion: "En somme, [TOPIC] est un domaine riche et dynamique qui offre de nombreuses opportunités. Que vous soyez étudiant, professionnel ou simplement curieux, l'exploration de ce sujet promet d'être une expérience enrichissante."
    },
    // Ajoutez d'autres templates (persuasif, casual) si nécessaire
};

// Gestionnaire d'événements pour le formulaire
document.getElementById('article-form').addEventListener('submit', function(e) {
    e.preventDefault();
    generateArticle();
});

// Fonction principale de génération
function generateArticle() {
    const topic = document.getElementById('topic').value;
    const tone = document.getElementById('tone').value;
    
    // Masquer l'étape 1, afficher le chargement
    document.getElementById('step-input').style.display = 'none';
    document.getElementById('step-loading').style.display = 'block';
    
    // Simuler un délai de génération
    setTimeout(() => {
        const template = articleTemplates[tone] || articleTemplates.professionnel;
        
        // Remplacer le placeholder [TOPIC] par le sujet réel
        const processText = (text) => text.replace(/\[TOPIC\]/g, topic);
        
        // Remplir les champs avec le contenu généré
        document.getElementById('article-title').value = generateTitle(topic);
        document.getElementById('article-intro').value = processText(template.intro);
        document.getElementById('article-conclusion').value = processText(template.conclusion);
        
        // Ajouter les paragraphes du corps
        const bodyContainer = document.getElementById('article-body-container');
        bodyContainer.innerHTML = ''; // Vider le conteneur
        template.body.forEach((paragraph, index) => {
            addParagraph(processText(paragraph));
        });

        // Mettre à jour les métadonnées SEO
        document.getElementById('meta-title').value = generateTitle(topic);
        document.getElementById('meta-description').value = processText(template.intro).substring(0, 160) + '...';
        
        // Masquer le chargement, afficher le résultat
        document.getElementById('step-loading').style.display = 'none';
        document.getElementById('step-result').style.display = 'block';
        
        // Mettre à jour les statistiques
        updateStatistics();
        
        // Ajouter les écouteurs d'événements pour les champs éditables
        addEditListeners();
        
    }, 2000); // Délai de 2 secondes pour l'effet de "génération"
}

// Générer un titre basé sur le sujet
function generateTitle(topic) {
    const titles = [
        `Le Guide Complet de ${topic}`,
        `Comment Réussir avec ${topic} : Les Meilleures Stratégies`,
        `${topic} : Tout Ce Que Vous Devez Savoir`,
        `Les 10 Astuces Essentielles pour ${topic}`,
        `Maîtriser ${topic} : Méthodes et Bonnes Pratiques`
    ];
    return titles[Math.floor(Math.random() * titles.length)];
}

// Ajouter un paragraphe au corps de l'article
function addParagraph(text = '') {
    const container = document.getElementById('article-body-container');
    const paragraphDiv = document.createElement('div');
    paragraphDiv.className = 'mb-3 d-flex align-items-start';
    paragraphDiv.innerHTML = `
        <textarea class="form-control me-2" rows="3" placeholder="Écrivez votre paragraphe ici...">${text}</textarea>
        <button class="btn btn-outline-danger btn-sm" onclick="this.parentElement.remove(); updateStatistics();">
            <i class="fas fa-trash"></i>
        </button>
    `;
    container.appendChild(paragraphDiv);
}

// Ajouter les écouteurs d'événements pour la mise à jour en temps réel
function addEditListeners() {
    document.getElementById('article-title').addEventListener('input', () => {
        updateStatistics();
        updateCharCount('title', 60);
    });
    document.getElementById('article-intro').addEventListener('input', updateStatistics);
    document.getElementById('article-conclusion').addEventListener('input', updateStatistics);
    document.getElementById('meta-title').addEventListener('input', () => updateCharCount('meta', 60));
    document.getElementById('meta-description').addEventListener('input', () => updateCharCount('meta-desc', 160));
    
    // Écouteurs pour les paragraphes du corps
    document.querySelectorAll('#article-body-container textarea').forEach(textarea => {
        textarea.addEventListener('input', updateStatistics);
    });
}

// Mettre à jour les statistiques de l'article
function updateStatistics() {
    const title = document.getElementById('article-title').value;
    const intro = document.getElementById('article-intro').value;
    const conclusion = document.getElementById('article-conclusion').value;
    
    let bodyText = '';
    document.querySelectorAll('#article-body-container textarea').forEach(textarea => {
        bodyText += textarea.value + ' ';
    });
    
    const fullText = `${title} ${intro} ${bodyText} ${conclusion}`;
    const wordCount = fullText.trim().split(/\s+/).length;
    const charCount = fullText.length;
    const readingTime = Math.ceil(wordCount / 200); // Estimation: 200 mots/min
    
    document.getElementById('word-count').textContent = wordCount;
    document.getElementById('char-count').textContent = charCount;
    document.getElementById('reading-time').textContent = `${readingTime} min`;
}

// Mettre à jour le compteur de caractères
function updateCharCount(type, maxLength) {
    let currentLength;
    if (type === 'title') {
        currentLength = document.getElementById('article-title').value.length;
        document.getElementById('char-count-title').textContent = `${currentLength}/${maxLength}`;
    } else if (type === 'meta') {
        currentLength = document.getElementById('meta-title').value.length;
        // Mettre à jour le compteur à côté du champ
    } else if (type === 'meta-desc') {
        currentLength = document.getElementById('meta-description').value.length;
        // Mettre à jour le compteur à côté du champ
    }
}

// Copier l'article dans le presse-papiers
function copyArticle() {
    const title = document.getElementById('article-title').value;
    const intro = document.getElementById('article-intro').value;
    
    let bodyText = '';
    document.querySelectorAll('#article-body-container textarea').forEach(textarea => {
        bodyText += textarea.value + '\n\n';
    });
    
    const conclusion = document.getElementById('article-conclusion').value;
    
    const fullArticle = `${title}\n\n${intro}\n\n${bodyText}${conclusion}`;
    
    navigator.clipboard.writeText(fullArticle).then(() => {
        alert('Article copié dans le presse-papiers !');
    });
}

// Télécharger l'article en fichier .txt
function downloadAsText() {
    const title = document.getElementById('article-title').value;
    const intro = document.getElementById('article-intro').value;
    
    let bodyText = '';
    document.querySelectorAll('#article-body-container textarea').forEach(textarea => {
        bodyText += textarea.value + '\n\n';
    });
    
    const conclusion = document.getElementById('article-conclusion').value;
    
    const fullArticle = `${title}\n\n${intro}\n\n${bodyText}${conclusion}`;
    
    const blob = new Blob([fullArticle], { type: 'text/plain' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `${title.replace(/\s+/g, '_')}.txt`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
}

// Télécharger l'article en PDF (simulation)
function downloadAsPdf() {
    alert('Fonctionnalité de téléchargement PDF à venir. Pour l\'instant, utilisez l\'option "Copier l\'Article" et collez-le dans votre éditeur de texte préféré.');
}

// Enregistrer l'article (simulation)
function saveArticle() {
    alert('Article enregistré en tant que brouillon ! (Fonctionnalité de sauvegarde à venir)');
}

// Réinitialiser le générateur
function resetGenerator() {
    if (confirm('Êtes-vous sûr de vouloir recommencer ? Tout le contenu non sauvegardé sera perdu.')) {
        document.getElementById('article-form').reset();
        document.getElementById('step-result').style.display = 'none';
        document.getElementById('step-loading').style.display = 'none';
        document.getElementById('step-input').style.display = 'block';
    }
}
</script>
@endsection