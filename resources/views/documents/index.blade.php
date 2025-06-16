@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Documents</h1>
    <a href="{{ route('documents.create') }}" class="btn btn-primary mb-3">Upload New Document</a>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Verified</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($documents as $document)
            <tr>
                <td>{{ $document->title }}</td>
                <td>{{ $document->description }}</td>
                <td>
                    @if($document->is_verified)
                        <span class="badge bg-success">Verified</span>
                    @else
                        <span class="badge bg-danger">Not Verified</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('documents.show', $document) }}" class="btn btn-sm btn-info">View</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection