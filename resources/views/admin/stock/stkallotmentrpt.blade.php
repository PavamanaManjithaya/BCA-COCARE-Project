@extends('admin.layouts.tables')
@section('title', 'View Stock Allotment Report')
@section('viewpage')
<div class="table-responsive-sm">
    <div class="row">
        <div class="col-md-12">
            <table id="datatable" class="table table-striped table-bordered" style="width: 100%">
                <thead>
                    <tr>
                        <th>CVC Name</th>
                        <th>Vaccine Type</th>
                        <th>DOSE</th>
                        <th>Quantity</th>
                        <th>SAGE</th>
                        <th>EAGE</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stocks as $stockrec)
                                <tr id="row_{{ $stockrec->stockid }}">
                                    <td>{{ $stockrec->vaccinecenter->cvcname }}</td>
                                    <td>{{ $stockrec->vaccinetype->vname }}</td>

                                    <td>Dose {{ $stockrec->dose }}</td>
                                    <td>{{ $stockrec->qty }}</td>
                                    <td>{{ $stockrec->sage }}</td>
                                    <td>{{ $stockrec->eage }}</td>
                                    <td>{{ date('d-m-Y', strtotime($stockrec->date)) }}</td>
                                    <td>
                                        <span class="px-3 pt-1">
@php
$date_now = time(); //current timestamp
$date_convert = strtotime($stockrec->date);
@endphp
@if ($date_convert > $date_now )
<button type="button" class="btn btn-danger btn-sm" onclick="confirmdelete({{ $stockrec->stockid }})">Delete</button>
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
			let _url = `/stock/`+id;
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