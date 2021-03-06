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
                @include('partials.button', ['action' => ['add']])
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
                                    @include('partials.button', ['action' => ['edit'], 'id' => $catalog_topic->id ])
                                    @include('partials.button', ['action' => ['delete'], 'id' => $catalog_topic->id ])       
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