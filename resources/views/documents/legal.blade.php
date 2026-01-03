@extends('layouts.app')

@section('title', 'Générateur Juridique - NJIEZM.FR')

@section('content')
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Générateur Juridique</li>
    </ol>
</nav>

<div class="card-custom">
    <h3 class="brand-font">9. Générateur Juridique</h3>
    <p class="small">Générez vos contrats et statuts juridiques avec des modèles prédéfinis.</p>
    
    <div class="row mt-4">
        <div class="col-md-4">
            <h5>Type de document</h5>
            <div class="content-generator">
                <div class="content-template" onclick="selectLegalTemplate('contract')">
                    <h6><i class="fas fa-handshake me-2"></i>Contrat de Prestation</h6>
                    <p>Document formalisant une relation commerciale entre deux parties</p>
                </div>
                <div class="content-template" onclick="selectLegalTemplate('nda')">
                    <h6><i class="fas fa-shield-alt me-2"></i>Accord de Confidentialité</h6>
                    <p>Protégez vos informations sensibles avec cet accord de non-divulgation</p>
                </div>
                <div class="content-template" onclick="selectLegalTemplate('status')">
                    <h6><i class="fas fa-building me-2"></i>Statuts de l'Entreprise</h6>
                    <p>Document officiel définissant les règles de fonctionnement d'une entreprise</p>
                </div>
                <div class="content-template" onclick="selectLegalTemplate('terms')">
                    <h6><i class="fas fa-file-contract me-2"></i>Conditions Générales de Vente</h6>
                    <p>Règles régissant la vente de vos produits ou services</p>
                </div>
                <div class="content-template" onclick="selectLegalTemplate('privacy')">
                    <h6><i class="fas fa-user-shield me-2"></i>Politique de Confidentialité</h6>
                    <p>Informez vos clients sur la collecte et l'utilisation de leurs données</p>
                </div>
                <div class="content-template" onclick="selectLegalTemplate('partnership')">
                    <h6><i class="fas fa-users me-2"></i>Contrat de Partenariat</h6>
                    <p>Formalisez une collaboration avec un autre partenaire commercial</p>
                </div>
                <div class="content-template" onclick="selectLegalTemplate('employment')">
                    <h6><i class="fas fa-user-tie me-2"></i>Contrat de Travail</h6>
                    <p>Définissez les conditions d'embauche et de travail pour vos employés</p>
                </div>
                <div class="content-template" onclick="selectLegalTemplate('lease')">
                    <h6><i class="fas fa-home me-2"></i>Bail Commercial</h6>
                    <p>Document pour la location d'un local à usage commercial</p>
                </div>
                <div class="content-template" onclick="selectLegalTemplate('loan')">
                    <h6><i class="fas fa-money-bill-wave me-2"></i>Contrat de Prêt</h6>
                    <p>Formalisez un prêt d'argent entre un prêteur et un emprunteur</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <h5>Aperçu du document</h5>
            <div class="document-preview" id="legal-preview">
                <div class="document-header">
                    <div class="document-logo">
                        <span style="font-family: 'Special Elite'; font-size: 1.5rem; color: var(--nj-blue);">NJIEZM<span style="color: var(--nj-yellow);">.FR</span></span>
                    </div>
                    <div class="document-type" id="document-type-display">
                        <h4>Sélectionnez un type de document</h4>
                    </div>
                </div>
                <div class="document-content" id="legal-content">
                    <p>Sélectionnez un type de document pour générer le contenu...</p>
                </div>
                <div class="document-footer">
                    <div class="document-signatures">
                        <div class="signature-box">
                            <p>Signature du prestataire</p>
                            <div class="signature-line"></div>
                            <p>NJIEZM.FR</p>
                        </div>
                        <div class="signature-box">
                            <p>Signature du client</p>
                            <div class="signature-line"></div>
                            <p>Nom du client</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-3">
                <h5>Personnalisation</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Partie 1</label>
                            <input type="text" class="form-control" id="party1-name" placeholder="Nom de l'entreprise ou personne">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="party1-address" placeholder="Adresse complète">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Représenté par</label>
                            <input type="text" class="form-control" id="party1-representative" placeholder="Nom du représentant">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Partie 2</label>
                            <input type="text" class="form-control" id="party2-name" placeholder="Nom du client ou partenaire">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="party2-address" placeholder="Adresse complète">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Représenté par</label>
                            <input type="text" class="form-control" id="party2-representative" placeholder="Nom du représentant">
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Objet du contrat</label>
                    <input type="text" class="form-control" id="contract-object" placeholder="Objet principal du contrat">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Durée</label>
                    <input type="text" class="form-control" id="contract-duration" placeholder="Durée du contrat">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Clauses spécifiques</label>
                    <textarea class="form-control" rows="4" id="contract-clauses" placeholder="Ajoutez des clauses spécifiques au contrat..."></textarea>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Date de signature</label>
                    <input type="date" class="form-control" id="contract-date">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Lieu de signature</label>
                    <input type="text" class="form-control" id="contract-location" placeholder="Ville de signature">
                </div>
                
                <button class="btn btn-primary w-100" onclick="generateLegalDocument()">GÉNÉRER LE DOCUMENT</button>
                <button class="btn btn-outline-primary w-100 mt-2" onclick="downloadLegalPDF()">TÉLÉCHARGER EN PDF</button>
                <button class="btn btn-outline-primary w-100 mt-2" onclick="saveLegalDocument()">ENREGISTRER</button>
            </div>
        </div>
    </div>
