@extends('admin.layouts.tables')
@section('title', 'View Stock')
@section('viewpage')
<div class="table-responsive-sm">
	<div class="row">
		<div class="col-lg-12">
			<table id="datatable" class="table table-striped table-bordered" style="width: 100%">
				<thead>
					<tr>
						<th>Date</th>
						<th>Supplied by</th>
						<th>District</th>
						<th>Vaccine Type</th>
						<th>Quantity</th>
                        <th>Action</th>
					</tr>
				</thead>
				<tbody>
				@foreach($stocks as $stock)
					<tr id="row_{{$stock->id}}">
						<td>{{ date("d-m-Y",strtotime($stock->date)) }}</td>
						<td>{{$stock->user->name}}</td>
						<td>{{$stock->district->district}}</td>
						<td>{{$stock->vaccinetype->vname}}</td>
						<td>{{$stock->qty}}</td>
						<td>
							<span class="px-3 pt-1">
							@php
							$date_now = time(); //current timestamp
							$date_convert = strtotime($stock->date);
							@endphp
							@if ($date_convert > $date_now )
								<button type="button" class="btn btn-danger btn-sm" onclick="confirmdelete({{$stock->id}})" >Delete</button>
							@else 
								<button type="button" onclick="alert('Past date Records cannot be deleted..')" class="btn btn-secondary btn-sm" >Delete</button>
							@endif
							</span>
						</td>
					</tr>
				@endforeach
				</tbody>
		</table>
		</div>
	</div>
</div>
<script>
	function confirmdelete(id)
	{
		if(confirm("Are you sure want to delete this record?") == true)
		{
			let _url = `/stock/${id}`;
			let _token   = $('meta[name="csrf-token"]').attr('content');

			$.ajax({
				url: _url,
				type: 'DELETE',
				data: {
				_token: _token
				},
				success: function(response) {
					$("#row_"+id).remove();
					alert("Record Deleted...");
				}
			});
		}
	}
 </script>
@endsection