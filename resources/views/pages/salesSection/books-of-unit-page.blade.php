@extends('layouts.app')
@section('page-title','Property Books')
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
    .unit-card {
        display: flex;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        min-height: 240px;
        margin-bottom: 25px;
    }

    .unit-card:hover {
        transform: translateY(-4px);
        border: 2px solid #ffd200; /* إطار أصفر عند التمرير */
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .unit-image {
        flex: 0 0 300px;
        height: 380px; /* اضف هذا لتوحيد ارتفاع الصورة */
        position: relative;
        overflow: hidden;
    }
    .unit-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        cursor: pointer;
    }
    .unit-body {
        flex: 1;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .unit-body h4 {
        font-weight: bold;
        font-size: 20px;
        margin-bottom: 12px;
        color: #333;
    }

    .unit-info {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 10px;
        color: #555;
        font-size: 15px;
    }

    .unit-info i {
        color: #f4b400;
        font-size: 16px;
        margin-top: 2px;
    }

    .info-block {
        display: flex;
        flex-direction: column;
    }

    .info-label {
        font-weight: bold;
        color: #222;
    }

    .info-value {
        color: #555;
    }

    .details-btn {
        margin-top: 10px;
    }

    .details-btn a {
        display: inline-block;
        padding: 8px 18px;
        background-color: #ffd200;
        color: #222222 !important;
        border: 2px solid #ffd200; /* جرب 2px بدل 5px */
        border-radius: 6px;
        font-weight: 600;
        transition: 0.3s ease;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        text-decoration: none;
    }

    .details-btn a:hover {
        background-color: #ffffff;
        color: rgba(34, 34, 34, 0.68) !important;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    .details-btn a:hover i {
        transform: translateX(3px);
        transition: transform 0.3s ease;
    }

    .pic-hover {
        position: relative;
        height: 100%;
        width: 100%;
        overflow: hidden; /* Add this to contain everything */
    }

    .pic-hover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .pic-hover .center-xy {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 3;
        pointer-events: none; /* Prevent interference with clicks */
    }
    .pic-hover .center-xy a {
        pointer-events: auto; /* Allow clicks on the anchor */
        display: flex; /* This helps with centering */
        justify-content: center;
        align-items: center;
        text-decoration: none !important; /* Add this line to remove underline */
    }
    .pic-hover .bg-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0);
        z-index: 2;
        transition: background 0.3s ease;
    }

    .pic-hover:hover .bg-overlay {
        background: rgba(0, 0, 0, 0.4);
    }


    .btn-action-hide {
        font-size: 24px;
        background: #fff;
        padding: 10px 12px;
        border-radius: 50%;
        box-shadow: 0 0 8px rgba(0,0,0,0.2);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .pic-hover:hover .btn-action-hide {
        opacity: 1;
    }

</style>

@section('main-content')
    <section id="subheader" data-stellar-background-ratio=".3">
        <div class="container">
            <h1>Available Property Models</h1>
            <div class="small-border-deco"><span></span></div>
            <ul class="crumb">
                <li><a href="{{ route('unitsSales') }}">Apartments for Sale</a></li>
                <li class="sep"></li>
                <li>Property Models</li>
            </ul>
        </div>
    </section>

    <div id="content">
        <div class="container">
            <div class="row">
                @foreach($books as $book)
                    <div class="col-md-6">
                        <div class="unit-card">
                            <div class="unit-image">
                                <figure class="pic-hover hover-scale mb0">
        <span class="center-xy">
            <a class="image-popup" href="{{ $book->diagram_image ?? asset('images/placeholder.jpg') }}">
                <i class="fa fa-image btn-action btn-action-hide" style="color: #ffd200;"></i>
            </a>
        </span>
                                    <span class="bg-overlay"></span>
                                    <img src="{{ $book->diagram_image ?? asset('images/placeholder.jpg') }}" class="img-responsive" alt="Diagram">
                                </figure>
                            </div>

                            <div class="unit-body">
                                <h4>Model: {{ $book->model }}</h4>

                                <div class="unit-info">
                                    <i class="fa fa-money-bill-wave"></i>
                                    <div class="info-block">
                                        <span class="info-label">Price:</span>
                                        <span class="info-value">{{ number_format($book->price, 0) }} SYP</span>
                                    </div>
                                </div>

                                <div class="unit-info">
                                    <i class="fa fa-hand-holding-usd"></i>
                                    <div class="info-block">
                                        <span class="info-label">First Pay:</span>
                                        <span class="info-value">{{ number_format($book->first_payment_amount, 0) }} SYP</span>
                                    </div>
                                </div>

                                <div class="unit-info">
                                    <i class="fa fa-calendar"></i>
                                    <div class="info-block">
                                        <span class="info-label">Payment Period:</span>
                                        <span class="info-value">{{ $book->payment_period }} months</span>
                                    </div>
                                </div>

                                <div class="unit-info">
                                    <i class="fa fa-warehouse"></i>
                                    <div class="info-block">
                                        <span class="info-label">Available Units:</span>
                                        <span class="info-value">{{ $book->available_units }}</span>
                                    </div>
                                </div>


                                <div class="details-btn">
                                    <a href="{{ route('bookDetails',$book->id) }}">
                                        View Full Details
                                        <i class="fa fa-arrow-right" style="margin-left: 8px;"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.image-popup').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                mainClass: 'mfp-img-mobile',
                image: {
                    verticalFit: true
                }
            });
        });
    </script>
@endpush
