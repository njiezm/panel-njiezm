@extends('layouts.app')

@section('title', 'Marketing & Social Media - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Marketing & Social Media</li>
    </ol>
</nav>

<style>
/* Dans votre fichier CSS principal */
.card-custom {
    margin-left: 0;
    padding-left: 15px;
    overflow-x: hidden;
}

/* Pour les conteneurs qui débordent */
.row {
    margin-left: 0;
    margin-right: 0;
}

.col-md-6 {
    padding-left: 10px;
    padding-right: 10px;
}

/* Pour les éléments qui peuvent causer un débordement */
.preview-box, .social-format-box {
    max-width: 100%;
    box-sizing: border-box;
}
</style>
@stack('styles')
<!-- SECTION MARKETING & SOCIAL -->
<section id="marketing">
    <div class="card-custom">
        <h3 class="brand-font">4. Marketing & Social Media</h3>
        <ul class="nav nav-tabs tab-custom">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#social-posts">Posts Réseaux Sociaux</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#brochures">Plaquettes & Brochures</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#banners">Bannières & Publicités</a>
            </li>
        </ul>
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="social-posts">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Templates par plateforme</h6>
                        <div class="social-format-box">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>LinkedIn</strong> (1200x627) - Carrousel ou Post unique</div>
                                </div>
                                <i class="fab fa-linkedin" style="font-size: 24px; color: #0077B5;"></i>
                            </div>
                        </div>
                        <div class="social-format-box">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Instagram</strong> (1080x1080 / Reels)</div>
                                </div>
                                <i class="fab fa-instagram" style="font-size: 24px; color: #E4405F;"></i>
                            </div>
                        </div>
                        <div class="social-format-box">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Facebook</strong> (1200x630)</div>
                                </div>
                                <i class="fab fa-facebook" style="font-size: 24px; color: #1877F2;"></i>
                            </div>
                        </div>
                        <div class="social-format-box">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Twitter</strong> (1600x900)</div>
                                </div>
                                <i class="fab fa-twitter" style="font-size: 24px; color: #1DA1F2;"></i>
                            </div>
                        </div>
                        <div class="social-format-box">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>TikTok</strong> (1080x1920)</div>
                                </div>
                                <i class="fab fa-tiktok" style="font-size: 24px; color: #000000;"></i>
                            </div>
                        </div>
                        <button class="btn btn-dark btn-sm w-100 mt-2">Générer le template Canva/HTML</button>
                    </div>
                    <div class="col-md-6">
                        <h6>Aperçu du post</h6>
                        <div class="preview-box" style="height: 400px; background: white;">
                            <!-- Remplacez les balises img par ce code -->
<div class="gray-placeholder" style="height: 400px; background: #f0f0f0; border: 1px dashed #ccc; display: flex; align-items: center; justify-content: center; flex-direction: column;">
    <i class="fas fa-image" style="font-size: 48px; color: #ccc;"></i>
    <span style="color: #999; margin-top: 10px;">600 × 400px</span>
</div>
                        </div>
                        <div class="mt-3">
                            <textarea class="form-control" rows="3" placeholder="Légende du post..."></textarea>
                            <div class="mt-2">
                                <span class="tag">#digital</span>
                                <span class="tag">#marketing</span>
                                <span class="tag">#njiezm</span>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100" onclick="generateSocialPost()">GÉNÉRER LE POST</button>
                        <button class="btn btn-outline-primary w-100 mt-2">PUBLIER</button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="brochures">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Plaquette Commerciale</h6>
                        <p class="small">Document PDF interactif présentant les services.</p>
                        <div class="mb-3">
                            <label class="form-label">Format</label>
                            <select class="form-select">
                                <option>A4 (210x297mm)</option>
                                <option>A5 (148x210mm)</option>
                                <option>A3 (297x420mm)</option>
                                <option>Format carré (210x210mm)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Type de brochure</label>
                            <select class="form-select">
                                <option>Biplan</option>
                                <option>Triplé</option>
                                <option>Quadriplié</option>
                            </select>
                        </div>
                        <button class="btn btn-outline-primary btn-sm w-100">Éditer la Plaquette</button>
                    </div>
                    <div class="col-md-6">
                        <h6>Aperçu</h6>
                        <div class="preview-box" style="height: 400px;">
                            <!-- Remplacez les balises img par ce code -->
<div class="gray-placeholder" style="height: 400px; background: #f0f0f0; border: 1px dashed #ccc; display: flex; align-items: center; justify-content: center; flex-direction: column;">
    <i class="fas fa-image" style="font-size: 48px; color: #ccc;"></i>
    <span style="color: #999; margin-top: 10px;">600 × 400px</span>
</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="banners">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Bannières publicitaires</h6>
                        <div class="social-format-box">
                            <strong>Leaderboard</strong> (728x90)</div>
                        </div>
                        <div class="social-format-box">
                            <strong>Medium Rectangle</strong> (300x250)</div>
                        </div>
                        <div class="social-format-box">
                            <strong>Large Rectangle</strong> (336x280)</div>
                        </div>
                        <div class="social-format-box">
                            <strong>Skyscraper</strong> (120x600)</div>
                        </div>
                        <div class="social-format-box">
                            <strong>Wide Skyscraper</strong> (160x600)</div>
                        </div>
                        <button class="btn btn-outline-primary btn-sm w-100 mt-2">CRÉER UNE BANNIÈRE</button>
                    </div>
                    <div class="col-md-6">
                        <h6>Aperçu de la bannière</h6>
                        <div class="preview-box" style="height: 400px;">
                           <!-- Remplacez les balises img par ce code -->
<div class="gray-placeholder" style="height: 400px; background: #f0f0f0; border: 1px dashed #ccc; display: flex; align-items: center; justify-content: center; flex-direction: column;">
    <i class="fas fa-image" style="font-size: 48px; color: #ccc;"></i>
    <span style="color: #999; margin-top: 10px;">600 × 400px</span>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal pour créer un post réseau social -->
<div class="modal fade" id="social-post-modal" tabindex="-1" aria-labelledby="socialPostModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="socialPostModalLabel">Créer un post réseau social</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Plateforme</label>
                    <select class="form-select" id="social-platform">
                        <option value="instagram">Instagram</option>
                        <option value="linkedin">LinkedIn</option>
                        <option value="facebook">Facebook</option>
                        <option value="twitter">Twitter</option>
                        <option value="tiktok">TikTok</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Type de post</label>
                    <select class="form-select" id="post-type">
                        <option value="lifehack">Life Hack Tech</option>
                        <option value="techhack">Tech Hack</option>
                        <option value="promo">Promotion</option>
                        <option value="blackfriday">Black Friday</option>
                        <option value="exclusive">Offre Exclusive</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Image de fond</label>
                    <div class="drop-zone" id="social-image-drop">
                        <i class="fas fa-cloud-upload-alt mb-2"></i>
                        <p>Glissez une image ici</p>
                        <button class="btn btn-sm btn-outline-primary">PARCOURIR</button>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Contenu</label>
                    <textarea class="form-control" rows="6" id="social-content" placeholder="Écrivez votre contenu ici..."></textarea>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Hashtags</label>
                    <input type="text" class="form-control" id="social-hashtags" placeholder="#tech #digital #njiezm">
                </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Appel à l'action</label>
                    <input type="text" class="form-control" id="social-cta" placeholder="Texte du bouton CTA">
                </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">URL de destination</label>
                    <input type="url" class="form-control" id="social-url" placeholder="https://www.njiezm.fr/destination">
                </div>
                </div>
                
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="social-personalization">
                        <label class="form-check-label" for="social-personalization">
                            Activer la personnalisation (nom du destinataire)
                        </label>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Ton du message</label>
                    <select class="form-select" id="social-tone">
                        <option>Professionnel</option>
                        <option>Informatif</option>
                        <option>Inspirant</option>
                        <option>Humoristique</option>
                        <option>Urgent</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Longueur du message</label>
                    <select class="form-select" id="social-length">
                        <option>Court (100-200 caractères)</option>
                        <option>Moyen (200-500 caractères)</option>
                        <option>Long (500+ caractères)</option>
                    </select>
                </div>
                
                <button class="btn btn-primary w-100" onclick="generateSocialPost()">GÉNÉRER LE POST</button>
                <button class="btn btn-outline-primary w-100 mt-2">TÉLÉCHARGER</button>
                <button class="btn btn-outline-primary w-100 mt-2">PROGRAMMER</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="saveSocialPost()">ENREGISTRER</button>
            </div>
        </div>
    </div>
</div>

<!-- Canvas pour l'exportation -->
<canvas id="export-canvas" style="display: none;"></canvas>

<script>
// Variables globales pour les posts sociaux
let currentSocialPost = {
    platform: 'instagram',
    type: 'lifehack',
    content: '',
    image: null,
    hashtags: '#tech #digital #njiezm',
    cta: '',
    url: '',
    personalization: false,
    tone: 'Professionnel',
    length: 'medium'
};

// Fonction pour générer un post réseau social
function generateSocialPost() {
    // Récupérer les valeurs des champs
    currentSocialPost = {
        platform: document.getElementById('social-platform').value,
        type: document.getElementById('post-type').value,
        content: document.getElementById('social-content').value,
        hashtags: document.getElementById('social-hashtags').value,
        cta: document.getElementById('social-cta').value,
        url: document.getElementById('social-url').value,
        personalization: document.getElementById('social-personalization').checked,
        tone: document.getElementById('social-tone').value,
        length: document.getElementById('social-length').value
    };
    
    // Générer le contenu en fonction du type et du ton
    let content = '';
    
    if (currentSocialPost.type === 'lifehack') {
        content = `💡 LIFE HACK TECH 💡\n\nSavez-vous que vous pouvez automatiser 80% de vos tâches répétitives avec quelques scripts simples ?\n\nVoici 3 astuces pour commencer :\n\n1. Utilisez des macros pour vos tâches bureautiques\n2. Créez des scripts pour vos sauvegardes automatiques\n3. Mettez en place des raccourcis clairs\n\nEssayez et dites-moi ce que vous en pensez !`;
    } else if (currentSocialPost.type === 'techhack') {
        content = `🔧 TECH HACK 🔧\n\nCe petit changement dans vos paramètres peut accélérer votre productivité de 30% !\n\nVoici comment faire :\n\n1. Allez dans Paramètres > Clavier > Langue > Texte substitution\n2. Ajoutez la substitution : /s/votre-texte-par-défaut/ /votre-nouveau-texte\n\nEssayez et dites-moi ce que vous en pensez !`;
    } else if (currentSocialPost.type === 'promo') {
        content = `🎉 OFFRE SPÉCIALE 🎉\n\nPendant 48h seulement, profitez de -20% sur tous nos services de développement web !\n\nCode: BF2023\n\nPour une durée limitée, profitez de -20% sur tous nos services de développement.\n\nCode: BF2023`;
    } else if (currentSocialPost) {
        content = `🛍 OFFRE EXCLUSIVE 🛍\n\nPour une durée limitée, profitez de -20% sur tous nos services de développement.\n\nCode: BF2023`;
    } else if (currentSocialPost.type === 'blackfriday') {
        content = `🛍 BLACK FRIDAY 🛍\n\nLe plus grand soldé de l'année !\n\nCode: BF2023\n\nPour une durée limitée, profitez de -40% sur tous nos services de développement.\n\nCode: BF2023`;
    } else if (currentSocialPost.type === 'exclusive') {
        content = `⭐ OFFRE EXCLUSIVE ⭐\n\nExclusivement pour nos abonnés !\n\nCode: BF2023`;
    }
    
    // Ajouter les hashtags personnalisés si fournis
    if (currentSocialPost.hashtags) {
        content += '\n\n' + currentSocialPost.hashtags;
    }
    
    // Ajouter le texte personnalisé si fourni
    if (currentSocialPost.customText) {
        content += '\n\n' + currentSocialPost.customText;
    }
    
    // Ajouter le CTA si fourni
    if (currentSocialPost.cta) {
        content += '\n\n👉 ' + currentSocialPost.cta;
    }
    
    // Ajouter l'URL de destination si fourni
    if (currentSocialPost.url) {
        content += '\n\n👉 ' + currentSocialPost.url;
    }
    
    // Afficher le contenu généré dans la zone de contenu
    document.getElementById('social-content').value = content;
    
    // Afficher une notification de succès
    showNotification('Post généré avec succès !', 'success');
}

// Sauvegarder le post
function saveSocialPost() {
    // Récupérer les valeurs des champs
    currentSocialPost = {
        platform: document.getElementById('social-platform').value,
        type: document.getElementById('post-type').value,
        content: document.getElementById('social-content').value,
        hashtags: document.getElementById('social-hashtags').value,
        cta: document.getElementById('social-cta').value,
        url: document.getElementById('social-url').value,
        personalization: document.getElementById('social-personalization').checked,
        tone: document.getElementById('social-tone').value,
        length: document.getElementById('social-length').value
    };
    
    // Envoyer les données au serveur pour l'enregistrement
    fetch('/api/social-posts', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(currentSocialPost)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Post enregistré avec succès !', 'success');
            
            // Fermer le modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('social-post-modal'));
            modal.hide();
        } else {
            showNotification('Erreur lors de l\'enregistrement du post', 'danger');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        showNotification('Erreur lors de l\'enregistrement du post', 'danger');
    });
}

// Afficher le modal pour créer un post
function showSocialPostModal() {
    // Réinitialiser les champs
    document.getElementById('social-platform').value = currentSocialPost.platform;
    document.getElementById('post-type').value = currentSocialPost.type;
    document.getElementById('social-content').value = currentSocialPost.content;
    document.getElementById('social-hashtags').value = currentSocialPost.hashtags;
    document.getElementById('social-cta').value = currentSocialPost.cta;
    document.getElementById('social-url').value = currentSocialPost.url;
    document.getElementById('social-personalization').checked = currentSocialPost.personalization;
    document.getElementById('social-tone').value = currentSocialPost.tone;
    document.getElementById('social-length').value = currentSocialPost.length;
    
    // Afficher le modal
    const modal = new bootstrap.Modal(document.getElementById('social-post-modal'));
    modal.show();
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
@endsection