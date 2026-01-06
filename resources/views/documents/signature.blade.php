@extends('layouts.app')

@section('title', 'Signatures Numériques - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Signatures Numériques</li>
    </ol>
</nav>

<div class="card-custom">
    <h3 class="brand-font">10. Signatures Numériques</h3>
    <p class="small">Créez et gérez vos signatures numériques pour vos documents.</p>
    
    <ul class="nav nav-tabs tab-custom mt-3">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#signature-manual">Signature Manuscrite</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#signature-email">Signature Email</a>
        </li>
    </ul>
    
    <div class="tab-content mt-3">
        <!-- Onglet Signature Manuscrite -->
        <div class="tab-pane fade show active" id="signature-manual">
            <div class="row mt-4">
                <div class="col-md-6">
                    <h5>Créer votre signature</h5>
                    <div class="mb-3">
                        <label class="form-label">Méthode de création</label>
                        <div class="btn-group w-100" role="group">
                            <button type="button" class="btn btn-outline-primary active" onclick="setSignatureMethod('draw')">Dessiner</button>
                            <button type="button" class="btn btn-outline-primary" onclick="setSignatureMethod('upload')">Télécharger</button>
                            <button type="button" class="btn btn-outline-primary" onclick="setSignatureMethod('type')">Taper</button>
                        </div>
                    </div>
                    
                    <div id="draw-method" class="signature-method">
                        <div class="mb-3">
                            <label class="form-label">Dessinez votre signature</label>
                            <div class="canvas-container">
                                <canvas id="signature-canvas" width="500" height="200" style="border: 1px solid #ddd; border-radius: 4px; background: white; cursor: crosshair;"></canvas>
                            </div>
                            <div class="mt-2">
                                <button class="btn btn-sm btn-secondary" onclick="clearCanvas()">Effacer</button>
                                <button class="btn btn-sm btn-primary" onclick="saveSignature()">Enregistrer</button>
                            </div>
                        </div>
                    </div>
                    
                    <div id="upload-method" class="signature-method" style="display: none;">
                        <div class="mb-3">
                            <label class="form-label">Téléchargez votre signature</label>
                            <div class="drop-zone" id="signature-drop-zone">
                                <i class="fas fa-cloud-upload-alt fa-3x mb-2"></i>
                                <p>Glissez une image de votre signature ici</p>
                                <p class="small">Formats acceptés : PNG, JPG, GIF</p>
                                <button class="btn btn-sm btn-outline-primary">PARCOURIR</button>
                                <input type="file" id="signature-file-input" accept="image/*" style="display: none;">
                            </div>
                        </div>
                    </div>
                    
                    <div id="type-method" class="signature-method" style="display: none;">
                        <div class="mb-3">
                            <label class="form-label">Tapez votre signature</label>
                            <div class="mb-3">
                                <select class="form-select" id="signature-font">
                                    <option value="cursive">Cursif</option>
                                    <option value="serif">Serif</option>
                                    <option value="sans-serif">Sans-serif</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="signature-text" placeholder="Tapez votre nom ici">
                            </div>
                            <div class="canvas-container">
                                <canvas id="text-signature-canvas" width="500" height="200" style="border: 1px solid #ddd; border-radius: 4px; background: white;"></canvas>
                            </div>
                            <div class="mt-2">
                                <button class="btn btn-sm btn-secondary" onclick="clearTextCanvas()">Effacer</button>
                                <button class="btn btn-sm btn-primary" onclick="saveTextSignature()">Enregistrer</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Style de signature</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="signature-style" id="style-black" checked>
                                    <label class="form-check-label" for="style-black">Noir sur fond blanc</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="signature-style" id="style-blue">
                                    <label class="form-check-label" for="style-blue">Bleu sur fond blanc</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <h5>Aperçu de la signature</h5>
                    <div class="signature-preview">
                        <div class="signature-header">
                            <div class="company-name">NJIEZM.FR</div>
                            <div class="document-type">Document type</div>
                        </div>
                        <div class="signature-image" id="signature-preview-image">
                            <canvas id="preview-canvas" width="500" height="200" style="border: 1px solid #ddd; border-radius: 4px; background: white;"></canvas>
                        </div>
                        <div class="signature-footer">
                            <div class="signature-date">{{ now()->format('d/m/Y') }}</div>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <h5>Signatures enregistrées</h5>
                        <div class="saved-signatures" id="saved-signatures">
                            <div class="saved-signature-item">
                                <div class="signature-thumbnail">
                                    <canvas width="100" height="50" style="border: 1px solid #ddd; border-radius: 4px;"></canvas>
                                </div>
                                <div class="signature-info">
                                    <div class="signature-name">Signature par défaut</div>
                                    <div class="signature-date">{{ now()->format('d/m/Y') }}</div>
                                </div>
                                <div class="signature-actions">
                                    <button class="btn btn-sm btn-outline-primary" onclick="useSavedSignature(0)">Utiliser</button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="deleteSavedSignature(0)">Supprimer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Onglet Signature Email -->
        <div class="tab-pane fade" id="signature-email">
            <div class="row mt-4">
                <div class="col-md-6">
                    <h5>Configuration de la signature email</h5>
                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" class="form-control" id="email-name" placeholder="Votre nom">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Titre</label>
                        <input type="text" class="form-control" id="email-title" placeholder="Votre titre ou poste">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Entreprise</label>
                        <input type="text" class="form-control" id="email-company" value="NJIEZM.FR">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Téléphone</label>
                        <input type="text" class="form-control" id="email-phone" placeholder="+596 696 70 39 22">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" id="email-email" placeholder="votre.email@njiezm.fr">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Site web</label>
                        <input type="text" class="form-control" id="email-website" value="www.njiezm.fr">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Logo (optionnel)</label>
                        <div class="drop-zone" id="email-logo-drop">
                            <i class="fas fa-cloud-upload-alt fa-3x mb-2"></i>
                            <p>Glissez votre logo ici</p>
                            <p class="small">Formats acceptés : PNG, JPG, GIF</p>
                            <button class="btn btn-sm btn-outline-primary">PARCOURIR</button>
                            <input type="file" id="email-logo-input" accept="image/*" style="display: none;">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Signature</label>
                        <select class="form-select" id="email-signature-select">
                            <option value="default">Signature par défaut</option>
                        </select>
                    </div>
                    <button class="btn btn-primary w-100" onclick="generateEmailSignature()">GÉNÉRER LA SIGNATURE</button>
                </div>
                
                <div class="col-md-6">
                    <h5>Aperçu de la signature email</h5>
                    <div class="email-signature-preview">
                        <div class="email-signature-header">
                            <div class="email-signature-logo" id="email-signature-logo-preview">
                                <span style="font-family: 'Special Elite'; font-size: 1.2rem; color: var(--nj-blue);">NJIEZM<span style="color: var(--nj-yellow);">.FR</span></span>
                            </div>
                            <div class="email-signature-info">
                                <div class="email-signature-name" id="email-signature-name-preview">Votre nom</div>
                                <div class="email-signature-title" id="email-signature-title-preview">Votre titre ou poste</div>
                                <div class="email-signature-contact">
                                    <div class="email-signature-phone" id="email-signature-phone-preview">+596 696 70 39 22</div>
                                    <div class="email-signature-email" id="email-signature-email-preview">votre.email@njiezm.fr</div>
                                    <div class="email-signature-website" id="email-signature-website-preview">www.njiezm.fr</div>
                                </div>
                            </div>
                        </div>
                        <div class="email-signature-body">
                            <div class="email-signature-text" id="email-signature-text-preview">
                                Cordialement,<br><br>
                                [Votre nom]<br>
                                [Votre titre ou poste]<br>
                                <br>
                                [Message personnalisé optionnel]
                            </div>
                        </div>
                        <div class="email-signature-footer">
                            <div class="email-signature-image" id="email-signature-image-preview">
                                <canvas id="email-preview-canvas" width="500" height="100" style="border: 1px solid #ddd; border-radius: 4px; background: white;"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <div class="mb-3">
                            <label class="form-label">Message personnalisé (optionnel)</label>
                            <textarea class="form-control" id="email-custom-text" rows="3" placeholder="Ajoutez un message personnalisé à votre signature"></textarea>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="email-include-logo" checked>
                                <label class="form-check-label" for="email-include-logo">
                                    Inclure le logo
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="email-include-contact" checked>
                                <label class="form-check-label" for="email-include-contact">
                                    Inclure les coordonnées
                                </label>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100" onclick="updateEmailPreview()">METTRE À JOUR L'APERÇU</button>
                        <button class="btn btn-outline-primary w-100 mt-2">COPIER LE HTML</button>
                        <button class="btn btn-outline-primary w-100 mt-2">ENREGISTRER</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Variables globales pour les signatures
let currentSignatureMethod = 'draw';
let savedSignatures = [];
let currentSignature = null;

// Définir la méthode de création de signature
function setSignatureMethod(method) {
    currentSignatureMethod = method;
    
    // Masquer toutes les méthodes
    document.querySelectorAll('.signature-method').forEach(el => {
        el.style.display = 'none';
    });
    
    // Afficher la méthode sélectionnée
    document.getElementById(`${method}-method`).style.display = 'block';
    
    // Mettre à jour le bouton actif
    document.querySelectorAll('.btn-group button').forEach(btn => {
        btn.classList.remove('active');
    });
    event.target.classList.add('active');
}

// Canvas pour la signature dessinée
const canvas = document.getElementById('signature-canvas');
const ctx = canvas.getContext('2d');
let drawing = false;
let lastX = 0;
let lastY = 0;

// Initialiser le canvas
function initCanvas() {
    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mouseout', stopDrawing);
    
    // Support tactile
    canvas.addEventListener('touchstart', handleTouch);
    canvas.addEventListener('touchmove', handleTouch);
    canvas.addEventListener('touchend', stopDrawing);
}

// Commencer à dessiner
function startDrawing(e) {
    drawing = true;
    const rect = canvas.getBoundingClientRect();
    lastX = e.clientX - rect.left;
    lastY = e.clientY - rect.top;
}

// Dessiner
function draw(e) {
    if (!drawing) return;
    
    const rect = canvas.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    
    ctx.beginPath();
    ctx.moveTo(lastX, lastY);
    ctx.lineTo(x, y);
    ctx.strokeStyle = document.querySelector('input[name="signature-style"]:checked').value === 'style-blue' ? '#003366' : '#000000';
    ctx.lineWidth = 2;
    ctx.stroke();
    
    lastX = x;
    lastY = y;
}

// Arrêter de dessiner
function stopDrawing() {
    drawing = false;
}

// Gérer les événements tactiles
function handleTouch(e) {
    e.preventDefault();
    const touch = e.touches[0];
    const mouseEvent = new MouseEvent(e.type === 'touchstart' ? 'mousedown' : e.type === 'touchmove' ? 'mousemove' : 'mouseup', {
        clientX: touch.clientX,
        clientY: touch.clientY
    });
    canvas.dispatchEvent(mouseEvent);
}

// Effacer le canvas
function clearCanvas() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}

