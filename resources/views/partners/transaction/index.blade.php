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
                <div class="container">
                    <div class="row">
                        <div class="col-sm-2">
                            <select name="status" class="form-control">
                                <option value="All">All</option>
                                <option value="Paid">Paid</option>
                            </select>
                        </div>
                        <div class="col-sm">
                            <a id="btn-exportPdf" href="#" class="btn btn-primary btn-sm my-2">Export to PDF</a>
                            <a id="btn-exportExcel" href="#" class="btn btn-primary btn-sm my-2 ml-2">Export to Excel</a>
                        </div>
                    </div>
                </div>
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr role="row">
                            <th>No</th>
                            <th>Customer Name</th>
                            <th>Course Title</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                        <tr>
                            <td width="40px;">{{($loop->index+1)}}</td>
                            <td>{{$transaction->name_customer}}</td>
                            <td>{{$transaction->title_course}}</td>
                            <td>{{$transaction->price}}</td>
                            <td class="text-{{ ($transaction->status_payment == 'waiting' || $transaction->status_payment == 'pending' ? 'yellow' : ($transaction->status_payment == 'settlement' ? 'green' : 'red')) }}">
                                @if ($transaction->status_payment == 'settlement')
                                Paid
                                @elseif ($transaction->status_payment == 'waiting')
                                Waiting for Payment
                                @else
                                {{$transaction->status_payment}}
                                @endif
                            </td>
                            <td>{{!is_null($transaction->created_at) ? date_format( date_create($transaction->created_at), 'd-M-Y H:i:s'  ) : ''}}</td>
                            
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
        $('#btn-exportPdf').click(function(){
            let status = $('[name="status"] option:selected').val()
            $(this).attr('href', 'transaction/export_pdf/'+status)
        })
        
        $('#btn-exportExcel').click(function(){
            let status = $('[name="status"] option:selected').val()
            $(this).attr('href', 'transaction/export_excel/'+status)
        })
    })
</script>
@endsection