@extends('layout')
    
@section('content')
  
<div class="mt-5 card">
  <h2 class="card-header">Add New Product</h2>
  <div class="card-body">
  
    <div class="gap-2 d-grid d-md-flex justify-content-md-end">
        <a class="btn btn-primary btn-sm" href="{{ route('url.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
  
    <form action="{{ route('url.store') }}" method="POST">
        @csrf
  
        <div class="mb-3">
            <label for="input_url" class="form-label"><strong>Enter url:</strong></label>
            <input 
                type="text" 
                name="input_url" 
                class="form-control @error('input_url') is-invalid @enderror" 
                id="input_url" 
                placeholder="Url">
            @error('input_url')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
    </form>
  
  </div>
</div>
@endsection