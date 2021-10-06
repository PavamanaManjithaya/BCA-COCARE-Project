@extends('admin.layouts.tables')
@section('title', 'View District')
@section('viewpage')
<div class="table-responsive-sm">
	<div class="row">
		<div class="col-lg-12">
			<table id="datatable" class="table table-striped table-bordered" style="width: 100%">
				<thead>
					<tr>
						<th>State</th>
						<th>District</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				@foreach($districts as $district)
					<tr id="row_{{$district->id}}">
						<td>{{$district->state->state}}</td>
						<td>{{$district->district}}</td>
						<td>{{$district->status}}</td>
						<td><a href="{{ route('district.edit', $district->id)}}" class="btn btn-info me-md-2 btn-sm" >Edit</a><button type="button" class="btn btn-danger btn-sm" onclick="confirmdelete({{$district->id}})" >Delete</button></td>
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
			let _url = `/district/${id}`;
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
				},
			});
		}
	}
 </script>
@endsection