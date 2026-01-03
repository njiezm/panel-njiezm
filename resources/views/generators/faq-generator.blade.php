@extends('layouts.app')

@section('title', 'FAQ - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item active">FAQ</li>
    </ol>
</nav>

<div class="card-custom">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="brand-font">22. FAQ - Questions Fréquemment Posées</h3>
        <div class="btn-group">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuestionModal">
                <i class="fas fa-plus me-2"></i>Ajouter une question
            </button>
            <button class="btn btn-outline-primary" onclick="exportFAQ()">
                <i class="fas fa-download me-2"></i>Exporter
            </button>
        </div>
    </div>
    
    <!-- Barre de recherche et filtres -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" class="form-control" id="faqSearch" placeholder="Rechercher dans la FAQ...">
            </div>
        </div>
        <div class="col-md-3">
            <select class="form-select" id="categoryFilter">
                <option value="">Toutes les catégories</option>
                <option value="general">Général</option>
                <option value="account">Compte</option>
                <option value="features">Fonctionnalités</option>
                <option value="pricing">Tarification</option>
                <option value="technical">Technique</option>
                <option value="support">Support</option>
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-select" id="sortFilter">
                <option value="popular">Plus populaires</option>
                <option value="recent">Plus récentes</option>
                <option value="alphabetical">Alphabétique</option>
            </select>
        </div>
    </div>
    
    <!-- Catégories rapides -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-wrap gap-2">
                <button class="btn btn-outline-primary btn-sm" onclick="filterByCategory('general')">
                    <i class="fas fa-info-circle me-1"></i>Général
                </button>
                <button class="btn btn-outline-primary btn-sm" onclick="filterByCategory('account')">
                    <i class="fas fa-user me-1"></i>Compte
                </button>
                <button class="btn btn-outline-primary btn-sm" onclick="filterByCategory('features')">
                    <i class="fas fa-cogs me-1"></i>Fonctionnalités
                </button>
                <button class="btn btn-outline-primary btn-sm" onclick="filterByCategory('pricing')">
                    <i class="fas fa-euro-sign me-1"></i>Tarification
                </button>
                <button class="btn btn-outline-primary btn-sm" onclick="filterByCategory('technical')">
                    <i class="fas fa-code me-1"></i>Technique
                </button>
                <button class="btn btn-outline-primary btn-sm" onclick="filterByCategory('support')">
                    <i class="fas fa-headset me-1"></i>Support
                </button>
            </div>
        </div>
    </div>
    
    <!-- Questions populaires -->
    <div class="row mb-4">
        <div class="col-12">
            <h5 class="mb-3">Questions les plus populaires</h5>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card popular-question" data-category="general">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <div class="me-3">
                                    <div class="question-number">1</div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="card-title">Qu'est-ce que NJIEZM.FR ?</h6>
                                    <p class="card-text text-muted small">NJIEZM.FR est une plateforme complète de gestion de marque qui aide les entreprises...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card popular-question" data-category="pricing">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <div class="me-3">
                                    <div class="question-number">2</div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="card-title">Comment fonctionne la tarification ?</h6>
                                    <p class="card-text text-muted small">Nous proposons plusieurs formules adaptées aux besoins de votre entreprise...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card popular-question" data-category="features">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <div class="me-3">
                                    <div class="question-number">3</div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="card-title">Puis-je personnaliser mon espace ?</h6>
                                    <p class="card-text text-muted small">Oui, NJIEZM.FR offre de nombreuses options de personnalisation...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card popular-question" data-category="support">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <div class="me-3">
                                    <div class="question-number">4</div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="card-title">Comment contacter le support ?</h6>
                                    <p class="card-text text-muted small">Notre équipe de support est disponible 24/7 par email et chat...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Liste complète des FAQ -->
    <div class="accordion" id="faqAccordion">
        <!-- Catégorie Général -->
        <div class="accordion-item faq-item" data-category="general">
            <h2 class="accordion-header" id="generalHeading">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#generalCollapse" aria-expanded="true" aria-controls="generalCollapse">
                    <i class="fas fa-info-circle me-2"></i>Général
                    <span class="badge bg-primary ms-auto">8 questions</span>
                </button>
            </h2>
            <div id="generalCollapse" class="accordion-collapse collapse show" aria-labelledby="generalHeading" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    <div class="faq-question">
                        <div class="question-header" onclick="toggleAnswer(this)">
                            <h6>Qu'est-ce que NJIEZM.FR ?</h6>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="answer">
                            <p>NJIEZM.FR est une plateforme complète de gestion de marque conçue pour aider les entreprises, les créateurs et les agences à gérer leur identité visuelle de manière centralisée. Notre plateforme offre des outils pour la création de logos, la génération de contenu, la gestion de documents juridiques, et bien plus encore.</p>
                        </div>
                    </div>
                    
                    <div class="faq-question">
                        <div class="question-header" onclick="toggleAnswer(this)">
                            <h6>Qui peut utiliser NJIEZM.FR ?</h6>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="answer">
                            <p>NJIEZM.FR s'adresse aux entreprises de toutes tailles, aux freelances, aux agences de communication, aux créateurs de contenu, et à toute personne souhaitant gérer efficacement son image de marque. Que vous soyez une startup, une PME ou une grande entreprise, notre plateforme s'adapte à vos besoins.</p>
                        </div>
                    </div>
                    
                    <div class="faq-question">
                        <div class="question-header" onclick="toggleAnswer(this)">
                            <h6>Comment commencer avec NJIEZM.FR ?</h6>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="answer">
                            <p>Pour commencer, il vous suffit de créer un compte gratuit sur notre plateforme. Une fois inscrit, vous aurez accès à un tableau de bord complet où vous pourrez commencer à gérer vos actifs de marque, créer du contenu et explorer toutes nos fonctionnalités.</p>
                        </div>
                    </div>
                    
                    <div class="faq-question">
                        <div class="question-header" onclick="toggleAnswer(this)">
                            <h6>NJIEZM.FR est-il disponible en plusieurs langues ?</h6>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="answer">
                            <p>Oui, NJIEZM.FR est disponible en français et en anglais. Nous prévoyons d'ajouter d'autres langues prochainement pour servir une audience internationale.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Catégorie Compte -->
        <div class="accordion-item faq-item" data-category="account">
            <h2 class="accordion-header" id="accountHeading">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accountCollapse" aria-expanded="false" aria-controls="accountCollapse">
                    <i class="fas fa-user me-2"></i>Compte
                    <span class="badge bg-primary ms-auto">6 questions</span>
                </button>
            </h2>
            <div id="accountCollapse" class="accordion-collapse collapse" aria-labelledby="accountHeading" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    <div class="faq-question">
                        <div class="question-header" onclick="toggleAnswer(this)">
                            <h6>Comment créer un compte ?</h6>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="answer">
                            <p>Pour créer un compte, cliquez sur le bouton "S'inscrire" en haut de la page, remplissez le formulaire avec vos informations (email, mot de passe, nom), et validez. Vous recevrez un email de confirmation pour activer votre compte.</p>
                        </div>
                    </div>
                    
                    <div class="faq-question">
                        <div class="question-header" onclick="toggleAnswer(this)">
                            <h6>Comment réinitialiser mon mot de passe ?</h6>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="answer">
                            <p>Cliquez sur "Mot de passe oublié" sur la page de connexion, entrez votre email, et suivez les instructions envoyées par email pour réinitialiser votre mot de passe en toute sécurité.</p>
                        </div>
                    </div>
                    
                    <div class="faq-question">
                        <div class="question-header" onclick="toggleAnswer(this)">
                            <h6>Puis-je avoir plusieurs comptes ?</h6>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="answer">
                            <p>Chaque utilisateur ne peut avoir qu'un seul compte. Cependant, vous pouvez créer des espaces de travail séparés et gérer plusieurs projets au sein d'un même compte.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Catégorie Fonctionnalités -->
        <div class="accordion-item faq-item" data-category="features">
            <h2 class="accordion-header" id="featuresHeading">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#featuresCollapse" aria-expanded="false" aria-controls="featuresCollapse">
                    <i class="fas fa-cogs me-2"></i>Fonctionnalités
                    <span class="badge bg-primary ms-auto">10 questions</span>
                </button>
            </h2>
            <div id="featuresCollapse" class="accordion-collapse collapse" aria-labelledby="featuresHeading" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    <div class="faq-question">
                        <div class="question-header" onclick="toggleAnswer(this)">
                            <h6>Quelles sont les principales fonctionnalités ?</h6>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="answer">
                            <p>NJIEZM.FR offre : gestion de logos et actifs visuels, générateur de contenu pour réseaux sociaux, création de documents juridiques, gestion d'équipe, templates personnalisables, générateur d'infographies, et bien plus encore.</p>
                        </div>
                    </div>
                    
                    <div class="faq-question">
                        <div class="question-header" onclick="toggleAnswer(this)">
                            <h6>Puis-je importer mes propres actifs ?</h6>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="answer">
                            <p>Oui, vous pouvez importer vos propres logos, images, polices et autres actifs visuels. Notre plateforme supporte tous les formats d'image courants (PNG, JPG, SVG, etc.) et les formats de police (TTF, OTF, WOFF).</p>
                        </div>
                    </div>
                    
                    <div class="faq-question">
                        <div class="question-header" onclick="toggleAnswer(this)">
                            <h6>Le générateur de contenu fonctionne-t-il avec l'IA ?</h6>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="answer">
                            <p>Oui, notre générateur de contenu utilise l'intelligence artificielle pour vous aider à créer des textes percutants et adaptés à votre marque. Vous pouvez générer des posts pour réseaux sociaux, des articles de blog, et bien plus encore.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Catégorie Tarification -->
        <div class="accordion-item faq-item" data-category="pricing">
            <h2 class="accordion-header" id="pricingHeading">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pricingCollapse" aria-expanded="false" aria-controls="pricingCollapse">
                    <i class="fas fa-euro-sign me-2"></i>Tarification
                    <span class="badge bg-primary ms-auto">5 questions</span>
                </button>
            </h2>
            <div id="pricingCollapse" class="accordion-collapse collapse" aria-labelledby="pricingHeading" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    <div class="faq-question">
                        <div class="question-header" onclick="toggleAnswer(this)">
                            <h6>Quelles sont les formules disponibles ?</h6>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="answer">
                            <p>Nous proposons 3 formules : Gratuit (pour les particuliers et petites équipes), Professionnel (pour les PME et freelances), et Entreprise (pour les grandes organisations). Chaque formule inclut des fonctionnalités adaptées à vos besoins.</p>
                        </div>
                    </div>
                    
                    <div class="faq-question">
                        <div class="question-header" onclick="toggleAnswer(this)">
                            <h6>Puis-je changer de formule à tout moment ?</h6>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="answer">
                            <p>Oui, vous pouvez passer à une formule supérieure à tout moment. Le changement sera effectif immédiatement et vous ne serez facturé que pour la différence de prix au prorata.</p>
                        </div>
                    </div>
                    
                    <div class="faq-question">
                        <div class="question-header" onclick="toggleAnswer(this)">
                            <h6>Y a-t-il un essai gratuit ?</h6>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="answer">
                            <p>Oui, nous offrons un essai gratuit de 14 jours sur nos formules payantes. Aucune carte bancaire n'est requise pour commencer l'essai.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Catégorie Technique -->
        <div class="accordion-item faq-item" data-category="technical">
            <h2 class="accordion-header" id="technicalHeading">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#technicalCollapse" aria-expanded="false" aria-controls="technicalCollapse">
                    <i class="fas fa-code me-2"></i>Technique
                    <span class="badge bg-primary ms-auto">4 questions</span>
                </button>
            </h2>
            <div id="technicalCollapse" class="accordion-collapse collapse" aria-labelledby="technicalHeading" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    <div class="faq-question">
                        <div class="question-header" onclick="toggleAnswer(this)">
                            <h6>Quels navigateurs sont supportés ?</h6>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="answer">
                            <p>NJIEZM.FR fonctionne sur tous les navigateurs modernes : Chrome, Firefox, Safari, Edge. Nous recommandons d'utiliser la dernière version de votre navigateur pour une expérience optimale.</p>
                        </div>
                    </div>
                    
                    <div class="faq-question">
                        <div class="question-header" onclick="toggleAnswer(this)">
                            <h6>Y a-t-il une application mobile ?</h6>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="answer">
                            <p>NJIEZM.FR est entièrement responsive et fonctionne parfaitement sur mobile via votre navigateur. Une application mobile native est en cours de développement et sera disponible prochainement.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Catégorie Support -->
        <div class="accordion-item faq-item" data-category="support">
            <h2 class="accordion-header" id="supportHeading">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#supportCollapse" aria-expanded="false" aria-controls="supportCollapse">
                    <i class="fas fa-headset me-2"></i>Support
                    <span class="badge bg-primary ms-auto">3 questions</span>
                </button>
            </h2>
            <div id="supportCollapse" class="accordion-collapse collapse" aria-labelledby="supportHeading" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    <div class="faq-question">
                        <div class="question-header" onclick="toggleAnswer(this)">
                            <h6>Comment contacter le support client ?</h6>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="answer">
                            <p>Vous pouvez nous contacter par email à support@njiezm.fr, via notre chat en direct disponible 24/7, ou par téléphone au 01 23 45 67 89 du lundi au vendredi de 9h à 18h.</p>
                        </div>
                    </div>
                    
                    <div class="faq-question">
                        <div class="question-header" onclick="toggleAnswer(this)">
                            <h6>Quels sont les horaires du support ?</h6>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="answer">
                            <p>Notre support par chat et email est disponible 24/7. Le support téléphonique est disponible du lundi au vendredi de 9h à 18h (heure de Paris).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Section "Vous ne trouvez pas votre réponse ?" -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card bg-light">
                <div class="card-body text-center">
                    <h5 class="mb-3">Vous ne trouvez pas votre réponse ?</h5>
                    <p class="mb-4">Notre équipe est là pour vous aider. N'hésitez pas à nous contacter directement.</p>
                    <div class="d-flex justify-content-center gap-2">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contactModal">
                            <i class="fas fa-envelope me-2"></i>Contacter le support
                        </button>
                        <button class="btn btn-outline-primary" onclick="scrollToTop()">
                            <i class="fas fa-arrow-up me-2"></i>Retour en haut
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour ajouter une question -->
<div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addQuestionModalLabel">Ajouter une question à la FAQ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="questionCategory" class="form-label">Catégorie</label>
                    <select class="form-select" id="questionCategory">
                        <option value="general">Général</option>
                        <option value="account">Compte</option>
                        <option value="features">Fonctionnalités</option>
                        <option value="pricing">Tarification</option>
                        <option value="technical">Technique</option>
                        <option value="support">Support</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="questionText" class="form-label">Question</label>
                    <input type="text" class="form-control" id="questionText" placeholder="Entrez votre question">
                </div>
                <div class="mb-3">
                    <label for="answerText" class="form-label">Réponse</label>
                    <textarea class="form-control" id="answerText" rows="4" placeholder="Entrez la réponse détaillée"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="submitQuestion()">Soumettre la question</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de contact -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">Contacter le support</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="contactSubject" class="form-label">Sujet</label>
                    <input type="text" class="form-control" id="contactSubject" placeholder="Sujet de votre demande">
                </div>
                <div class="mb-3">
                    <label for="contactMessage" class="form-label">Message</label>
                    <textarea class="form-control" id="contactMessage" rows="5" placeholder="Décrivez votre question ou problème"></textarea>
                </div>
                <div class="mb-3">
                    <label for="contactEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="contactEmail" placeholder="votre@email.com">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="submitContact()">Envoyer</button>
            </div>
        </div>
    </div>
</div>

<script>
// Variables globales
let currentFilter = '';
let currentSort = 'popular';

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    setupEventListeners();
    initializeSearch();
});

