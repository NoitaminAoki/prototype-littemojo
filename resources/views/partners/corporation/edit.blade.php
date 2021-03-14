@extends('partners.templates.main')

@section('css')
{{-- kosong --}}
@endsection

@section('Page-Header', 'Edit Corporation')

@section('breadcrumbs')
<li class="breadcrumb-item">Course</li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg">
        <div class="card">
            <form action="{{route('partner.manage.corporation.update', $corporation->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
                <div class="card-body">
                    @include('partials.alert')
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image" placeholder="Masukkan Image" required>
                    </div>
                    <div class="form-group">
                        <label>Logo</label>
                        <input type="file" class="form-control" name="logo" placeholder="Masukkan Logo" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('partner.manage.corporation.index') }}" class="btn btn-warning btn-sm">Back</a>
                        @include('partials.button', ['action' => ['save']])
                    </div>
                </div>
            </form>
        </div>
    </div>        
</div>
@endsection