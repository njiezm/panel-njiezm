@extends('layouts.app')

@section('title', 'Générateur Instagram - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Générateur Instagram</li>
    </ol>
</nav>

<div class="card-custom">
    <h3 class="brand-font">5. Générateur de Posts Instagram</h3>
    <p class="small">Créez des posts Instagram attractifs avec des templates prédéfinis.</p>
    
    <div class="row mt-4">
        <div class="col-md-4">
            <h5>Type de post</h5>
            <div class="content-generator">
                <div class="content-template" onclick="selectInstagramTemplate('lifehack')">
                    <h6><i class="fas fa-lightbulb me-2"></i>Life Hack Tech</h6>
                    <p>Astuce informatique pour simplifier votre quotidien</p>
                </div>
                <div class="content-template" onclick="selectInstagramTemplate('techhack')">
                    <h6><i class="fas fa-code me-2"></i>Tech Hack</h6>
                    <p>Solution technique innovante pour un problème courant</p>
                </div>
                <div class="content-template" onclick="selectInstagramTemplate('promo')">
                    <h6><i class="fas fa-percentage me-2"></i>Promotion</h6>
                    <p>Annonce d'une offre spéciale ou d'une réduction</p>
                </div>
                <div class="content-template" onclick="selectInstagramTemplate('blackfriday')">
                    <h6><i class="fas fa-shopping-bag me-2"></i>Black Friday</h6>
                    <p>Offre exceptionnelle pour le Black Friday</p>
                </div>
                <div class="content-template" onclick="selectInstagramTemplate('exclusive')">
                    <h6><i class="fas fa-star me-2"></i>Offre Exclusive</h6>
                    <p>Avantage réservé à nos abonnés</p>
                </div>
                <div class="content-template" onclick="selectInstagramTemplate('testimonial')">
                    <h6><i class="fas fa-quote-right me-2"></i>Témoignage</h6>
                    <p>Mise en avant d'un avis client positif</p>
                </div>
                <div class="content-template" onclick="selectInstagramTemplate('beforeafter')">
                    <h6><i class="fas fa-exchange-alt me-2"></i>Avant/Après</h6>
                    <p>Comparaison avant et après votre intervention</p>
                </div>
                <div class="content-template" onclick="selectInstagramTemplate('behindthescenes')">
                    <h6><i class="fas fa-eye me-2"></i>Coulisses</h6>
                    <p>Un aperçu de votre processus de travail</p>
                </div>
                <div class="content-template" onclick="selectInstagramTemplate('news')">
                    <h6><i class="fas fa-newspaper me-2"></i>Actualité</h6>
                    <p>Partage d'une nouveauté dans votre secteur</p>
                </div>
                <div class="content-template" onclick="selectInstagramTemplate('storytelling')">
                    <h6><i class="fas fa-book me-2"></i>Récit</h6>
                    <p>Histoire inspirante ou divertissante</p>
                </div>
                <div class="content-template" onclick="selectInstagramTemplate('mythbuster')">
                    <h6><i class="fas fa-search me-2"></i>Démystification</h6>
                    <p>Buster les mythes courants du secteur</p>
                </div>
                <div class="content-template" onclick="selectInstagramTemplate('reality')">
                    <h6><i class="fas fa-chart-line me-2"></i>Réalité</h6>
                    <p>Analyse d'une tendance ou d'une nouveauté du secteur</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <h5>Aperçu du post</h5>
            <div class="instagram-post" id="instagram-preview">
                <div class="instagram-header">
                    <div class="instagram-avatar">NJ</div>
                    <div class="instagram-username">njiezm.fr</div>
                </div>
                <div class="gray-placeholder" style="height: 400px; background: #f0f0f0; border: 1px dashed #ccc; display: flex; align-items: center; justify-content: center; flex-direction: column;">
                    <i class="fas fa-image" style="font-size: 48px; color: #ccc;"></i>
                    <span style="color: #999; margin-top: 10px;">1080 × 1080px</span>
                </div>
                <div class="instagram-actions">
                    <button class="instagram-action-btn"><i class="far fa-heart"></i></button>
                    <button class="instagram-action-btn"><i class="far fa-comment"></i></button>
                    <button class="instagram-action-btn"><i class="far fa-paper-plane"></i></button>
                    <button class="instagram-action-btn"><i class="far fa-bookmark"></i></button>
                </div>
                <div class="instagram-caption">
                    <strong>njiezm.fr</strong> <span id="instagram-caption-text">Sélectionnez un type de post pour générer le contenu...</span>
                    <div class="mt-2">
                        <span class="tag">#tech</span>
                        <span class="tag">#digital</span>
                        <span class="tag">#njiezm</span>
                    </div>
                </div>
            </div>
            
            <div class="mt-3">
                <h5>Personnalisation</h5>
                <div class="mb-3">
                    <label class="form-label">Format</label>
                    <select class="form-select" id="instagram-format">
                        <option value="square">Carré (1080x1080)</option>
                        <option value="reels">Reels (1080x1920)</option>
                        <option value="story">Story (1080x1920)</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Image de fond</label>
                    <div class="drop-zone" id="instagram-image-drop">
                        <i class="fas fa-cloud-upload-alt mb-2"></i>
                        <p>Glissez une image ici</p>
                        <button class="btn btn-sm btn-outline-primary">PARCOURIR</button>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Texte personnalisé</label>
                    <textarea class="form-control" rows="3" id="instagram-custom-text" placeholder="Ajoutez votre texte personnalisé..."></textarea>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Hashtags</label>
                    <input type="text" class="form-control" id="instagram-hashtags" placeholder="#tech #digital #njiezm">
                </div>
                
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="instagram-personalization">
                        <label class="form-check-label" for="instagram-personalization">
                            Activer la personnalisation (nom du destinataire)
                        </label>
                    </div>
                </div>
                
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="instagram-comments">
                        <label class="form-check-label" for="instagram-comments">
                            Activer les commentaires
                        </label>
                    </div>
                </div>
                
                <button class="btn btn-primary w-100" onclick="generateInstagramPost()">GÉNÉRER LE POST</button>
                <button class="btn btn-outline-primary w-100 mt-2" onclick="saveInstagramPost()">ENREGISTRER</button>
                <button class="btn btn-outline-primary w-100 mt-2" onclick="exportInstagramPost()">EXPORTER EN HTML</button>
            </div>
        </div>
    </div>
</div>

<!-- Canvas pour l'exportation -->
<canvas id="instagram-canvas" style="display: none;"></canvas>

<script>
// Variables globales pour Instagram
let currentInstagramPost = {
    platform: 'instagram',
    type: 'lifehack',
    content: '',
    image: null,
    hashtags: '#tech #digital #njiezm',
    cta: '',
    url: '',
    personalization: false,
    tone: 'Professionnel',
    length: 'medium',
    format: 'square',
    date: null
};

// Sélectionner un type de post
function selectInstagramTemplate(type) {
    currentInstagramPost.type = type;
    
    // Mettre en évidence le type sélectionné
    document.querySelectorAll('.content-template').forEach(t => {
        t.classList.remove('border-primary');
        t.classList.add('border');
    });
    event.currentTarget.classList.remove('border');
    event.currentTarget.classList.add('border-primary');
    
    // Générer le contenu en fonction du type et du ton
    generateInstagramPost();
}

// Générer le contenu en fonction du type et du ton
function generateInstagramPost() {
    const format = document.getElementById('instagram-format').value;
    const customText = document.getElementById('instagram-custom-text').value;
    const hashtags = document.getElementById('instagram-hashtags').value;
    
    let content = '';
    
    if (currentInstagramPost.type === 'lifehack') {
        content = `💡 LIFE HACK TECH 💡\n\nSavez-vous que vous pouvez automatiser 80% de vos tâches répétitives avec quelques scripts simples ?\n\nVoici 3 astuces pour commencer :\n\n1. Utilisez des macros pour vos tâches bureautiques\n2. Créez des scripts pour vos sauvegardes automatiques\n3. Mettez en place des raccourcis clairs\n\nEssayez et dites-moi ce que vous en pensez !`;
    } else if (currentInstagramPost.type === 'techhack') {
        content = `🔧 TECH HACK 🔧\n\nCe petit changement dans vos paramètres peut accélérer votre productivité de 30% !\n\nVoici comment faire :\n\n1. Allez dans Paramètres > Clavier > Langue > Texte substitution\n2. Ajoutez la substitution : /s/votre-texte-par-défaut/ /votre-nouveau-texte\n\nEssayez et dites-moi ce que vous en pensez !`;
    } else if (currentInstagramPost.type === 'promo') {
        content = `🎉 OFFRE SPÉCIALE 🎉\n\nPendant 48h seulement, profitez de -20% sur tous nos services de développement !\n\nCode: BF2023`;
    } else if (currentInstagramPost.type === 'blackfriday') {
        content = `🛍 BLACK FRIDAY 🛍\n\nLe plus grand soldé de l'année !\n\nPour une durée limitée, profitez de -40% sur tous nos services.\n\nCode: BF2023`;
    } else if (currentInstagramPost.type === 'exclusive') {
        content = `⭐ OFFRE EXCLUSIVE ⭐\n\nExclusivement pour nos abonnés !\n\nCode: BF2023`;
    } else if (currentInstagramPost.type === 'testimonial') {
        content = `💬 TÉMOIGNAGE 💬\n\nMise en avant d'un avis client positif\n\nCode: BF2023`;
    } else if (currentInstagramPost.type === 'beforeafter') {
        content = `✨ AVANT/APRÈS ✨\n\nComparaison avant et après votre intervention\n\nCode: BF2023`;
    } else if (currentInstagramPost.type === 'news') {
        content = `📰 ACTUALITÉ 📰\n\nPartage d'une nouveauté dans votre secteur\n\nCode: BF2023`;
    } else if (currentInstagramPost.type === 'storytelling') {
        content = `📚 RÉCIT 📚\n\nHistoire inspirante ou divertissante\n\nCode: BF2023`;
    } else if (currentInstagramPost.type === 'reality') {
        content = `📊 RÉALITÉ 📊\n\nAnalyse d'une tendance ou d'une nouveauté du secteur\n\nCode: BF2023`;
    }
    
    // Ajouter les hashtags personnalisés si fournis
    if (hashtags) {
        content += '\n\n' + hashtags;
    }
    
    // Ajouter le texte personnalisé si fourni
    if (customText) {
        content += '\n\n' + customText;
    }
    
    // Ajouter le CTA si fourni
    if (currentInstagramPost.cta) {
        content += '\n\n👉 ' + currentInstagramPost.cta;
    }
    
    // Ajouter l'URL de destination si fourni
    if (currentInstagramPost.url) {
        content += '\n\n👉 ' + currentInstagramPost.url;
    }
    
    // Afficher le contenu généré dans la zone de contenu
    document.getElementById('instagram-caption-text').textContent = content;
    
    // Afficher une notification de succès
    showNotification('Post Instagram généré avec succès !', 'success');
}

// Sauvegarder le post
function saveInstagramPost() {
    // Récupérer les valeurs des champs
    currentInstagramPost = {
        platform: 'instagram',
        type: currentInstagramPost.type,
        content: document.getElementById('instagram-caption-text').textContent,
        hashtags: document.getElementById('instagram-hashtags').value,
        cta: currentInstagramPost.cta,
        url: currentInstagramPost.url,
        personalization: document.getElementById('instagram-personalization').checked,
        tone: currentInstagramPost.tone,
        length: currentInstagramPost.length,
        format: document.getElementById('instagram-format').value,
        image: currentInstagramPost.image
    };
    
    // Envoyer les données au serveur pour l'enregistrement
    fetch('/api/social-posts', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(currentInstagramPost)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Post Instagram enregistré avec succès !', 'success');
        } else {
            showNotification('Erreur lors de l\'enregistrement du post', 'danger');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        showNotification('Erreur lors de l\'enregistrement du post', 'danger');
    });
}

