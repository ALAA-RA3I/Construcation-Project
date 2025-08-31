<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Apartment Sale Contract - #{{ $order->id }}</title>
    <style>
        /* --- Base --- */
        @page {
            margin: 30pt 40pt;
        }

        body {
            font-family: "DejaVu Sans", "Arial", Helvetica, sans-serif;
            color: #222;
            font-size: 12px;
            line-height: 1.5;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 16px;
        }

        .title {
            font-size: 20px;
            font-weight: 700;
            color: #0f3c6b;
        }

        .sub {
            font-size: 11px;
            color: #6b6b6b;
        }

        .meta {
            margin-top: 6px;
            font-size: 11px;
            color: #444;
        }

        .section {
            margin-top: 14px;
        }

        .label {
            font-weight: 700;
            color: #0f3c6b;
            display: inline-block;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            font-size: 12px;
        }

        .table th,
        .table td {
            border: 1px solid #dcdcdc;
            padding: 8px 10px;
            vertical-align: top;
            text-align: left;
        }

        .table th {
            background: #f5f8fb;
            font-weight: 700;
            color: #0f3c6b;
        }

        .two-cols {
            display: flex;
            gap: 16px;
        }

        .col {
            flex: 1;
        }

        .details {
            background: #fbfcfe;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #eef3f9;
        }

        .clause {
            margin-bottom: 10px;
            text-align: justify;
        }

        /* ID card display */
        .id-block {
            width: 100%;
            margin: 18px auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .id-frame {
            border: 1px solid #d9e3ef;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(10, 30, 60, 0.06);
            background: #fff;
            text-align: center;
        }

        .id-frame img {
            max-width: 360px;
            max-height: 240px;
            object-fit: contain;
            border-radius: 4px;
        }

        .id-caption {
            margin-top: 8px;
            font-size: 11px;
            color: #666;
        }

        /* Signatures area: client left, company right */
        .signatures {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 80px;
            gap: 12px;
        }

        .sign-left {
            width: 40%;
            text-align: left;
        }

        .sign-right {
            width: 40%;
            text-align: right;
        }

        .sign-line {
            display: inline-block;
            border-top: 1px solid #222;
            padding-top: 6px;
            font-weight: 700;
            font-size: 13px;
            color: #111;
            width: 100%;
        }

        .sign-meta {
            margin-top: 6px;
            font-size: 11px;
            color: #666;
        }

        /* Project images */
        .project-image {
            max-width: 260px;
            max-height: 160px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #e6eef8;
            padding: 3px;
        }

        /* Footer */
        .footer {
            margin-top: 30px;
            font-size: 11px;
            color: #666;
            border-top: 1px dashed #e5e5e5;
            padding-top: 8px;
        }

        /* Make sure long text wraps */
        p,
        td {
            word-wrap: break-word;
            white-space: normal;
        }

        /* RTL support if needed */
        .rtl {
            direction: rtl;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="title">Apartment Sale Contract</div>
            <div class="sub">Preliminary Contract — ID: <strong>#{{ $order->id }}</strong></div>
            <div class="meta">Date: {{ $date }}</div>
        </div>

        <div class="section">
            <div class="label">First Party (Seller):</div> <span>Real Estate Company</span>
        </div>

        <div class="section">
            <div class="label">Second Party (Buyer):</div>
            <div style="margin-top:6px;">
                <strong>{{ $client->first_name ?? '-' }} {{ $client->last_name ?? '' }}</strong>
            </div>

            <table class="table" style="margin-top:10px;">
                <tr>
                    <th style="width: 30%;">Email</th>
                    <td>{{ $client->email ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $client->phone ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{ $client->address ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Request Date</th>
                    <td>{{ $request_date ? $request_date->format('Y-m-d H:i:s') : 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Approval Date</th>
                    <td>{{ $approval_date ? $approval_date->format('Y-m-d H:i:s') : 'N/A' }}</td>
                </tr>
                <tr>
                    <th>IP Address</th>
                    <td>{{ $client_ip ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>User Agent / Device</th>
                    <td>{{ $user_agent ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Browser / Platform</th>
                    <td>{{ $browser ?? ($user_agent ?? 'N/A') }}</td>
                </tr>
                <tr>
                    <th>Request URL</th>
                    <td style="word-break:break-all;">{{ $request_url ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Referer</th>
                    <td style="word-break:break-all;">{{ $referer ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Accept-Language</th>
                    <td>{{ $accept_language ?? '-' }}</td>
                </tr>
            </table>
        </div>

        {{-- Identity image: prefer $order->identity_file then fallback to $client->id_image --}}
        @php
        $identityPath = null;
        if (!empty($order->identity_file)) {
        $identityPath = asset('storage/' . ltrim($order->identity_file, '/'));
        } elseif (!empty($client->id_image)) {
        // if client->id_image is already a full URL keep it, otherwise resolve storage
        if (Str::startsWith($client->id_image, ['http://','https://'])) {
        $identityPath = $client->id_image;
        } else {
        $identityPath = asset('storage/' . ltrim($client->id_image, '/'));
        }
        }
        @endphp

        @if($identityPath)
        <div class="id-block">
            <div class="id-frame">
                <div style="font-weight:700; color:#0f3c6b;">Client Identity (ID / Passport)</div>
                <img src="{{ $identityPath }}" alt="Client ID">
                <div class="id-caption">This document was uploaded by the applicant during the order submission. (Stored path shown)</div>
            </div>
        </div>
        @endif

        <div class="section details">
            <div style="font-weight:700; margin-bottom:8px; color:#0f3c6b;">Apartment Details</div>
            <table class="table">
                <tr>
                    <th style="width: 30%;">Area</th>
                    <td>{{ $propertyBook->space ?? 'N/A' }} m²</td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td>${{ number_format($propertyBook->price ?? 0) }}</td>
                </tr>
                <tr>
                    <th>Project</th>
                    <td>{{ $project->title ?? 'Not specified' }}</td>
                </tr>
                <tr>
                    <th>Model</th>
                    <td>{{ $propertyBook->model ?? 'Not specified' }}</td>
                </tr>
                <tr>
                    <th>Rooms / Bathrooms</th>
                    <td>
                        Rooms: {{ $property_details['rooms'] ?? 'N/A' }} |
                        Bathrooms: {{ $property_details['bathrooms'] ?? 'N/A' }}
                    </td>
                </tr>
                <tr>
                    <th>Direction</th>
                    <td>{{ $property_details['direction'] ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>First Payment</th>
                    <td>
                        @if(isset($property_details['first_payment']))
                        ${{ number_format($property_details['first_payment']) }}
                        @else
                        N/A
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Payment Period</th>
                    <td>{{ $property_details['payment_period'] ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Order Payment Amount</th>
                    <td>${{ number_format($order->payment_amount ?? 0) }}</td>
                </tr>
                <tr>
                    <th>Client Identity</th>
                    <td>
                        @if($identity_local_path)
                        <img src="{{ $identity_local_path }}"
                            alt="Client Identity"
                            style="max-width: 300px; border:1px solid #ccc; padding:5px; border-radius:8px;">
                        @else
                        N/A
                        @endif
                    </td>
                </tr>

            </table>
        </div>

        {{-- Project Sales Details --}}
        <div class="section details">
            <div style="font-weight:700; margin-bottom:8px; color:#0f3c6b;">Project Details</div>

            @if(isset($project) && isset($project->salesDetails))
            <table class="table">
                <tr>
                    <th style="width: 30%;">Main Title</th>
                    <td>{{ $project->salesDetails->main_title ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{ $project->salesDetails->marketing_description ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{ $project->salesDetails->address ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td>
                        @if(!empty($project->salesDetails->location_link))
                        <a href="{{ $project->salesDetails->location_link }}" target="_blank">View on Map</a>
                        @else
                        N/A
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Main Image</th>
                    <td>
                        @if(!empty($project->salesDetails->main_image))
                        <img src="{{ asset('storage/' . ltrim($project->salesDetails->main_image, '/')) }}"
                            alt="Project Main Image" class="project-image">
                        @else
                        N/A
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Diagram</th>
                    <td>
                        @if(!empty($project->salesDetails->diagram_image))
                        <img src="{{ asset('storage/' . ltrim($project->salesDetails->diagram_image, '/')) }}"
                            alt="Diagram" class="project-image">
                        @else
                        N/A
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Video</th>
                    <td>
                        @if(!empty($project->salesDetails->video_url))
                        <a href="{{ $project->salesDetails->video_url }}" target="_blank">Watch Video</a>
                        @else
                        N/A
                        @endif
                    </td>
                </tr>
            </table>
            @else
            <p>No project details available.</p>
            @endif
        </div>

        {{-- Payment schedule --}}
        <div class="section">
            <div class="label">Payment Schedule</div>
            @if($propertyBookBills && $propertyBookBills->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Amount</th>
                        <th>Due Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($propertyBookBills as $bill)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>${{ number_format($bill->amount) }}</td>
                        <td>{{ $bill->due_date ?? 'N/A' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p style="margin-top:8px;">No payment schedule available.</p>
            @endif
        </div>

        {{-- Clauses / Terms --}}
        <div class="section">
            <div class="label">Contract Clauses</div>
            <div class="clause"><strong>1. Sale Agreement:</strong> The Seller agrees to sell and the Buyer agrees to purchase the described apartment under the terms and conditions contained in this contract.</div>
            <div class="clause"><strong>2. Purchase Price:</strong> The total purchase price is <strong>${{ number_format($propertyBook->price ?? 0) }}</strong>, payable in accordance with the payment schedule.</div>
            <div class="clause"><strong>3. Deposit & Reservation:</strong> The reservation deposit secures the unit and will be handled according to the Company policy.</div>
            <div class="clause"><strong>4. Delivery & Handover:</strong> The Seller undertakes to hand over the property to the Buyer in the agreed condition at the agreed date, subject to completion of all payments and registration formalities.</div>
            <div class="clause"><strong>5. Taxes & Fees:</strong> All registration fees, transfer taxes and notary costs required for legal transfer shall be borne by the Buyer unless otherwise agreed.</div>
            <div class="clause"><strong>6. Late Payment:</strong> Delay in payments may lead to penalties or cancellation as per the Company policy.</div>
            <div class="clause"><strong>7. Liabilities & Warranties:</strong> Seller liability limited to construction defects within applicable warranty periods.</div>
            <div class="clause"><strong>8. Force Majeure:</strong> Neither party shall be liable for events beyond their control that prevent performance.</div>
            <div class="clause"><strong>9. Cancellation & Refunds:</strong> Refund conditions are governed by Company policy and applicable laws.</div>
            <div class="clause"><strong>10. Dispute Resolution:</strong> Parties shall seek amicable settlement; otherwise competent local courts shall have jurisdiction.</div>
            <div class="clause"><strong>11. Evidence & Request Proof:</strong> Technical metadata (IP, user agent, request URL, referer, accept-language) is recorded and forms part of this contract.</div>
            <div class="clause"><strong>12. Entire Agreement:</strong> This document is the entire agreement between parties regarding the described transaction.</div>
        </div>

        <div class="section">
            <div class="label">Additional Notes</div>
            <div style="margin-top:6px;">{{ $order->note ?? '-' }}</div>
        </div>

        {{-- Signatures: client left, company right (placeholders left empty if no signature images) --}}
        {{-- Page break before signatures --}}
        <div style="page-break-before: always;"></div>

        <div class="signatures" style="display: flex; justify-content: space-between; align-items: flex-end; margin-top: 200px;">
            {{-- Client signature (left) --}}
            <p> Client Signature
            </p>
            <div style="width: 45%; text-align: left;">
                @if($withSignatures && !empty($order->client_signature_url))
                <div><img src="{{ asset($order->client_signature_url) }}" alt="Client Signature" style="max-height:120px;"></div>
                @else
                <div style="height:120px;"></div> {{-- Placeholder empty --}}
                @endif
                <div style="border-top:1px solid #000; margin-top:5px; width: 100%;">&nbsp;</div>
            </div>
            <p> Company
            </p>
            <h1> Company Signture Alaa </h1>
            {{-- Company signature (right) --}}
            <div style="width: 45%; text-align: right; font-size: 13px; line-height: 1.4;">
                <!-- @if($withSignatures ) -->

                <!-- <img src="{{ asset('signatures/company-sign-MAIN.png') }}" alt="Company Signature"
                    style="height: 70px; display:block; margin-bottom:5px;"> -->
                <!-- <p style="margin: 2px 0; font-weight: bold;">Company Signed At:</p>
                <p style="margin: 2px 0;">
                    {{ $order->company_signed_at ? \Carbon\Carbon::parse($order->company_signed_at)->format('Y-m-d H:i') : '-' }}
                </p> -->
                <!-- @else
                {{-- Placeholder for empty signature --}}
                <div style="height: 120px;"></div>
                @endif -->

                <div style="border-top: 1px solid #000; margin-top: 8px; width: 100%;"></div>
            </div>

            {{-- Footer --}}
            <!--  -->

        </div>
</body>

</html>