@extends('admins.templates.main')

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
@endsection

@section('Page-Header', 'Add new article')

@section('breadcrumbs')
<li class="breadcrumb-item">Blog</li>
@endsection

@section('content')
<div class="row pb-5">
    <div class="col-12">
        @include('admins.manage.blog.form', [
            'action' => route('admin.blog.store')
        ])
    </div>
</div>
@endsection

@include('admins.manage.blog.script')