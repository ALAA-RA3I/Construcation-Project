@extends('layouts.app')

@section('page-title','My Orders')

<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
    .order-card {
        display: flex;
        flex-direction: row;
        margin-bottom: 25px;
        border-radius: 12px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        background-color: #fff;
        transition: all 0.3s ease-in-out;
        overflow: hidden;
        min-height: 180px;
    }

    .order-card:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        transform: translateY(-3px);
        border-color: rgba(255, 210, 0, 0.5);
    }

    .order-image {
        width: 200px;
        min-width: 200px;
        background-color: #f8f9fa;
        background-size: cover;
        background-position: center;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .order-image i {
        font-size: 40px;
        color: rgba(0, 0, 0, 0.1);
    }

    .order-content {
        flex-grow: 1;
        padding: 20px;
        display: flex;
        flex-direction: column;
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    .order-title {
        font-size: 18px;
        font-weight: 700;
        color: #222 !important;
        margin: 0;
        display: flex;
        align-items: center;
        text-decoration: none;
    }
    .order-title:hover
    {
        color: #ffd200 !important;
        text-decoration: none;
    }

    .order-title i {
        color: #ffd200;
        margin-right: 10px;
        font-size: 20px;
    }

    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: bold;
        font-size: 12px;
        text-transform: capitalize;
        letter-spacing: 0.5px;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeeba;
    }

    .status-rejected {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .status-payment_pending {
        background-color: #e7f1ff;
        color: #004085;
        border: 1px solid #c6d9f1;
    }

    .status-payment_completed {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .status-contract_signed {
        background-color: #d1ecf1;
        color: #0c5460;
        border: 1px solid #bee5eb;
    }

    .order-details {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 15px;
    }

    .detail-item {
        display: flex;
        align-items: center;
        font-size: 14px;
    }

    .detail-item i {
        color: #ffd200;
        margin-right: 8px;
        font-size: 16px;
        min-width: 16px;
        text-align: center;
    }

    .detail-label {
        font-weight: 600;
        color: #555;
        margin-right: 5px;
    }

    .detail-value {
        color: #222;
    }

    .price-highlight {
        font-weight: 700;
        color: #222;
        font-size: 16px;
    }

    .order-actions {
        margin-top: auto;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .order-btn {
        border-radius: 6px;
        font-weight: 600;
        transition: all 0.2s ease;
        padding: 8px 16px;
        font-size: 13px;
        border: 2px solid transparent;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .order-btn i {
        margin-right: 6px;
        font-size: 14px;
    }

    .btn-view-contract {
        background-color: #ffd200;
        color: #222 !important;
    }

    .btn-view-contract:hover {
        background-color: #e6c000;
    }

    .btn-pay-now {
        background-color: #28a745;
        color: white !important;
    }

    .btn-pay-now:hover {
        background-color: #218838;
    }

    .btn-sign-contract {
        background-color: #17a2b8;
        color: white !important;
    }

    .btn-sign-contract:hover {
        background-color: #138496;
    }

    .btn-download-contract {
        background-color: #6c757d;
        color: white !important;
    }

    .btn-download-contract:hover {
        background-color: #5a6268;
    }

    .no-orders {
        text-align: center;
        padding: 40px;
        background-color: #f8f9fa;
        border-radius: 12px;
    }

    .no-orders i {
        font-size: 50px;
        color: #ddd;
        margin-bottom: 20px;
    }

    body, h1, h2, h3, h4, h5, h6, p, a, span, li, button {
        font-family: 'Cairo', sans-serif;
    }
</style>

@section('main-content')
    <!-- subheader -->
    <section id="subheader" data-stellar-background-ratio=".3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>My Orders</h1>
                    <div class="small-border-deco"><span></span></div>
                    <ul class="crumb">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="sep"></li>
                        <li>My Orders</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- subheader close -->

    <!-- content begin -->
    <div id="content">
        <div class="container">
            @if($orders->isEmpty())
                <div class="no-orders">
                    <i class="far fa-folder-open"></i>
                    <h3>No Orders Found</h3>
                    <p>You don't have any orders yet. Start by exploring our available units.</p>
                    <a href="{{ route('unitsSales') }}" class="btn btn-primary">Browse Properties</a>
                </div>
            @else
                <div class="row">
                    <div class="col-md-12">
                        @foreach($orders as $order)
                            <div class="order-card">
                                <div class="order-image">
                                    <i class="fas fa-home"></i>
                                </div>

                                <div class="order-content">
                                    <div class="order-header">
                                        <a href="{{ route('bookDetails',$order->id) }}" class="order-title">
                                            <i class="fas fa-building"></i>
                                            {{ $order->main_title }}
                                        </a>
                                        <span class="status-badge status-{{ $order->status }}">
                                            {{ str_replace('_', ' ', $order->status) }}
                                        </span>
                                    </div>

                                    <div class="order-details">
                                        <div class="detail-item">
                                            <i class="fas fa-hashtag"></i>
                                            <span class="detail-label">Priority:</span>
                                            <span class="detail-value">{{ $order->priority_number }}</span>
                                        </div>

                                        <div class="detail-item">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span class="detail-label">Location:</span>
                                            <span class="detail-value">{{ $order->address }}</span>
                                        </div>

                                        <div class="detail-item">
                                            <i class="fas fa-tag"></i>
                                            <span class="detail-label">Price:</span>
                                            <span class="detail-value price-highlight">{{ number_format($order->price, 2) }} SYP</span>
                                        </div>

                                        <div class="detail-item">
                                            <i class="fas fa-money-bill-wave"></i>
                                            <span class="detail-label">First Payment:</span>
                                            <span class="detail-value">{{ number_format($order->first_payment_amount, 2) }} SYP</span>
                                        </div>
                                    </div>

                                    <div class="order-actions">
                                        @if($order->status == 'rejected' || $order->status == 'pending')
                                            <div class="text-muted">
                                                <i class="fas fa-info-circle"></i>
                                                @if($order->status == 'rejected')
                                                    This order has been rejected. Contact support for details.
                                                @else
                                                    Your order is being processed. We'll notify you of updates.
                                                @endif
                                            </div>
                                        @elseif($order->status == 'payment_pending')
                                            <a href="#" class="order-btn btn-view-contract">
                                                <i class="fas fa-file-contract"></i> View Contract
                                            </a>
                                            <a href="#" class="order-btn btn-pay-now">
                                                <i class="fas fa-credit-card"></i> Pay Now
                                            </a>
                                        @elseif($order->status == 'payment_completed')
                                            <a href="#" class="order-btn btn-sign-contract">
                                                <i class="fas fa-signature"></i> Sign Contract
                                            </a>
                                        @elseif($order->status == 'contract_signed')
                                            <a href="#" class="order-btn btn-download-contract">
                                                <i class="fas fa-download"></i> Download Contract
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Pagination -->
                <div class="row">
                    <div class="col-md-12">
                        {{ $orders->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
