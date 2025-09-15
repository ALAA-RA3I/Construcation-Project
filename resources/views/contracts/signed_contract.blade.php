<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Signed Apartment Sale Contract</title>
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
        <img src="{{ public_path('signatures/company-logo.png') }}" alt="Company Logo" style="height: 80px; display:block; margin:auto;">
        <div class="title">Signed Apartment Sale Contract</div>
        <div style="font-size:18px; font-weight:bold;">شركة العقارات الحديثة Modern Real Estate Co.</div>
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
                <th>Unit Number</th>
                <td>{{ $propertyUnit->unit_number }}</td>
            </tr>
            <tr>
                <th>Floor</th>
                <td>{{ $propertyUnit->floor ?? 'Not specified' }}</td>
            </tr>
            <tr>
                <th>Area</th>
                <td>{{ $propertyBook->space }} m²</td>
            </tr>
            <tr>
                <th>Price</th>
                <td>${{ number_format($propertyBook->price) }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $propertyUnit->address ?? 'Not specified' }}</td>
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
        <span class="label">Signatures:</span>
        <table class="table">
            <tr>
                <th>Client Name</th>
                <td>{{ $client->first_name }} {{ $client->last_name }}</td>
            </tr>
            <tr>
                <th>Signature Code</th>
                <td>{{ $secret_code ?? ($order->signature_code ?? '-') }}</td>
            </tr>
            <tr>
                <th>Signed At</th>
                <td>{{ $order->client_signed_at ? $order->client_signed_at : '-' }}</td>
            </tr>
            <tr>
                <th>Client IP</th>
                <td>{{ $client_ip ?? '-' }}</td>
            </tr>
            <tr>
                <th>Company Signature</th>
                <td>
                    <img src="{{ public_path('signatures/company-sign.png') }}" alt="Company Signature" style="height: 60px;">
                </td>
            </tr>
            <tr>
                <th>Company Signed At</th>
                <td>{{ $order->company_signed_at ? $order->company_signed_at : '-' }}</td>
            </tr>
        </table>
        @if(isset($clientInfo))
        <div style="margin-top: 10px;">
            <span class="label">Client Details:</span>
            <table class="table">
                <tr>
                    <th>Email</th>
                    <td>{{ $clientInfo['client_email'] ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $clientInfo['client_phone'] ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Identity Number</th>
                    <td>{{ $clientInfo['client_identity'] ?? '-' }}</td>
                </tr>
                <tr>
                    <th>User Agent</th>
                    <td>{{ $clientInfo['user_agent'] ?? '-' }}</td>
                </tr>
            </table>
        </div>
        @endif
        <div style="margin-top: 10px; font-size: 12px; color: #555;">
            <b>Blockchain Link:</b> <span>{{ $blockchain_link ?? '--- سيتم إضافة الرابط بعد رفع العقد على البلوك تشين ---' }}</span>
        </div>
        <div style="margin-top: 10px; font-size: 12px; color: #555;">
            <b>ملاحظة قانونية:</b> تم توقيع هذا العقد إلكترونيًا من قبل العميل والشركة. التوقيع الإلكتروني يعادل التوقيع اليدوي قانونيًا.
        </div>
        <div style="margin-top: 10px; font-size: 12px; color: #555;">
            <b>ملاحظة:</b> جميع بيانات التوقيع (IP، الجهاز، البريد، الجوال، الهوية) تم تسجيلها لحظة التوقيع.
        </div>
    </div>
</body>

</html>