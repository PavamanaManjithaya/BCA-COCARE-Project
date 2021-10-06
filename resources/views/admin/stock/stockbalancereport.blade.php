@extends('admin.layouts.tables')
@section('title', 'Stock Allotment')
@section('viewpage')
    <div class="">
        <div class="row">
            <div class="col-lg-12">
                <table id="datatable" class="table table-striped table-bordered" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Vaccine Name</th>
                            <th>Total Received Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $data['vtype'] as $vtype)
                @php
                $dt  = date("Y-m-d");
                $stkreceived = App\Models\Stock::where('district_id',Auth::user()->district_id)->where('vaccinetype_id',$vtype->id)->where('date','<=',$dt)->where('status','Admin2District')->sum('qty');
                $stkspent = App\Models\Stock::where('vaccinetype_id',$vtype->id)->where('status','DistAdmin2Vcenter')->sum('qty');
                $balqty = $stkreceived - $stkspent;
                @endphp
                            <tr>
                                <td>{{ $vtype->vname }}</td>
                                <td>{{ $balqty }}</td>
                                <td><a href="stockallotment/{{ $vtype->id }}" class="btn btn-info" style="color: white;" >Stock Allotment</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
