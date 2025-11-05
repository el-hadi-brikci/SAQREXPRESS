<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket - Colis #{{ $colis->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .ticket {
            border: 1px dashed #000;
            padding: 10px;
            width: 100mm;
            height: 100mm;
            box-sizing: border-box;
            margin: 0 auto;
        }
        .ticket h1 {
            font-size: 16px;
            text-align: center;
        }
        .ticket p {
            margin: 5px 0;
            font-size: 12px;
        }
        .print-button {
            display: none;
        }
        @media print {
            @page {
                size: 100mm 100mm;
                margin: 0;
            }
            body {
                margin: 0;
                padding: 0;
            }
            .ticket {
                width: 100mm;
                height: 100mm;
                margin: 0;
                box-sizing: border-box;
            }
        }
    </style>
</head>
<body>
    <div class="ticket">
        <h1 style="font-size:20px; text-align:center; margin-bottom:10px;">Ticket de Colis</h1>
        <div style="text-align:center; margin-bottom:15px;">
            <svg id="barcode" style="max-width:100%; height:auto; display:block; margin:0 auto"></svg>
        </div>
        <div style="margin-bottom:10px;">
            <p style="margin:4px 0; font-size:17px;"><strong>Client :</strong> {{ $colis->client->nom ?? '-' }}</p>
            <p style="margin:4px 0; font-size:17px;"><strong>Bureau :</strong> {{ $colis->bureau->nom ?? '-' }} - {{ $colis->bureauDestination->nom ?? '-' }}</p>
            <p style="margin:4px 0; font-size:17px;"><strong>Poids :</strong> {{ $colis->poids }} kg</p>
            <p style="margin:4px 0; font-size:17px;"><strong>Prix :</strong> {{ number_format($colis->prix, 2) }} DA</p>
            <p style="margin:4px 0; font-size:17px;"><strong>Date :</strong> {{ now()->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <script>
        window.onload = function() {
            JsBarcode("#barcode", "{{ $colis->code_suivi }}", {
                format: "CODE128",
                width: 1.2,
                height: 35,
                displayValue: true,
                fontSize: 13,
                margin: 0,
                textMargin: 2
            });
            window.print();
        };
    </script>
</body>
</html>