// Sauvegarder la signature
function saveSignature() {
    const imageData = canvas.toDataURL('image/png');
    currentSignature = imageData;
    
    // Ajouter aux signatures sauvegardées
    savedSignatures.push({
        id: Date.now(),
        data: imageData,
        date: new Date().toISOString(),
        method: currentSignatureMethod
    });
    
    // Mettre à jour l'aperçu
    updatePreview();
    
    // Mettre à jour la liste des signatures sauvegardées
    updateSavedSignaturesList();
    
    // Afficher une notification
    showNotification('Signature enregistrée avec succès !', 'success');
}

// Mettre à jour l'aperçu de la signature
function updatePreview() {
    const previewCanvas = document.getElementById('preview-canvas');
    const previewCtx = previewCanvas.getContext('2d');
    
    previewCanvas.width = 500;
    previewCanvas.height = 200;
    
    // Fond blanc
    previewCtx.fillStyle = '#FFFFFF';
    previewCtx.fillRect(0, 0, previewCanvas.width, previewCanvas.height);
    
    // Signature
    if (currentSignature) {
        const img = new Image();
        img.onload = function() {
            previewCtx.drawImage(img, 0, 0, previewCanvas.width, previewCanvas.height);
        };
        img.src = currentSignature;
    } else {
        // Texte par défaut
        previewCtx.font = 'italic 16px cursive';
        previewCtx.fillStyle = '#333333';
        previewCtx.fillText('Votre signature apparaîtra ici', 150, 100);
    }
}

