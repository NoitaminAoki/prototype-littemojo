@extends('admins.templates.main')

@section('css')
{{-- kosong --}}
@endsection

@section('Page-Header', 'Tambah Catalog')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#">Master</a></li>
<li class="breadcrumb-item">Catalog</li>
<li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg">
        <div class="card">
            <form action="{{route('catalog.store')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="name" placeholder="Masukkan Nama Catalog" required>
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>        
</div>
@endsection
@section('script')
<script>
    $('button').click(function(){
        if ($('input').val() != '') {
            $(this).attr('disabled', true)
            $(this).text('Load..')
        }        
    })
</script>
@endsection