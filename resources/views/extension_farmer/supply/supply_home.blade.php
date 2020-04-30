@extends('master')

@section('content')
{{-- @include('flash-message') --}}
<section class="content">
  <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">Supply Information
      </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Sl. no</th>
            <th>Produce</th>
            <th>Quantity</th>
            <th>Farm gate Price</th>
            <th>Harvest Date</th>
            <th>Tentitive Pickup Date</th>
            <th>Remarks</th>
            <th>Status</th>
            <th>Action &nbsp;<span class="fa fa-cogs"></span></th>
          </tr>
        </thead>    
      </table>
    </div>
</div>  
</section>

</div>
</div>
@endsection
   
     