// Mettre à jour la liste des signatures sauvegardées
function updateSavedSignaturesList() {
    const container = document.getElementById('saved-signatures');
    container.innerHTML = '';
    
    if (savedSignatures.length === 0) {
        container.innerHTML = '<p class="text-center text-muted">Aucune signature enregistrée</p>';
        return;
    }
    
    savedSignatures.forEach((signature, index) => {
        const item = document.createElement('div');
        item.className = 'saved-signature-item';
        
        // Canvas pour la miniature
        const thumbnail = document.createElement('canvas');
        thumbnail.width = 100;
        thumbnail.height = 50;
        const thumbnailCtx = thumbnail.getContext('2d');
        
        const img = new Image();
        img.onload = function() {
            thumbnailCtx.drawImage(img, 0, 0, thumbnail.width, thumbnail.height);
        };
        img.src = signature.data;
        
        // Informations sur la signature
        const info = document.createElement('div');
        info.className = 'signature-info';
        info.innerHTML = `
            <div class="signature-name">Signature ${index + 1}</div>
            <div class="signature-date">${new Date(signature.date).toLocaleDateString('fr-FR')}</div>
        `;
        
        // Actions
        const actions = document.createElement('div');
        actions.className = 'signature-actions';
        actions.innerHTML = `
            <button class="btn btn-sm btn-outline-primary" onclick="useSavedSignature(${index})">Utiliser</button>
            <button class="btn btn-sm btn-outline-danger" onclick="deleteSavedSignature(${index})">Supprimer</button>
        `;
        
        item.appendChild(thumbnail);
        item.appendChild(info);
        item.appendChild(actions);
        
        container.appendChild(item);
    });
}

