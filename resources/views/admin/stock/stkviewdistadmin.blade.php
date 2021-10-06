@extends('admin.layouts.tables')
@section('title', 'View Stock Report')
@section('viewpage')
    <div class="table-responsive-sm">
        <div class="row">
            <div class="col-lg-12">
                <table id="datatable" class="table table-striped table-bordered" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>User</th>
                            <th>District</th>
                            <th>Vaccine Type</th>
                            <th>Quantity</th>
                            <?php
                            /*
                            <th>Available Quantity</th>
                            <th>Action</th>
                            */
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stocks as $stock)
                            <tr id="row_{{ $stock->id }}">
                                <td>{{ date('d-m-Y', strtotime($stock->date)) }}</td>
                                <td>{{ $stock->user->name }}</td>
                                <td>{{ $stock->district->district }}</td>
                                <td>{{ $stock->vaccinetype->vname }}</td>
                                <td>{{ $stock->qty }}</td>
                                <?php
                                /*
                                <td>
                                    @php
                                    $avail = 0;
                                    @endphp
                                    @foreach (App\Models\Stock::where('stock_id', $stock->id)->get() as $stockassign)
                                        @if ($stockassign)
                                            @php
                                                $avail = $avail + $stockassign->qty;
                                            @endphp
                                        @endif
                                    @endforeach	
                                    {{$stock->qty-$avail}}
                                </td>
                                <td>
                                    @php
                                        $avail = 0;
                                    @endphp
                                    @foreach (App\Models\Stock::where('stock_id', $stock->id)->get() as $stockassign)
                                        @if ($stockassign)
                                            @php
                                                $avail = $avail + $stockassign->qty;
                                            @endphp
                                        @endif
									@endforeach	
										@if ($avail==$stock->qty)
										<span class="px-3 pt-1">
                                            <a href="{{ route('stockallotment', $stock->id) }}" type="button"
                                                class="btn btn-danger btn-sm">Stock Allotment</a>
                                        </span>
										@else
										<span class="px-3 pt-1">
                                            <a href="{{ route('stockallotment', $stock->id) }}" type="button"
                                                class="btn btn-info btn-sm">Stock Allotment</a>
                                        </span>
										@endif
                                </td>
                                */
                                ?>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
