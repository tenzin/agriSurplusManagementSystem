@extends('master')

@section('content')

<div class="content-header">
    <form class="form-horizontal" method="POST" action = "{{route('product-update',$product->id)}}">
      @csrf
    <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Add Product Name and Its Type</h3>
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
                        <label for="product_type_id">Product Type:<font color="red">*</font></label>
                        <select  name="product_type" id="product_type_id" class="form-control select2bs4">
                            <option selected value="{{ $product->productType_id }}">{{ $product->productType->type }}</option>              
                            @foreach($ptypes as $ptype)
                            <option value="{{ $ptype->id }}">{{$ptype->type}}</option>
                            @endforeach
                          </select>
                      </div>                
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                      <label for="product">Product:<font color="red">*</font></label>
                      <input id="product" type="text" class="form-control" name="product" maxlength="50" value="{{ $product->product }}" />
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
  

@endsection
