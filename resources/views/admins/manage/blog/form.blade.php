@php
    $isPutMethod = isset($isPutMethod) and $isPutMethod === true ? true : false;
@endphp
@if ($isPutMethod)
<img src="{{ Storage::url($article->img) }}" alt="{{ $article->title }}" 
height="300" class="mb-5 d-block mx-auto">
@endif
<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf 
    @if ($isPutMethod)
        @method('PUT')
    @endif
    <div class="form-group">
        <label for="exampleFormControlInput1">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" 
        name="title" value="{{ $isPutMethod ? $article->title : old('title') }}" autofocus>
        @error('title')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @else
        <small id="passwordHelpBlock" class="form-text text-muted">
            Title shouldn't be more than 50 character
        </small>
        @enderror
    </div>
    <div class="form-group mb-4">
        <label for="exampleFormControlInput1">
            {{ $isPutMethod ? 'Change ' : 'Add ' }} Cover article
        </label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile" 
            name="img" accept="image/*" value="{{ old('img') }}">
            <label class="custom-file-label" for="customFile">
                {{ old('img') ?? 'Choose cover' }}
            </label>
        </div>
        @error('img')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group">
    <label for="exampleFormControlTextarea1">Content</label>
    <textarea class="form-control" name="content" 
    id="summernote" rows="3">{!! $isPutMethod ? $article->content : old('content') !!}</textarea>
    @error('content')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">
        {{ $isPutMethod ? 'Update ' : 'Add new' }} article
    </button>
</form>