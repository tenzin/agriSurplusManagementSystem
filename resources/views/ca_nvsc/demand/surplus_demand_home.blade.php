@extends('master')

@section('content')
{{-- @include('flash-message') --}}

<section class="content">
  <h1 class="text-center mt-1 mb-1 alert aqua">Surplus Demand Details Information</h1>
      {{-- <div class="card card-info">
         <div class="card-header">
            <h3 class="card-title">Surplus Demand Details</h3>
         </div> --}}
         <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Sl. no</th>
            <th>Product Name</th>
            <th>Product Type</th>
            <th>Quantity</th>
            <th>Date</th>
            <th>Price</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
               @foreach($demand as $d)
                  <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$d->product->product}}</td>
                      <td>{{$d->product->productType->type}}</td>
                      <td>{{$d->quantity.' '.$d->unit->unit}}</td>
                      <td>{{$d->tentativeRequiredDate}}</td>
                      <td>Nu. {{$d->price}}</td>
                      <td>{{$d->status}}</td>
                      <td><a href="/edit_submitted/{{$row->id}}">
                        <i class="fa fa-edit" aria-hidden="true"> </i> Edit</a>
                      </td>
                  </tr>
               @endforeach
        </tbody> 
      </table>
    </div>
  </div>  
  </section>
  
  </div>
  </div>
@endsection

   
     












