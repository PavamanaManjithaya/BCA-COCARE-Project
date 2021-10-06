@extends('admin.layouts.tables')
@section('title','View ' . $accounttype . ' Accounts')
@section('viewpage')
<div class="table-responsive-sm">
	<div class="row">
		<div class="col-lg-12">
			<table id="datatable" class="table table-striped table-bordered" style="width: 100%">
				<thead>
					<tr>
						@if($accounttype == "District Admin" || $accounttype == "Vaccinator" || $accounttype == "Verifier")
						<th>State </th>
						<th>District</th>
						@endif
						<th>Name</th>
						<th>Mobile No.</th>
						<th>Email ID</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				@foreach($users as $user)
					<tr id="row_{{$user->id}}">
						@if($accounttype == "District Admin" || $accounttype == "Vaccinator" || $accounttype == "Verifier")
						<td>{{$user->state->state}}</td>
						<td>{{$user->district->district}}</td>
						@endif
						<td>{{$user->name}}</td>
						<td>{{$user->mob_no}}</td>
						<td>{{$user->email}}</td>
						<td>{{$user->status}}</td>
						<td>
							<a href="{{ route('editaccount', $user->id)}}" class="btn btn-info me-md-2 btn-sm" >Edit</a>
							<button type="button" class="btn btn-danger btn-sm" onclick="confirmdelete({{$user->id}})" >Delete</button>
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
			let _url = `/deleteaccount/${id}`;
			let _token   = $('meta[name="csrf-token"]').attr('content');

			$.ajax({
				url: _url,
				type: 'GET',
				data: {
				_token: _token
				},
				success: function(response) {
					$("#row_"+id).remove();
					alert("Record Deleted...");
				},
				
			});
		}
	}
 </script>
@endsection