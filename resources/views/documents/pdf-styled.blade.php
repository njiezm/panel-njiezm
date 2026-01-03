<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $document->type == 'quote' ? 'Devis' : 'Facture' }} {{ $document->type == 'quote' ? 'D' : 'F' }}{{ str_pad($document->id, 5, '0', STR_PAD_LEFT) }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Special+Elite&family=Space+Grotesk:wght@300;500;700&family=JetBrains+Mono&display=swap');
        
        :root {
            --nj-blue: #003366;
            --nj-yellow: #FFD700;
            --nj-white: #F8F9FA;
            --nj-dark: #1a1a1a;
            --nj-light: #e9ecef;
            --nj-success: #28a745;
            --nj-danger: #dc3545;
            --nj-purple: #6f42c1;
            --nj-pink: #e83e8c;
            --nj-teal: #20c997;
            --nj-orange: #fd7e14;
        }
        
        body {
            font-family: 'Special Elite', cursive;
            font-size: 12px;
            line-height: 1.4;
            color: var(--nj-dark);
            margin: 0;
            padding: 15px;
            background-color: #fff;
        }
        
        .document-preview {
            background: white;
            padding: 15px;
            margin-bottom: 10px;
        }

        .document-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--nj-blue);
        }

        .document-logo {
            font-family: 'Special Elite', cursive;
            font-size: 20px;
            color: var(--nj-blue);
        }

        .document-logo span {
            color: var(--nj-yellow);
        }

        .document-info {
            text-align: right;
        }

        .document-type {
            font-size: 20px;
            font-weight: bold;
            color: var(--nj-blue);
            margin-bottom: 3px;
        }

        .document-number {
            font-size: 16px;
            margin-bottom: 3px;
        }

        .document-date {
            font-size: 12px;
            color: #666;
        }

        .document-content {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .company-info, .client-info {
            width: 48%;
        }

        .section-title {
            font-weight: bold;
            color: var(--nj-blue);
            margin-bottom: 5px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 3px;
            font-size: 13px;
        }

        .info-row {
            margin-bottom: 3px;
            font-size: 11px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 11px;
        }

        .items-table th, .items-table td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
        }

        .items-table th {
            background-color: #f0f0f0;
            font-weight: bold;
            font-size: 11px;
        }

        .items-table .text-right {
            text-align: right;
        }

        .totals {
            margin-bottom: 20px;
            font-size: 11px;
        }

        .totals-row {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 3px;
            align-items: center;
            flex-wrap: nowrap;
        }

        .totals-label {
            min-width: 100px;
            padding-right: 10px;
            text-align: right;
            white-space: nowrap;
        }

        .totals-value {
            min-width: 80px;
            text-align: right;
            white-space: nowrap;
        }

        .totals-row.grand-total {
            font-weight: bold;
            font-size: 14px;
            border-top: 1px solid #ddd;
            padding-top: 5px;
            margin-top: 5px;
        }

        .payment-info {
            margin-bottom: 15px;
            font-size: 11px;
        }

        .notes {
            margin-top: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border-left: 3px solid var(--nj-blue);
            font-size: 11px;
        }

        .footer {
            margin-top: 30px;
            border-top: 1px solid #ddd;
            padding-top: 15px;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="document-preview">
        <div class="document-header">
            <div class="document-logo">
                <span style="font-family: 'Special Elite'; font-size: 20px; color: var(--nj-blue);">NJIEZM<span style="color: var(--nj-yellow);">.FR</span></span>
            </div>
            <div class="document-info">
                <div class="document-type">{{ $document->type == 'quote' ? 'DEVIS' : 'FACTURE' }}</div>
                <div class="document-number">N° {{ str_pad($document->id, 5, '0', STR_PAD_LEFT) }}</div>
                <div class="document-date">Date: {{ $document->issue_date->format('d/m/Y') }}</div>
                @if($document->type == 'invoice')
                    <div class="document-date">Échéance: {{ $document->due_date->format('d/m/Y') }}</div>
                @endif
            </div>
        </div>
        
        <div class="document-content">
            <div class="company-info">
                <div class="section-title">NJIEZM.FR</div>
                <div class="info-row">123 Rue de la République, 75001 Paris</div>
                <div class="info-row">+33 1 23 45 67 89</div>
                <div class="info-row">contact@njiezm.fr</div>
                <div class="info-row">SIRET: 12345678901234</div>
                <div class="info-row">TVA: FR00123456789</div>
            </div>
            
            <div class="client-info">
                <div class="section-title">Client</div>
                <div class="info-row">{{ $document->client_name }}</div>
                @if(isset($document->metadata['client_address']))
                    <div class="info-row">{{ $document->metadata['client_address'] }}</div>
                @endif
                @if(isset($document->metadata['client_email']))
                    <div class="info-row">{{ $document->metadata['client_email'] }}</div>
                @endif
                @if(isset($document->metadata['client_phone']))
                    <div class="info-row">{{ $document->metadata['client_phone'] }}</div>
                @endif
            </div>
        </div>
        
        @if($document->type == 'quote')
            <div class="section-title">Objet du devis</div>
            <div class="info-row">{{ $document->title }}</div>
        @endif
        
        <table class="items-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th class="text-right">Quantité</th>
                    <th class="text-right">Prix unitaire</th>
                    <th class="text-right">TVA (%)</th>
                    <th class="text-right">Total HT</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($document->metadata['items']) && count($document->metadata['items']) > 0)
                    @foreach($document->metadata['items'] as $item)
                    <tr>
                        <td>{{ $item['description'] }}</td>
                        <td class="text-right">{{ $item['quantity'] }}</td>
                        <td class="text-right">{{ number_format($item['unit_price'], 2, ',', ' ') }} €</td>
                        <td class="text-right">{{ $item['vat'] }}</td>
                        <td class="text-right">{{ number_format($item['quantity'] * $item['unit_price'], 2, ',', ' ') }} €</td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 15px;">
                            Aucun article n'a été ajouté à ce {{ $document->type == 'quote' ? 'devis' : 'facture' }}.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        
        <div class="totals">
            <div class="totals-row">
                <div class="totals-label">Total HT:</div>
                <div class="totals-value">{{ number_format($document->amount, 2, ',', ' ') }} €</div>
            </div>
            <div class="totals-row">
                <div class="totals-label">TVA (20%):</div>
                <div class="totals-value">{{ number_format($document->amount * 0.2, 2, ',', ' ') }} €</div>
            </div>
            <div class="totals-row grand-total">
                <div class="totals-label">Total TTC:</div>
                <div class="totals-value">{{ number_format($document->amount * 1.2, 2, ',', ' ') }} €</div>
            </div>
        </div>
        
        @if($document->type == 'invoice')
            <div class="payment-info">
                <div class="section-title">Informations de paiement</div>
                <div class="info-row">Virement bancaire</div>
                <div class="info-row">IBAN: FR76 3000 4000 1234 5678 9012 345</div>
                <div class="info-row">BIC: BNPAFRPPXXX</div>
            </div>
        @endif
        
        @if(isset($document->metadata['notes']))
            <div class="notes">
                <div class="section-title">Notes</div>
                <div>{{ $document->metadata['notes'] }}</div>
            </div>
        @endif
        
        <div class="footer">
            <div>{{ $document->type == 'quote' ? 'Devis' : 'Facture' }} établi par NJIEZM.FR</div>
            <div>{{ $document->type == 'quote' ? 'Ce devis est valable 30 jours.' : 'En cas de retard de paiement, une pénalité de 3 fois le taux d\'intérêt légal sera appliquée.' }}</div>
        </div>
    </div>
</body>
</html>