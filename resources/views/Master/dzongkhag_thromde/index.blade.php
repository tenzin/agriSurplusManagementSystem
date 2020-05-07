@extends('master')

@section('content')
<div class="content-header">
  <form class="form-horizontal" method="POST" action = "{{route('dzongkhag-store')}}">
    @csrf
  <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Add Dzongkhag/Thromde to Region</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if ($errors->any())
            <div class="col-sm-12">
                <div class="alert  alert-warning alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                        <span><p>{{ $error }}</p></span>
                    @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            </div>
        @endif
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="code">Code:<font color="red">*</font></label>
              <input id="code" type="text" class="form-control" name="code" maxlength="5" placeholder="Enter code..."/>
            </div>                
          </div>
      </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="dzongkhag">Dzongkhag/Thromde:<font color="red">*</font></label>
              <input id="dzongkhag" type="text" class="form-control" name="dzongkhag" maxlength="50" placeholder="Enter Dzongkhag/Thromde..."/>
            </div>                
          </div>
      </div>
          </div>
          <!-- /.card-body -->
          @csrf
          <div class="card-footer">
            <a href="{{ url()->current() }}" class="btn btn-danger">Reset</a>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
  </div>
</form>

    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Dzongkhag-Region List</h3>
        </div>
        <div class="card-body">
              <table id="example1" class="table table-bordered">
                <thead>                  
                  <tr>
                    <th>Sl. No.</th>
                    <th>Dzongkhag/Thromde</th>     
                    <th>Region</th> 
                    <th>Actions</th>           
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($dzo as $row)
                                  <tr>
                                      <td>{{ $loop->iteration }}</td>                             
                                      <td>{{ $row->dzongkhag }}</td>
                                      <td>@if(!empty($row->regionName->region)) {{ $row->regionName->region }} @endif</td>
                                      <td>
                                        <a href="{{ route('dzongkhag-edit',[$row->id]) }}" class="btn btn-primary btn-xs" onclick="return confirm('Are you sure to you want to edit this data?');"> Edit</a> &nbsp;
                                        <a href="{{ route('dzongkhag-delete',[$row->id]) }}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to you want to delete this data?');"> Delete</a>                      
                                      </td>
                                  </tr>
                    @endforeach
                        
                </tbody>
              </table>
        </div>
    </div>
         
</div>
@endsection