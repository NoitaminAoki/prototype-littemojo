@extends('admins.templates.main')

@section('css')
{{-- kosong --}}
@endsection

@section('Page-Header', 'Partner Verif Course')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#">Partner</a></li>
<li class="breadcrumb-item active">Verif Course</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg">
        <div class="card">
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover" role="grid" aria-describedby="example1_info">
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
                                <br>
                                {{date_format(date_create($course->date_verified), 'd-M-Y')}}
                                <br>
                                {{date_format(date_create($course->date_verified), 'H:i:s')}}
                                @else
                                <span class="badge badge-danger">Unverified</span>
                                @endif
                            </td>
                            <td width="100px;" class="text-center">
                                <div class="d-flex justify-content-center">
                                    @include('partials.button', ['action' => ['show'], 'id' => $course->id ])
                                    @if(!$course->is_verified)
                                    <div class="mx-1">
                                        <a href="{{\Request::url().'/'.$course->id.'/edit'}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                            Verif
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