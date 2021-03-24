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
                @include('partials.button', ['action' => ['add']])
                <table id="example1" class="table table-bordered table-striped table-hover">
                    @include('partials.alert')
                    <thead>
                        <tr role="row">
                            <th>No</th>
                            <th>Title</th>
                            <th>Catalog</th>
                            <th>Level</th>
                            <th>Durasi</th>
                            <th>Price (Rp)</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                        <tr>
                            <td width="40px;">{{($loop->index+1)}}</td>
                            <td>{{$course->title}}</td>
                            <td> {{$course->nama_catalog}} - {{$course->nama_catalog_topic}} </td>
                            <td>{{$course->nama_level}}</td>
                            <td>{{ ($course->duration == "month" ? '30 Hari' : '7 Hari') }}</td>
                            <td style="width: 100px"><p>{{number_format($course->price, 0)}}</p></td>
                            <td>
                                @if($course->is_verified)
                                <span class="badge badge-primary">Verified</span>
                                @else
                                <span class="badge badge-danger">Unverified</span>
                                @endif
                                @if($course->is_published)
                                <span class="badge badge-primary">Published</span>
                                @else
                                <span class="badge badge-danger">Unpublished</span>
                                @endif
                            </td>
                            <td width="100px;" class="text-center">
                                <div class="d-flex justify-content-center">
                                    @include('partials.button', ['action' => ['show'], 'id' => $course->id ])
                                    @include('partials.button', ['action' => ['edit'], 'id' => $course->id ])
                                    @include('partials.button', ['action' => ['delete'], 'id' => $course->id ])
                                    @if($course->lessons->isEmpty() || !$course->is_verified)
                                    {{-- <div class="mx-1">
                                        -
                                    </div> --}}
                                    @elseif(!$course->is_published && $course->is_verified)
                                    <div class="mx-1">
                                        <a href="{{\Request::url().'/publish/'.$course->id}}" class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="Publish">
                                            <i class="fas fa-check"></i>
                                        </a>
                                    </div>
                                    @endif
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