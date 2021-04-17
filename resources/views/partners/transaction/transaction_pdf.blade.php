<!DOCTYPE html>
<html>
<head>
	<title>Data Transaction</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Data Transaction</h4>
		</center>
		
		<table class='table table-bordered'>
			<thead>
				<tr>
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
		
	</body>
	</html>