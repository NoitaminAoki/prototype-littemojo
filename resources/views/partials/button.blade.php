@if(in_array("add", $action))
<a href="{{\Request::url().'/create'}}" class="btn btn-primary btn-sm my-2">Add</a>
@endif

@if(in_array("save", $action))
<button type="submit" class="btn btn-primary btn-sm">Submit</button>
@endif

@if(in_array("update", $action))
<button type="submit" class="btn btn-primary btn-sm">Update</button>
@endif

<!-- ini button buat table -->
@if(in_array("show", $action))
<div class="mx-1">
	<a href="{{\Request::url().'/'.$id}}" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Show">
		<i class="fas fa-search"></i>
	</a>
</div>
@endif

@if(in_array("edit", $action))
<div class="mx-1">
	<a href="{{\Request::url().'/'.$id.'/edit'}}" class="btn btn-outline-warning btn-sm" data-toggle="tooltip" data-placement="bottom" title="Edit">
		<i class="fas fa-edit"></i>
	</a>
</div>
@endif

@if(in_array("delete", $action))
<div class="mx-1">
	<form action="{{\Request::url().'/'.$id}}" method="POST">
		{{ method_field('DELETE') }}
		@csrf
		<button type="submit" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Delete">
			<i class="fas fa-trash"></i>
		</button>
	</form>    
</div>
@endif

@section('scripts')
<script>
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
</script>
@endsection