@extends('admin.layouts.tables')
@section('title', 'Stock Wastage Report')
@section('viewpage')
<div class="table">
    <div class="row">
        <div class="col-md-12">
            <table id="datatable" class="table table-striped table-bordered" style="width: 100%">
                <thead>
                    <tr>
                        <th>CVC Name</th>
                        <th>Vaccine Type</th>
                        <th>Wastage Quantity</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stocks as $stockrec)
                                <tr id="row_{{ $stockrec->stockid }}">
                                    <td>{{ $stockrec->vaccinecenter->cvcname }}</td>
                                    <td>{{ $stockrec->vaccinetype->vname }}</td>
                                    <td>{{ $stockrec->qty }}</td>
                                    <td>{{ date('d-m-Y', strtotime($stockrec->date)) }}</td>
                                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection