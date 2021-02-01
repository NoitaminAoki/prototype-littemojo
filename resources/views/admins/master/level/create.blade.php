@extends('admins.templates.main')

@section('css')
{{-- kosong --}}
@endsection

@section('Page-Header', 'Tambah Level')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#">Master</a></li>
<li class="breadcrumb-item">Level</li>
<li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg">
        <div class="card">
            <form action="{{route('admin.level.store')}}" method="POST">
                @csrf
                <div class="card-body">
                    @include('partials.alert')
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Masukkan Nama Level" required>
                    </div>
                    <div class="form-group">
                        <label>Kesulitan</label>
                        <select name="difficulty" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input type="text" class="form-control" name="description" value="{{old('description')}}" placeholder="Masukkan Deskripsi" required>
                    </div>
                    @include('partials.button', ['action' => ['save']])
                </div>
            </form>
        </div>
    </div>        
</div>
@endsection