</div>

<script>
// Variables globales pour les documents juridiques
let selectedLegalTemplate = '';

// Sélectionner un type de document
function selectLegalTemplate(template) {
    selectedLegalTemplate = template;
    
    // Mettre en évidence le type sélectionné
    document.querySelectorAll('.content-template').forEach(t => {
        t.classList.remove('border-primary');
        t.classList.add('border');
    });
    event.currentTarget.classList.remove('border');
    event.currentTarget.classList.add('border-primary');
    
    // Mettre à jour l'affichage du type de document
    const typeDisplay = document.getElementById('document-type-display');
    const templateNames = {
        'contract': 'Contrat de Prestation',
        'nda': 'Accord de Confidentialité',
        'status': 'Statuts de l\'Entreprise',
        'terms': 'Conditions Générales de Vente',
        'privacy': 'Politique de Confidentialité',
        'partnership': 'Contrat de Partenariat',
        'employment': 'Contrat de Travail',
        'lease': 'Bail Commercial',
        'loan': 'Contrat de Prêt'
    };
    
    typeDisplay.innerHTML = `<h4>${templateNames[template]}</h4>`;
    
    // Générer le contenu en fonction du type
    generateLegalDocument();
}

// Générer le contenu en fonction du type
function generateLegalDocument() {
    const content = document.getElementById('legal-content');
    const party1Name = document.getElementById('party1-name').value || 'NJIEZM.FR';
    const party2Name = document.getElementById('party2-name').value || 'Client';
    const contractObject = document.getElementById('contract-object').value || 'Prestation de services';
    const contractDuration = document.getElementById('contract-duration').value || '12 mois';
    const contractClauses = document.getElementById('contract-clauses').value || '';
    const contractDate = document.getElementById('contract-date').value || new Date().toISOString().split('T')[0];
    const contractLocation = document.getElementById('contract-location').value || 'Paris';
    
    let documentContent = '';
    
    if (selectedLegalTemplate === 'contract') {
        documentContent = `
            <h5>CONTRAT DE PRESTATION DE SERVICES</h5>
            <p>Entre les soussignés :</p>
            <p><strong>Le prestataire :</strong> ${party1Name}</p>
            <p>Et</p>
            <p><strong>Le client :</strong> ${party2Name}</p>
            
            <h6>Article 1 - Objet</h6>
            <p>Le présent contrat a pour objet la prestation de services par le prestataire au client selon les termes et conditions ci-après.</p>
            
            <h6>Article 2 - Durée</h6>
            <p>Le contrat est conclu pour une durée de ${contractDuration} à compter de la date de signature.</p>
            
            <h6>Article 3 - Obligations du prestataire</h6>
            <p>Le prestataire s'engage à :</p>
            <ul>
                <li>Réaliser les prestations avec diligence et compétence</li>
                <li>Respecter les délais convenus</li>
                <li>Fournir une assistance technique si nécessaire</li>
            </ul>
            
            <h6>Article 4 - Obligations du client</h6>
            <p>Le client s'engage à :</p>
            <ul>
                <li>Fournir toutes les informations nécessaires à la réalisation des prestations</li>
                <li>Payer le prix convenu aux échéances prévues</li>
                <li>Collaborer avec le prestataire pour la bonne exécution du contrat</li>
            </ul>
            
            <h6>Article 5 - Prix et modalités de paiement</h6>
            <p>Le prix des prestations est fixé à [montant] €, payable selon les modalités suivantes : [modalités de paiement].</p>
            
            ${contractClauses ? `<h6>Article 6 - Clauses spécifiques</h6><p>${contractClauses}</p>` : ''}
            
            <h6>Article 7 - Confidentialité</h6>
            <p>Les parties s'engagent à maintenir la confidentialité sur toutes les informations échangées dans le cadre du présent contrat.</p>
            
            <h6>Article 8 - Propriété intellectuelle</h6>
            <p>Le prestataire conserve la propriété intellectuelle sur les créations réalisées dans le cadre du présent contrat.</p>
            
            <h6>Article 9 - Résiliation</h6>
            <p>Le contrat peut être résilié par l'une ou l'autre des parties avec un préavis de 30 jours.</p>
            
            <h6>Article 10 - Litiges</h6>
            <p>Tout litige relatif à l'interprétation ou à l'exécution du présent contrat sera de la compétence du tribunal de commerce de [ville].</p>
        `;
    } else if (selectedLegalTemplate === 'nda') {
        documentContent = `
            <h5>ACCORD DE CONFIDENTIALITÉ</h5>
            <p>Entre les soussignés :</p>
            <p><strong>Le divulgateur :</strong> ${party1Name}</p>
            <p>Et</p>
            <p><strong>Le destinataire :</strong> ${party2Name}</p>
            
            <h6>Article 1 - Définition des informations confidentielles</h6>
            <p>Sont considérées comme confidentielles toutes les informations techniques, commerciales, financières ou autres, communiquées par le divulgateur au destinataire dans le cadre de ${contractObject}.</p>
            
            <h6>Article 2 - Obligations du destinataire</h6>
            <p>Le destinataire s'engage à :</p>
            <ul>
                <li>Maintenir la confidentialité des informations reçues</li>
                <li>Ne pas utiliser ces informations à d'autres fins que ${contractObject}</li>
                <li>Ne pas reproduire ou diffuser ces informations sans autorisation écrite</li>
            </ul>
            
            <h6>Article 3 - Durée</h6>
            <p>Le présent accord est conclu pour une durée de ${contractDuration} à compter de la date de signature.</p>
            
            <h6>Article 4 - Sanctions en cas de violation</h6>
            <p>En cas de violation des obligations de confidentialité, le destinataire s'expose à des dommages et intérêts dont le montant sera fixé par le tribunal compétent.</p>
            
            ${contractClauses ? `<h6>Article 5 - Clauses spécifiques</h6><p>${contractClauses}</p>` : ''}
            
            <h6>Article 6 - Litiges</h6>
            <p>Tout litige relatif à l'interprétation ou à l'exécution du présent accord sera de la compétence du tribunal de commerce de [ville].</p>
        `;
    } else if (selectedLegalTemplate === 'status') {
        documentContent = `
            <h5>STATUTS DE L'ENTREPRISE</h5>
            
            <h6>Article 1 - Forme juridique</h6>
            <p>L'entreprise ${party1Name} est constituée sous la forme [forme juridique].</p>
            
            <h6>Article 2 - Dénomination sociale</h6>
            <p>La dénomination sociale de l'entreprise est : ${party1Name}.</p>
            
            <h6>Article 3 - Siège social</h6>
            <p>Le siège social de l'entreprise est situé à [adresse du siège social].</p>
            
            <h6>Article 4 - Objet social</h6>
            <p>L'entreprise a pour objet : [objet social].</p>
            
            <h6>Article 5 - Durée</h6>
            <p>La durée de l'entreprise est fixée à [durée] à compter de la date d'immatriculation.</p>
            
            <h6>Article 6 - Capital social</h6>
            <p>Le capital social est fixé à [montant] €, divisé en [nombre] actions de [valeur] € chacune.</p>
            
            <h6>Article 7 - Direction</h6>
            <p>L'entreprise est dirigée par [mode de direction].</p>
            
            <h6>Article 8 - Décisions collectives</h6>
            <p>Les décisions collectives sont prises selon les modalités prévues par les dispositions légales applicables.</p>
            
            <h6>Article 9 - Exercice social</h6>
            <p>L'exercice social commence le 1er janvier et se termine le 31 décembre de chaque année.</p>
            
            <h6>Article 10 - Répartition des bénéfices</h6>
            <p>Les bénéfices sont répartis selon les modalités prévues par les dispositions légales applicables.</p>
            
            <h6>Article 11 - Dissolution</h6>
            <p>La dissolution de l'entreprise peut intervenir dans les cas prévus par la loi.</p>
            
            <h6>Article 12 - Liquidation</h6>
            <p>En cas de dissolution, la liquidation est confiée à un ou plusieurs liquidateurs.</p>
            
            <h6>Article 13 - Litiges</h6>
            <p>Tout litige relatif à l'interprétation ou à l'exécution des statuts sera de la compétence du tribunal de commerce de [ville].</p>
        `;
    } else if (selectedLegalTemplate === 'terms') {
        documentContent = `
            <h5>CONDITIONS GÉNÉRALES DE VENTE</h5>
            
            <h6>Article 1 - Objet</h6>
            <p>Les présentes conditions générales de vente régissent les relations contractuelles entre ${party1Name} et tout client achetant des produits ou services via le site [site web ou application].</p>
            
            <h6>Article 2 - Produits et services</h6>
            <p>Les produits et services proposés par ${party1Name} sont ceux décrits sur le site [site web ou application] dans la description de chaque produit ou service.</p>
            
            <h6>Article 3 - Prix</h6>
            <p>Les prix des produits et services sont ceux en vigueur au jour de la commande. ${party1Name} se réserve le droit de modifier ses prix à tout moment.</p>
            
            <h6>Article 4 - Commande</h6>
            <p>Toute commande suppose l'acceptation par le client des présentes conditions générales de vente.</p>
            
            <h6>Article 5 - Paiement</h6>
            <p>Le paiement s'effectue selon les modalités proposées sur le site [site web ou application].</p>
            
            <h6>Article 6 - Livraison</h6>
            <p>La livraison est effectuée à l'adresse indiquée par le client lors de sa commande.</p>
            
            <h6>Article 7 - Rétractation</h6>
            <p>Le client dispose d'un délai de 14 jours à compter de la réception de sa commande pour exercer son droit de rétractation.</p>
            
            <h6>Article 8 - Garantie</h6>
            <p>Les produits bénéficient de la garantie légale de conformité et des vices cachés.</p>
            
            <h6>Article 9 - Responsabilité</h6>
            <p>La responsabilité de ${party1Name} est limitée aux dommages directs prévisibles et proportionnels au prix du produit.</p>
            
            <h6>Article 10 - Propriété intellectuelle</h6>
            <p>Tous les éléments du site [site web ou application] sont la propriété intellectuelle de ${party1Name} et sont protégés par le droit d'auteur.</p>
            
            <h6>Article 11 - Litiges</h6>
            <p>Tout litige relatif à l'interprétation ou à l'exécution des présentes conditions générales de vente sera de la compétence du tribunal de commerce de [ville].</p>
        `;
    } else if (selectedLegalTemplate === 'privacy') {
        documentContent = `
            <h5>POLITIQUE DE CONFIDENTIALITÉ</h5>
            
            <h6>Article 1 - Introduction</h6>
            <p>${party1Name} s'engage à protéger la vie privée des utilisateurs de son site [site web ou application] et à respecter les dispositions de la loi n°78-17 du 6 janvier 1978 relative à l'informatique, aux fichiers et aux libertés.</p>
            
            <h6>Article 2 - Données collectées</h6>
            <p>Les données personnelles collectées sur le site [site web ou application] sont les suivantes : [types de données collectées].</p>
            
            <h6>Article 3 - Finalités</h6>
            <p>Les données personnelles sont collectées pour les finalités suivantes : [finalités de la collecte].</p>
            
            <h6>Article 4 - Conservation</h6>
            <p>Les données personnelles sont conservées pendant une durée qui n'excède pas la durée nécessaire aux finalités pour lesquelles elles sont collectées.</p>
            
            <h6>Article 5 - Droits des utilisateurs</h6>
            <p>Conformément à la loi Informatique et Libertés, tout utilisateur dispose d'un droit d'accès, de modification, de rectification et de suppression des données le concernant.</p>
            
            <h6>Article 6 - Cookies</h6>
            <p>Le site [site web ou application] utilise des cookies pour améliorer l'expérience utilisateur. L'utilisateur peut désactiver les cookies dans les paramètres de son navigateur.</p>
            
            <h6>Article 7 - Sécurité</h6>
            <p>${party1Name} met en œuvre des mesures de sécurité appropriées pour protéger les données personnelles contre la perte, l'accès non autorisé, la modification, la divulgation ou la destruction.</p>
            
            <h6>Article 8 - Sous-traitance</h6>
            <p>${party1Name} peut faire appel à des sous-traitants pour réaliser certaines traitements. Ces sous-traitants s'engagent à respecter la présente politique de confidentialité.</p>
            
            <h6>Article 9 - Modifications</h6>
            <p>${party1Name} se réserve le droit de modifier la présente politique de confidentialité à tout moment.</p>
            
            <h6>Article 10 - Litiges</h6>
            <p>Tout litige relatif à l'interprétation ou à l'exécution de la présente politique de confidentialité sera de la compétence du tribunal de commerce de [ville].</p>
        `;
    } else if (selectedLegalTemplate === 'partnership') {
        documentContent = `
            <h5>CONTRATAT DE PARTENARIAT</h5>
            <p>Entre les soussignés :</p>
            <p><strong>Partenaire 1 :</strong> ${party1Name}</p>
            <p>Et</p>
            <p><strong>Partenaire 2 :</strong> ${party2Name}</p>
            
            <h6>Article 1 - Objet</h6>
            <p>Le présent contrat a pour objet la mise en place d'un partenariat entre les deux parties pour [objet du partenariat].</p>
            
            <h6>Article 2 - Durée</h6>
            <p>Le contrat est conclu pour une durée de ${contractDuration} à compter de la date de signature.</p>
            
            <h6>Article 3 - Obligations des partenaires</h6>
            <p>Les partenaires s'engagent à collaborer étroitement pour atteindre les objectifs fixés dans le cadre du partenariat.</p>
            
            <h6>Article 4 - Ressources</h6>
            <p>Chaque partenaire met à la disposition de l'autre les ressources nécessaires à la bonne exécution du partenariat.</p>
            
            <h6>Article 5 - Confidentialité</h6>
            <p>Les informations échangées dans le cadre du partenariat sont considérées comme confidentielles.</p>
            
            <h6>Article 6 - Propriété intellectuelle</h6>
            <p>Chaque partenaire conserve la propriété de ses propres droits de propriété intellectuelle.</p>
            
            <h6>Article 7 - Résiliation</h6>
            <p>Le contrat peut être résilié par l'une ou l'autre des parties avec un préavis de 30 jours.</p>
            
            <h6>Article 8 - Litiges</h6>
            <p>Tout litige relatif à l'interprétation ou à l'exécution du présent contrat sera de la compétence du tribunal de commerce de [ville].</p>
        `;
    } else if (selectedLegalTemplate === 'employment') {
        documentContent = `
            <h5>CONTRAT DE TRAVAIL</h5>
            <p>Entre les soussignés :</p>
            <p><strong>L'employeur :</strong> ${party1Name}</p>
            <p>Et</p>
            <p><strong>Le salarié :</strong> ${party2Name}</p>
            
            <h6>Article 1 - Objet</h6>
            <p>Le présent contrat a pour objet l'embauche du salarié par l'employeur en qualité de [poste du salarié].</p>
            
            <h6>Article 2 - Durée</h6>
            <p>Le contrat est conclu pour une durée de ${contractDuration} à compter de la date d'embauche.</p>
            
            <h6>Article 3 - Lieu de travail</h6>
            <p>Le salarié exercera ses fonctions à [lieu de travail].</p>
            
            <h6>Article 4 - Temps de travail</h6>
            <p>Le temps de travail est fixé à [nombre] heures par semaine, réparties sur [nombre] jours.</p>
            
            <h6>Article 5 - Rémunération</h6>
            <p>Le salarié percevra une rémunération brute de [montant] €, versée mensuellement.</p>
            
            <h6>Article 6 - Congés payés</h6>
            <p>Le salarié bénéficiera de congés payés dans les conditions prévues par le code du travail.</p>
            
            <h6>Article 7 - Obligations du salarié</h6>
            <p>Le salarié s'engage à :</p>
            <ul>
                <li>Exécuter son travail avec diligence et compétence</li>
                <li>Respecter les horaires de travail</li>
                <li>Respecter les règles de sécurité et d'hygiène</li>
                <li>Ne pas divulguer d'informations confidentielles</li>
            </ul>
            
            <h6>Article 8 - Obligations de l'employeur</h6>
            <p>L'employeur s'engage à :</p>
            <ul>
                <li>Fournir le travail convenu</li>
                <li>Payer la rémunération convenue</li>
                <li>Assurer la formation du salarié</li>
                <li>Respecter les dispositions légales relatives au travail</li>
            </ul>
            
            <h6>Article 9 - Résiliation</h6>
            <p>Le contrat peut être résilié par l'une ou l'autre des parties dans les conditions prévues par le code du travail.</p>
            
            <h6>Article 10 - Litiges</h6>
            <p>Tout litige relatif à l'interprétation ou à l'exécution du présent contrat sera de la compétence du conseil de prud'hommes de [ville].</p>
        `;
    } else if (selectedLegalTemplate === 'lease') {
        documentContent = `
            <h5>BAIL COMMERCIAL</h5>
            <p>Entre les soussignés :</p>
            <p><strong>Le bailleur :</strong> ${party1Name}</p>
            <p>Et</p>
            <p><strong>Le preneur :</strong> ${party2Name}</p>
            
            <h6>Article 1 - Objet</h6>
            <p>Le présent bail a pour objet la location du local situé à [adresse du local], destiné à un usage commercial.</p>
            
            <h6>Article 2 - Durée</h6>
            <p>Le bail est conclu pour une durée de ${contractDuration} à compter de la date de signature.</p>
            
            <h6>Article 3 - Loyer</h6>
            <p>Le loyer mensuel est fixé à [montant] €, payable le [jour du mois] de chaque mois.</p>
            
            <h6>Article 4 - Charges</h6>
            <p>Le preneur s'engage à payer les charges locatives suivantes : [liste des charges].</p>
            
            <h6>Article 5 - Destination des lieux</h6>
            <p>Le preneur s'engage à n'utiliser le local qu'à usage commercial et à ne pas en changer la destination sans l'accord écrit du bailleur.</p>
            
            <h6>Article 6 - Entretien et réparations</h6>
            <p>Le preneur est responsable de l'entretien courant du local. Les grosses réparations restent à la charge du bailleur.</p>
            
            <h6>Article 7 - Assurance</h6>
            <p>Le preneur s'engage à souscrire une assurance couvrant les risques locatifs.</p>
            
            <h6>Article 8 - Résiliation</h6>
            <p>Le bail peut être résilié par l'une ou l'autre des parties avec un préavis de 3 mois.</p>
            
            <h6>Article 9 - Litiges</h6>
            <p>Tout litige relatif à l'interprétation ou à l'exécution du présent bail sera de la compétence du tribunal de commerce de [ville].</p>
        `;
    } else if (selectedLegalTemplate === 'loan') {
        documentContent = `
            <h5>CONTRAT DE PRÊT</h5>
            <p>Entre les soussignés :</p>
            <p><strong>Le prêteur :</strong> ${party1Name}</p>
            <p>Et</p>
            <p><strong>L'emprunteur :</strong> ${party2Name}</p>
            
            <h6>Article 1 - Objet</h6>
            <p>Le présent contrat a pour objet le prêt d'une somme de [montant] € par le prêteur à l'emprunteur.</p>
            
            <h6>Article 2 - Durée</h6>
            <p>Le prêt est consenti pour une durée de ${contractDuration} à compter de la date de signature.</p>
            
            <h6>Article 3 - Taux d'intérêt</h6>
            <p>Le prêt est consenti au taux d'intérêt fixe de [taux]% l'an.</p>
            
            <h6>Article 4 - Modalités de remboursement</h6>
            <p>L'emprunteur s'engage à rembourser le prêt par échéances mensuelles d'un montant de [montant échéance] €.</p>
            
            <h6>Article 5 - Garantie</h6>
            <p>Le prêt est garanti par [type de garantie].</p>
            
            <h6>Article 6 - Remboursement anticipé</h6>
            <p>L'emprunteur peut rembourser le prêt par anticipation, sans pénalité.</p>
            
            <h6>Article 7 - Défaillance</h6>
            <p>En cas de non-paiement d'une échéance, l'emprunteur sera en situation de défaillance.</p>
            
            <h6>Article 8 - Litiges</h6>
            <p>Tout litige relatif à l'interprétation ou à l'exécution du présent contrat sera de la compétence du tribunal de commerce de [ville].</p>
        `;
    }
    
    content.innerHTML = documentContent;
    
    // Mettre à jour la date et le lieu de signature
    const footer = document.querySelector('.document-footer');
    if (footer) {
        const dateElement = footer.querySelector('.document-signatures p:last-child');
        if (dateElement) {
            dateElement.textContent = `Fait à ${contractLocation}, le ${new Date(contractDate).toLocaleDateString('fr-FR')}`;
        }
    }
}

