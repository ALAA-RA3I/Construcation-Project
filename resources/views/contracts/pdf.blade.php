<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Apartment Sale Contract</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            direction: ltr;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .section {
            margin-bottom: 20px;
        }

        .details {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
        }

        .signatures {
            margin-top: 40px;
        }

        .sign {
            display: inline-block;
            width: 45%;
            text-align: center;
        }

        .label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="title">Apartment Sale Contract</div>
        <div>Date: {{ $date }}</div>
    </div>
    <div class="section">
        <span class="label">First Party (Seller):</span> Real Estate Company
    </div>
    <div class="section">
        <span class="label">Second Party (Buyer):</span>
        {{ $client->first_name }} {{ $client->last_name }}
    </div>
    <div class="section details">
        <div><span class="label">Apartment Details:</span></div>
        <div>Unit Number: {{ $propertyUnit->unit_number }}</div>
        <div>Floor: {{ $propertyUnit->floor ?? 'Not specified' }}</div>
        <div>Area: {{ $propertyBook->space }} m²</div>
        <div>Price: ${{ number_format($propertyBook->price) }}</div>
    </div>
    <div class="section">
        <span class="label">Notes:</span>
        {{ $order->note ?? '-' }}
    </div>
    <div class="signatures">
        <div class="sign">
            <div class="label">Seller Signature</div>
            <div style="margin-bottom: 8px;">Sunset Development Corp.</div>
            <img src="{{ public_path('signatures/company-sign.png') }}" alt="Company Signature" style="height: 50px; margin-bottom: 4px;">
        </div>
        <div class="sign">
            <div class="label">Buyer Signature</div>
            <div style="margin-bottom: 8px;">{{ $client->first_name }} {{ $client->last_name }}</div>
            <div style="font-size: 12px; color: #555;">Secret Code: <b>{{ $secret_code }}</b></div>
        </div>
    </div>
</body>

</html>