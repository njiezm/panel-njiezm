<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Document;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $documents = Document::with('items')->get();
        return view('documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('documents.create');
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'amount' => 'nullable|numeric|min:0',
            'issue_date' => 'required|date',
            'due_date' => 'required|date|after:issue_date',
            'status' => 'required|in:draft,sent,accepted,refused,paid,overdue',
            'metadata' => 'nullable|array',
            'items' => 'nullable|array',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.vat' => 'required|numeric|min:0|max:100',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('documents', 'public');
            $validated['file_path'] = $path;
        }

        // Utiliser une transaction pour s'assurer que tout est sauvegardé correctement
        DB::transaction(function () use ($validated, $request) {
            // Générer le numéro de référence
            $referenceNumber = Document::where('type', $validated['type'])->max('reference_number') + 1;
            
            // Créer le document
            $document = Document::create([
                'reference_number' => $referenceNumber,
                'title' => $validated['title'],
                'type' => $validated['type'],
                'client_name' => $validated['client_name'],
                'amount' => $validated['amount'] ?? 0,
                'issue_date' => $validated['issue_date'],
                'due_date' => $validated['due_date'],
                'status' => $validated['status'],
                'file_path' => $validated['file_path'] ?? null,
                'metadata' => $validated['metadata'] ?? null,
                'user_id' => auth()->id(),
            ]);

            // Créer les articles associés
            if (isset($validated['items'])) {
                foreach ($validated['items'] as $itemData) {
                    Item::create([
                        'document_id' => $document->id,
                        'description' => $itemData['description'],
                        'quantity' => $itemData['quantity'],
                        'unit_price' => $itemData['unit_price'],
                        'vat' => $itemData['vat'],
                    ]);
                }
                
                // Mettre à jour le montant total du document
                $document->updateTotalAmount();
            }

            // Générer le PDF
            $document->generatePdf();

            // Créer une activité si le modèle Activity existe
            if (class_exists('App\Models\Activity')) {
                Activity::create([
                    'title' => 'Document créé',
                    'description' => $document->type . ' pour ' . $document->client_name,
                    'type' => 'document_created',
                    'user_id' => auth()->id(),
                    'activitable_id' => $document->id,
                    'activitable_type' => Document::class,
                ]);
            }
        });

        return redirect()->route('documents.index')
                         ->with('success', 'Document créé avec succès.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'amount' => 'nullable|numeric|min:0',
            'issue_date' => 'required|date',
            'due_date' => 'required|date|after:issue_date',
            'status' => 'required|in:draft,sent,accepted,refused,paid,overdue',
            'metadata' => 'nullable|array',
            'items' => 'nullable|array',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.vat' => 'required|numeric|min:0|max:100',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('documents', 'public');
            $validated['file_path'] = $path;
        }

        // Utiliser une transaction pour s'assurer que tout est sauvegardé correctement
        DB::transaction(function () use ($validated, $request, $document) {
            // Mettre à jour le document
            $document->update([
                'title' => $validated['title'],
                'type' => $validated['type'],
                'client_name' => $validated['client_name'],
                'amount' => $validated['amount'] ?? 0,
                'issue_date' => $validated['issue_date'],
                'due_date' => $validated['due_date'],
                'status' => $validated['status'],
                'file_path' => $validated['file_path'] ?? $document->file_path,
                'metadata' => $validated['metadata'] ?? $document->metadata,
            ]);

            // Supprimer tous les articles existants
            $document->items()->delete();

            // Créer les nouveaux articles
            if (isset($validated['items'])) {
                foreach ($validated['items'] as $itemData) {
                    Item::create([
                        'document_id' => $document->id,
                        'description' => $itemData['description'],
                        'quantity' => $itemData['quantity'],
                        'unit_price' => $itemData['unit_price'],
                        'vat' => $itemData['vat'],
                    ]);
                }
            }
            
            // Mettre à jour le montant total du document
            $document->updateTotalAmount();
            
            // Régénérer le PDF
            $document->generatePdf();
        });

        return redirect()->route('documents.index')
                         ->with('success', 'Document mis à jour avec succès.');
    }
    
    /**
     * Create a new document from a template.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createFromTemplate(Request $request)
    {
        $template = $request->input('template');
        $type = $template == 'quote' ? 'quote' : 'invoice';
        
        // Utiliser une transaction pour s'assurer que tout est sauvegardé correctement
        $document = DB::transaction(function () use ($template, $type) {
            // Générer le numéro de référence
            $referenceNumber = Document::where('type', $type)->max('reference_number') + 1;
            
            // Créer le document
            $document = Document::create([
                'reference_number' => $referenceNumber,
                'title' => $this->getTemplateTitle($template),
                'type' => $type,
                'client_name' => 'Client à définir',
                'amount' => 0,
                'issue_date' => now()->format('Y-m-d'),
                'due_date' => now()->addDays(30)->format('Y-m-d'),
                'status' => 'draft',
                'metadata' => [
                    'template' => $template
                ],
                'user_id' => auth()->id(),
            ]);

            // Créer les articles du modèle
            $templateItems = $this->getTemplateItems($template);
            foreach ($templateItems as $itemData) {
                Item::create([
                    'document_id' => $document->id,
                    'description' => $itemData['description'],
                    'quantity' => $itemData['quantity'],
                    'unit_price' => $itemData['unit_price'],
                    'vat' => $itemData['vat'],
                ]);
            }
            
            // Mettre à jour le montant total du document
            $document->updateTotalAmount();
            
            // Générer le PDF
            $document->generatePdf();
            
            return $document;
        });
        
        return redirect()->route('documents.edit', $document->id)
                         ->with('success', 'Document créé à partir du modèle. Vous pouvez maintenant le personnaliser.');
    }
    
 
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\View\View
     */
    public function show(Document $document)
    {
        $document->load('items');
        return view('documents.show', compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\View\View
     */
    public function edit(Document $document)
    {
        $document->load('items');
        return view('documents.edit', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function updateold(Request $request, Document $document)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'amount' => 'nullable|numeric|min:0',
            'issue_date' => 'required|date',
            'due_date' => 'required|date|after:issue_date',
            'status' => 'required|in:draft,sent,accepted,refused,paid,overdue',
            'metadata' => 'nullable|array',
            'items' => 'nullable|array',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.vat' => 'required|numeric|min:0|max:100',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('documents', 'public');
            $validated['file_path'] = $path;
        }

        // Utiliser une transaction pour s'assurer que tout est sauvegardé correctement
        DB::transaction(function () use ($validated, $request, $document) {
            // Mettre à jour le document
            $document->update([
                'title' => $validated['title'],
                'type' => $validated['type'],
                'client_name' => $validated['client_name'],
                'amount' => $validated['amount'] ?? 0,
                'issue_date' => $validated['issue_date'],
                'due_date' => $validated['due_date'],
                'status' => $validated['status'],
                'file_path' => $validated['file_path'] ?? $document->file_path,
                'metadata' => $validated['metadata'] ?? $document->metadata,
            ]);

            // Supprimer tous les articles existants
            $document->items()->delete();

            // Créer les nouveaux articles
            if (isset($validated['items'])) {
                foreach ($validated['items'] as $itemData) {
                    Item::create([
                        'document_id' => $document->id,
                        'description' => $itemData['description'],
                        'quantity' => $itemData['quantity'],
                        'unit_price' => $itemData['unit_price'],
                        'vat' => $itemData['vat'],
                    ]);
                }
            }
            
            // Mettre à jour le montant total du document
            $document->updateTotalAmount();
        });

        return redirect()->route('documents.index')
                         ->with('success', 'Document mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        $document->delete();

        return redirect()->route('documents.index')
                         ->with('success', 'Document supprimé avec succès.');
    }
    
    /**
 * Download the specified document as PDF.
 *
 * @param  \App\Models\Document  $document
 * @return \Illuminate\Http\Response
 */
public function downloadPdf(Document $document)
{
    $document->load('items');
    
    $data = [
        'document' => $document,
        'company' => [
            'name' => 'NJIEZM.FR',
            'address' => '123 Rue de la République, 75001 Paris',
            'phone' => '+33 1 23 45 67 89',
            'email' => 'contact@njiezm.fr',
            'siret' => '12345678901234',
            'tva' => 'FR00123456789'
        ]
    ];
    
    // Configuration de DomPDF pour une meilleure compatibilité CSS
    $pdf = Pdf::loadView('documents.pdf', $data)
        ->setPaper('a4')
        ->setOptions([
            'defaultFont' => 'Space Grotesk',
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
            'isFontSubsettingEnabled' => true,
            'tempDir' => storage_path('app/public/temp'),
        ]);
    
    $filename = $document->type . '_' . $document->id . '.pdf';
    
    return $pdf->download($filename);
}
    
    /**
     * Create a new document from a template.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createFromTemplateold(Request $request)
    {
        $template = $request->input('template');
        
        // Utiliser une transaction pour s'assurer que tout est sauvegardé correctement
        $document = DB::transaction(function () use ($template) {
            // Créer le document
            $document = Document::create([
                'title' => $this->getTemplateTitle($template),
                'type' => $template == 'quote' ? 'quote' : 'invoice',
                'client_name' => 'Client à définir',
                'amount' => 0,
                'issue_date' => now()->format('Y-m-d'),
                'due_date' => now()->addDays(30)->format('Y-m-d'),
                'status' => 'draft',
                'metadata' => [
                    'template' => $template
                ],
                'user_id' => auth()->id(),
            ]);

            // Créer les articles du modèle
            $templateItems = $this->getTemplateItems($template);
            foreach ($templateItems as $itemData) {
                Item::create([
                    'document_id' => $document->id,
                    'description' => $itemData['description'],
                    'quantity' => $itemData['quantity'],
                    'unit_price' => $itemData['unit_price'],
                    'vat' => $itemData['vat'],
                ]);
            }
            
            // Mettre à jour le montant total du document
            $document->updateTotalAmount();
            
            return $document;
        });
        
        return redirect()->route('documents.edit', $document->id)
                         ->with('success', 'Document créé à partir du modèle. Vous pouvez maintenant le personnaliser.');
    }
    
    /**
     * Get template title based on template type.
     *
     * @param  string  $template
     * @return string
     */
    private function getTemplateTitle($template)
    {
        $titles = [
            'quote' => 'Devis standard',
            'invoice' => 'Facture standard',
            'proforma' => 'Devis proforma'
        ];
        
        return $titles[$template] ?? 'Document';
    }
    
    /**
     * Get template items based on template type.
     *
     * @param  string  $template
     * @return array
     */
    private function getTemplateItems($template)
    {
        $items = [
            'quote' => [
                ['description' => 'Prestation de développement web', 'quantity' => 1, 'unit_price' => 1500, 'vat' => 20],
                ['description' => 'Design UI/UX', 'quantity' => 1, 'unit_price' => 800, 'vat' => 20],
                ['description' => 'Hébergement annuel', 'quantity' => 1, 'unit_price' => 300, 'vat' => 20]
            ],
            'invoice' => [
                ['description' => 'Prestation de développement web', 'quantity' => 1, 'unit_price' => 1500, 'vat' => 20],
                ['description' => 'Design UI/UX', 'quantity' => 1, 'unit_price' => 800, 'vat' => 20],
                ['description' => 'Hébergement annuel', 'quantity' => 1, 'unit_price' => 300, 'vat' => 20]
            ],
            'proforma' => [
                ['description' => 'Prestation de développement web', 'quantity' => 1, 'unit_price' => 1500, 'vat' => 20],
                ['description' => 'Design UI/UX', 'quantity' => 1, 'unit_price' => 800, 'vat' => 20],
                ['description' => 'Hébergement annuel', 'quantity' => 1, 'unit_price' => 300, 'vat' => 20]
            ]
        ];
        
        return $items[$template] ?? [];
    }
}