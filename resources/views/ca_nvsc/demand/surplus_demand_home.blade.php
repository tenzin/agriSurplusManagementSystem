@extends('master')

@section('content')
{{-- @include('flash-message') --}}

<section class="content">
      <div class="card card-info">
         <div class="card-header">
            <h3 class="card-title">Surplus Demand Details</h3>
         </div>

    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Sl. no</th>
            <th>Produce</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Tentitive Supply Date</th>
            <th>Remarks</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
                    <tr>
                      <td>1</td>
                      <td>Cabbage</td>
                      <td>500kg</td>
                      <td>50</td>
                      <td>30/07/2020</td>
                      <td>Good</td>
                      <td>Avaliable</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Chilli</td>
                      <td>500kg</td>
                      <td>50</td>
                      <td>30/07/2020</td>
                      <td>Good</td>
                      <td>Avaliable</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Potatoes</td>
                      <td>500kg</td>
                      <td>50</td>
                      <td>30/07/2020</td>
                      <td>Good</td>
                      <td>Avaliable</td>
                    </tr>
        </tbody>

          
      </table>
    </div>
</div>  
</section>

</div>
</div>
@endsection
   
     












