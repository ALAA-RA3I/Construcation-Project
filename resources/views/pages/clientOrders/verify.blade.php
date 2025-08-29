@extends('layouts.app')

@section('page-title','Verify Contract')

<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
    body, h1, h2, h3, h4, h5, h6, p, a, span, li, button {
        font-family: 'Cairo', sans-serif;
    }

    .verify-section {
        padding: 120px 15px 60px;
        min-height: 80vh;
        background-color: #f7f8fa;
        display: flex;
        justify-content: center;
    }

    .verify-card {
        background-color: #fff;
        border-radius: 18px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        padding: 50px 40px;
        width: 100%;
        max-width: 720px;
        transition: all 0.3s ease-in-out;
    }

    .verify-card:hover {
        box-shadow: 0 15px 45px rgba(0,0,0,0.12);
    }

    .verify-card h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #222;
        margin-bottom: 35px;
        text-align: center;
    }

    .form-group label {
        font-weight: 600;
        color: #555;
        margin-bottom: 10px;
        display: block;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #ced4da;
        padding: 14px 18px;
        font-size: 15px;
        width: 100%;
    }

    .btn-verify {
        background-color: #28a745;
        color: #fff;
        font-weight: 600;
        padding: 14px 25px;
        border-radius: 10px;
        border: none;
        font-size: 16px;
        display: block;
        width: 100%;
        margin-top: 20px;
        transition: all 0.2s ease;
    }

    .btn-verify:hover {
        background-color: #218838;
        color: #fff;
    }

    .result-card {
        margin-top: 30px;
        padding: 25px 30px;
        border-radius: 14px;
        background-color: #f8f9fa;
        border-left: 6px solid #28a745;
        text-align: center;
    }

    .result-card h4 {
        margin-bottom: 15px;
        font-size: 1.4rem;
    }

    .result-card p {
        margin: 8px 0;
        font-size: 15px;
        color: #333;
    }

    @media (max-width: 768px) {
        .verify-card {
            padding: 30px 20px;
        }
    }
</style>

@section('main-content')
<section class="verify-section">
    <div class="verify-card">
        <h2>Verify Contract for Order #{{ $order->id }}</h2>

        <form action="{{ route('verifyContract', $order->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="document">Upload Contract Document (PDF)</label>
                <input type="file" name="document" id="document" class="form-control" accept=".pdf" required>
            </div>
            <button type="submit" class="btn-verify mt-3">Verify</button>
        </form>

        @if(session()->has('verify_result'))
            @php $result = session('verify_result'); @endphp
            <div class="result-card mt-4">
                <h4>{{ $result['is_valid'] ? ' Contract Verified Successfully!' : ' Verification Failed!' }}</h4>
                <p><strong>Message:</strong> {{ $result['message'] }}</p>
                <p><strong>Stored CID:</strong> {{ $result['stored_cid'] }}</p>
                <p><strong>Computed CID:</strong> {{ $result['computed_cid'] }}</p>
            </div>
        @endif
    </div>
</section>
@endsection
