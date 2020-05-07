<?php
if($_GET['t'] == "gewog") { ?>
<select name="gewog" id="gewog">
    <?php $gewogs = App\Gewog::where('dzongkhag_id',$_GET['d'])->get(); ?>
    @foreach($gewogs as $gewog)
       
            <option value="{{ $gewog->id }}">{{ $gewog->gewog}}</option> 
    @endforeach
</select>
<?php
} //end of gewog.
?>