@extends('admin.layouts.tables')
@section('title', 'View Verified Data')
@section('viewpage')
<div class="table-responsive-sm">
	<div class="row">
		<div class="col-lg-12">
			<table id="datatable" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Referenceid</th>
						<th>ID PROOF</th>
						<th>ID Number</th>
                        <th>Name</th>
                        <th>Dose</th>
                        <th>Vaccine Type</th>
                        <th>Vaccine Date</th>
                        
					</tr>
				</thead>
				<tbody>
				@foreach($verify as $vr)
					<tr id="">
						<td>{{$vr->referenceid}}</td>
						<td>{{$vr->id_proof}}</td>
						<td>{{$vr->id_number}}</td>
						<td>{{$vr->name}}</td>
						<td>{{$vr->doseno}}</td>
						<td>{{$vr->vname}}</td>
						<td>{{$vr->vaccinedate}}</td>
					
				@endforeach
				</tbody>
		</table>
		</div>
	</div>
</div>

@endsection