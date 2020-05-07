@extends('master')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
          <form class="form-horizontal" method="POST" action = "{{route('product-store')}}">
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
                                <option disabled selected value="">Select Product Type</option>
                                @foreach($ptypes as $ptype)
                                <option value="{{ $ptype->id }}">{{$ptype->type}}</option>
                                @endforeach
                              </select>
                          </div>                
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                          <label for="product">Product:<font color="red">*</font></label>
                          <input id="product" type="text" class="form-control" name="product" maxlength="50" placeholder="Enter product..."/>
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
                  <h3 class="card-title">Product Name List</h3>
                </div>
                <div class="card-body">
                      <table id="example1" class="table table-bordered">
                        <thead>                  
                            <tr>
                                <th>Sl. No.</th>
                                <th>Type</th>
                                <th>Product</th>
                                <th>Action</th>
                              </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                              <td>{{$loop->iteration}}</td>
                              <td>{{$product->productType->type }}</td> 
                              <td>{{$product->product}}</td>   
                              <td>
                                  {{-- <a href="{{ route('product-edit',[$product->id]) }}" class="btn btn-warning">Edit</a> --}}
                                  <a href="{{ route('product-edit',[$product->id]) }}" class="btn btn-primary btn-xs"></span>Edit</a>
                                  <a href="{{route('product-delete',$product['id'])}}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this data??');"></span>Delete</a>
                                </td>                  
                            </tr>
                            @endforeach 
                                
                        </tbody>
                      </table>
                </div>
            </div>
                 
    </div>
    
    


@endsection
