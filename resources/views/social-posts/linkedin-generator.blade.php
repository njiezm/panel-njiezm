@extends('layouts.app')

@section('title', 'Générateur LinkedIn - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Générateur LinkedIn</li>
    </ol>
</nav>

<div class="card-custom">
    <h3 class="brand-font">6. Générateur de Posts LinkedIn</h3>
    <p class="small">Créez des posts LinkedIn professionnels avec des templates prédéfinis.</p>
    
    <div class="row mt-4">
        <div class="col-md-4">
            <h5>Type de post</h5>
            <div class="content-generator">
                <div class="content-template" onclick="selectLinkedInTemplate('announcement')">
                    <h6><i class="fas fa-bullhorn me-2"></i>Annonce</h6>
                    <p>Partagez une nouvelle importante concernant votre entreprise</p>
                </div>
                <div class="content-template" onclick="selectLinkedInTemplate('insight')">
                    <h6><i class="fas fa-lightbulb me-2"></i>Insight</h6>
                    <p>Partagez une analyse ou une réflexion sur votre secteur</p>
                </div>
                <div class="content-template" onclick="selectLinkedInTemplate('achievement')">
                    <h6><i class="fas fa-trophy me-2"></i>Réalisation</h6>
                    <p>Célébrez un succès ou une réalisation importante</p>
                </div>
                <div class="content-template" onclick="selectLinkedInTemplate('question')">
                    <h6><i class="fas fa-question-circle me-2"></i>Question</h6>
                    <p>Engagez votre communauté avec une question pertinente</p>
                </div>
                <div class="content-template" onclick="selectLinkedInTemplate('case_study')">
                    <h6><i class="fas fa-briefcase me-2"></i>Étude de cas</h6>
                    <p>Présentez un projet réussi et ses résultats</p>
                </div>
                <div class="content-template" onclick="selectLinkedInTemplate('industry_news')">
                    <h6><i class="fas fa-newspaper me-2"></i>Actualité sectorielle</h6>
                    <p>Commentez une actualité pertinente pour votre secteur</p>
                </div>
                <div class="content-template" onclick="selectLinkedInTemplate('tutorial')">
                    <h6><i class="fas fa-graduation-cap me-2"></i>Tutoriel</h6>
                    <p>Partagez des connaissances ou des compétences</p>
                </div>
                <div class="content-template" onclick="selectLinkedInTemplate('recruitment')">
                    <h6><i class="fas fa-user-plus me-2"></i>Recrutement</h6>
                    <p>Annoncez une offre d'emploi ou une opportunité</p>
                </div>
                <div class="content-template" onclick="selectLinkedInTemplate('event')">
                    <h6><i class="fas fa-calendar-alt me-2"></i>Événement</h6>
                    <p>Invitez à un événement ou partagez les retours</p>
                </div>
                <div class="content-template" onclick="selectLinkedInTemplate('behind_scenes')">
                    <h6><i class="fas fa-eye me-2"></i>Coulisses</h6>
                    <p>Montrez les coulisses de votre entreprise</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <h5>Aperçu du post</h5>
            <div class="linkedin-post" id="linkedin-preview">
                <div class="linkedin-header">
                    <div class="linkedin-avatar">NJ</div>
                    <div class="linkedin-info">
                        <div class="linkedin-name">NJIEZM.FR</div>
                        <div class="linkedin-headline">Solutions Tech Innovantes</div>
                        <div class="linkedin-time">Il y a quelques minutes</div>
                    </div>
                    <button class="linkedin-follow-btn">Suivre</button>
                </div>
                <div class="linkedin-content">
                    <p id="linkedin-caption-text">Sélectionnez un type de post pour générer le contenu...</p>
                    <div class="gray-placeholder" style="height: 300px; background: #f0f0f0; border: 1px dashed #ccc; display: flex; align-items: center; justify-content: center; flex-direction: column;">
                        <i class="fas fa-image" style="font-size: 48px; color: #ccc;"></i>
                        <span style="color: #999; margin-top: 10px;">1200 × 627px</span>
                    </div>
                </div>
                <div class="linkedin-actions">
                    <button class="linkedin-action-btn"><i class="far fa-thumbs-up"></i> J'aime</button>
                    <button class="linkedin-action-btn"><i class="far fa-comment"></i> Commenter</button>
                    <button class="linkedin-action-btn"><i class="fas fa-share"></i> Partager</button>
                    <button class="linkedin-action-btn"><i class="fas fa-paper-plane"></i> Envoyer</button>
                </div>
            </div>
            
            <div class="mt-3">
                <h5>Personnalisation</h5>
                <div class="mb-3">
                    <label class="form-label">Image de fond</label>
                    <div class="drop-zone" id="linkedin-image-drop">
                        <i class="fas fa-cloud-upload-alt mb-2"></i>
                        <p>Glissez une image ici</p>
                        <button class="btn btn-sm btn-outline-primary">PARCOURIR</button>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Texte personnalisé</label>
                    <textarea class="form-control" rows="4" id="linkedin-custom-text" placeholder="Ajoutez votre texte personnalisé..."></textarea>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Hashtags</label>
                    <input type="text" class="form-control" id="linkedin-hashtags" placeholder="#tech #digital #njiezm">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Ton du message</label>
                    <select class="form-select" id="linkedin-tone">
                        <option value="professional">Professionnel</option>
                        <option value="inspirational">Inspirant</option>
                        <option value="educational">Éducatif</option>
                        <option value="conversational">Conversationnel</option>
                        <option value="promotional">Promotionnel</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Appel à l'action</label>
                    <input type="text" class="form-control" id="linkedin-cta" placeholder="Ex: Découvrez comment...">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">URL de destination</label>
                    <input type="url" class="form-control" id="linkedin-url" placeholder="https://www.njiezm.fr/destination">
                </div>
                
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="linkedin-comments">
                        <label class="form-check-label" for="linkedin-comments">
                            Activer les commentaires
                        </label>
                    </div>
                </div>
                
                <button class="btn btn-primary w-100" onclick="generateLinkedInPost()">GÉNÉRER LE POST</button>
                <button class="btn btn-outline-primary w-100 mt-2" onclick="saveLinkedInPost()">ENREGISTRER</button>
                <button class="btn btn-outline-primary w-100 mt-2" onclick="exportLinkedInPost()">EXPORTER EN HTML</button>
            </div>
        </div>
    </div>
</div>

<!-- Canvas pour l'exportation -->
<canvas id="linkedin-canvas" style="display: none;"></canvas>

<script>
// Variables globales pour LinkedIn
let currentLinkedInPost = {
    platform: 'linkedin',
    type: 'announcement',
    content: '',
    image: null,
    hashtags: '#tech #digital #njiezm',
    cta: '',
    url: '',
    tone: 'professional',
    comments: true
};

// Sélectionner un type de post
function selectLinkedInTemplate(type) {
    currentLinkedInPost.type = type;
    
    // Mettre en évidence le type sélectionné
    document.querySelectorAll('.content-template').forEach(t => {
        t.classList.remove('border-primary');
        t.classList.add('border');
    });
    event.currentTarget.classList.remove('border');
    event.currentTarget.classList.add('border-primary');
    
    // Générer le contenu en fonction du type et du ton
    generateLinkedInPost();
}

// Générer le contenu en fonction du type et du ton
function generateLinkedInPost() {
    const tone = document.getElementById('linkedin-tone').value;
    const customText = document.getElementById('linkedin-custom-text').value;
    const hashtags = document.getElementById('linkedin-hashtags').value;
    
    let content = '';
    
    if (currentLinkedInPost.type === 'announcement') {
        content = `📢 NOUVEAUTÉ CHEZ NJIEZM.FR 📢\n\nNous sommes ravis de vous annoncer le lancement de notre nouvelle solution de développement web sur mesure !\n\nCette plateforme révolutionnaire permettra à nos clients de :\n\n• Accélérer leur transformation digitale\n• Optimiser leurs processus métier\n• Améliorer leur expérience client\n\nNous croyons fermement que cette innovation changera la donne dans le secteur. N'hésitez pas à nous contacter pour en savoir plus !`;
    } else if (currentLinkedInPost.type === 'insight') {
        content = `💡 RÉFLEXION SUR L'AVENIR DU DÉVELOPPEMENT WEB 💡\n\nAprès avoir analysé les tendances actuelles du marché, j'observe 3 axes majeurs qui façonneront l'avenir du développement web :\n\n1. L'IA générative transformera la manière dont nous concevons et développons des applications\n2. L'approche "mobile-first" deviendra "AI-first" pour créer des expériences plus intelligentes\n3. La durabilité deviendra un critère essentiel dans le choix des technologies\n\nQu'en pensez-vous ? Quelles autres tendances observez-vous dans votre secteur ?`;
    } else if (currentLinkedInPost.type === 'achievement') {
        content = `🏆 NOUS SOMMES FIERS DE PARTAGER NOTRE RÉUSSITE ! 🏆\n\nCette semaine, notre équipe a atteint un jalon important : 100 projets livrés avec succès !\n\nCe succès est le fruit de :\n\n• L'engagement exceptionnel de notre équipe\n• La confiance de nos clients\n• Notre expertise technique reconnue\n\nJe tiens à remercier chaleureusement tous nos collaborateurs et clients pour leur contribution à cette réussite. Ensemble, nous continuons à innover !`;
    } else if (currentLinkedInPost.type === 'question') {
        content = `❓ QUESTION POUR LA COMMUNAUTÉ TECH ❓\n\nFace à l'évolution rapide des technologies web, comment faites-vous pour rester à jour ?\n\nPersonnellement, j'adopte une approche structurée :\n\n• 30 minutes de veille technologique chaque matin\n• Participation à des webinaires mensuels\n• Expérimentation régulière de nouveaux frameworks\n\nQuelles sont vos stratégies pour maintenir vos compétences à jour ? Partagez vos astuces dans les commentaires !`;
    } else if (currentLinkedInPost.type === 'case_study') {
        content = `📊 ÉTUDE DE CAS : OPTIMISATION D'UNE PLATEFORME E-COMMERCE 📊\n\nDéfi : Un client de l'e-commerce faisait face à un taux de conversion de seulement 1,2% et des temps de chargement de 4,5 secondes.\n\nNotre approche :\n\n• Audit complet de l'architecture existante\n• Mise en place d'un système de cache avancé\n• Optimisation des requêtes base de données\n• Refonte progressive de l'interface utilisateur\n\nRésultats après 3 mois :\n\n✅ Temps de chargement réduit à 1,2 seconde\n✅ Taux de conversion augmenté à 3,8%\n✅ Baisse du taux de rebond de 42%\n\nLa clé du succès : une approche méthodique et une collaboration étroite avec le client.`;
    } else if (currentLinkedInPost.type === 'industry_news') {
        content = `📰 RÉFLEXION SUR LA DERNIÈRE TENDANCE DU SECTEUR TECH 📰\n\nLa récente annonce concernant l'intégration de l'IA directement dans les navigateurs web soulève des questions intéressantes pour notre secteur.\n\nPoints clés à considérer :\n\n• Les implications en termes de sécurité et de confidentialité\n• Les nouvelles opportunités pour les développeurs web\n• L'impact sur l'expérience utilisateur\n\nSelon moi, cette évolution pourrait transformer radicalement notre approche du développement web. Quelles sont vos perspectives sur cette tendance ?`;
    } else if (currentLinkedInPost.type === 'tutorial') {
        content = `🎓 TUTORIEL : AMÉLIOREZ VOTRE PRODUCTIVITÉ AVEC CES ASTUCES DÉVELOPPEUR 🎓\n\nAujourd'hui, je partage 5 techniques qui ont transformé ma façon de travailler :\n\n1. Utilisez des snippets personnalisés pour accélérer votre codage\n2. Mettez en place des raccourcis clavier pour les actions répétitives\n3. Configurez des linters et formatters pour maintenir un code propre\n4. Adoptez la méthode Pomodoro pour une meilleure concentration\n5. Créez une documentation en parallèle du développement\n\nQuelles sont vos astuces pour être plus productif ? Partagez-les ci-dessous !`;
    } else if (currentLinkedInPost.type === 'recruitment') {
        content = `🔍 NOUS RECRUTONS ! REJOIGNEZ NOTRE ÉQUIPE INNOVANTE 🔍\n\nNJIEZM.FR cherche un(e) Développeur(se) Web Full Stack passionné(e) pour rejoindre notre équipe grandissante.\n\nProfil recherché :\n\n• Expérience confirmée avec JavaScript, React et Node.js\n• Connaissance des bonnes pratiques en matière de sécurité web\n• Esprit d'équipe et excellentes capacités de communication\n• Passion pour l'innovation technologique\n\nNous offrons :\n\n• Un environnement de travail stimulant\n• Des opportunités de formation continue\n• Une flexibilité dans l'organisation du travail\n• Une rémunération compétitive\n\nIntéressé(e) ? Envoyez votre CV à careers@njiezm.fr`;
    } else if (currentLinkedInPost.type === 'event') {
        content = `📅 ÉVÉNEMENT À NE PAS MANQUER ! 📅\n\nNous sommes ravis d'inviter notre communauté à notre prochain webinaire : "L'avenir du développement web dans un monde post-pandémique".\n\nDate : 15 juin 2023\nHeure : 14h00 - 15h30\nFormat : En ligne (gratuit)\n\nAu programme :\n\n• Tendances émergentes du développement web\n• Stratégies d'adaptation pour les entreprises\n• Retours d'expériences concrets\n• Session Q&R interactive\n\nRéservez votre place dès maintenant : https://njiezm.fr/webinaire\n\nPlaces limitées, ne manquez pas cette opportunité d'apprendre des experts du secteur !`;
    } else if (currentLinkedInPost.type === 'behind_scenes') {
        content = `🔭 DANS LES COULISSES DE NJIEZM.FR 🔭\n\nAujourd'hui, je vous emmène derrière les scènes de notre processus de développement agile.\n\nNotre journée type commence par :\n\n• 9h00 : Stand-up morning pour synchroniser l'équipe\n• 9h30 : Sessions de développement en mode "pair programming"\n• 12h00 : Déjeuner d'équipe (essentiel pour la cohésion !)\n• 14h00 : Revue de code collaborative\n• 16h00 : Session de "retrospective" pour améliorer continuellement\n\nCe qui me passionne le plus dans cette approche : la transparence, la collaboration et l'amélioration continue. C'est cette culture qui nous permet de livrer des solutions de qualité pour nos clients.`;
    }
    
    // Ajouter les hashtags personnalisés si fournis
    if (hashtags) {
        content += '\n\n' + hashtags;
    }
    
    // Ajouter le texte personnalisé si fournis
    if (customText) {
        content += '\n\n' + customText;
    }
    
    // Ajouter le CTA si fourni
    if (document.getElementById('linkedin-cta').value) {
        content += '\n\n👉 ' + document.getElementById('linkedin-cta').value;
    }
    
    // Ajouter l'URL de destination si fourni
    if (document.getElementById('linkedin-url').value) {
        content += '\n\n🔗 ' + document.getElementById('linkedin-url').value;
    }
    
    // Afficher le contenu généré dans la zone de contenu
    document.getElementById('linkedin-caption-text').textContent = content;
    
    // Afficher une notification de succès
    showNotification('Post LinkedIn généré avec succès !', 'success');
}

// Sauvegarder le post
function saveLinkedInPost() {
    // Récupérer les valeurs des champs
    currentLinkedInPost = {
        platform: 'linkedin',
        type: currentLinkedInPost.type,
        content: document.getElementById('linkedin-caption-text').textContent,
        hashtags: document.getElementById('linkedin-hashtags').value,
        cta: document.getElementById('linkedin-cta').value,
        url: document.getElementById('linkedin-url').value,
        tone: document.getElementById('linkedin-tone').value,
        comments: document.getElementById('linkedin-comments').checked,
        image: currentLinkedInPost.image
    };
    
    // Envoyer les données au serveur pour l'enregistrement
    fetch('/api/social-posts', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(currentLinkedInPost)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Post LinkedIn enregistré avec succès !', 'success');
        } else {
            showNotification('Erreur lors de l\'enregistrement du post', 'danger');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        showNotification('Erreur lors de l\'enregistrement du post', 'danger');
    });
}