// Télécharger le document en PDF
// Télécharger le document en PDF
function downloadLegalPDF() {
    // Vérifier qu'un type de document est sélectionné
    if (!selectedLegalTemplate) {
        showNotification('Veuillez sélectionner un type de document', 'warning');
        return;
    }
    
    // Créer un formulaire pour envoyer les données au serveur
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("legal.download-pdf") }}';
    
    // Ajouter le token CSRF
    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    form.appendChild(csrfToken);
    
    // Ajouter les données du document
    const documentData = {
        template: selectedLegalTemplate,
        party1Name: document.getElementById('party1-name').value || 'NJIEZM.FR',
        party1Address: document.getElementById('party1-address').value || '',
        party1Representative: document.getElementById('party1-representative').value || '',
        party2Name: document.getElementById('party2-name').value || 'Client',
        party2Address: document.getElementById('party2-address').value || '',
        party2Representative: document.getElementById('party2-representative').value || '',
        contractObject: document.getElementById('contract-object').value || '',
        contractDuration: document.getElementById('contract-duration').value || '',
        contractClauses: document.getElementById('contract-clauses').value || '',
        contractDate: document.getElementById('contract-date').value || new Date().toISOString().split('T')[0],
        contractLocation: document.getElementById('contract-location').value || 'Paris',
        content: document.getElementById('legal-content').innerHTML
    };
    
    const dataInput = document.createElement('input');
    dataInput.type = 'hidden';
    dataInput.name = 'document_data';
    dataInput.value = JSON.stringify(documentData);
    form.appendChild(dataInput);
    
    // Soumettre le formulaire
    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
}