// Utiliser une signature sauvegardée
function useSavedSignature(index) {
    currentSignature = savedSignatures[index].data;
    updatePreview();
    showNotification('Signature sélectionnée', 'info');
}

// Supprimer une signature sauvegardée
function deleteSavedSignature(index) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette signature ?')) {
        savedSignatures.splice(index, 1);
        updateSavedSignaturesList();
        showNotification('Signature supprimée', 'info');
    }
}

// Gérer le téléchargement de fichiers
document.getElementById('signature-drop-zone').addEventListener('click', function() {
    document.getElementById('signature-file-input').click();
});

document.getElementById('signature-file-input').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            const img = new Image();
            img.onload = function() {
                // Dessiner l'image sur le canvas
                canvas.width = 500;
                canvas.height = 200;
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                
                // Calculer les dimensions pour s'adapter au canvas
                const scale = Math.min(canvas.width / img.width, canvas.height / img.height);
                const width = img.width * scale;
                const height = img.height * scale;
                
                // Centrer l'image
                const x = (canvas.width - width) / 2;
                const y = (canvas.height - height) / 2;
                
                ctx.drawImage(img, x, y, width, height);
                
                // Sauvegarder l'image comme signature
                currentSignature = canvas.toDataURL('image/png');
                updatePreview();
                updateSavedSignaturesList();
                showNotification('Signature importée avec succès !', 'success');
            };
            img.src = event.target.result;
        };
        reader.readAsDataURL(file);
    }
});

// Gérer le glisser-déposer
const dropZone = document.getElementById('signature-drop-zone');

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
                const img = new Image();
                img.onload = function() {
                    // Dessiner l'image sur le canvas
                    canvas.width = 500;
                    canvas.height = 200;
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    
                    // Calculer les dimensions pour s'adapter au canvas
                    const scale = Math.min(canvas.width / img.width, canvas.height / img.height);
                    const width = img.width * scale;
                    const height = img.height * scale;
                    
                    // Centrer l'image
                    const x = (canvas.width - width) / 2;
                    const y = (canvas.height - height) / 2;
                    
                    ctx.drawImage(img, x, y, width, height);
                    
                    // Sauvegarder l'image comme signature
                    currentSignature = canvas.toDataURL('image/png');
                    updatePreview();
                    updateSavedSignaturesList();
                    showNotification('Signature importée avec succès !', 'success');
                };
                img.src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
});

