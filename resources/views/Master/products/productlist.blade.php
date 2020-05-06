@extends('master')

@section('content')
{{-- @include('flash-message') --}}
<section class="content">
      <div class="card card-info">
         <div class="card-header">
            <h3 class="card-title">Product List</h3>
         </div>
    <div class="card-body">
      <table id="products" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Sl. No.</th>
            <th>Type</th>
            <th>Product</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$product->productType->type }}</td> 
                      <td>{{$product->product}}</td>   
                      <td>
                        <a href="{{ route('product-edit',[$product->id]) }}" class="btn btn-warning btn-xs" onclick="return confirm('Are you sure to you want to edit this data?');"> Edit</a> &nbsp;
                        <a href="{{ route('product-delete',[$product->id]) }}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to you want to delete this data?');"> Delete</a>
                      </td>                  
                    </tr>
        @endforeach            

        </tbody>
      </table>
      {{ $products->links() }}
    </div>
</div>  
</section>

</div>
</div>
@endsection