// Configuration des écouteurs d'événements
function setupEventListeners() {
    // Recherche
    document.getElementById('faqSearch').addEventListener('input', performSearch);
    
    // Filtres
    document.getElementById('categoryFilter').addEventListener('change', function() {
        currentFilter = this.value;
        filterFAQ();
    });
    
    document.getElementById('sortFilter').addEventListener('change', function() {
        currentSort = this.value;
        sortFAQ();
    });
}

// Initialiser la recherche
function initializeSearch() {
    // Mettre en évidence les termes de recherche
    const searchInput = document.getElementById('faqSearch');
    searchInput.addEventListener('input', highlightSearchTerms);
}

// Effectuer une recherche
function performSearch() {
    const searchTerm = document.getElementById('faqSearch').value.toLowerCase();
    const questions = document.querySelectorAll('.faq-question');
    
    questions.forEach(question => {
        const questionText = question.textContent.toLowerCase();
        const questionHeader = question.querySelector('.question-header h6');
        const answer = question.querySelector('.answer');
        
        if (questionText.includes(searchTerm)) {
            question.style.display = '';
            questionHeader.parentElement.classList.add('search-highlight');
        } else {
            question.style.display = 'none';
            questionHeader.parentElement.classList.remove('search-highlight');
        }
    });
}

