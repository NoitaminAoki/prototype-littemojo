@extends('partners.templates.main')

@section('css')
{{-- kosong --}}
@endsection

@section('Page-Header', 'Transaction')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Transaction</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg">
        <div class="card">
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr role="row">
                            <th>No</th>
                            <th>Customer Name</th>
                            <th>Course Title</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Start Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                        <tr>
                            <td width="40px;">{{($loop->index+1)}}</td>
                            <td>{{$transaction->name_customer}}</td>
                            <td>{{$transaction->title_course}}</td>
                            <td>{{$transaction->price}}</td>
                            <td class="text-{{ ($transaction->status_payment == 'waiting' || $transaction->status_payment == 'pending' ? 'yellow' : ($transaction->status_payment == 'settlement' ? 'green' : 'red')) }}">{{$transaction->status_payment}}</td>
                            <td>{{!is_null($transaction->start_date) ? date_format( date_create($transaction->start_date), 'd-M-Y H:i:s'  ) : ''}}</td>

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