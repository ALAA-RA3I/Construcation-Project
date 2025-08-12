@extends('layouts.app')
@section('page-title', 'Model Details')
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
    /* Reusing styles from previous page with additions */
    .model-details-container {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-bottom: 30px;
    }

    .model-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }

    .model-title {
        font-size: 28px;
        font-weight: 700;
        color: #333;
    }

    .model-price {
        font-size: 24px;
        font-weight: 700;
        color: #ffd200;
        background: #f9f9f9;
        padding: 10px 20px;
        border-radius: 8px;
    }

    .model-content {
        display: flex;
        gap: 30px;
    }

    .model-image {
        flex: 0 0 45%;
        position: relative;
        border-radius: 8px;
        overflow: hidden;
    }

    .model-image img {
        width: 100%;
        height: 600px;
        background-size: contain;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .model-info {
        flex: 1;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-item i {
        color: #ffd200;
        font-size: 18px;
        width: 24px;
        text-align: center;
    }

    .info-label {
        font-weight: 600;
        color: #555;
        margin-bottom: 5px;
    }

    .info-value {
        font-weight: 700;
        color: #333;
    }

    .description-box {
        background: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 30px;
    }

    .description-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 15px;
        color: #333;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .description-text {
        color: #555;
        line-height: 1.6;
    }

    /* Installments table styles */
    .installments-section {
        margin-top: 40px;
    }

    .section-title {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #333;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        color: #ffd200;
    }

    .installments-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border-radius: 8px;
        overflow: hidden;
    }

    .installments-table thead {
        background: #ffd200;
        color: #222;
    }

    .installments-table th {
        padding: 15px;
        text-align: left;
        font-weight: 700;
    }

    .installments-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    .installments-table tr:last-child td {
        border-bottom: none;
    }

    .installments-table tr:hover {
        background: #f9f9f9;
    }

    .amount-cell {
        font-weight: 700;
        color: #333;
    }

    .summary-card {
        background: #f9f9f9;
        border-radius: 8px;
        padding: 20px;
        margin-top: 20px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }

    .summary-row:last-child {
        border-bottom: none;
    }

    .summary-label {
        font-weight: 600;
        color: #555;
    }

    .summary-value {
        font-weight: 700;
        color: #333;
    }

    .total-row {
        font-size: 18px;
        color: #ffd200 !important;
    }

    @media (max-width: 768px) {
        .model-content {
            flex-direction: column;
        }

        .model-image {
            flex: 1;
            margin-bottom: 20px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }
    }
    .back-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 25px;
        height: 44px;
        background-color: #fff;
        color: #222 !important;
        border: 2px solid #ffd200;
        border-radius: 6px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        text-decoration: none;
        font-size: 16px;
    }

    .register-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 25px;
        height: 44px;
        background-color: #ffd200;
        color: #222 !important;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        font-size: 16px;
    }

    /* Hover states */
    .back-btn:hover {
        background-color: #ffd200;
        color: #222 !important;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }

    .register-btn:hover {
        background-color: #e6c000;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }

    .submit-btn {
        display: inline-flex;
        align-items: center;
        padding: 10px 25px;
        background-color: #ffd200;
        color: #222 !important;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }
</style>

@section('main-content')
    <section id="subheader" data-stellar-background-ratio=".3">
        <div class="container">
            <h1>Model {{ $book->model }} Details</h1>
            <div class="small-border-deco"><span></span></div>
            <ul class="crumb">
                <li><a href="{{ route('unitsSales') }}">Apartments for Sale</a></li>
                <li class="sep"></li>
                <li><a href="{{ route('unitsBooks',$book->id) }}">Property Models</a></li>
                <li class="sep"></li>
                <li>Model {{ $book->model }}</li>
            </ul>
        </div>
    </section>

    <div id="content">
        <div class="container">
            <div class="model-details-container">
                <div class="model-header">
                    <div class="model-title-container">
                        <img src="{{ asset('images/logo-2.png') }}"  alt="Company Logo" class="company-logo">
                    </div>
                    <div class="model-price">{{ number_format($book->price, 0) }} SYP</div>
                </div>

                <div class="model-content">
                    <div class="model-image">
                        <img src="{{ $book->diagram_image ?? asset('images/placeholder.jpg') }}" alt="Model {{ $book->model }}">
                    </div>

                    <div class="model-info">
                        <h2 class="model-title">Apartment Details :</h2>
                        <div class="info-grid">

                            <div class="info-item">
                                <i class="fa fa-ruler-combined"></i>
                                <div>
                                    <div class="info-label">Area</div>
                                    <div class="info-value">{{ $book->space }} m²</div>
                                </div>
                            </div>

                            <div class="info-item">
                                <i class="fa fa-door-open"></i>
                                <div>
                                    <div class="info-label">Rooms</div>
                                    <div class="info-value">{{ $book->number_of_rooms }}</div>
                                </div>
                            </div>

                            <div class="info-item">
                                <i class="fa fa-bath"></i>
                                <div>
                                    <div class="info-label">Bathrooms</div>
                                    <div class="info-value">{{ $book->number_of_bathrooms }}</div>
                                </div>
                            </div>

                            <div class="info-item">
                                <i class="fa fa-compass"></i>
                                <div>
                                    <div class="info-label">Direction</div>
                                    <div class="info-value">{{ $book->direction }}</div>
                                </div>
                            </div>

                            <div class="info-item">
                                <i class="fa fa-hand-holding-usd"></i>
                                <div>
                                    <div class="info-label">First Payment</div>
                                    <div class="info-value">{{ number_format($book->first_payment_amount, 0) }} SYP</div>
                                </div>
                            </div>

                            <div class="info-item">
                                <i class="fa fa-calendar-alt"></i>
                                <div>
                                    <div class="info-label">Payment Period</div>
                                    <div class="info-value">{{ $book->payment_period }} months</div>
                                </div>
                            </div>

                            <div class="info-item">
                                <i class="fa fa-building"></i>
                                <div>
                                    <div class="info-label">Available Units</div>
                                    <div class="info-value">{{ $book->available_units }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="description-box">
                            <h3 class="description-title">
                                <i class="fa fa-file-alt"></i>
                                Description
                            </h3>
                            <p class="description-text">
                                {{ $book->description ?? 'No description available' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="installments-section">
                    <h3 class="section-title">
                        <i class="fa fa-credit-card"></i>
                        Payment Plan
                    </h3>

                    <div class="table-responsive">
                        <table class="installments-table">
                            <thead>
                            <tr>
                                <th>Installment #</th>
                                <th>Amount</th>
                                <th>Notes</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($book->bills as $index => $bill)
                                <tr>
                                    <td style="color: #626161">Installment {{ $index + 1 }}</td>
                                    <td class="amount-cell">{{ number_format($bill->amount, 0) }} SYP</td>
                                    <td>{{ $bill->description ?? '-' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="summary-card">
                        <div class="summary-row">
                            <span class="summary-label">Model Price:</span>
                            <span class="summary-value">{{ number_format($book->price, 0) }} SYP</span>
                        </div>
                        <div class="summary-row">
                            <span class="summary-label">First Payment:</span>
                            <span class="summary-value">{{ number_format($book->first_payment_amount, 0) }} SYP</span>
                        </div>
                        <div class="summary-row">
                            <span class="summary-label">Remaining Amount:</span>
                            <span class="summary-value">{{ number_format($book->price - $book->first_payment_amount, 0) }} SYP</span>
                        </div>
                        <div class="summary-row total-row">
                            <span class="summary-label">Total Installments:</span>
                            <span class="summary-value">{{ number_format($book->bills->sum('amount'), 0) }} SYP</span>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: end; align-items: center; margin-top: 30px; gap: 20px;">
                        <a href="{{ route('unitsBooks',$book->id) }}" class="back-btn">
                            <i class="fa fa-arrow-right " style="margin-right: 5px ; margin-bottom: 1px" ></i>
                            Back to Models List
                        </a>

                        <button id="showRegisterForm" class="register-btn">
                            <i class="fa fa-edit" style="margin-right: 8px;"></i>
                            Register for This Apartment
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Registration Form Modal -->
    <div id="registerModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
        <div class="modal-content" style="background-color: #fefefe; margin: 10% auto; padding: 30px; border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.3); width: 50%; max-width: 600px;">
            <span class="close-modal" style="float: right; font-size: 28px; font-weight: bold; cursor: pointer;">&times;</span>

            <h2 style="color: #333; margin-bottom: 20px;">Register for Apartment</h2>

            @auth('client')
                <form id="registrationForm" action="{{ route('registerOrder') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="property_book_id" value="{{ $book->id }}">
                    <input type="hidden" name="client_id" value="{{ auth('client')->id() }}">

                    <div style="display: flex; gap: 20px; margin-bottom: 30px;">
                        <!-- Identity File Input -->
                        <div class="file-upload-container" style="flex: 1;">
                            <label for="identity_file" class="file-upload-label" style="display: block; margin-bottom: 8px; font-weight: 600;">Identity Document</label>
                            <div class="file-upload-box" style="border: 2px solid #ffd200; border-radius: 8px; height: 150px; display: flex; flex-direction: column; align-items: center; justify-content: center; cursor: pointer; position: relative; overflow: hidden;">
                                <input type="file" id="identity_file" name="identity_file" required class="file-upload-input" style="position: absolute; width: 100%; height: 100%; opacity: 0; cursor: pointer;">
                                <i class="fas fa-id-card" style="font-size: 36px; color: #ffd200; margin-bottom: 10px;"></i>
                                <div class="file-upload-text" style="text-align: center; color: #555; font-size: 14px;">
                                    <div>ID/Passport</div>
                                    <div class="file-name" style="margin-top: 5px; color: #333; font-weight: 600; display: none;"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Clearance Certificate Input -->
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label for="note" style="display: block; margin-bottom: 8px; font-weight: 600;">Additional Notes (Optional)</label>
                        <textarea id="note" name="note" rows="4" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;"></textarea>
                    </div>

                    <div style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 30px;">
                        <button type="button" class="close-modal back-btn">Cancel</button>
                        <button type="submit" class="register-btn">Submit Registration</button>
                    </div>
                </form>
            @else
                <div style="text-align: center; padding: 20px;">
                    <p style="font-size: 16px; margin-bottom: 30px;">You need to login to register for this apartment.</p>
                    <a href="{{ route('client.login') }}?redirect={{ urlencode(Request::url()) }}" class="register-btn" style="text-decoration: none;">
                        <i class="fa fa-sign-in-alt" style="margin-right: 8px;"></i>
                        Login Now
                    </a>
                </div>
            @endauth
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('registerModal');
            const showBtn = document.getElementById('showRegisterForm');
            const closeBtns = document.querySelectorAll('.close-modal');

            // Show modal when button is clicked
            showBtn.addEventListener('click', function() {
                modal.style.display = 'block';
            });

            // Close modal when X or Cancel is clicked
            closeBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    modal.style.display = 'none';
                });
            });

            // Close modal when clicking outside
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });

            // File input handling
            document.querySelectorAll('.file-upload-input').forEach(input => {
                input.addEventListener('change', function() {
                    const container = this.closest('.file-upload-box');
                    const fileNameDisplay = container.querySelector('.file-name');

                    if (this.files.length > 0) {
                        fileNameDisplay.textContent = this.files[0].name;
                        fileNameDisplay.style.display = 'block';
                        container.style.borderColor = '#28a745'; // Green border when file selected
                    } else {
                        fileNameDisplay.style.display = 'none';
                        container.style.borderColor = '#ffd200'; // Yellow border when no file
                    }
                });
            });
        });
    </script>

    <style>
        .modal {
            transition: all 0.3s ease;
        }

        .modal-content {
            animation: modalFadeIn 0.3s;
        }

        @keyframes modalFadeIn {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        }

        .file-upload-box {
            transition: all 0.3s ease;
        }

        .file-upload-box:hover {
            background-color: #f9f9f9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .modal-content {
                width: 90%;
                margin: 20% auto;
            }

            .file-upload-container {
                flex: 100% !important;
            }

            .file-upload-container + .file-upload-container {
                margin-top: 20px;
            }
        }
    </style>
@endsection
