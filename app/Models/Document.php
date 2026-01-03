<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    use HasFactory;

     protected $fillable = [
        'reference_number',
        'title',
        'type',
        'client_name',
        'amount',
        'discount_amount',
        'discount_percentage',
        'discount_type',
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
        'discount_amount' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
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
     * Calculate the discount amount based on discount type
     */
    public function calculateDiscountAmount()
    {
        if ($this->discount_type === 'fixed') {
            return $this->discount_amount;
        } elseif ($this->discount_type === 'percentage') {
            return $this->amount * ($this->discount_percentage / 100);
        }
        
        return 0;
    }
    
    /**
     * Get the total amount after discount
     */
    public function getTotalAfterDiscountAttribute()
    {
        return $this->amount - $this->calculateDiscountAmount();
    }
    
    /**
     * Get the total TVA after discount
     */
    public function getTotalTvaAfterDiscountAttribute()
    {
        $totalAfterDiscount = $this->getTotalAfterDiscountAttribute();
        return $this->items->sum(function ($item) use ($totalAfterDiscount) {
            $itemRatio = $item->total_ht / $this->amount;
            return $item->total_tva * $itemRatio * ($totalAfterDiscount / $this->amount);
        });
    }
    
   /**
 * Calcule le total TTC après réduction
 * @return float
 */
public function getTotalTtcAfterDiscountAttribute()
{
    $totalHt = $this->items->sum('total_ht');
    $totalTva = $this->items->sum('total_tva');
    
    // Appliquer la réduction
    $discount = 0;
    if ($this->discount_type === 'fixed') {
        $discount = min($this->discount_amount ?? 0, $totalHt);
    } elseif ($this->discount_type === 'percentage') {
        $discount = $totalHt * (($this->discount_percentage ?? 0) / 100);
    }
    
    $totalHtAfterDiscount = $totalHt - $discount;
    
    // Calculer la TVA après réduction en proportionnant la réduction sur chaque article
    $totalTvaAfterDiscount = 0;
    foreach ($this->items as $item) {
        // Proportionner la réduction sur cet article
        $itemDiscount = $item->total_ht * ($discount / $totalHt);
        $itemHtAfterDiscount = $item->total_ht - $itemDiscount;
        
        // Calculer la TVA sur le montant après réduction
        $totalTvaAfterDiscount += $itemHtAfterDiscount * ($item->vat / 100);
    }
    
    return $totalHtAfterDiscount + $totalTvaAfterDiscount;
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