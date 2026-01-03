@extends('layouts.app')

@section('title', 'Déclinaisons Saisonnières - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Déclinaisons Saisonnières</li>
    </ol>
</nav>

<!-- SECTION DÉCLINAISONS SAISONNIÈRES -->
<section id="seasonal">
    <div class="card-custom">
        <h3 class="brand-font">3. Déclinaisons Saisonnières</h3>
        <p class="small">Adaptation automatique du logo pour les événements de l'année.</p>
        
        <div class="row mt-4">
            <div class="col-md-8">
                <div class="seasonal-grid">
                    <div class="seasonal-item" onclick="setSeasonal('Noël')" data-event="Noël" data-emoji="🎄">
                        <span>🎄</span>
                        <p>Noël</p>
                    </div>
                    <div class="seasonal-item" onclick="setSeasonal('Nouvel An')" data-event="Nouvel An" data-emoji="🥂">
                        <span>🥂</span>
                        <p>Nouvel An</p>
                    </div>
                    <div class="seasonal-item" onclick="setSeasonal('Carnaval')" data-event="Carnaval" data-emoji="🎭">
                        <span>🎭</span>
                        <p>Carnaval</p>
                    </div>
                    <div class="seasonal-item" onclick="setSeasonal('St Valentin')" data-event="St Valentin" data-emoji="❤️">
                        <span>❤️</span>
                        <p>St Valentin</p>
                    </div>
                    <div class="seasonal-item" onclick="setSeasonal('Abolition')" data-event="Abolition" data-emoji="🔗">
                        <span>🔗</span>
                        <p>22 Mai (Abolition)</p>
                    </div>
                    <div class="seasonal-item" onclick="setSeasonal('Halloween')" data-event="Halloween" data-emoji="🎃">
                        <span>🎃</span>
                        <p>Halloween</p>
                    </div>
                    <div class="seasonal-item" onclick="setSeasonal('Galette')" data-event="Galette" data-emoji="👑">
                        <span>👑</span>
                        <p>Galette des Rois</p>
                    </div>
                    <div class="seasonal-item" onclick="setSeasonal('Caresme')" data-event="Caresme" data-emoji="🕊️">
                        <span>🕊️</span>
                        <p>Carême</p>
                    </div>
                    <div class="seasonal-item" onclick="setSeasonal('Fête Nationale')" data-event="Fête Nationale" data-emoji="🇫🇷">
                        <span>🇫🇷</span>
                        <p>14 Juillet</p>
                    </div>
                    <div class="seasonal-item" onclick="setSeasonal('Pâques')" data-event="Pâques" data-emoji="🥄">
                        <span>🥄</span>
                        <p>Pâques</p>
                    </div>
                    <div class="seasonal-item" onclick="setSeasonal('Fête des Mères')" data-event="Fête des Mères" data-emoji="💐">
                        <span>💐</span>
                        <p>Fête des Mères</p>
                    </div>
                    <div class="seasonal-item" onclick="setSeasonal('Fête des Pères')" data-event="Fête des Pères" data-emoji="👔">
                        <span>👔</span>
                        <p>Fête des Pères</p>
                    </div>
                </div>
                <div id="seasonal-preview" class="mt-4 preview-box" style="background: var(--nj-blue); min-height: 200px;">
                    <div class="text-center">
                        <div id="preview-emoji" style="font-size: 4rem;">🎄</div>
                        <div style="font-family: 'Special Elite'; font-size: 2rem; color: var(--nj-yellow); margin-top: 10px;">NJIEZM<span style="color: white;">.FR</span></div>
                        <p class="text-white mt-2">Sélectionnez un événement</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h5>Paramètres</h5>
                <div class="mb-3">
                    <label class="form-label">Événement sélectionné</label>
                    <input type="text" class="form-control" id="selected-event" readonly>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Position de l'élément saisonnier</label>
                    <select class="form-select" id="element-position">
                        <option value="top">Au-dessus du logo</option>
                        <option value="left">À gauche du logo</option>
                        <option value="right">À droite du logo</option>
                        <option value="integrated">Intégré au logo</option>
                        <option value="bottom">En dessous du logo</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Taille de l'élément</label>
                    <input type="range" class="form-range" min="10" max="100" value="50" id="element-size">
                    <div class="d-flex justify-content-between">
                        <small>Petit</small>
                        <span id="size-value">50%</span>
                        <small>Grand</small>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Couleur de l'élément</label>
                    <input type="color" class="form-control form-control-color" value="#FFD700" id="element-color">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Texte personnalisé</label>
                    <input type="text" class="form-control" id="custom-text" placeholder="Texte optionnel (ex: Promotion -20%)">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Date d'activation</label>
                    <input type="date" class="form-control" id="activation-date">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Date de fin</label>
                    <input type="date" class="form-control" id="end-date">
                </div>
                
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="auto-activate">
                        <label class="form-check-label" for="auto-activate">
                            Activer automatiquement
                        </label>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Enregistrer comme modèle</label>
                    <input type="text" class="form-control" id="template-name" placeholder="Nom du modèle">
                </div>
                </div>
                
                <button class="btn btn-primary w-100" onclick="applySeasonalLogo()">APPLIQUER</button>
                <button class="btn btn-success w-100 mt-2" onclick="saveAsTemplate()">ENREGISTRER COMME MODÈLE</button>
                <button class="btn btn-outline-primary w-100 mt-2" onclick="scheduleActivation()">PROGRAMMER L'ACTIVATION</button>
                <button class="btn btn-outline-primary w-100 mt-2" onclick="exportSeasonalLogo()">TÉLÉCHARGER</button>
            </div>
        </div>
    </div>
</section>

<!-- Modal pour enregistrer comme modèle -->
<div class="modal fade" id="templateModal" tabindex="-1" aria-labelledby="templateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="templateModalLabel">Enregistrer comme modèle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="template-name-modal" class="form-label">Nom du modèle</label>
                    <input type="text" class="form-control" id="template-name-modal">
                </div>
                <div class="mb-3">
                    <label for="template-description-modal" class="form-label">Description</label>
                    <textarea class="form-control" id="template-description-modal" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="saveTemplateModal()">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<!-- Canvas pour l'exportation -->
<canvas id="export-canvas" style="display: none;"></canvas>

<script>
let currentEvent = '';
let currentEmoji = '';
let seasonalLogos = [];

// Mettre à jour l'affichage de la taille
document.getElementById('element-size').addEventListener('input', function() {
    document.getElementById('size-value').textContent = this.value + '%';
});

// Sélectionner un événement saisonnier
function setSeasonal(element) {
    const eventElement = element.currentTarget;
    const eventName = eventElement.dataset.event;
    const emoji = eventElement.dataset.emoji;
    
    // Mettre à jour l'événement sélectionné
    currentEvent = eventName;
    currentEmoji = emoji;
    
    // Mettre à jour le champ de texte
    document.getElementById('selected-event').value = eventName;
    
    // Mettre à jour l'aperçu
    updatePreview();
    
    // Mettre en évidence l'élément sélectionné
    document.querySelectorAll('.seasonal-item').forEach(item => {
        item.classList.remove('active');
    });
    eventElement.classList.add('active');
}

// Mettre à jour l'aperçu
function updatePreview() {
    const preview = document.getElementById('seasonal-preview');
    const elementPosition = document.getElementById('element-position').value;
    const elementSize = document.getElementById('element-size').value;
    const elementColor = document.getElementById('element-color').value;
    const customText = document.getElementById('custom-text').value;
    
    // Définir les dimensions
    const width = 600;
    const height = 300;
    
    // Créer le canvas
    const canvas = document.getElementById('export-canvas');
    const ctx = canvas.getContext('2d');
    canvas.width = width;
    canvas.height = height;
    
    // Définir la couleur de fond
    ctx.fillStyle = '#003366';
    ctx.fillRect(0, 0, width, height);
    
    // Déterminer la position de l'élément saisonnier
    let elementX, elementY, textX, textY;
    
    if (elementPosition === 'top') {
        elementX = width / 2;
        elementY = 50;
        textX = width / 2;
        textY = elementY + parseInt(elementSize) + 20;
    } else if (elementPosition === 'left') {
        elementX = 50;
        elementY = height / 2;
        textX = elementX + parseInt(elementSize) + 20;
        textY = height / 2;
    } else if (elementPosition === 'right') {
        elementX = width - 50;
        elementY = height / 2;
        textX = elementX - parseInt(elementSize) - 20;
        textY = height / 2;
    } else if (elementPosition === 'bottom') {
        elementX = width / 2;
        elementY = height - 50;
        textX = width / 2;
        textY = elementY - parseInt(elementSize) - 20;
    } else if (elementPosition === 'integrated') {
        elementX = width / 2;
        elementY = height / 2;
        textX = width / 2;
        textY = height / 2;
    }
    
    // Dessiner l'élément saisonnier
    ctx.font = `${elementSize}px FontAwesome`;
    ctx.fillStyle = elementColor;
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    
    // Simuler l'icône avec un cercle
    ctx.beginPath();
    ctx.arc(elementX, elementY, elementSize / 2, 0, 2 * Math.PI);
    ctx.fill();
    
    // Dessiner le texte du logo
    ctx.font = "bold 32px 'Special Elite'";
    ctx.fillStyle = '#FFFFFF';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    
    if (elementPosition === 'integrated') {
        // Pour la position intégrée, le texte est centré
        ctx.fillText('NJIEZM', width / 2, height / 2 - 10);
        ctx.fillStyle = '#FFD700';
        ctx.fillText('.FR', width / 2, height / 2 + 10);
    } else {
        // Pour les autres positions, le texte est à côté de l'élément
        ctx.font = "bold 32px 'Special Elite'";
        ctx.fillStyle = '#FFFFFF';
        ctx.textAlign = elementPosition === 'left' ? 'left' : 'right';
        ctx.textBaseline = 'middle';
        
        if (elementPosition === 'left') {
            ctx.fillText('NJIEZM', textX, textY);
            ctx.fillStyle = '#FFD700';
            ctx.fillText('.FR', textX + 100, textY);
        } else if (elementPosition === 'right') {
            ctx.fillText('NJIEZM', textX, textY);
            ctx.fillStyle = '#FFD700';
            ctx.fillText('.FR', textX - 100, textY);
        } else if (elementPosition === 'top') {
            ctx.fillText('NJIEZM', textX, textY);
            ctx.fillStyle = '#FFD700';
            ctx.fillText('.FR', textX, textY + 30);
        } else if (elementPosition === 'bottom') {
            ctx.fillText('NJIEZM', textX, textY);
            ctx.fillStyle = '#FFD700';
            ctx.fillText('.FR', textX, textY - 30);
        }
    }
    
    // Ajouter le texte personnalisé si fourni
    if (customText) {
        ctx.font = "14px 'Space Grotesk'";
        ctx.fillStyle = '#FFFFFF';
        ctx.textAlign = 'center';
        ctx.fillText(customText, width / 2, height - 30);
    }
    
    // Afficher l'emoji dans l'aperçu
    const previewEmoji = document.getElementById('preview-emoji');
    if (previewEmoji) {
        previewEmoji.style.fontSize = '4rem';
        previewEmoji.textContent = currentEmoji;
    }
}

// Appliquer les paramètres saisonniers au logo
function applySeasonalLogo() {
    const elementPosition = document.getElementById('element-position').value;
    const elementSize = document.getElementById('element-size').value;
    const elementColor = document.getElementById('element-color').value;
    const customText = document.getElementById('custom-text').value;
    
    // Sauvegarder les paramètres pour une utilisation future
    const seasonalConfig = {
        event: currentEvent,
        emoji: currentEmoji,
        position: elementPosition,
        size: elementSize,
        color: elementColor,
        customText: customText
    };
    
    // Ajouter à la liste des logos saisonniers
    seasonalLogos.push(seasonalConfig);
    
    // Limiter à 10 logos saisonniers
    if (seasonalLogos.length > 10) {
        seasonalLogos.shift();
    }
    
    // Mettre à jour l'aperçu
    updatePreview();
    
    // Afficher une notification de succès
    showNotification('Paramètres saisonniers appliqués avec succès !', 'success');
}

// Enregistrer comme modèle
function saveAsTemplate() {
    const templateName = document.getElementById('template-name').value;
    
    if (!templateName) {
        showNotification('Veuillez entrer un nom pour le modèle', 'warning');
        return;
    }
    
    // Afficher le modal
    const templateModal = new bootstrap.Modal(document.getElementById('templateModal'));
    templateModal.show();
}

// Enregistrer le modèle
function saveTemplateModal() {
    const templateName = document.getElementById('template-name-modal').value;
    const templateDescription = document.getElementById('template-description-modal').value;
    
    // Récupérer la configuration actuelle
    const templateConfig = {
        name: templateName,
        description: templateDescription,
        event: currentEvent,
        emoji: currentEmoji,
        position: document.getElementById('element-position').value,
        size: document.getElementById('element-size').value,
        color: document.getElementById('element-color').value,
        customText: document.getElementById('custom-text').value
    };
    
    // Envoyer la configuration au serveur pour l'enregistrement
    fetch('/api/seasonal-templates', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(templateConfig)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Modèle enregistré avec succès !', 'success');
            
            // Fermer le modal
            const templateModal = bootstrap.Modal.getInstance(document.getElementById('templateModal'));
            templateModal.hide();
        } else {
            showNotification('Erreur lors de l\'enregistrement du modèle', 'danger');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        showNotification('Erreur lors de l\'enregistrement du modèle', 'danger');
    });
}

