@if(in_array("add", $action))
<a href="{{\Request::url().'/create'}}" class="btn btn-primary btn-sm my-2">Add</a>
@endif

@if(in_array("save", $action))
<button type="submit" class="btn btn-primary btn-sm">Submit</button>
@endif

@if(in_array("update", $action))
<button type="submit" class="btn btn-primary btn-sm">Update</button>
@endif