// Exporter le post Instagram
function exportInstagramPost() {
    const format = document.getElementById('instagram-format').value;
    
    // Définir les dimensions en fonction du format
    let width, height;
    
    if (format === 'square') {
        width = 1080;
        height = 1080;
    } else if (format === 'reels' || format === 'story') {
        width = 1080;
        height = 1920;
    }
    
    // Créer le canvas
    const canvas = document.getElementById('instagram-canvas');
    const ctx = canvas.getContext('2d');
    canvas.width = width;
    canvas.height = height;
    
    // Définir la couleur de fond
    ctx.fillStyle = '#FFFFFF';
    ctx.fillRect(0, 0, width, height);
    
    // Si une image est disponible, la dessiner
    if (currentInstagramPost.image) {
        const img = new Image();
        img.onload = function() {
            ctx.drawImage(img, 0, 0, width, height);
            
            // Télécharger l'image
            canvas.toBlob(function(blob) {
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `njiezm-instagram-${format}.jpg`;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                URL.revokeObjectURL(url);
            }, 'image/jpeg');
        };
        img.src = currentInstagramPost.image;
    } else {
        // Dessiner le logo par défaut
        ctx.font = "bold 64px 'Special Elite'";
        ctx.fillStyle = '#003366';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        
        ctx.fillText('NJIEZM', width / 2, height / 2 - 30);
        ctx.fillStyle = '#FFD700';
        ctx.fillText('.FR', width / 2, height / 2 + 10);
        
        // Télécharger le post
        canvas.toBlob(function(blob) {
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `njiezm-instagram-${format}.jpg`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
            
            // Afficher une notification de succès
            showNotification(`Post Instagram (${format}) téléchargé avec succès !`, 'success');
        }, 'image/jpeg');
    }
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

// Gestion du drag & drop pour les images
document.addEventListener('DOMContentLoaded', function() {
    const dropZone = document.getElementById('instagram-image-drop');
    
    if (dropZone) {
        // Événements de drag & drop
        dropZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('bg-light');
        });
        
        dropZone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('bg-light');
        });
        
        dropZone.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('bg-light');
            
            if (e.dataTransfer.files.length) {
                const file = e.dataTransfer.files[0];
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        currentInstagramPost.image = event.target.result;
                        
                        // Mettre à jour l'aperçu
                        const preview = document.querySelector('#instagram-preview .gray-placeholder');
                        preview.innerHTML = `<img src="${event.target.result}" alt="Aperçu" style="width: 100%; height: 100%; object-fit: cover;">`;
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
        
        // Clic sur le bouton "Parcourir"
        const browseBtn = dropZone.querySelector('button');
        browseBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.accept = 'image/*';
            fileInput.addEventListener('change', function() {
                if (this.files.length) {
                    const file = this.files[0];
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        currentInstagramPost.image = event.target.result;
                        
                        // Mettre à jour l'aperçu
                        const preview = document.querySelector('#instagram-preview .gray-placeholder');
                        preview.innerHTML = `<img src="${event.target.result}" alt="Aperçu" style="width: 100%; height: 100%; object-fit: cover;">`;
                    };
                    reader.readAsDataURL(file);
                }
            });
            fileInput.click();
        });
    }
});
</script>
@endsection