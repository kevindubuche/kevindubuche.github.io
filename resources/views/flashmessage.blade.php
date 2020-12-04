@if($message=Session::get('succes'))
<div id="succes"class="alert alert-success alert-block">
<button type="button" class="close" data-dismiss="alert">x</button>
<p>{{$message}}</p>
</div>
@elseif($message=Session::get('error'))
<div id="succes"class="alert alert-warning alert-block">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <p>{{$message}}</p>
</div>
@endif