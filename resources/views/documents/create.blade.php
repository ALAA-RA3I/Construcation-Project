@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Upload New Document</h1>
    
    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        
        <div class="mb-3">
            <label for="document" class="form-label">Document</label>
            <input type="file" class="form-control" id="document" name="document" required>
            <div class="form-text">Supported formats: PDF, DOC, DOCX, TXT (Max: 10MB)</div>
        </div>
        
        <button type="submit" class="btn btn-primary">Upload & Verify</button>
    </form>
</div>
@endsection