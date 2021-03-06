@extends('admins.templates.main')

@section('css')
{{-- kosong --}}
@endsection

@section('Page-Header', 'Master Catalog')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#">Master</a></li>
<li class="breadcrumb-item active">Catalog</li>
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
                            <th>Created By</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($catalogs as $catalog)
                        <tr>
                            <td width="40px;">{{$catalog->id}}</td>
                            <td>{{$catalog->name}}</td>
                            <td>{{is_null($catalog->created_by) ? '-' : $catalog->created_by}}</td>
                            <td width="100px;" class="text-center">
                                <div class="d-flex justify-content-center">
                                    @include('partials.button', ['action' => ['edit'], 'id' => $catalog->id ])
                                    @include('partials.button', ['action' => ['delete'], 'id' => $catalog->id ])      
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