// Mettre en évidence les termes de recherche
function highlightSearchTerms() {
    const searchTerm = document.getElementById('faqSearch').value;
    const questions = document.querySelectorAll('.faq-question');
    
    questions.forEach(question => {
        const questionHeader = question.querySelector('.question-header h6');
        const answer = question.querySelector('.answer');
        
        // Supprimer les surbrillances précédentes
        questionHeader.innerHTML = questionHeader.textContent;
        answer.innerHTML = answer.textContent;
        
        if (searchTerm) {
            // Ajouter la surbrillance
            const regex = new RegExp(`(${searchTerm})`, 'gi');
            questionHeader.innerHTML = questionHeader.textContent.replace(regex, '<mark>$1</mark>');
            answer.innerHTML = answer.textContent.replace(regex, '<mark>$1</mark>');
        }
    });
}

// Filtrer par catégorie
function filterByCategory(category) {
    document.getElementById('categoryFilter').value = category;
    currentFilter = category;
    filterFAQ();
}

// Filtrer la FAQ
function filterFAQ() {
    const faqItems = document.querySelectorAll('.faq-item');
    const popularQuestions = document.querySelectorAll('.popular-question');
    
    faqItems.forEach(item => {
        if (currentFilter && item.dataset.category !== currentFilter) {
            item.style.display = 'none';
        } else {
            item.style.display = '';
        }
    });
    
    popularQuestions.forEach(question => {
        if (currentFilter && question.dataset.category !== currentFilter) {
            question.style.display = 'none';
        } else {
            question.style.display = '';
        }
    });
}

