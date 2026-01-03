<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reference_number',
        'title',
        'type',
        'client_name',
        'amount',
        'issue_date',
        'due_date',
        'status',
        'file_path',
        'metadata',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'issue_date' => 'date',
        'due_date' => 'date',
        'metadata' => 'array',
    ];

    /**
     * Get the user that owns the document.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the activities for the document.
     */
    public function activities()
    {
        return $this->morphMany(Activity::class, 'activitable');
    }

    /**
     * Get the items for the document.
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    /**
     * Calculate and update the total amount based on items
     */
    public function updateTotalAmount()
    {
        $this->amount = $this->items->sum('total_ht');
        $this->save();
    }
    
    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();
        
        // Observer pour régénérer le PDF lorsque le document est modifié
        static::updated(function ($document) {
            // Vérifier si les champs importants ont été modifiés
            if ($document->wasChanged(['title', 'client_name', 'amount', 'issue_date', 'due_date', 'status', 'metadata'])) {
                $document->generatePdf();
            }
        });
    }
    
    /**
     * Generate PDF for the document
     */
    public function generatePdf()
    {
        // S'assurer que le document a des items
        if ($this->items->count() === 0) {
            return null;
        }
        
        $data = [
            'document' => $this,
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
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('documents.pdf', $data)
            ->setPaper('a4')
            ->setOptions([
                'defaultFont' => 'Space Grotesk',
                'isRemoteEnabled' => true,
                'isHtml5ParserEnabled' => true,
                'isFontSubsettingEnabled' => true,
                'tempDir' => storage_path('app/public/temp'),
            ]);
        
        // Créer le dossier s'il n'existe pas
        $folder = $this->type == 'quote' ? 'DevisG' : 'FacturesG';
        $directory = storage_path('app/public/files/' . $folder);
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
        
        // Définir le nom du fichier
        $filename = $this->type == 'quote' ? 'D' : 'F' . str_pad($this->reference_number, 5, '0', STR_PAD_LEFT) . '.pdf';
        $filePath = 'files/' . $folder . '/' . $filename;
        
        // Sauvegarder le PDF
        Storage::disk('public')->put($filePath, $pdf->output());
        
        // Mettre à jour le chemin du fichier dans la base de données
        $this->file_path = $filePath;
        $this->save();
        
        return $filePath;
    }
}