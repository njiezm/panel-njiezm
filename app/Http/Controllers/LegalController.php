<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LegalController extends Controller
{
    /**
     * Afficher la page du générateur juridique
     */
    public function index()
    {
        return view('documents.legal');
    }
    
    /**
     * Télécharger un document juridique en PDF
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function downloadPdf(Request $request)
    {
        $documentData = json_decode($request->input('document_data'), true);
        
        // Définir le nom du modèle en fonction du type
        $templateNames = [
            'contract' => 'Contrat de Prestation',
            'nda' => 'Accord de Confidentialité',
            'status' => 'Statuts de l\'Entreprise',
            'terms' => 'Conditions Générales de Vente',
            'privacy' => 'Politique de Confidentialité',
            'partnership' => 'Contrat de Partenariat',
            'employment' => 'Contrat de Travail',
            'lease' => 'Bail Commercial',
            'loan' => 'Contrat de Prêt'
        ];
        
        $documentType = $templateNames[$documentData['template']] ?? 'Document Juridique';
        
        // Créer le PDF avec le même style que la visualisation
        $pdf = Pdf::loadView('legal.pdf', [
            'documentData' => $documentData,
            'documentType' => $documentType
        ])
        ->setPaper('a4')
        ->setOptions([
            'defaultFont' => 'Special Elite',
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
            'isFontSubsettingEnabled' => true,
            'tempDir' => storage_path('app/public/temp'),
        ]);
        
        $filename = str_replace(' ', '_', $documentType) . '_' . date('d-m-Y') . '.pdf';
        
        return $pdf->download($filename);
    }
}