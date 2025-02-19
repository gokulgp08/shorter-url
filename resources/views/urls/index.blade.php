@extends('layout')
   
@section('content')
  
<div class="mt-5 card">
  <h2 class="card-header">Urls</h2>
  <div class="card-body">
          
        @session('success')
            <div class="alert alert-success" role="alert"> {{ $value }} </div>
        @endsession
  
        <div class="gap-2 d-grid d-md-flex justify-content-md-end">
            <a class="btn btn-success btn-sm" href="{{ route('url.create') }}"> <i class="fa fa-plus"></i> Create New</a>
        </div>
  
        <table class="table mt-4 table-bordered table-striped">
            <thead>
                <tr>
                    <th>Input url</th>
                    <th>Output url</th>
                    <th>Date</th>
                    <th width="250px">Action</th>
                </tr>
            </thead>
  
            <tbody>
            @forelse ($urls as $url)
                <tr>
                    <td>{{ $url->input_url }}</td>
                    <td>{{ $url->output_url }}</td>
                    <td>{{ $url->created_at }}</td>
                    <td>
                        <form action="{{ route('url.destroy',$url->id) }}" method="POST">
             
                            <a class="btn btn-info btn-sm" href="{{ route('url.show',$url->id) }}"><i class="fa-solid fa-list"></i> Show</a>
             
                            @csrf
                            @method('DELETE')
                
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">There are no data.</td>
                </tr>
            @endforelse
            </tbody>
  
        </table>
        
        {!! $urls->links() !!}
  
  </div>
</div>  
@endsection