// Programmer l'activation automatique
function scheduleActivation() {
    const activationDate = document.getElementById('activation-date').value;
    const endDate = document.getElementById('end-date').value;
    const autoActivate = document.getElementById('auto-activate').checked;
    
    if (!activationDate) {
        showNotification('Veuillez sélectionner une date d\'activation', 'warning');
        return;
    }
    
    if (!endDate) {
        showNotification('Veuillez sélectionner une date de fin', 'warning');
        return;
    }
    
    // Envoyer les dates au serveur pour la programmation
    fetch('/api/seasonal-activation', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            activation_date: activationDate,
            end_date: endDate,
            auto_activate: autoActivate,
            event: currentEvent,
            position: document.getElementById('element-position').value,
            size: document.getElementById('element-size').value,
            color: document.getElementById('element-color').value,
            custom_text: document.getElementById('custom-text').value
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Activation programmée avec succès !', 'success');
        } else {
            showNotification('Erreur lors de la programmation de l\'activation', 'danger');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        showNotification('Erreur lors de la programmation de l\'activation', 'danger');
    });
}

// Exporter le logo saisonnier
function exportSeasonalLogo() {
    const elementPosition = document.getElementById('element-position').value;
    const elementSize = document.getElementById('element-size').value;
    const elementColor = document.getElementById('element-color').value;
    const customText = document.getElementById('custom-text').value;
    const bgColor = '#003366';
    
    // Définir les dimensions
    const width = 800;
    const height = 400;
    
    // Créer le canvas
    const canvas = document.getElementById('export-canvas');
    const ctx = canvas.getContext('2d');
    canvas.width = width;
    canvas.height = height;
    
    // Définir la couleur de fond
    ctx.fillStyle = bgColor;
    ctx.fillRect(0, 0, width, height);
    
    // Déterminer la position de l'élément saisonnier
    let elementX, elementY, textX, textY;
    
    if (elementPosition === 'top') {
        elementX = width / 2;
        elementY = 50;
        textX = width / 2;
        textY = elementY + parseInt(elementSize) + 20;
    } else if (elementPosition === 'left') {
        elementX = 50;
        elementY = height / 2;
        textX = elementX + parseInt(elementSize) + 20;
        textY = height / 2;
    } else if (elementPosition === 'right') {
        elementX = width - 50;
        elementY = height / 2;
        textX = elementX - parseInt(elementSize) - 20;
        textY = height / 2;
    } else if (elementPosition === 'bottom') {
        elementX = width / 2;
        elementY = height - 50;
        textX = width / 2;
        textY = elementY - parseInt(elementSize) - 20;
    } else if (elementPosition === 'integrated') {
        elementX = width / 2;
        elementY = height / 2;
        textX = width / 2;
        textY = height / 2;
    }
    
    // Dessiner l'élément saisonnier
    ctx.font = `${elementSize}px FontAwesome`;
    ctx.fillStyle = elementColor;
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    
    // Simuler l'icône avec un cercle
    ctx.beginPath();
    ctx.arc(elementX, elementY, elementSize / 2, 0, 2 * Math.PI);
    ctx.fill();
    
    // Dessiner le texte du logo
    ctx.font = "bold 32px 'Special Elite'";
    ctx.fillStyle = '#FFFFFF';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    
    if (elementPosition === 'integrated') {
        // Pour la position intégrée, le texte est centré
        ctx.fillText('NJIEZM', width / 2, height / 2 - 10);
        ctx.fillStyle = '#FFD700';
        ctx.fillText('.FR', width / 2, height / 2 + 10);
    } else {
        // Pour les autres positions, le texte est à côté de l'élément
        ctx.font = "bold 32px 'Special Elite'";
        ctx.fillStyle = '#FFFFFF';
        ctx.textAlign = elementPosition === 'left' ? 'left' : 'right';
        ctx.textBaseline = 'middle';
        
        if (elementPosition === 'left') {
            ctx.fillText('NJIEZM', textX, textY);
            ctx.fillStyle = '#FFD700';
            ctx.fillText('.FR', textX + 100, textY);
        } else if (elementPosition === 'right') {
            ctx.fillText('NJIEZM', textX, textY);
            ctx.fillStyle = '#FFD700';
            ctx.fillText('.FR', textX - 100, textY);
        } else if (elementPosition === 'top') {
            ctx.fillText('NJIEZM', textX, textY);
            ctx.fillStyle = '#FFD700';
            ctx.fillText('.FR', textX, textY + 30);
        } else if (elementPosition === 'bottom') {
            ctx.fillText('NJIEZM', textX, textY);
            ctx.fillStyle = '#FFD700';
            ctx.fillText('.FR', textX, textY - 30);
        }
    }
    
    // Ajouter le texte personnalisé si fourni
    if (customText) {
        ctx.font = "14px 'Space Grotesk'";
        ctx.fillStyle = '#FFFFFF';
        ctx.textAlign = 'center';
        ctx.fillText(customText, width / 2, height - 30);
    }
    
    // Ajouter l'emoji dans le coin inférieur droit
    ctx.font = "20px Arial";
    ctx.fillStyle = '#FFD700';
    ctx.textAlign = 'right';
    ctx.textBaseline = 'bottom';
    ctx.fillText(currentEmoji, width - 20, height - 20);
    
    // Télécharger le logo
    canvas.toBlob(function(blob) {
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = `njiezm-${currentEvent.toLowerCase().replace(/\s+/g, '-')}.png`;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
        
        // Afficher une notification de succès
        showNotification(`Logo saisonnier (${currentEvent}) téléchargé avec succès !`, 'success');
    }, 'image/png');
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

// Initialiser l'aperçu au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    updatePreview();
});
</script>
@endsection