// Exporter le post LinkedIn
function exportLinkedInPost() {
    // Créer le canvas
    const canvas = document.getElementById('linkedin-canvas');
    const ctx = canvas.getContext('2d');
    canvas.width = 1200;
    canvas.height = 627;
    
    // Définir la couleur de fond
    ctx.fillStyle = '#FFFFFF';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    
    // Si une image est disponible, la dessiner
    if (currentLinkedInPost.image) {
        const img = new Image();
        img.onload = function() {
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
            
            // Télécharger l'image
            canvas.toBlob(function(blob) {
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `njiezm-linkedin-post.jpg`;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                URL.revokeObjectURL(url);
            }, 'image/jpeg');
        };
        img.src = currentLinkedInPost.image;
    } else {
        // Dessiner le logo par défaut
        ctx.font = "bold 64px 'Special Elite'";
        ctx.fillStyle = '#003366';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        
        ctx.fillText('NJIEZM', canvas.width / 2, canvas.height / 2 - 30);
        ctx.fillStyle = '#FFD700';
        ctx.fillText('.FR', canvas.width / 2, canvas.height / 2 + 10);
        
        // Télécharger le post
        canvas.toBlob(function(blob) {
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `njiezm-linkedin-post.jpg`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
            
            // Afficher une notification de succès
            showNotification('Post LinkedIn téléchargé avec succès !', 'success');
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
    const dropZone = document.getElementById('linkedin-image-drop');
    
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
                        currentLinkedInPost.image = event.target.result;
                        
                        // Mettre à jour l'aperçu
                        const preview = document.querySelector('#linkedin-preview .gray-placeholder');
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
                        currentLinkedInPost.image = event.target.result;
                        
                        // Mettre à jour l'aperçu
                        const preview = document.querySelector('#linkedin-preview .gray-placeholder');
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