// Trier la FAQ
function sortFAQ() {
    // Implémenter le tri selon le critère sélectionné
    console.log('Tri par :', currentSort);
}

// Basculer l'affichage de la réponse
function toggleAnswer(element) {
    const answer = element.nextElementSibling;
    const icon = element.querySelector('i');
    
    if (answer.style.display === 'block') {
        answer.style.display = 'none';
        icon.classList.remove('fa-chevron-up');
        icon.classList.add('fa-chevron-down');
    } else {
        answer.style.display = 'block';
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-up');
    }
}

// Soumettre une question
function submitQuestion() {
    const category = document.getElementById('questionCategory').value;
    const question = document.getElementById('questionText').value;
    const answer = document.getElementById('answerText').value;
    
    if (!question || !answer) {
        showNotification('Veuillez remplir tous les champs', 'warning');
        return;
    }
    
    // Simuler la soumission
    showNotification('Question soumise avec succès. Nous la traiterons prochainement.', 'success');
    
    // Fermer le modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('addQuestionModal'));
    modal.hide();
    
    // Réinitialiser le formulaire
    document.getElementById('questionText').value = '';
    document.getElementById('answerText').value = '';
}

// Soumettre le contact
function submitContact() {
    const subject = document.getElementById('contactSubject').value;
    const message = document.getElementById('contactMessage').value;
    const email = document.getElementById('contactEmail').value;
    
    if (!subject || !message || !email) {
        showNotification('Veuillez remplir tous les champs', 'warning');
        return;
    }
    
    // Simuler l'envoi
    showNotification('Message envoyé avec succès. Nous vous répondrons dans les plus brefs délais.', 'success');
    
    // Fermer le modal
    const modal = bootstrap.Modal.getInstance(document.getElementById('contactModal'));
    modal.hide();
    
    // Réinitialiser le formulaire
    document.getElementById('contactSubject').value = '';
    document.getElementById('contactMessage').value = '';
    document.getElementById('contactEmail').value = '';
}

