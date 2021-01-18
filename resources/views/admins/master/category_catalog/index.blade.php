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
                        @foreach($category_catalogs as $category)
                        <tr>
                            <td width="40px;">{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->nama_catalog}}</td>
                            <td>{{is_null($category->created_by) ? '-' : $category->created_by}}</td>
                            <td>
                                <a href="{{\Request::url().'/'.$category->id.'/edit'}}" class="btn btn-outline-primary btn-sm">
                                    Edit
                                </a>
                                <form action="{{route('catalog_topic.destroy', $category->id)}}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>                                
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