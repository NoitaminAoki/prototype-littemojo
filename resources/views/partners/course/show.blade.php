@extends('partners.templates.main')

@section('css')
{{-- kosong --}}
@endsection

@section('Page-Header', 'Detail Course')

@section('breadcrumbs')
<li class="breadcrumb-item">Course</li>
<li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg">
        <div class="card">
            <form action="javascript:void(0)" method="POST">
                @csrf
                <div class="card-body">
                    @include('partials.alert')
                    <div class="form-group">
                        <label>Nama Catalog</label>
                        <select class="form-control" name="catalog_id">
                            <option value="">Pilih Catalog</option>
                            @foreach($catalogs as $catalog)
                            <option value="{{$catalog->id}}" {{$catalog->id == $course->catalog_id ? 'selected' : ''}} >{{$catalog->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Catalog Topic</label>
                        <input type="text" class="form-control" name="name" placeholder="Masukkan Nama Topic" required value="{{$course->nama_catalog_topic}}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Masukkan Title" required value="{{$course->title}}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control" name="description" placeholder="Masukkan Deskripsi">{{$course->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" class="form-control" name="price" placeholder="Masukkan Harga" required value="{{$course->price}}" readonly>
                    </div>
                    <button type="submit" class="btn btn-outline-primary btn-sm" disabled>Simpan</button>
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