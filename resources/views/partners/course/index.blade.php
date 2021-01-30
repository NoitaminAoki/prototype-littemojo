@extends('partners.templates.main')

@section('css')
{{-- kosong --}}
@endsection

@section('Page-Header', 'Course')

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
                <a href="{{\Request::url().'/create'}}" class="btn btn-outline-primary btn-sm my-2">Tambah Data</a>
                <table id="example1" class="table table-bordered table-striped table-hover">
                    @include('partials.alert')
                    <thead>
                        <tr role="row">
                            <th>No</th>
                            <th>Title</th>
                            <th>Catalog</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                        <tr>
                            <td width="40px;">{{($loop->index+1)}}</td>
                            <td>{{$course->title}}</td>
                            <td> {{$course->nama_catalog}} - {{$course->nama_catalog_topic}} </td>
                            <td>{{$course->price}}</td>
                            <td width="100px;" class="text-center">
                                <div class="d-flex justify-content-center">
                                    <div class="mx-1">
                                        <a href="{{\Request::url().'/'.$course->id}}" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-search"></i>
                                        </a>
                                    </div>
                                    <div class="mx-1">
                                        <a href="#" class="btn btn-outline-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="mx-1">
                                        <form action="#" method="POST">
                                            {{ method_field('DELETE') }}
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>    
                                    </div>         
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