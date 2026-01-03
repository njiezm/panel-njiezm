@extends('layouts.app')

@section('title', 'Générateur d\'Emails Marketing - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Générateur d'Emails Marketing</li>
    </ol>
</nav>

<div class="card-custom">
    <h3 class="brand-font">15. Générateur d'Emails Marketing</h3>
    <p class="text-muted">Créez des e-mails percutants et professionnels en quelques minutes avec l'aide de notre IA.</p>

    <!-- Étape 1: Configuration de la Campagne -->
    <div id="step-input" class="step-container">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-bullhorn me-2"></i>1. Configurez votre Campagne</h5>
            </div>
            <div class="card-body">
                <form id="email-form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="campaign-goal" class="form-label">Objectif de la Campagne</label>
                                <select class="form-select" id="campaign-goal" required>
                                    <option value="">Sélectionnez un objectif</option>
                                    <option value="promotion">Promotion / Offre Spéciale</option>
                                    <option value="newsletter">Newsletter / Information</option>
                                    <option value="welcome">Email de Bienvenue</option>
                                    <option value="relance">Email de Relance</option>
                                    <option value="announcement">Annonce Produit/Événement</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="target-audience" class="form-label">Public Cible</label>
                                <select class="form-select" id="target-audience" required>
                                    <option value="">Sélectionnez un public</option>
                                    <option value="new-clients">Nouveaux Clients</option>
                                    <option value="existing-clients">Clients Existants</option>
                                    <option value="prospects">Prospects</option>
                                    <option value="all">Tous les Abonnés</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="product-service" class="form-label">Produit / Service Concerné</label>
                                <input type="text" class="form-control" id="product-service" placeholder="Ex: Pack Brand Center Pro" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="key-offer" class="form-label">Offre Clé / Message Principal</label>
                                <input type="text" class="form-control" id="key-offer" placeholder="Ex: -20% sur tous nos packs" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="tone" class="form-label">Ton de l'Email</label>
                        <select class="form-select" id="tone">
                            <option value="professionnel">Professionnel</option>
                            <option value="amical">Amical et Décontracté</option>
                            <option value="urgent">Urgent et Percutant</option>
                            <option value="informatif">Informatif et Pédagogique</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="additional-info" class="form-label">Informations Supplémentaires (Optionnel)</label>
                        <textarea class="form-control" id="additional-info" rows="2" placeholder="Détails spécifiques à inclure dans l'email..."></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-magic me-2"></i>Générer l'Email
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
        <h4 class="mt-3">L'IA rédige votre email...</h4>
        <p class="text-muted">Nous personnalisons le contenu pour qu'il ait le plus d'impact possible sur votre cible.</p>
    </div>

    <!-- Étape 3: Aperçu et Édition -->
    <div id="step-result" class="step-container" style="display: none;">
        <div class="row">
            <!-- Colonne de gauche : Éditeur -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h6><i class="fas fa-edit me-2"></i>Éditeur de Contenu</h6>
                    </div>
                    <div class="card-body">
                        <!-- Objet et Pré-en-tête -->
                        <div class="mb-3">
                            <label for="email-subject" class="form-label">Objet de l'email</label>
                            <input type="text" class="form-control" id="email-subject" maxlength="70">
                            <small class="text-muted">Idéalement 40-60 caractères pour une meilleure lisibilité.</small>
                        </div>
                        <div class="mb-3">
                            <label for="email-preheader" class="form-label">Pré-en-tête (texte d'aperçu)</label>
                            <input type="text" class="form-control" id="email-preheader" maxlength="100">
                            <small class="text-muted">Ce texte s'affiche après l'objet dans la plupart des boîtes de réception.</small>
                        </div>
                        
                        <!-- Corps de l'email -->
                        <div class="mb-3">
                            <label for="email-body" class="form-label">Corps de l'email</label>
                            <textarea class="form-control" id="email-body" rows="12" placeholder="Le contenu généré apparaîtra ici..."></textarea>
                        </div>

                        <!-- Appel à l'action (CTA) -->
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="cta-text" class="form-label">Texte du Bouton (Appel à l'action)</label>
                                    <input type="text" class="form-control" id="cta-text">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="cta-link" class="form-label">URL du Lien</label>
                                    <input type="url" class="form-control" id="cta-link" placeholder="https://...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Colonne de droite : Aperçu -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6><i class="fas fa-eye me-2"></i>Aperçu de l'Email</h6>
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-outline-secondary active" onclick="setPreviewMode('desktop')">
                                <i class="fas fa-desktop"></i>
                            </button>
                            <button type="button" class="btn btn-outline-secondary" onclick="setPreviewMode('mobile')">
                                <i class="fas fa-mobile-alt"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div id="email-preview" class="email-preview-desktop">
                            <!-- En-tête de l'email -->
                            <div class="email-header">
                                <img src="https://via.placeholder.com/150x50/003366/FFFFFF?text=NJIEZM.FR" alt="Logo NJIEZM.FR" class="email-logo">
                            </div>
                            
                            <!-- Contenu principal -->
                            <div class="email-content">
                                <h1 id="preview-subject" class="email-subject-preview">L'objet de votre email</h1>
                                <div id="preview-body" class="email-body-preview">
                                    Le corps de votre email généré apparaîtra ici. Cliquez sur les champs à gauche pour le modifier en temps réel.
                                </div>
                                
                                <!-- Bouton CTA -->
                                <div class="text-center my-4">
                                    <a href="#" id="preview-cta" class="email-cta-button">En savoir plus</a>
                                </div>
                            </div>
                            
                            <!-- Pied de page -->
                            <div class="email-footer">
                                <p>Nous sommes ravis de vous avoir parmi nos abonnés.</p>
                                <p class="small">
                                    <a href="#" style="color: inherit;">Se désinscrire</a> | 
                                    <a href="#" style="color: inherit;">Mettre à jour les préférences</a> | 
                                    <a href="#" style="color: inherit;">Nous contacter</a>
                                </p>
                                <p class="small text-muted">© {{ date('Y') }} NJIEZM.FR. Tous droits réservés.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h6><i class="fas fa-tools me-2"></i>Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" onclick="copyHtmlCode()">
                                <i class="fas fa-code me-2"></i>Copier le Code HTML
                            </button>
                            <button class="btn btn-outline-secondary" onclick="sendTestEmail()">
                                <i class="fas fa-paper-plane me-2"></i>Envoyer un Email de Test
                            </button>
                            <button class="btn btn-outline-info" onclick="saveAsTemplate()">
                                <i class="fas fa-save me-2"></i>Enregistrer comme Modèle
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

<style>
/* Styles pour l'aperçu de l'email */
.email-preview-desktop, .email-preview-mobile {
    font-family: Arial, sans-serif;
    color: #333;
    background-color: #f4f4f4;
    border: 1px solid #ddd;
}

.email-preview-desktop {
    max-width: 600px;
    margin: 0 auto;
}

.email-preview-mobile {
    max-width: 375px;
    margin: 0 auto;
}

.email-header {
    background-color: #fff;
    padding: 20px;
    text-align: center;
    border-bottom: 1px solid #eee;
}

.email-logo {
    max-width: 150px;
    height: auto;
}

.email-content {
    background-color: #fff;
    padding: 30px;
}

.email-subject-preview {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #003366;
}

.email-body-preview {
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 20px;
}

.email-cta-button {
    display: inline-block;
    padding: 12px 30px;
    background-color: #FFD700; /* var(--nj-yellow) */
    color: #1a1a1a; /* var(--nj-dark) */
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    font-size: 16px;
}

.email-cta-button:hover {
    background-color: #e6c200;
}

.email-footer {
    background-color: #f8f9fa;
    padding: 20px;
    text-align: center;
    font-size: 12px;
    color: #666;
    border-top: 1px solid #eee;
}

.email-footer a {
    text-decoration: underline;
    color: inherit;
}
</style>

<script>
// Données simulées pour la génération d'emails
const emailTemplates = {
    promotion: {
        subject: "Offre Spéciale : [KEY_OFFER] sur [PRODUCT_SERVICE] !",
        preheader: "Ne manquez pas cette opportunité unique. Profitez de [KEY_OFFER] avant qu'il ne soit trop tard.",
        body: `Bonjour [AUDIENCE],\n\nNous sommes ravis de vous présenter une offre exceptionnelle sur notre [PRODUCT_SERVICE] !\n\nPour une durée limitée, bénéficiez de [KEY_OFFER]. C'est le moment idéal pour découvrir tous les bénéfices de notre solution et donner un nouvel élan à votre activité.\n\n[ADDITIONAL_INFO]\n\nCette offre est conçue pour vous offrir un maximum de valeur. N'attendez plus pour saisir cette opportunité.\n\nCordialement,\nL'équipe de NJIEZM.FR`,
        ctaText: "Je profite de l'offre"
    },
    newsletter: {
        subject: "Votre Newsletter NJIEZM.FR : Les dernières actualités",
        preheader: "Découvrez nos nouveautés, nos conseils d'experts et les actualités du mois.",
        body: `Bonjour [AUDIENCE],\n\nBienvenue dans notre nouvelle newsletter ! Ce mois-ci, nous avons beaucoup de choses passionnantes à partager avec vous.\n\nAu sommaire :\n- Focus sur notre [PRODUCT_SERVICE]\n- Nos conseils pour optimiser votre stratégie\n- [ADDITIONAL_INFO]\n\nNous espérons que ces informations vous seront utiles. N'hésitez pas à nous faire part de vos retours !\n\nBonne lecture,\nL'équipe de NJIEZM.FR`,
        ctaText: "Lire la suite"
    },
    welcome: {
        subject: "Bienvenue chez NJIEZM.FR !",
        preheader: "Nous sommes heureux de vous compter parmi nous. Voici les prochaines étapes.",
        body: `Bonjour,\n\nBienvenue et merci de vous être inscrit ! Nous sommes ravis de vous compter parmi la communauté NJIEZM.FR.\n\nVotre inscription est désormais confirmée. Pour commencer, nous vous invitons à découvrir notre [PRODUCT_SERVICE], une solution conçue pour vous aider à atteindre vos objectifs.\n\n[ADDITIONAL_INFO]\n\nN'hésitez pas à explorer nos ressources et à nous contacter si vous avez la moindre question.\n\nÀ très bientôt,\nL'équipe de NJIEZM.FR`,
        ctaText: "Découvrir nos services"
    },
    // Ajoutez d'autres templates (relance, announcement) si nécessaire
};

// Gestionnaire d'événements pour le formulaire
document.getElementById('email-form').addEventListener('submit', function(e) {
    e.preventDefault();
    generateEmail();
});

// Fonction principale de génération
function generateEmail() {
    const goal = document.getElementById('campaign-goal').value;
    const audience = document.getElementById('target-audience').value;
    const product = document.getElementById('product-service').value;
    const offer = document.getElementById('key-offer').value;
    const additionalInfo = document.getElementById('additional-info').value;
    
    // Masquer l'étape 1, afficher le chargement
    document.getElementById('step-input').style.display = 'none';
    document.getElementById('step-loading').style.display = 'block';
    
    // Simuler un délai de génération
    setTimeout(() => {
        const template = emailTemplates[goal] || emailTemplates.newsletter;
        
        // Remplacer les placeholders
        const processText = (text) => text
            .replace(/\[PRODUCT_SERVICE\]/g, product)
            .replace(/\[KEY_OFFER\]/g, offer)
            .replace(/\[AUDIENCE\]/g, audience.replace('-', ' '))
            .replace(/\[ADDITIONAL_INFO\]/g, additionalInfo ? `\n${additionalInfo}\n` : '');
        
        // Remplir les champs éditables
        document.getElementById('email-subject').value = processText(template.subject);
        document.getElementById('email-preheader').value = processText(template.preheader);
        document.getElementById('email-body').value = processText(template.body);
        document.getElementById('cta-text').value = template.ctaText;
        document.getElementById('cta-link').value = 'https://njiezm.fr/contact'; // Lien par défaut
        
        // Masquer le chargement, afficher le résultat
        document.getElementById('step-loading').style.display = 'none';
        document.getElementById('step-result').style.display = 'block';
        
        // Mettre à jour l'aperçu
        updatePreview();
        
        // Ajouter les écouteurs d'événements pour la mise à jour en temps réel
        addEditListeners();
        
    }, 2000);
}

// Ajouter les écouteurs d'événements pour la mise à jour en temps réel
function addEditListeners() {
    document.getElementById('email-subject').addEventListener('input', updatePreview);
    document.getElementById('email-preheader').addEventListener('input', updatePreview);
    document.getElementById('email-body').addEventListener('input', updatePreview);
    document.getElementById('cta-text').addEventListener('input', updatePreview);
    document.getElementById('cta-link').addEventListener('input', updatePreview);
}

// Mettre à jour l'aperçu en temps réel
function updatePreview() {
    const subject = document.getElementById('email-subject').value;
    const body = document.getElementById('email-body').value;
    const ctaText = document.getElementById('cta-text').value;
    const ctaLink = document.getElementById('cta-link').value;
    
    document.getElementById('preview-subject').textContent = subject || "L'objet de votre email";
    document.getElementById('preview-body').innerHTML = (body || "Le corps de votre email...").replace(/\n/g, '<br>');
    
    const ctaButton = document.getElementById('preview-cta');
    ctaButton.textContent = ctaText || "En savoir plus";
    ctaButton.href = ctaLink || '#';
}

// Changer le mode d'aperçu (desktop/mobile)
function setPreviewMode(mode) {
    const preview = document.getElementById('email-preview');
    const buttons = document.querySelectorAll('.btn-group .btn');
    
    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.closest('button').classList.add('active');
    
    if (mode === 'mobile') {
        preview.className = 'email-preview-mobile';
    } else {
        preview.className = 'email-preview-desktop';
    }
}

// Copier le code HTML de l'aperçu
function copyHtmlCode() {
    const previewHtml = document.getElementById('email-preview').innerHTML;
    navigator.clipboard.writeText(previewHtml).then(() => {
        alert('Code HTML de l\'email copié dans le presse-papiers !');
    });
}

// Envoyer un email de test (simulation)
function sendTestEmail() {
    const email = prompt("Veuillez entrer votre adresse email pour recevoir l'email de test :");
    if (email) {
        alert(`Email de test envoyé à ${email} ! (Fonctionnalité de simulation)`);
    }
}

// Enregistrer comme modèle (simulation)
function saveAsTemplate() {
    alert('Modèle d\'email enregistré ! (Fonctionnalité de simulation)');
}

// Réinitialiser le générateur
function resetGenerator() {
    if (confirm('Êtes-vous sûr de vouloir recommencer ? Tout le contenu non sauvegardé sera perdu.')) {
        document.getElementById('email-form').reset();
        document.getElementById('step-result').style.display = 'none';
        document.getElementById('step-loading').style.display = 'none';
        document.getElementById('step-input').style.display = 'block';
    }
}
</script>
@endsection