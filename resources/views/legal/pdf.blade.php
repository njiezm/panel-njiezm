<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $documentType }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Special+Elite&family=Space+Grotesk:wght@300;500;700&display=swap');
        
        :root {
            --nj-blue: #003366;
            --nj-yellow: #FFD700;
            --nj-white: #F8F9FA;
            --nj-dark: #1a1a1a;
            --nj-light: #e9ecef;
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

        .document-type h4 {
            margin: 0;
            color: var(--nj-blue);
            font-size: 20px;
        }

        .document-content {
            margin-bottom: 20px;
            min-height: 300px;
        }

        .document-content h5 {
            color: var(--nj-blue);
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .document-content h6 {
            color: var(--nj-blue);
            margin-top: 15px;
            margin-bottom: 5px;
            font-size: 14px;
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
</head>
<body>
    <div class="document-preview">
        <div class="document-header">
            <div class="document-logo">
                <span style="font-family: 'Special Elite'; font-size: 20px; color: var(--nj-blue);">NJIEZM<span style="color: var(--nj-yellow);">.FR</span></span>
            </div>
            <div class="document-type">
                <h4>{{ $documentType }}</h4>
            </div>
        </div>
        
        <div class="document-content">
            {!! $documentData['content'] !!}
        </div>
        
        <div class="document-footer">
            <div class="document-signatures">
                <div class="signature-box">
                    <p>Signature du prestataire</p>
                    <div class="signature-line"></div>
                    <p>{{ $documentData['party1Name'] }}</p>
                </div>
                <div class="signature-box">
                    <p>Signature du client</p>
                    <div class="signature-line"></div>
                    <p>{{ $documentData['party2Name'] }}</p>
                </div>
            </div>
            <p style="text-align: center; margin-top: 20px;">Fait à {{ $documentData['contractLocation'] }}, le {{ \Carbon\Carbon::parse($documentData['contractDate'])->format('d/m/Y') }}</p>
        </div>
    </div>
</body>
</html>