@extends('master')
@section('content')
<div class="container">
    <h3 class="text-primary text-center">Demand List (Nation)</h3>

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
        @foreach($demands as $row)
        <tr>
            <td>{{$loop->index+1}}</td>
            {{-- <td>{{$row->refNumber}}</td> --}}
            <td>{{$row->type}}</td>
            <td>{{$row->product}}</td>
            <td>{{$row->quantity.' '.$row->unit}}</td>
            <td>{{$row->price}}</td>
            {{-- <td>{{$row->tentativeRequiredDate}}</td> --}}
            <td>
              <a href="{{route('view-detail',$row->id)}}">
                <i class="fa fa-eye" aria-hidden="true"> </i> View</a>
              </a>
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