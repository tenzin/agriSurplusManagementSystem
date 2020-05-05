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
            <th></th>
          </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$product->productType->type }}</td> 
                      <td>{{$product->product}}</td>   
                      <td><a href="{{ route('product-edit',[$product->id]) }}" class="btn btn-warning">Edit</a></td>                  
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