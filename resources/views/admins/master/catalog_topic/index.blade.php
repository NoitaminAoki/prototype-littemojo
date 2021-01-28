@extends('admins.templates.main')

@section('css')
{{-- kosong --}}
@endsection

@section('Page-Header', 'Master Catalog Topic')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#">Master</a></li>
<li class="breadcrumb-item active">Catalog Topic</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg">
        <div class="card">
            <div class="card-body">
                <a href="{{\Request::url().'/create'}}" class="btn btn-outline-primary btn-sm my-2">Tambah Data</a>
                <table id="example1" class="table table-bordered table-striped table-hover" role="grid" aria-describedby="example1_info">
                    @include('partials.alert')
                    <thead>
                        <tr role="row">
                            <th>No</th>
                            <th>Nama Catalog</th>
                            <th>Nama Topic</th>
                            <th>Created By</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($catalog_topics as $catalog_topic)
                        <tr>
                            <td width="40px;">{{$catalog_topic->id}}</td>
                            <td>{{$catalog_topic->name}}</td>
                            <td>{{$catalog_topic->nama_catalog}}</td>
                            <td>{{is_null($catalog_topic->created_by) ? '-' : $catalog_topic->created_by}}</td>                            
                            <td width="100px;" class="text-center">
                                <div class="d-flex justify-content-center">
                                    <div class="mx-1">
                                        <a href="{{\Request::url().'/'.$catalog_topic->id.'/edit'}}" class="btn btn-outline-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="mx-1">
                                        <form action="{{route('admin.catalog_topic.destroy', $catalog_topic->id)}}" method="POST">
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
                    <tfoot>
                        <th>No</th>
                        <th>Nama Catalog</th>
                        <th>Nama Kategori</th>
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