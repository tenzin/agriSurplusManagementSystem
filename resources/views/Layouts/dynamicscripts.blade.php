<script type="text/javascript">

$("#addrow").click(function(){


 var tmphtml = '<div class= "row"><div class= "col col-md-3"><select class= "form-control custom-select " name= "producttype[]" required><option value="">Choose...</option>@foreach($product_type as $row)<option value="{{$row->id}}">{{$row->type}}</option>@endforeach</select></div>';
     tmphtml += '<div class= "col col-md-3 "><select class= "form-control custom-select " name= "product[] "><option value= "">Choose...</option></select>';        
     tmphtml += '</div><div class="col col-md-2"><input type= "date " class= "form-control " name= "harvestdate[] " id = "harvestdate " value= "{{$trans->harvestdate ?? date('Y-m-d') }} " required>';
     tmphtml += '</div><div class="col col-md-2"><div class= "row"><div class= "col "><input type= "text " class= "form-control col " name= "quantity[] " id = "quantity " required></div>';
     tmphtml += '<div class= "col "><select name= "unit " id= "unit"></select></div></div></div><div class= "col col-md-2">';  
     tmphtml += '<div class= "form-group row "><div class= "col "><input type= "text " class= "form-control " name= "price[] " id = "price "></div>';
     tmphtml += '<div class= "col "><button class= "btn btn-info " type= "button " onclick= "addrow() "><i class= "fa fa-plus "></i></button></div></div></div></div>';

    $("#newrows").append(tmphtml);

});

</script>