@extends('master')
@section('content')
<div class="container">
    <h2 class="text-primary text-center">Surplus List</h2>
    {{-- <center><p class="text-muted">{{$msg}}</p></center> --}}
    {{-- <br>
    <form action="{{ url()->current() }}" method="GET">
        <div class="row">
          <div class="col-md-4">
          <input type="date" class="form-control" name="date">
          </div>
          <div class="col-md-5">
            <select name="location" class="form-control select2bs4">
              <option value="">--Select Location--</option>
              @foreach ($locations as $location)
                  <option value="{{ $location->id }}" {{ Request::get('location') == $location->id ? 'selected' : '' }}>{{ $location->dzongkhag->dzongkhag . ' - ' . $location->gewog}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-3">
            <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> </button>
            <a href="{{ url()->current() }}" class="btn btn-danger"><i class="fa fa-undo"></i> </a>
          </div>
        </div>
      </form>

      <br> --}}
    <table id="example1"class="table table-bordered table-striped table-sm">
    <thead>
        <tr>
        <th>#</th>
        {{-- <th scope="col">Referance No.</th> --}}
        <th>Product Type</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Pick Up Date</th>
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
            <td>{{$row->tentativePickupDate}}</td>
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
    {{ $supply->links() }}
    <div class="row">
        <div class="col-12 text-center">

        </div>
    </div>
</div>
@endsection