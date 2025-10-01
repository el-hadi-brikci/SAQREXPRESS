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
            padding: 20px;
        }
        .ticket {
            border: 1px dashed #000;
            padding: 20px;
            width: 300px;
            margin: 0 auto;
        }
        .ticket h1 {
            font-size: 18px;
            text-align: center;
        }
        .ticket p {
            margin: 5px 0;
        }
        .print-button {
            display: none;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <h1>Ticket - Colis #{{ $colis->id }}</h1>
        <p><strong>Code Suivi:</strong> {{ $colis->code_suivi }}</p>
        <p><strong>Description:</strong> {{ $colis->description }}</p>
        <p><strong>Poids:</strong> {{ $colis->poids }} kg</p>
        <p><strong>Client:</strong> {{ $colis->client->nom ?? '-' }}</p>
        <p><strong>Bureau:</strong> {{ $colis->bureau->nom ?? '-' }}</p>
        <p><strong>Statut:</strong> {{ ucfirst($colis->statut) }}</p>
        <p><strong>Date Livraison Réelle:</strong> {{ $colis->date_livraison_reelle ? $colis->date_livraison_reelle->format('d/m/Y H:i') : '-' }}</p>
    </div>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
