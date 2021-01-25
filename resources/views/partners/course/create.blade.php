@extends('partners.templates.main')

@section('css')
{{-- kosong --}}
@endsection

@section('Page-Header', 'Tambah Course')

@section('breadcrumbs')
<li class="breadcrumb-item">Course</li>
<li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg">
        <div class="card">
            <form action="{{route('partner.manage.course.store')}}" method="POST">
                @csrf
                <div class="card-body">
                    @include('partials.alert')
                    <div class="form-group">
                        <label>Nama Catalog</label>
                        <select class="form-control" name="catalog_id">
                            <option selected="selected" value="">Pilih Catalog</option>
                            @foreach($catalogs as $catalog)
                            <option value="{{$catalog->id}}">{{$catalog->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Catalog Topic</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Masukkan Nama Topic" required>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" value="{{old('title')}}" placeholder="Masukkan Title" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control" name="description" placeholder="Masukkan Deskripsi">{{old('description')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" class="form-control" name="price" value="{{old('price')}}" placeholder="Masukkan Harga" required>
                    </div>
                    <button type="submit" class="btn btn-outline-primary btn-sm">Simpan</button>
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