// Canvas pour la signature textuelle
const textCanvas = document.getElementById('text-signature-canvas');
const textCtx = textCanvas.getContext('2d');

document.getElementById('signature-text').addEventListener('input', function() {
    updateTextSignature();
});

document.getElementById('signature-font').addEventListener('change', function() {
    updateTextSignature();
});

function updateTextSignature() {
    const text = document.getElementById('signature-text').value;
    const font = document.getElementById('signature-font').value;
    
    textCanvas.width = 500;
    textCanvas.height = 200;
    
    // Fond blanc
    textCtx.fillStyle = '#FFFFFF';
    textCtx.fillRect(0, 0, textCanvas.width, textCanvas.height);
    
    // Texte de la signature
    textCtx.font = `italic 24px ${font}`;
    textCtx.fillStyle = document.querySelector('input[name="signature-style"]:checked').value === 'style-blue' ? '#003366' : '#000000';
    textCtx.textAlign = 'center';
    textCtx.textBaseline = 'middle';
    
    // Diviser le texte en plusieurs lignes si nécessaire
    const lines = text.split(' ');
    const lineHeight = 30;
    const startY = textCanvas.height / 2 - (lines.length * lineHeight) / 2;
    
    lines.forEach((line, index) => {
        textCtx.fillText(line, textCanvas.width / 2, startY + (index * lineHeight));
    });
    
    // Sauvegarder comme signature
    currentSignature = textCanvas.toDataURL('image/png');
    updatePreview();
}

function clearTextCanvas() {
    document.getElementById('signature-text').value = '';
    updateTextSignature();
}

function saveTextSignature() {
    currentSignature = textCanvas.toDataURL('image/png');
    updatePreview();
    updateSavedSignaturesList();
    showNotification('Signature enregistrée avec succès !', 'success');
}

// Génération de signature email
function generateEmailSignature() {
    const name = document.getElementById('email-name').value || 'Votre nom';
    const title = document.getElementById('email-title').value || 'Votre titre';
    const company = document.getElementById('email-company').value || 'NJIEZM.FR';
    const phone = document.getElementById('email-phone').value || '+596 696 70 39 22';
    const email = document.getElementById('email-email').value || 'votre.email@njiezm.fr';
    const website = document.getElementById('email-website').value || 'www.njiezm.fr';
    const customText = document.getElementById('email-custom-text').value;
    const includeLogo = document.getElementById('email-include-logo').checked;
    const includeContact = document.getElementById('email-include-contact').checked;
    
    const previewCanvas = document.getElementById('email-preview-canvas');
    const previewCtx = previewCanvas.getContext('2d');
    
    previewCanvas.width = 500;
    previewCanvas.height = 300;
    
    // Fond blanc
    previewCtx.fillStyle = '#FFFFFF';
    previewCtx.fillRect(0, 0, previewCanvas.width, previewCanvas.height);
    
    let yPos = 30;
    
    // Logo si inclus
    if (includeLogo) {
        const logoElement = document.getElementById('email-signature-logo-preview');
        if (logoElement && logoElement.querySelector('span')) {
            const logoText = logoElement.querySelector('span').textContent;
            previewCtx.font = "bold 18px 'Special Elite'";
            previewCtx.fillStyle = '#003366';
            previewCtx.fillText(logoText, 30, yPos);
            yPos += 30;
        }
    }
    
    // Nom et titre
    previewCtx.font = "bold 16px Arial";
    previewCtx.fillStyle = '#333333';
    previewCtx.fillText(name, 30, yPos);
    yPos += 20;
    
    previewCtx.font = "14px Arial";
    previewCtx.fillStyle = '#666666';
    previewCtx.fillText(title, 30, yPos);
    yPos += 30;
    
    // Coordonnées si incluses
    if (includeContact) {
        previewCtx.font = "12px Arial";
        previewCtx.fillStyle = '#666666';
        previewCtx.fillText(phone, 30, yPos);
        yPos += 20;
        previewCtx.fillText(email, 30, yPos);
        yPos += 20;
        previewCtx.fillText(website, 30, yPos);
        yPos += 20;
    }
    
    // Ligne de séparation
    previewCtx.strokeStyle = '#DDDDDD';
    previewCtx.beginPath();
    previewCtx.moveTo(30, yPos);
    previewCtx.lineTo(470, yPos);
    previewCtx.stroke();
    yPos += 20;
    
    // Texte personnalisé
    if (customText) {
        previewCtx.font = "12px Arial";
        previewCtx.fillStyle = '#333333';
        
        // Diviser le texte en plusieurs lignes si nécessaire
        const lines = customText.split('\n');
        const lineHeight = 18;
        
        lines.forEach((line, index) => {
            previewCtx.fillText(line, 30, yPos + (index * lineHeight));
        });
        
        yPos += lines.length * lineHeight + 20;
    }
    
    // Signature
    if (currentSignature) {
        const img = new Image();
        img.onload = function() {
            // Redimensionner la signature pour s'adapter
            const scale = 0.5; // Ajuster selon vos besoins
            const width = img.width * scale;
            const height = img.height * scale;
            
            previewCtx.drawImage(img, 350, yPos, width, height);
        };
        img.src = currentSignature;
    } else {
        // Texte par défaut
        previewCtx.font = "italic 16px cursive";
        previewCtx.fillStyle = '#333333';
        previewCtx.textAlign = 'center';
        previewCtx.fillText('Votre signature apparaîtra ici', previewCanvas.width / 2, yPos + 50);
    }
    
    // Date
    previewCtx.font = "10px Arial";
    previewCtx.fillStyle = '#999999';
    previewCtx.textAlign = 'right';
    previewCtx.fillText(new Date().toLocaleDateString('fr-FR'), previewCanvas.width - 30, previewCanvas.height - 20);
    
    // Sauvegarder comme signature email
    currentSignature = previewCanvas.toDataURL('image/png');
    
    // Mettre à jour l'aperçu
    updateEmailPreview();
}

