<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Apartment Sale Contract</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            direction: ltr;
            color: #222;
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

        .clause {
            margin-bottom: 10px;
        }

        .label {
            font-weight: bold;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th,
        .table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background: #f0f0f0;
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
        <table class="table">
            <tr>
                <th>Area</th>
                <td>{{ $propertyBook->space }} m²</td>
            </tr>
            <tr>
                <th>Price</th>
                <td>${{ number_format($propertyBook->price) }}</td>
            </tr>
            <tr>
                <th>Project</th>
                <td>{{ $propertyBook->project_name ?? 'Not specified' }}</td>
            </tr>
        </table>
    </div>
    <div class="section">
        <span class="label">Contract Clauses:</span>
        <div class="clause">1. The Seller agrees to sell and the Buyer agrees to purchase the above-described apartment under the terms and conditions set forth in this contract.</div>
        <div class="clause">2. The total purchase price is <b>${{ number_format($propertyBook->price) }}</b>, payable as agreed between both parties.</div>
        <div class="clause">3. The Buyer acknowledges that they have inspected the apartment and accepts its current condition.</div>
        <div class="clause">4. The Seller guarantees that the apartment is free from any legal encumbrances, liens, or debts.</div>
        <div class="clause">5. The transfer of ownership will be completed upon full payment and signing of the final contract by both parties.</div>
        <div class="clause">6. All taxes, fees, and registration costs related to the transfer of ownership shall be borne by the Buyer unless otherwise agreed.</div>
        <div class="clause">7. The Seller shall provide all necessary documents required for the legal transfer of the apartment.</div>
        <div class="clause">8. In case of any dispute arising from this contract, both parties agree to resolve the matter amicably or through the competent courts.</div>
        <div class="clause">9. This contract is governed by the laws of the country in which the property is located.</div>
        <div class="clause">10. This contract is made in two original copies, one for each party.</div>
    </div>
    <div class="section">
        <span class="label">Notes:</span>
        {{ $order->note ?? '-' }}
    </div>
    <div class="section" style="margin-top: 40px;">
        <span class="label">This contract is preliminary and does not include any signatures at this stage.</span>
    </div>
</body>

</html>