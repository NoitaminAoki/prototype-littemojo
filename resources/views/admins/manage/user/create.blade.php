@extends('admins.templates.main')

@section('css')
{{-- kosong --}}
@endsection

@section('Page-Header', 'Tambah Catalog')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#">Manage</a></li>
<li class="breadcrumb-item">Catalog</li>
<li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg">
        <div class="card">
            <form action="{{route('admin.catalog.store')}}" method="POST">
                @csrf
                <div class="card-body">
                    @include('partials.alert')
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Masukkan Nama Catalog" required>
                    </div>
                    @include('partials.button', ['action' => ['save']])
                </div>
            </form>
        </div>
    </div>        
</div>
@endsection