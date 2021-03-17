@extends('partners.templates.main')

@section('css')
{{-- kosong --}}
@endsection

@section('Page-Header', 'Corporation')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Manage</li>
<li class="breadcrumb-item active">Course</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg">
        <div class="card">
            <div class="card-body">
                @include('partials.button', ['action' => ['add']])
                <table id="example1" class="table table-bordered table-striped table-hover">
                    @include('partials.alert')
                    <thead>
                        <tr role="row">
                            <th>No</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Logo</th>
                            <th>Thumbnail</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($corporations as $corporation)
                        <tr>
                            <td width="40px;">{{($loop->index+1)}}</td>
                            <td>{{$corporation->name}}</td>
                            <td><img src="{{url('uploaded_files/corporation/'.$corporation->image)}}" class="img-fluid" alt="" style="width: 150px;height: 150px;"></td>
                            <td><img src="{{url('uploaded_files/corporation/'.$corporation->logo)}}" class="img-fluid" alt=""></td>
                            <td><img src="{{url('uploaded_files/corporation/'.$corporation->thumbnail)}}" class="img-fluid" alt=""></td>
                            <td width="100px;" class="text-center">
                                <div class="d-flex justify-content-center">
                                    @include('partials.button', ['action' => ['edit'], 'id' => $corporation->id ])
                                    @include('partials.button', ['action' => ['delete'], 'id' => $corporation->id ])
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>        
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $("#example1").DataTable({
            "autoWidth": false,
        });
    })
</script>
@endsection