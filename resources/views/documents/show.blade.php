@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $document->title }}</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Document Details</h5>
            <p><strong>Description:</strong> {{ $document->description }}</p>
            <p><strong>File Name:</strong> {{ $document->file_name }}</p>
            <p><strong>Uploaded At:</strong> {{ $document->created_at->format('Y-m-d H:i:s') }}</p>
            <p>
                <strong>Verification Status:</strong>
                @if($document->is_verified)
                    <span class="badge bg-success">Verified</span>
                @else
                    <span class="badge bg-danger">Not Verified</span>
                @endif
            </p>
            
            <h5 class="mt-4">Blockchain Information</h5>
            <p><strong>IPFS Hash:</strong> {{ $document->ipfs_hash }}</p>
            <p><strong>Blockchain Transaction:</strong> {{ $document->blockchain_tx_hash }}</p>
            
            <div class="mt-3">
                <a href="{{ Storage::url($document->file_path) }}" class="btn btn-primary" target="_blank">View Document</a>
                
                <form action="{{ route('documents.verify', $document) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success">Verify Document</button>
                </form>
            </div>
        </div>
    </div>
    
    <a href="{{ route('documents.index') }}" class="btn btn-secondary">Back to Documents</a>
</div>
@endsection