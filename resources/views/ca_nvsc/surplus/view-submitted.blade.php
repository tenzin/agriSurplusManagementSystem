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
        <th scope="col">Pick Up Location</th>
        <th scope="col">Pick Date</th>
        <th>Action</th>
        <th>Update</th>
        
        </tr>
    </thead>
    <tbody>
        @foreach($supply as $row)
        <tr>
            <td>{{$loop->index+1}}</td>
            {{-- <td>{{$row->refNumber}}</td> --}}
            <td>{{$row->type}}</td>
            <td>{{$row->product}}</td>
            <td>{{$row->quantity.' '.$row->unit}}</td>
            <td>Nu. {{$row->price}}</td>
            <td>{{$row->location}}</td>
            <td>{{$row->pickupdate}}</td>
            <td>
                @can('aggregator_edit_surplus_details')
              <a href="/edit_submited/{{$row->id}}">
              <i class="fa fa-edit" aria-hidden="true"> </i> Edit</a>
              @endcan

              @can('aggregator_view_surplus_details')
              <a href="{{route('view-details',$row->id)}}">
                <i class="fa fa-eye" aria-hidden="true"> </i> View</a>
              </a>
              @endcan
            </td>
            <td>
                <button type="button" class="btn btn-block bg-gradient-warning btn-xs" style="width:2cm;" onclick="return confirm('Are you sure all Quantity are Taken??');">
                    <a href="{{route('update',$row->id)}}" >All Taken</a>
                    </button>
                {{-- <a href="{{route('update',$row->id)}}">
                    <i class="fa fa-eye" aria-hidden="true"> </i> To Zero</a>
                 </a> --}}
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