@extends('admins.templates.main')

@section('css')
{{-- kosong --}}
@endsection

@section('Page-Header', 'Ubah Topic Catalog')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#">Master</a></li>
<li class="breadcrumb-item">Topic Catalog</li>
<li class="breadcrumb-item active">Ubah</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg">
        <div class="card">
            <form action="{{route('admin.catalog_topic.update', $id)}}" method="POST">
                @csrf
                {{ method_field('PATCH') }}
                <div class="card-body">
                    @include('partials.alert')
                    <div class="form-group">
                        <label>Nama Catalog</label>
                        <select class="form-control" name="catalog_id">
                            <option selected="selected">Pilih Catalog</option>
                            @foreach($catalogs as $catalog)
                            <option value="{{$catalog->id}}" {{$catalog_topic->catalog_id == $catalog->id ? 'selected' : ''}} >{{$catalog->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Topic</label>
                        <input type="text" class="form-control" name="name" value="{{$catalog_topic->name}}" placeholder="Masukkan Nama Topic" required>
                    </div>
                    @include('partials.button', ['action' => ['update']])
                </div>
            </form>
        </div>
    </div>        
</div>
@endsection