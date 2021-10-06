@extends('admin.layouts.tables')
@section('title', 'View Vaccine Center')
@section('viewpage')
<div class="table-responsive-sm">
	<div class="row">
		<div class="col-lg-12">
			<table id="datatable" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>CVC Name</th>
						<th>category</th>
						<th>Pincodes</th>
                        <th>State</th>
                        <th>District</th>
                        <th>Timings</th>
                        <th>Status</th>
                        <th>Action</th>
					</tr>
				</thead>
				<tbody>
				@foreach($vcenters as $vcenter)
					<tr id="row_{{$vcenter->id}}">
						<td><b>{{$vcenter->cvcname}}</b><bR>{{$vcenter->address}}</td>
						<td>{{$vcenter->category}}</td>
                        <td>{{	str_replace(",",", ",$vcenter->pincode)	}}</td>
                        <td>{{$vcenter->state->state}}</td>
                        <td>{{$vcenter->district->district}}</td>
                        <td>{{ date("h:i A",strtotime($vcenter->starttime)) }} - {{ date("h:i A",strtotime($vcenter->endtime)) }}</td>
                        <td>{{$vcenter->status}}</td>
						<td>
							<a href="{{ route('vaccinecenter.edit', $vcenter->id)}}" class="btn btn-info me-md-2 btn-sm"  >Edit</a>
							<button type="button" class="btn btn-danger btn-sm" onclick="confirmdelete({{$vcenter->id}})" >Delete</button>
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
			let _url = `/vaccinecenter/${id}`;
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