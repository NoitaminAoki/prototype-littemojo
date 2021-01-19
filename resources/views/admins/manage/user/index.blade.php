@extends('admins.templates.main')

@section('css')
{{-- kosong --}}
@endsection

@section('Page-Header', 'Manage User')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#">Manage</a></li>
<li class="breadcrumb-item active">User</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg">
        <div class="card">
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover" role="grid" aria-describedby="example1_info">
                    @include('partials.alert')
                    <thead>
                        <tr role="row">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td width="40px;">{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if($user->status == 'A')
                                <span class="badge badge-primary">Active</span>
                                @else
                                <span class="badge badge-danger">Deactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{\Request::url().'/'.$user->id.'/edit'}}" class="btn btn-outline-primary btn-sm">
                                    Edit
                                </a>
                                <form action="{{route('admin.user.destroy', $user->id)}}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    @if($user->status == 'A')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        Non Aktifkan
                                    </button>
                                    @else
                                    <button type="submit" class="btn btn-outline-info btn-sm">
                                        Aktifkan
                                    </button>
                                    @endif
                                </form>                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tfoot>
                </table>
            </div>
        </div>        
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $("#example1").DataTable({
            "order": [[ 2, "desc" ]]
        })
    })
</script>
@endsection