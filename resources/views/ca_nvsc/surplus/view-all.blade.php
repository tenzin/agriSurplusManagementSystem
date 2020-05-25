@extends('master')
@section('content')
<div class="container">
    <h2 class="text-primary text-center">Surplus List</h2>
    
    <table id="example1"class="table table-bordered table-striped table-sm">
    <thead>
        <tr>
        <th>#</th>
        {{-- <th scope="col">Referance No.</th> --}}
        <th>Product Type</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Price</th>
        {{-- <th>Pick Up Date</th> --}}
        <th>Action</th>
        </tr>
    </thead>
    <tbody>
        {{-- @forelse ($supply as $row) --}}
        @foreach($supply as $row)
        <tr>
            <td>{{$loop->iteration}}</td>
            {{-- <td>{{$row->refNumber}}</td> --}}
            <td>{{$row->type}}</td>
            <td>{{$row->product}}</td>
            <td>{{$row->quantity.' '.$row->unit}}</td>
            <td>{{$row->price}}</td>
            {{-- <td>{{$row->tentativePickupDate}}</td> --}}
            <td>
              <a href="{{route('view-details',$row->id)}}">
                <i class="fa fa-eye" aria-hidden="true"> </i> View</a>
              </a>
            </td>
            {{-- @empty
            <td colspan="7" class="text-center text-danger">Please choose an appropriate filters to search</td>
            @endforelse --}}
        </tr>
        @endforeach
    </tbody>
    </table>
    {{-- {{ $supply->links() }} --}}
    <div class="row">
        <div class="col-12 text-center">

        </div>
    </div>
</div>
@endsection