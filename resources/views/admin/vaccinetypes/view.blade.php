@extends('admin.layouts.tables')
@section('title', 'View Vaccine Types')
@section('viewpage')
<!---<div class="table-responsive-sm">-->
	<div class="row">
		<div class="col-lg-12">
	<table id="datatable" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Vaccine Name</th>
				<th>Description</th>
                <th>Period</th>
                <th>Second Dose</th>
                <th style="text-align: right;">Cost</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
            @foreach($vtypes as $vtype)
			<tr>
				<td>{{$vtype->vname}}</td>
				<td>{{$vtype->description}}</td>
				<td>{{$vtype->period}}</td>
				<td>{{$vtype->seconddose}}</td>
				<td style="text-align: right;">₹{{$vtype->cost}}</td>
                <td>{{$vtype->status}}</td>
				<td>
					<a href="{{ route('vaccinetype.edit', $vtype->id)}}" class="btn btn-info">Edit</a>  
					<button type="button" class="btn btn-danger" onclick="confirmdelete({{$vtype->id}})" >Delete</button>
				</td>
			</tr>
            @endforeach
		</tbody>
	</table>
		</div>
	</div>
	<!-- </div>-->
	<script>
	function confirmdelete(id)
	{
		if(confirm("Are you sure want to delete this record?") == true)
		{
			let _url = `/vaccinetype/${id}`;
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