function updateEmailPreview() {
    const previewImage = document.getElementById('email-signature-image-preview');
    const previewCtx = previewImage.getContext('2d');
    
    previewImage.width = 500;
    previewImage.height = 100;
    
    // Fond blanc
    previewCtx.fillStyle = '#FFFFFF';
    previewCtx.fillRect(0, 0, previewImage.width, previewImage.height);
    
    // Signature
    if (currentSignature) {
        const img = new Image();
        img.onload = function() {
            previewCtx.drawImage(img, 0, 0, previewImage.width, previewImage.height);
        };
        img.src = currentSignature;
    } else {
        // Texte par défaut
        previewCtx.font = "italic 14px cursive";
        previewCtx.fillStyle = '#333333';
        previewCtx.textAlign = 'center';
        previewCtx.fillText('Votre signature apparaîtra ici', previewImage.width / 2, previewImage.height / 2);
    }
}

// Mettre à jour les aperçus
document.getElementById('email-name').addEventListener('input', updateEmailPreview);
document.getElementById('email-title').addEventListener('input', updateEmailPreview);
document.getElementById('email-company').addEventListener('input', updateEmailPreview);
document.getElementById('email-phone').addEventListener('input', updateEmailPreview);
document.getElementById('email-email').addEventListener('input', updateEmailPreview);
document.getElementById('email-website').addEventListener('input', updateEmailPreview);
document.getElementById('email-custom-text').addEventListener('input', updateEmailPreview);
document.getElementById('email-include-logo').addEventListener('change', updateEmailPreview);
document.getElementById('email-include-contact').addEventListener('change', updateEmailPreview);

// Gérer le téléchargement du logo email
document.getElementById('email-logo-drop').addEventListener('click', function() {
    document.getElementById('email-logo-input').click();
});

document.getElementById('email-logo-input').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            const img = new Image();
            img.onload = function() {
                // Mettre à jour l'aperçu du logo
                const logoPreview = document.getElementById('email-signature-logo-preview');
                logoPreview.innerHTML = `<span style="font-family: 'Special Elite'; font-size: 1.2rem; color: var(--nj-blue);">NJIEZM<span style="color: var(--nj-yellow);">.FR</span></span>`;
                
                // Mettre à jour l'aperçu complet
                updateEmailPreview();
            };
            img.src = event.target.result;
        };
        reader.readAsDataURL(file);
    }
});

