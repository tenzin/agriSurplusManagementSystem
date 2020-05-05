@extends('master')

@section('content')

{{-- @include('flash-message') --}}

<div class="container-fluid"> 
<div class="card card-info">
<div class="card-header">
<h3 class="card-title">Update Product</h3>
</div>
<form role="form" method="POST" action="{{route('product-update',$product->id)}}">
@csrf


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

<div class="card-body">
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


    <div class="card-footer">
      <button type="submit" class="btn btn-info float-left">Update</button>
    </div>
</div>        
</form>
</div>
</div>


@endsection
