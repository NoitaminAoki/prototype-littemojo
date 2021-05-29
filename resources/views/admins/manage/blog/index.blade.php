@extends('admins.templates.main')

@section('breadcrumbs')
<li class="breadcrumb-item">Blog</li>
@endsection

@section('content')
<div class="row justify-content-center">
    @forelse ($blogs as $blog)
    <div class="col-lg-3">
        <div class="card" style="width: 18rem;">
            <img src="{{ asset('storage/blogs/' . $blog->img) }}" 
            class="card-img-top" alt="{{ $blog->title }}">
            <div class="card-body">
              <h5 class="card-title">{{ $blog->title }}</h5>
              {!! Str::limit($blog->content, 10) !!}
            </div>
            <div class="card-footer">
                <a href="{{ route('blog.show', $blog->id) }}" class="btn btn-primary">
                    See article
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="alert alert-light" role="alert">
        There's no article right now
    </div>
    @endforelse
</div>

@endsection