@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote.css') }}">

<style>
    .file-form-control {
        height: calc(2.25rem + 7px);
    }
    .list-topic {
        min-height: 80px;
    }
    .bg-outline-blue {
        border: 1px solid #1e9da2;
        color: #1e9da2;
    }
    .item__suggess-topic {
        cursor: pointer;
    }
</style>
@endsection

@section('Page-Header', 'Add Course')


@section('breadcrumbs')
<li class="breadcrumb-item">Course</li>
<li class="breadcrumb-item active">Add</li>
@endsection

<div class="row">
    <div class="col-lg">
        <div class="card">
            <form action="{{route('partner.manage.course.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @include('partials.alert')
                    <div class="row">
                        <div wire:ignore class="form-group col-lg-6">
                            <label>Catalog Name</label>
                            <select class="form-control select2" style="width: 100%;" name="catalog_id" required>
                                <option selected="selected" value=""></option>
                                @foreach($catalogs as $catalog)
                                <option value="{{$catalog->id}}">{{$catalog->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Topic</label>
                            <input type="text" id="input_topic" wire:model.debounce.600ms="topic_name" class="form-control" name="name" placeholder="Masukkan Nama Topic" required autocomplete="off">
                        </div>
                        <div class="col-lg-12">
                            <div class="attachment-block custom-attachment-block">
                                <div class="border-bottom pb-1">
                                    <span>Suggested Topics</span>
                                </div>
                                <div class="list-topic">
                                    <div class="d-flex flex-wrap mt-3">
                                        @foreach ($suggested_topics as $topic)
                                        <div class="item__suggess-topic rounded bg-outline-blue py-1 px-2 my-1 mx-2">{{$topic->name}}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" value="{{old('title')}}" placeholder="Masukkan Title" required>
                        </div>
                        <div wire:ignore class="form-group col-lg-6">
                            <label>Level</label>
                            <select class="form-control select2" style="width: 100%;" name="level_id" required>
                                <option selected="selected" value=""></option>
                                @foreach($levels as $level)
                                <option value="{{$level->id}}">{{$level->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Price</label>
                            <input type="text" class="form-control" name="price" value="{{old('price')}}" placeholder="Masukkan Harga" required>
                        </div>
                        <div wire:ignore class="form-group col-lg-6">
                            <label>Duration</label>
                            <select class="form-control select2" style="width: 100%;" name="duration" required>
                                <option selected="selected" value=""></option>
                                <option value="week">7 Hari</option>
                                <option value="month">30 Hari</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-12">
                            <label>Cover</label>
                            <input type="file" class="form-control file-form-control" name="filename" placeholder="Masukkan Cover" required>
                        </div>
                        <div wire:ignore class="form-group col-lg-12">
                            <label>Description</label>
                            <textarea name="description" id="summernote" placeholder="Masukkan Deskripsi">{{old('description')}}</textarea>
                            <!-- <div id="summernote" name="description"></div> -->
                        </div>
                        <div class="col-lg-12 d-flex justify-content-between">
                            <a href="{{ route('partner.manage.course.index') }}" class="btn btn-warning btn-sm">Back</a>
                            @include('partials.button', ['action' => ['save']])
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>        
</div>


@push('script')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js')}} "></script>
<script src="{{ asset('plugins/summernote/summernote.js')}} "></script>
<script>
    $('[name="catalog_id"]').select2({
        placeholder: '-- Choose Catalog --',
        width: '100%'
    })
    $('[name="level_id"]').select2({
        placeholder: '-- Choose Level --',
        width: '100%'
    })
    $('[name="duration"]').select2({
        placeholder: '-- Choose Duration --',
        width: '100%'
    })
    $('#summernote').summernote()
    
    
    document.addEventListener('livewire:load', function () {
        $('[name="catalog_id"]').on('change', function() {
            var value = $(this).val();
            Livewire.emit('evSearchTopic', value);
        })
        $(document).on('click', '.item__suggess-topic', function() {
            var value = $(this).text();
            Livewire.emit('evSetTopic', value);
        });
        $(document).on('click', '.btn-delete', function () {
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    @this.delete(id);
                }
            }); 
        });
    });
</script> 
@endpush
