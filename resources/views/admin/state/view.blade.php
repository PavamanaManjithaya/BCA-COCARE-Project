@extends('admin.layouts.tables')
@section('title', 'View State')
@section('viewpage')
<!---<div class="table-responsive-sm">-->
	<div class="row">
		<div class="col-lg-12">
	<table id="datatable" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>State</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
            @foreach($states as $state)
			<tr>
				<td>{{$state->state}}</td>
				<td>{{$state->status}}</td>
				<td>
					<a href="{{ route('state.edit', $state->id)}}" class="btn btn-info">Edit</a>  
					<button type="button" class="btn btn-danger" onclick="confirmdelete({{$state->id}})" >Delete</button>
				</td>
			</tr>
            @endforeach
		</tbody>
	</table>
		</div>
	</div>
	<script>
		function confirmdelete(id)
		{
			if(confirm("Are you sure want to delete this record?") == true)
			{
				let _url = `/state/${id}`;
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