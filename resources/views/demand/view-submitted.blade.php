@extends('master')
@section('content')
<div class="container">
    <h3 class="text-primary text-center">Demand List (Submitted)</h3>
    <center><p class="text-muted">{{$msg}}</p></center>

    <table class="table table-sm" id="demand">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Referance No.</th>
        <th scope="col">Product Type</th>
        <th scope="col">Product</th>
        <th scope="col">Quantity</th>
        <th scope="col">Price</th>
        <th scope="col">Required Date</th>
        <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($demands as $row)
        <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$row->refNumber}}</td>
            <td>{{$row->type}}</td>
            <td>{{$row->product}}</td>
            <td>{{$row->quantity.' '.$row->unit}}</td>
            <td>{{$row->price}}</td>
            <td>{{$row->tentativeRequiredDate}}</td>
            <td><a href="/edit_submitted/{{$row->id}}">
              <i class="fa fa-edit" aria-hidden="true"> </i> Edit</a>
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

