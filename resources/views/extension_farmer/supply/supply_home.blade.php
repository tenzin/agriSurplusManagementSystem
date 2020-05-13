
@extends('master')
@section('content')

<div class="container">
    <h3 class="text-primary text-center">Surplus List (Submitted)</h3>
    <center><p class="text-muted">{{$msg}}</p></center>

    <table id= "example1" class="table table-bordered table-striped table-sm">
    <thead>
        <tr>
        <th scope="col">#</th>
        {{-- <th scope="col">Referance No.</th> --}}
        <th scope="col">Product Type</th>
        <th scope="col">Product</th>
        <th scope="col">Quantity</th>
        <th scope="col">Price</th>
        {{-- <th scope="col">Required Date</th> --}}
        <th>Action</th>
        </tr>
    </thead>
        <tbody>
          @foreach($product as $row)
          <tr>
             <td>{{$loop->iteration}}</td>
             <td>{{$row->type}}</td>
             <td>{{$row->product}}</td>
             <td>{{$row->quantity.' '.$row->unit}}</td>
             <td>Nu. {{$row->price}}</td>
             <!-- <td>{{$row->harvestDate}}</td> -->
             <td>{{$row->tentativePickupDate}}</td>
             <td> <a href="{{route('surplus-view-detail',$row->id)}}">
                <i class="fa fa-eye" aria-hidden="true"></i>View</a>
                &nbsp;
                <a href="{{route('editi-submitted',$row->id)}}">
                <i class="fa fa-edit" aria-hidden="true"></i>Edit</a>
             </td>  
             </tr>
        @endforeach
    </tbody>
    </table>
    <div class="row">
        <div class="col-12 text-center">

        </div>
    </div>
</div>
@endsection
   
     












