@if(\Session::has('alert-message'))
<div class="alert alert-primary">
	{{\Session::get('alert-message')}}
</div>
@endif
@if($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach($errors->messages() as $value)
		<li>
			{{$value[0]}}
		</li>                              
		@endforeach
	</ul>
</div>
@endif
<script>
	setTimeout(function(){
		$('.alert').hide(800)
	}, 7000)
</script>