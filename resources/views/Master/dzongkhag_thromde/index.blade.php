@extends('master')

@section('content')
<div class="content-header">
        <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Dzongkhag List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl. no</th>
                  <th>Dzongkhag_Thromde</th>                 
                </tr>
                </thead>
                <tbody>
                  @foreach($dzo as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>                             
                                    <td>{{ $row->dzongkhag }}</td>
                                    
                                </tr>
                  @endforeach
              </table>
            </div>
    </div>         
</div>
</div>
</div>

@endsection