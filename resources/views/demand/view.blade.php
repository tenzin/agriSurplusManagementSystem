@extends('layouts.app')

@section('content')
<div class="container">
    <center><p class="text-muted">{{$msg}}</p></center>
    <a href="" class="btn btn-sm btn-primary">Add New</a><br>
    <table class="table table-sm">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Product Type</th>
        <th scope="col">Product</th>
        <th scope="col">Quantity</th>
        <th scope="col">Price</th>
        <th scope="col">Required Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($demands as $row)
        <tr>
        <th scope="row">{{$loop->index+1}}</th>
        <td>{{$row->type}}</td>
        <td>{{$row->product}}</td>
        <td>{{$row->quantity.' '.$row->unit}}</td>
        <td>{{$row->price}}</td>
        <td>{{$row->tentativeRequiredDate}}</td>
        </tr>
        @endforeach
    </tbody>
    </table>
    <div>
    <a href="" class="btn btn-sm btn-primary">Submit</a>
    </div>
</div>
@endsection