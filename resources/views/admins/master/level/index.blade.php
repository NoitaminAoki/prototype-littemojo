@extends('admins.templates.main')

@section('css')
{{-- kosong --}}
@endsection

@section('Page-Header', 'Master Level')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#">Master</a></li>
<li class="breadcrumb-item active">Level</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg">
        <div class="card">
            <div class="card-body">
                @include('partials.button', ['action' => ['add']])
                <table id="example1" class="table table-bordered table-striped table-hover" role="grid" aria-describedby="example1_info">
                    @include('partials.alert')
                    <thead>
                        <tr role="row">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Difficulty</th>
                            <th>Description</th>
                            <th>Created By</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($levels as $level)
                        <tr>
                            <td width="40px;">{{$level->id}}</td>
                            <td>{{$level->name}}</td>
                            <td>{{$level->difficulty}}</td>
                            <td>{{$level->description}}</td>
                            <td>{{is_null($level->created_by) ? '-' : $level->created_by}}</td>
                            <td width="100px;" class="text-center">
                                <div class="d-flex justify-content-center">
                                    @include('partials.button', ['action' => ['edit'], 'id' => $level->id ])
                                    @include('partials.button', ['action' => ['delete'], 'id' => $level->id ])      
                                </div>                         
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Created By</th>
                        <th>Aksi</th>
                    </tfoot>
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
            "order": [[ 2, "desc" ]]
        })
    })
</script>
@endsection