// Gérer le glisser-déposer du logo email
const emailDropZone = document.getElementById('email-logo-drop');

emailDropZone.addEventListener('dragover', function(e) {
    e.preventDefault();
    this.classList.add('bg-light');
});

emailDropZone.addEventListener('dragleave', function(e) {
    e.preventDefault();
    this.classList.remove('bg-light');
});

emailDropZone.addEventListener('drop', function(e) {
    e.preventDefault();
    this.classList.remove('bg-light');
    
    if (e.dataTransfer.files.length) {
        const file = e.dataTransfer.files[0];
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const img = new Image();
                img.onload = function() {
                    // Mettre à jour l'aperçu du logo
                    const logoPreview = document.getElementById('email-signature-logo-preview');
                    logoPreview.innerHTML = `<span style="font-family: 'Special Elite'; font-size: 1.2rem; color: var(--nj-blue);">NJIEZM<span style="color: var(--nj-yellow);">.FR</span></span>`;
                    
                    // Mettre à jour l'aperçu complet
                    updateEmailPreview();
                };
                img.src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
});

// Copier le HTML de la signature email
function copyEmailSignatureHTML() {
    const emailSignatureHTML = document.getElementById('email-signature-preview').innerHTML;
    
    // Créer un élément temporaire pour copier le HTML
    const tempElement = document.createElement('textarea');
    tempElement.value = emailSignatureHTML;
    document.body.appendChild(tempElement);
    
    // Sélectionner et copier le texte
    tempElement.select();
    document.execCommand('copy');
    
    // Supprimer l'élément temporaire
    document.body.removeChild(tempElement);
    
    // Afficher une notification
    showNotification('HTML de la signature copié dans le presse-papiers', 'success');
}

// Initialiser les canvas au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    initCanvas();
    updatePreview();
    updateSavedSignaturesList();
});
</script>

<style>
.signature-preview {
    background: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.signature-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid #ddd;
}

.company-name {
    font-family: 'Special Elite', cursive;
    font-size: 1.2rem;
    color: var(--nj-blue);
}

.document-type {
    color: #666;
    font-size: 0.9rem;
}

.signature-image {
    margin: 20px 0;
    text-align: center;
}

.signature-footer {
    text-align: right;
    font-size: 0.8rem;
    color: #666;
}

.saved-signatures {
    margin-top: 20px;
}

.saved-signature-item {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.saved-signature-item:hover {
    background-color: #f8f9fa;
}

.signature-thumbnail {
    margin-right: 15px;
}

.signature-info {
    flex: 1;
}

.signature-name {
    font-weight: bold;
    font-size: 0.9rem;
}

.signature-date {
    font-size: 0.8rem;
    color: #666;
}

.signature-actions {
    display: flex;
    gap: 5px;
}

.email-signature-preview {
    background: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.email-signature-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid #ddd;
}

.email-signature-logo {
    font-family: 'Special Elite', cursive;
    font-size: 1.2rem;
    color: var(--nj-blue);
}

.email-signature-info {
    flex: 1;
}

.email-signature-name {
    font-weight: bold;
    font-size: 1rem;
}

.email-signature-title {
    font-size: 0.9rem;
    color: #666;
}

.email-signature-contact {
    font-size: 0.8rem;
    color: #666;
}

.email-signature-body {
    margin: 20px 0;
    padding: 15px;
    background-color: #f8f9fa;
    border-radius: 4px;
}

.email-signature-text {
    font-style: italic;
    line-height: 1.5;
}

.email-signature-footer {
    text-align: right;
    font-size: 0.8rem;
    color: #666;
}

.email-signature-image {
    margin: 20px 0;
    text-align: center;
}

.canvas-container {
    margin-bottom: 15px;
}

.drop-zone {
    border: 2px dashed #ccc;
    padding: 30px;
    text-align: center;
    background-color: #fafafa;
    cursor: pointer;
    transition: all 0.3s ease;
}

.drop-zone:hover {
    background-color: #f0f0f0;
    border-color: #aaa;
}

.drop-zone.active {
    background-color: #e6f7ff;
    border-color: var(--nj-blue);
}
</style>
@endsection