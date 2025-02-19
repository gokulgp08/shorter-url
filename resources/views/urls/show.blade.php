@extends('layout')
   
@section('content')
  
<div class="mt-5 card">
  <h2 class="card-header">Show Details</h2>
  <div class="card-body">
          
        @session('success')
            <div class="alert alert-success" role="alert"> {{ $value }} </div>
        @endsession
  
        <div class="gap-2 d-grid d-md-flex justify-content-md-end">
          <a class="btn btn-primary btn-sm" href="{{ route('url.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
        
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                  <strong>Total Visit:</strong> <br/>
                  {{ $total_visit }}
              </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Url:</strong> <br/>
                <a href="{{route('url.new',['output_url'=> $urlshort->output_url])}}">{{ $urlshort->output_url }}</a>
            </div>
          </div> 
        </div>    
        <table class="table mt-4 table-bordered table-striped">
            <thead>
                <tr>
                    <th>Visited Ip</th>
                    <th>Visied Time</th>
                </tr>
            </thead>
  
            <tbody>
            @forelse ($visits as $visit)
                <tr>
                    <td>{{ $visit->ip_address }}</td>
                    <td>{{ $visit->visited_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">There are no data.</td>
                </tr>
            @endforelse
            </tbody>
  
        </table>
        
        {!! $visits->links() !!}
  
  </div>
</div>  
@endsection