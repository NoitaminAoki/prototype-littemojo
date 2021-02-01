@extends('admins.templates.main')

@section('css')
{{-- kosong --}}
@endsection

@section('Page-Header', 'Ubah Catalog')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#">Master</a></li>
<li class="breadcrumb-item">Catalog</li>
<li class="breadcrumb-item active">Ubah</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg">
        <div class="card">
            <form action="{{route('admin.catalog.update', $id)}}" method="POST">
                @csrf
                {{ method_field('PATCH') }}
                <div class="card-body">
                    @include('partials.alert')
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="name" placeholder="Masukkan Nama Catalog" value="{{$catalog->name}}" required>
                    </div>
                    @include('partials.button', ['action' => ['update']])
                </div>
            </form>
        </div>
    </div>        
</div>
@endsection