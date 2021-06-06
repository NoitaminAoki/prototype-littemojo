@extends('admins.templates.main')


@section('Page-Header', 'Manage Blog')

@section('breadcrumbs')
<li class="breadcrumb-item">Blog</li>
@endsection

@section('content')

@if (session('success'))
<div class="alert alert-success text-center" role="alert">
    {{ session('success') }}
</div>
@endif

<a href="{{ route('admin.blog.create') }}" class="btn btn-primary">Add new article</a>
<div class="row justify-content-center mt-3">
    @forelse ($blogs as $blog)
    <div class="col-lg-3">
        <div class="card" style="width: 18rem;">
            <img src="{{ Storage::url($blog->img) }}" 
            class="card-img-top" alt="{{ $blog->title }}">
            <div class="card-body">
              <h5 class="card-title">{{ $blog->title }}</h5>
              {!! Str::limit($blog->content, 10) !!}
            </div>
            <div class="card-footer d-flex flex-wrap justify-content-between">
                <a href="{{ route('admin.blog.edit', $blog->id) }}" 
                    class="btn btn-warning">
                    Edit article
                </a>
                <form action="{{ route('admin.blog.destroy', $blog->id) }}" method="post"
                    onclick="return confirm('Are you sure you wanna delete this article?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        Delete article
                    </button>
                </form>
                <a href="{{ route('blog.show', $blog->id) }}" 
                    class="btn btn-primary d-block w-100 mt-2">
                    See article
                </a>
                <form action="{{ route('admin.blog.mark-as-highlight', $blog->id) }}" method="post"
                class="d-block w-100 mt-2">
                    @csrf @method('PUT')
                    <button type="submit"
                        class="btn @if($blog->is_highlight == true) btn-success @else btn-outline-success @endif w-100">
                        @if($blog->is_highlight == true)
                        Unmark from highlight
                        @else 
                        Mark as highlight
                        @endif
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="alert alert-light" role="alert">
        There's no article right now
    </div>
    @endforelse
</div>

{{ $blogs->links() }}

@endsection