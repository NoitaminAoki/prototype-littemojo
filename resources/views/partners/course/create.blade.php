@extends('partners.templates.main')

@section('css')
{{-- kosong --}}
@endsection

@section('Page-Header', 'Add Course')

@section('breadcrumbs')
<li class="breadcrumb-item">Course</li>
<li class="breadcrumb-item active">Add</li>
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
                        <select class="form-control select2" style="width: 100%;" name="catalog_id" required>
                            <option selected="selected" value=""></option>
                            @foreach($catalogs as $catalog)
                            <option value="{{$catalog->id}}">{{$catalog->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Topic</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Masukkan Nama Topic" required autocomplete="off">
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
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('partner.manage.course.index') }}" class="btn btn-warning btn-sm">Back</a>
                        @include('partials.button', ['action' => ['save']])
                    </div>
                </div>
            </form>
        </div>
    </div>        
</div>
@endsection
@section('script')
<script>
    $('.select2').select2({
        placeholder: '-- Pilih Catalog --',
        width: '100%'
    })
</script>
@endsection