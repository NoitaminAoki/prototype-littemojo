@section('css')
@endsection

@section('Page-Header', 'Books')


@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#">Course</a></li>
@endsection

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form wire:submit.prevent="upload">
                    <label for="">File</label>
                    <input type="file" wire:model="photo" class="form-control" id="upload{{$iteration}}">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
                @error('photo') <span class="text-sm text-red-500 italic">{{ $message }}</span>@enderror
                <br>
                <div wire:loading class="text-sm italic" style="display: none">Uploading...</div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Books</h3>
                <br>
            </div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        @if ($books->isEmpty())
                        <tr class="border bg-light">
                            <td class="text-center text-secondary">No Data</td>
                        </tr>
                        @else
                        @foreach ($books as $book)
                        <tr>
                            <td><a target="_blank" href="{{ route('lesson.books', ['uuid'=>$book->uuid]) }}">{{$book->filename}}</a></td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>        
    </div>
</div>


@push('script')
@endpush