// Sauvegarder le document
function saveLegalDocument() {
    const documentData = {
        template: selectedLegalTemplate,
        party1Name: document.getElementById('party1-name').value,
        party1Address: document.getElementById('party1-address').value,
        party1Representative: document.getElementById('party1-representative').value,
        party2Name: document.getElementById('party2-name').value,
        party2Address: document.getElementById('party2-address').value,
        party2Representative: document.getElementById('party2-representative').value,
        contractObject: document.getElementById('contract-object').value,
        contractDuration: document.getElementById('contract-duration').value,
        contractClauses: document.getElementById('contract-clauses').value,
        contractDate: document.getElementById('contract-date').value,
        contractLocation: document.getElementById('contract-location').value,
        content: document.getElementById('legal-content').innerHTML
    };
    
    // Envoyer les données au serveur pour l'enregistrement
    fetch('/api/legal-documents', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(documentData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Document juridique enregistré avec succès !', 'success');
        } else {
            showNotification('Erreur lors de l\'enregistrement du document', 'danger');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        showNotification('Erreur lors de l\'enregistrement du document', 'danger');
    });
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

// Initialiser la date du jour
document.addEventListener('DOMContentLoaded', function() {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('contract-date').value = today;
});
</script>

<style>
.document-preview {
    background: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.document-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid #ddd;
}

.document-logo {
    font-family: 'Special Elite', cursive;
    font-size: 1.5rem;
    color: var(--nj-blue);
}

.document-type h4 {
    margin: 0;
    color: var(--nj-blue);
}

.document-content {
    margin-bottom: 20px;
    min-height: 300px;
}

.document-content h5 {
    color: var(--nj-blue);
    margin-top: 20px;
    margin-bottom: 10px;
}

.document-content h6 {
    color: var(--nj-blue);
    margin-top: 15px;
    margin-bottom: 5px;
}

.document-content p {
    margin-bottom: 10px;
    line-height: 1.5;
}

.document-content ul {
    margin-bottom: 10px;
    padding-left: 20px;
}

.document-footer {
    margin-top: 30px;
    border-top: 1px solid #ddd;
    padding-top: 20px;
}

.document-signatures {
    display: flex;
    justify-content: space-between;
    margin-top: 30px;
}

.signature-box {
    width: 45%;
    text-align: center;
}

.signature-line {
    border-bottom: 1px solid #333;
    height: 30px;
    margin: 10px 0;
}

.signature-box p {
    margin: 5px 0;
    font-weight: bold;
}
</style>
@endsection