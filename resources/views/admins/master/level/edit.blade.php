@extends('admins.templates.main')

@section('css')
{{-- kosong --}}
@endsection

@section('Page-Header', 'Ubah Level')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#">Master</a></li>
<li class="breadcrumb-item">Level</li>
<li class="breadcrumb-item active">Ubah</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg">
        <div class="card">
            <form action="{{route('admin.level.update', $id)}}" method="POST">
                @csrf
                {{ method_field('PATCH') }}
                <div class="card-body">
                    @include('partials.alert')
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="name" value="{{$level->name}}" placeholder="Masukkan Nama Level" required>
                    </div>
                    <div class="form-group">
                        <label>Kesulitan</label>
                        <select name="difficulty" class="form-control">
                            <option value="1" {{$level->difficulty == 1 ? 'selected' : ''}}>1</option>
                            <option value="2" {{$level->difficulty == 2 ? 'selected' : ''}}>2</option>
                            <option value="3" {{$level->difficulty == 3 ? 'selected' : ''}}>3</option>
                            <option value="4" {{$level->difficulty == 4 ? 'selected' : ''}}>4</option>
                            <option value="5" {{$level->difficulty == 5 ? 'selected' : ''}}>5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input type="text" class="form-control" name="description" value="{{$level->description}}" placeholder="Masukkan Deskripsi" required>
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