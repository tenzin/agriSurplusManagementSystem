@extends('master')

@section('content')
{{-- @include('flash-message') --}}
<section class="content">
      <div class="card card-info">
         <div class="card-header">
            <h3 class="card-title">Units List</h3>
         </div>
    <div class="card-body">
      <table id="unit" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Sl. No.</th>
            <th>Units</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        @foreach($units as $unit)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$unit->unit}}</td> 
                      <td><a href="{{ route('unit-edit',[$unit->id]) }}" class="btn btn-warning">Edit</a></td>                     
                    </tr>
        @endforeach            

        </tbody>
      </table>
      {{ $units->links() }}
    </div>
</div>  
</section>

</div>
</div>
@endsection