// Exporter la FAQ
function exportFAQ() {
    // Créer le contenu à exporter
    let content = 'FAQ - NJIEZM.FR\n\n';
    
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const category = item.querySelector('.accordion-button').textContent.trim();
        content += `=== ${category} ===\n\n`;
        
        const questions = item.querySelectorAll('.faq-question');
        questions.forEach(question => {
            const questionText = question.querySelector('.question-header h6').textContent;
            const answerText = question.querySelector('.answer').textContent;
            content += `Q: ${questionText}\n`;
            content += `R: ${answerText}\n\n`;
        });
    });
    
    // Créer et télécharger le fichier
    const blob = new Blob([content], { type: 'text/plain' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.download = 'FAQ_NJIEZM.txt';
    link.click();
    URL.revokeObjectURL(url);
    
    showNotification('FAQ exportée avec succès', 'success');
}

// Retour en haut de la page
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
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
.popular-question {
    cursor: pointer;
    transition: all 0.3s ease;
}

.popular-question:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.question-number {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: var(--nj-blue);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 14px;
}

.faq-question {
    border-bottom: 1px solid #eee;
    padding: 15px 0;
}

.faq-question:last-child {
    border-bottom: none;
}

.question-header {
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    background-color: #f8f9fa;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.question-header:hover {
    background-color: #e9ecef;
}

.question-header h6 {
    margin: 0;
    font-weight: 600;
    color: var(--nj-blue);
}

.answer {
    display: none;
    padding: 15px;
    line-height: 1.6;
    background-color: white;
    border-radius: 5px;
    margin-top: 10px;
}

.search-highlight {
    background-color: #fff3cd;
    border-left: 3px solid var(--nj-yellow);
}

mark {
    background-color: var(--nj-yellow);
    padding: 2px 4px;
    border-radius: 3px;
}

.accordion-button {
    font-weight: 600;
}

.accordion-button:not(.collapsed) {
    background-color: var(--nj-blue);
    color: white;
}

.accordion-button:focus {
    box-shadow: none;
}

.accordion-button:not(.collapsed)::after {
    filter: brightness(0) invert(1);
}
</style>
@endsection