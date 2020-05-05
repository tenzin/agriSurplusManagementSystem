@extends('master')

@section('content')
{{-- @include('flash-message') --}}
<section class="content">
      <div class="card card-info">
         <div class="card-header">
            <h3 class="card-title">Product Types</h3>
         </div>
    <div class="card-body">
      <table id="ptype" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Sl. No.</th>
            <th>Type</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        @foreach($ptypes as $ptype)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$ptype->type}}</td> 
                      <td><a href="{{ route('product-type-edit',[$ptype->id]) }}" class="btn btn-warning">Edit</a></td>                     
                    </tr>
        @endforeach            

        </tbody>
      </table>
      {{ $ptypes->links() }}
    </div>
</div>  
</section>

</div>
</div>
@endsection