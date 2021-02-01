@extends('admins.templates.main')

@section('css')
{{-- kosong --}}
@endsection

@section('Page-Header', 'Ubah User')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#">Manage</a></li>
<li class="breadcrumb-item">User</li>
<li class="breadcrumb-item active">Ubah</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg">
        <div class="card">
            <form action="{{route('admin.user.update', $id)}}" method="POST">
                @csrf
                {{ method_field('PATCH') }}
                <div class="card-body">
                    @include('partials.alert')
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="name" placeholder="Masukkan Nama User" value="{{$catalog->name}}" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Masukkan Email" value="{{$catalog->email}}" required>
                    </div>
                    @include('partials.button', ['action' => ['update']])
                </div>
            </form>
        </div>
    </div>        
</div>
@endsection