@extends('master')

@section('content')
<div class="content-header">
  <div class="card-body">
  <form class="form-horizontal" method="POST" action = "{{route('dzongkhag-update',$dzongkhag->id)}}">
    @csrf
  <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Edit Dzongkhag/Thromde</h3>
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
              <input id="code" type="text" class="form-control" name="code" maxlength="5" value="{{ $dzongkhag->code}}" disabled/>
            </div>                
          </div>
      </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="dzongkhag">Dzongkhag/Thromde:<font color="red">*</font></label>
              <input id="dzongkhag" type="text" class="form-control" name="dzongkhag" maxlength="50" value="{{ $dzongkhag->dzongkhag}}" />
            </div>                
          </div>
      </div>

      <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="region">Region:</label>
              <select id="region" name="region">
                @if(empty($dzongkhag->region_id))
                  <option value="" selected>Optional selection</option>  
                @else
                  <option value="">Optional selection</option>
                @endif   

                @foreach($regions as $region)                  
                  @if($dzongkhag->region_id == $region->id)
                  <option value="{{$region->id}}" selected>{{$region->region}}</option>
                  @else
                  <option value="{{$region->id}}">{{$region->region}}</option>
                  @endif
                @endforeach
               
              </select>
            </div>                
          </div>
      </div>

          </div>
          <!-- /.card-body -->
          @csrf
          <div class="card-footer">           
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
  </div>
</form>

  </div>
</div>
</div>
</div>

@endsection