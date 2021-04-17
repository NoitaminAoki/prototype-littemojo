@extends('admins.templates.main')

@section('css')
<style>
    #btn-verified{
        cursor: not-allowed;
    }
</style>
@endsection

@section('Page-Header', 'Partner Verif')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#">Partner</a></li>
<li class="breadcrumb-item active">Verif Partner</li>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($partners as $partner)
                        <tr>
                            <td width="40px;">{{($loop->index+1)}}</td>
                            <td>{{$partner->name}}</td>
                            <td>{{$partner->email}}</td>
                            <!-- <td>
                                @if($partner->is_verified)
                                <span class="badge badge-primary">Verified</span>
                                <br>
                                {{date_format(date_create($partner->date_verified), 'd-M-Y')}}
                                <br>
                                {{date_format(date_create($partner->date_verified), 'H:i:s')}}
                                @else
                                <span class="badge badge-danger">Unverified</span>
                                @endif
                            </td> -->
                            <td width="100px;" class="text-center">
                                <div class="d-flex justify-content-center">
                                    @if(!$partner->is_verified_by_admin)
                                    <div class="mx-1">
                                        <a href="{{\Request::url().'/'.$partner->id.'/edit'}}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                            Verif
                                        </a>
                                    </div>
                                    @else
                                    <div class="mx-1">
                                        <a href="{javascript::void(0)" class="btn btn-primary btn-sm" id="btn-verified" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                            Verified
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
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
            "autoWidth": false,
        });
    })
</script>
@endsection