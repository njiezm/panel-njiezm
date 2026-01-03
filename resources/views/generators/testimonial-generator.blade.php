@extends('layouts.app')

@section('title', 'Générateur de Témoignages - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Générateur de Témoignages</li>
    </ol>
</nav>

<div class="card-custom">
    <h3 class="brand-font">21. Générateur de Témoignages</h3>
    <p class="text-muted">Créez des témoignages clients authentiques et convaincants pour valoriser vos produits et services.</p>

    <!-- Étape 1: Informations du Témoignage -->
    <div id="step-input" class="step-container">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-quote-right me-2"></i>1. Décrivez le Témoignage</h5>
            </div>
            <div class="card-body">
                <form id="testimonial-form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="client-name" class="form-label">Nom du Client / Témoin</label>
                                <input type="text" class="form-control" id="client-name" placeholder="Ex: Jean Dupont" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="client-role" class="form-label">Rôle / Entreprise</label>
                                <input type="text" class="form-control" id="client-role" placeholder="Ex: Directeur Marketing, TechInnov">
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
                                <label for="key-benefit" class="form-label">Bénéfice Principal / Problème Résolu</label>
                                <input type="text" class="form-control" id="key-benefit" placeholder="Ex: Unifier notre image de marque" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="testimonial-tone" class="form-label">Ton du Témoignage</label>
                                <select class="form-select" id="testimonial-tone">
                                    <option value="professionnel">Professionnel et Confiant</option>
                                    <option value="enthousiaste">Enthousiaste et Passionné</option>
                                    <option value="soulage">Soulagé et Reconnaissant</option>
                                    <option value="impressionne">Impressionné et Étonné</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="testimonial-length" class="form-label">Longueur</label>
                                <select class="form-select" id="testimonial-length">
                                    <option value="court">Court (1-2 phrases)</option>
                                    <option value="moyen" selected>Moyen (3-4 phrases)</option>
                                    <option value="long">Long (5+ phrases)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="specific-detail" class="form-label">Détail Spécifique (Optionnel)</label>
                        <textarea class="form-control" id="specific-detail" rows="2" placeholder="Ex: Le gain de temps a été visible dès la première semaine..."></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-magic me-2"></i>Générer le Témoignage
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
        <h4 class="mt-3">L'IA rédige le témoignage...</h4>
        <p class="text-muted">Nous créons un témoignage authentique qui met en valeur les bénéfices de manière naturelle.</p>
    </div>

    <!-- Étape 3: Révision et Personnalisation -->
    <div id="step-review" class="step-container" style="display: none;">
        <div class="row">
            <!-- Colonne de gauche : Éditeur -->
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h6><i class="fas fa-edit me-2"></i>2. Personnalisez le Témoignage</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="testimonial-text" class="form-label">Texte du Témoignage</label>
                            <textarea class="form-control" id="testimonial-text" rows="8" placeholder="Le témoignage généré apparaîtra ici..."></textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="client-name-edit" class="form-label">Nom du Client</label>
                                    <input type="text" class="form-control" id="client-name-edit">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="client-role-edit" class="form-label">Rôle / Entreprise</label>
                                    <input type="text" class="form-control" id="client-role-edit">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="client-photo" class="form-label">Photo du Client (Optionnel)</label>
                            <input type="file" class="form-control" id="client-photo" accept="image/*">
                            <small class="text-muted">Laissez vide pour utiliser une photo par défaut.</small>
                            <div id="photo-preview" class="mt-2"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Colonne de droite : Aperçu -->
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h6><i class="fas fa-eye me-2"></i>Aperçu du Témoignage</h6>
                    </div>
                    <div class="card-body">
                        <!-- Aperçu Style Site Web -->
                        <div class="testimonial-preview-web mb-3">
                            <div class="d-flex align-items-start">
                                <img id="preview-photo" src="https://via.placeholder.com/80x80/003366/FFFFFF?text=JD" alt="Photo" class="rounded-circle me-3">
                                <div>
                                    <blockquote class="blockquote mb-0">
                                        <p id="preview-text">"Le témoignage généré apparaîtra ici. C'est un outil incroyable qui a transformé notre façon de travailler."</p>
                                        <footer class="blockquote-footer mt-2">
                                            <strong id="preview-name">Nom du Client</strong> - <cite id="preview-role" title="Source Title">Rôle / Entreprise</cite>
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="mt-3" id="preview-rating">
                                <!-- Les étoiles seront ajoutées ici -->
                            </div>
                        </div>

                        <!-- Aperçu Style Carte -->
                        <div class="testimonial-preview-card">
                            <div class="text-center mb-3">
                                <img id="card-preview-photo" src="https://via.placeholder.com/100x100/003366/FFFFFF?text=JD" alt="Photo" class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;">
                                <h5 id="card-preview-name">Nom du Client</h5>
                                <p class="text-muted" id="card-preview-role">Rôle / Entreprise</p>
                            </div>
                            <div class="card-body pt-0">
                                <p id="card-preview-text" class="fst-italic">"Le témoignage généré apparaîtra ici. C'est un outil incroyable qui a transformé notre façon de travailler."</p>
                                <div class="mt-3" id="card-preview-rating">
                                    <!-- Les étoiles seront ajoutées ici -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <button class="btn btn-secondary me-2" onclick="goToStep('input')">
                <i class="fas fa-arrow-left me-2"></i>Modifier les Informations
            </button>
            <button class="btn btn-primary btn-lg" onclick="goToStep('export')">
                <i class="fas fa-arrow-right me-2"></i>Exporter le Témoignage
            </button>
        </div>
    </div>

    <!-- Étape 4: Exportation -->
    <div id="step-export" class="step-container" style="display: none;">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-download me-2"></i>3. Exportez votre Témoignage</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h6>Exporter le Texte</h6>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" onclick="copyTestimonial()">
                                <i class="fas fa-copy me-2"></i>Copier le Texte
                            </button>
                            <button class="btn btn-outline-secondary" onclick="downloadAsTxt()">
                                <i class="fas fa-file-alt me-2"></i>Télécharger (.txt)
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6>Exporter pour le Web</h6>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-info" onclick="copyHtmlCode()">
                                <i class="fas fa-code me-2"></i>Copier le Code HTML
                            </button>
                            <button class="btn btn-outline-secondary" onclick="downloadAsHtml()">
                                <i class="fas fa-download me-2"></i>Télécharger (.html)
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h6>Générer des Variations</h6>
                        <p class="small text-muted">Créez plusieurs versions du même témoignage.</p>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-success" onclick="generateVariations()">
                                <i class="fas fa-random me-2"></i>Générer 3 Variations
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6>Actions</h6>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-warning" onclick="saveTestimonial()">
                                <i class="fas fa-save me-2"></i>Enregistrer
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
/* Styles pour les aperçus de témoignages */
.testimonial-preview-web {
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid var(--nj-blue);
}

.testimonial-preview-card {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
}

.testimonial-preview-card img {
    border: 3px solid var(--nj-blue);
    padding: 2px;
}

.rating {
    color: #ffc107; /* Jaune pour les étoiles */
    font-size: 1rem;
}
</style>

<script>
// Données simulées pour la génération de témoignages
const testimonialTemplates = {
    professionnel: {
        intro: "Avant d'utiliser [PRODUCT_SERVICE], nous faisions face à [PROBLÈME IMPLICITE].",
        body: "Depuis l'adoption de cette solution, nous avons constaté [BÉNÉFICE PRINCIPAL]. La mise en place a été simple et le support technique réactif.",
        conclusion: "Je recommande [PRODUCT_SERVICE] sans hésiter pour toute entreprise cherchant à [OBJECTIF GÉNÉRAL]."
    },
    enthousiaste: {
        intro: "Je suis absolument bluffé par [PRODUCT_SERVICE] ! C'est exactement ce qu'il nous fallait.",
        body: "En quelques semaines seulement, les résultats ont été au-delà de nos attentes. L'équipe est passionnée et le produit est une vraie mine d'or. [DÉTAIL SPÉCIFIQUE]",
        conclusion: "Si vous hésitez, n'hésitez plus ! C'est un investissement qui paie vite, très vite."
    },
    soulage: {
        intro: "Je ne sais comment nous faisions avant [PRODUCT_SERVICE].",
        body: "Cela a allégé notre charge de travail de manière significative. [BÉNÉFICE PRINCIPAL]. Nous pouvons enfin nous concentrer sur ce que nous faisons de mieux.",
        conclusion: "Un immense merci à l'équipe pour cette solution qui a changé notre quotidien."
    },
    impressionne: {
        intro: "La première fois que j'ai vu [PRODUCT_SERVICE], je n'ai pas compris comment c'était possible.",
        body: "La puissance et la simplicité combinées sont impressionnantes. [DÉTAIL SPÉCIFIQUE]. C'est l'outil le plus performant que nous ayons utilisé.",
        conclusion: "Je suis encore étonné aujourd'hui. Bravo pour avoir créé un tel produit."
    }
};

// Gestionnaire d'événements pour le formulaire
document.getElementById('testimonial-form').addEventListener('submit', function(e) {
    e.preventDefault();
    generateTestimonial();
});

// Gestionnaire pour l'upload de la photo
document.getElementById('client-photo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('photo-preview');
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            const imgHtml = `<img src="${event.target.result}" alt="Photo" style="max-height: 80px;" class="rounded-circle">`;
            preview.innerHTML = imgHtml;
            // Mettre à jour les aperçus
            document.getElementById('preview-photo').src = event.target.result;
            document.getElementById('card-preview-photo').src = event.target.result;
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

// Fonction principale de génération de témoignage
function generateTestimonial() {
    const tone = document.getElementById('testimonial-tone').value;
    const product = document.getElementById('product-service').value;
    const benefit = document.getElementById('key-benefit').value;
    const detail = document.getElementById('specific-detail').value;
    const clientName = document.getElementById('client-name').value;
    const clientRole = document.getElementById('client-role').value;
    
    // Masquer l'étape 1, afficher le chargement
    document.getElementById('step-input').style.display = 'none';
    document.getElementById('step-loading').style.display = 'block';
    
    // Simuler un délai de génération
    setTimeout(() => {
        const template = testimonialTemplates[tone] || testimonialTemplates.professionnel;
        
        // Remplacer les placeholders
        const processText = (text) => text
            .replace(/\[PRODUCT_SERVICE\]/g, product)
            .replace(/\[BÉNÉFICE PRINCIPAL\]/g, benefit)
            .replace(/\[PROBLÈME IMPLICITE\]/g, "des défis de productivité et de cohérence")
            .replace(/\[OBJECTIF GÉNÉRAL\]/g, "optimiser leurs processus")
            .replace(/\[DÉTAIL SPÉCIFIQUE\]/g, detail ? ` ${detail}` : "");
        
        // Assembler le témoignage complet
        const fullText = `${processText(template.intro)} ${processText(template.body)} ${processText(template.conclusion)}`;
        
        // Remplir les champs éditables
        document.getElementById('testimonial-text').value = fullText;
        document.getElementById('client-name-edit').value = clientName;
        document.getElementById('client-role-edit').value = clientRole;
        
        // Mettre à jour les aperçus
        updatePreviews(clientName, clientRole, fullText);
        
        // Masquer le chargement, afficher l'étape de révision
        document.getElementById('step-loading').style.display = 'none';
        document.getElementById('step-review').style.display = 'block';
        
        // Ajouter les écouteurs pour la mise à jour en temps réel
        addEditListeners();
        
    }, 2000);
}

// Mettre à jour tous les aperçus
function updatePreviews(name, role, text) {
    // Aperçu Web
    document.getElementById('preview-name').textContent = name;
    document.getElementById('preview-role').textContent = role;
    document.getElementById('preview-text').textContent = `"${text}"`;
    
    // Aperçu Carte
    document.getElementById('card-preview-name').textContent = name;
    document.getElementById('card-preview-role').textContent = role;
    document.getElementById('card-preview-text').textContent = `"${text}"`;
    
    // Mettre à jour les initiales si pas de photo
    if (!document.getElementById('client-photo').files.length) {
        const initials = name.split(' ').map(n => n[0]).join('').toUpperCase();
        const defaultPhotoSrc = `https://via.placeholder.com/80x80/003366/FFFFFF?text=${initials}`;
        document.getElementById('preview-photo').src = defaultPhotoSrc;
        document.getElementById('card-preview-photo').src = `https://via.placeholder.com/100x100/003366/FFFFFF?text=${initials}`;
    }
    
    // Ajouter un rating de 5 étoiles
    const ratingHtml = '<span class="rating"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></span>';
    document.getElementById('preview-rating').innerHTML = ratingHtml;
    document.getElementById('card-preview-rating').innerHTML = ratingHtml;
}

// Ajouter les écouteurs pour la mise à jour en temps réel
function addEditListeners() {
    document.getElementById('testimonial-text').addEventListener('input', (e) => {
        document.getElementById('preview-text').textContent = `"${e.target.value}"`;
        document.getElementById('card-preview-text').textContent = `"${e.target.value}"`;
    });
    
    document.getElementById('client-name-edit').addEventListener('input', (e) => {
        document.getElementById('preview-name').textContent = e.target.value;
        document.getElementById('card-preview-name').textContent = e.target.value;
        
        // Mettre à jour les initiales si pas de photo
        if (!document.getElementById('client-photo').files.length) {
            const initials = e.target.value.split(' ').map(n => n[0]).join('').toUpperCase();
            const defaultPhotoSrc = `https://via.placeholder.com/80x80/003366/FFFFFF?text=${initials}`;
            document.getElementById('preview-photo').src = defaultPhotoSrc;
            document.getElementById('card-preview-photo').src = `https://via.placeholder.com/100x100/003366/FFFFFF?text=${initials}`;
        }
    });
    
    document.getElementById('client-role-edit').addEventListener('input', (e) => {
        document.getElementById('preview-role').textContent = e.target.value;
        document.getElementById('card-preview-role').textContent = e.target.value;
    });
}

// --- Fonctions d'exportation ---

function copyTestimonial() {
    const name = document.getElementById('client-name-edit').value;
    const role = document.getElementById('client-role-edit').value;
    const text = document.getElementById('testimonial-text').value;
    
    const fullText = `"${text}"\n\n- ${name}, ${role}`;
    
    navigator.clipboard.writeText(fullText).then(() => {
        alert('Témoignage copié dans le presse-papiers !');
    });
}

function downloadAsTxt() {
    const name = document.getElementById('client-name-edit').value;
    const role = document.getElementById('client-role-edit').value;
    const text = document.getElementById('testimonial-text').value;
    
    const fullText = `Témoignage de ${name}\n${role}\n\n${text}`;
    
    const blob = new Blob([fullText], { type: 'text/plain' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `temoignage_${Date.now()}.txt`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
}

function copyHtmlCode() {
    const name = document.getElementById('client-name-edit').value;
    const role = document.getElementById('client-role-edit').value;
    const text = document.getElementById('testimonial-text').value;
    const photoSrc = document.getElementById('preview-photo').src;
    
    const htmlCode = `<div class="testimonial">
    <div class="d-flex align-items-start">
        <img src="${photoSrc}" alt="${name}" class="rounded-circle me-3" style="width: 80px; height: 80px; object-fit: cover;">
        <div>
            <blockquote class="blockquote mb-0">
                <p>"${text}"</p>
                <footer class="blockquote-footer mt-2">
                    <strong>${name}</strong> - <cite title="Source Title">${role}</cite>
                </footer>
            </blockquote>
        </div>
    </div>
</div>`;
    
    navigator.clipboard.writeText(htmlCode).then(() => {
        alert('Code HTML copié dans le presse-papiers !');
    });
}

function downloadAsHtml() {
    const name = document.getElementById('client-name-edit').value;
    const role = document.getElementById('client-role-edit').value;
    const text = document.getElementById('testimonial-text').value;
    const photoSrc = document.getElementById('preview-photo').src;
    
    const htmlContent = `<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Témoignage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="testimonial">
            <div class="d-flex align-items-start">
                <img src="${photoSrc}" alt="${name}" class="rounded-circle me-3" style="width: 80px; height: 80px; object-fit: cover;">
                <div>
                    <blockquote class="blockquote mb-0">
                        <p>"${text}"</p>
                        <footer class="blockquote-footer mt-2">
                            <strong>${name}</strong> - <cite title="Source Title">${role}</cite>
                        </footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</body>
</html>`;
    
    const blob = new Blob([htmlContent], { type: 'text/html' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `temoignage_${Date.now()}.html`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
}

function generateVariations() {
    const baseText = document.getElementById('testimonial-text').value;
    const tone = document.getElementById('testimonial-tone').value;
    
    // Simuler la génération de variations (dans une vraie app, cela appellerait une API)
    const variations = [
        baseText.replace("incroyable", "exceptionnel"),
        baseText.replace("facile", "intuitif"),
        baseText.replace("résultats", "retour sur investissement")
    ];
    
    let variationsText = "Voici 3 variations de votre témoignage :\n\n";
    variations.forEach((variation, index) => {
        variationsText += `--- Variation ${index + 1} ---\n${variation}\n\n`;
    });
    
    const blob = new Blob([variationsText], { type: 'text/plain' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `variations_temoignage_${Date.now()}.txt`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
    
    alert("3 variations du témoignage ont été générées et téléchargées !");
}

function saveTestimonial() {
    alert('Témoignage enregistré ! (Fonctionnalité de sauvegarde à venir)');
}

function resetGenerator() {
    if (confirm('Êtes-vous sûr de vouloir recommencer ?')) {
        document.getElementById('testimonial-form').reset();
        document.getElementById('testimonial-text').value = '';
        document.getElementById('client-name-edit').value = '';
        document.getElementById('client-role-edit').value = '';
        document.getElementById('photo-preview').innerHTML = '';
        document.querySelectorAll('.step-container').forEach(container => {
            container.style.display = 'none';
        });
        document.getElementById('step-input').style.display = 'block';
    }
}
</script>
@endsection