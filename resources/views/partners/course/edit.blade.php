@extends('partners.templates.main')

@section('css')
{{-- kosong --}}
@endsection

@section('Page-Header', 'Edit Course')

@section('breadcrumbs')
<li class="breadcrumb-item">Course</li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg">
        <div class="card">
            <form action="{{route('partner.manage.course.update', $data->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
                <div class="card-body">
                    @include('partials.alert')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Catalog</label>
                                <select class="form-control select2" style="width: 100%;" name="catalog_id" required>
                                    <option selected="selected" value=""></option>
                                    @foreach($catalogs as $catalog)
                                    <option value="{{$catalog->id}}" {{$data->catalog_id == $catalog->id ? 'selected' : ''}}>{{$catalog->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Topic</label>
                                <input type="text" name="name" value="{{$data->name_catalog_topic}}" class="form-control">
                                <input type="hidden" class="form-control" name="catalog_topic_id"  placeholder="Masukkan Nama Topic" required autocomplete="off">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="attachment-block custom-attachment-block">
                                <div class="border-bottom pb-1">
                                    <span>Suggested Topics</span>
                                </div>
                                <div class="list-topic">
                                    <div class="d-flex flex-wrap mt-3" id="div-konten" style="height: 80px;">
                                        <!-- konten -->                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" value="{{$data->title}}" placeholder="Masukkan Title" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Level</label>
                                <select class="form-control select2" style="width: 100%;" name="level_id" required>
                                    <option selected="selected" value=""></option>
                                    @foreach($levels as $level)
                                    <option value="{{$level->id}}" {{$data->level_id == $level->id ? 'selected' : ''}}>{{$level->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="text" class="form-control" name="price" value="{{$data->price}}" placeholder="Masukkan Harga" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Durasi</label>
                                <select class="form-control select2" style="width: 100%;" name="duration" required>
                                    <option selected="selected" value=""></option>
                                    <option value="week" {{$data->duration == 'week' ? 'selected' : ''}}>7 Hari</option>
                                    <option value="month" {{$data->duration == 'month' ? 'selected' : ''}}>30 Hari</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Cover</label>
                        <input type="file" class="form-control" name="filename" placeholder="Masukkan Cover">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="description" id="summernote" placeholder="Masukkan Deskripsi">{!! $data->description !!}</textarea>
                        <!-- <div id="summernote" name="description"></div> -->
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
    $('[name="catalog_id"]').select2({
        placeholder: '-- Pilih Catalog --',
        width: '100%'
    })
    $('[name="level_id"]').select2({
        placeholder: '-- Pilih Level --',
        width: '100%'
    })
    $('[name="duration"]').select2({
        placeholder: '-- Pilih Durasi --',
        width: '100%'
    })
    $('#summernote').summernote()
    function getTopic(id){
        $.ajax({
            url: "{{url('partner/management/course/suggestTopic')}}" + '/' + id,
            method: 'GET',
            success: function(data){
                var html = '';
                $.each(data, function(k, v){
                    html += '<div class="item__suggess-topic rounded bg-outline-blue mx-2">'
                    html += '<button class="btn btn-sm btn-outline-primary" id="btn-sugest" data-id='+v.id+'>'+v.name+'</button>'
                    html += '</div>'
                })
                $('#div-konten').html(html)
            }
        })
    }
    getTopic('{{$data->catalog_id}}')
    $('[name="catalog_id"]').change(function(){
        let id = $(this).val()
        getTopic(id)
        
    })
    $('body').on('click', '#btn-sugest', function(e){
        e.preventDefault()        
        let id = $(this).data('id')
        $('[name="name"]').val($(this).text())
        $('[name="catalog_topic_id"]').val(id)
        $('#btn-sugest:not([data-id="'+id+'"])').remove()
    })
</script>
@endsection