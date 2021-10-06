@extends('admin.layouts.form')
@section('title', 'Edit Stock')
@section('formpage')
    <form action="{{ route('stock.update',$stock->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    Vaccinecenter:
                    <select name="vaccinecenter_id" id="vaccinecenter_id" class="form-control" required>
                        <option value="">Select Vaccinecenter</option>
                        @foreach (App\Models\Vaccinecenter::all() as $vcenter)
                            <option value="{{ $vcenter->id }}"@if($vcenter->id==$stock->vaccinecenter_id) selected @endif>{{ $vcenter->cvcname }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    VaccineType:
                    <select name="vaccinetype_id" id="vaccinetype_id" class="form-control" required>
                        <option value="">Select VaccineType</option>
                        @foreach (App\Models\Vaccinetype::all() as $vtype)
                            <option value="{{ $vtype->id }}"@if($vtype->id==$stock->vaccinetype_id) selected @endif>{{ $vtype->vname }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    Date:
                    <input type="date" name="date" id="date" class="form-control" placeholder="Enter a date"
                        value="{{ $stock->date }}" required>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    Quantity:
                    <input type="number" name="qty" id="qty" class="form-control" min="10" placeholder="Vaccine Quantity"
                        value="{{ $stock->qty }}" required>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    Starting Age:
                    <input type="number" name="sage" id="sage" class="form-control" placeholder="Starting Age"
                        value="{{ $stock->sage }}" required>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    Ending Age:
                    <input type="number" name="eage" id="eage" class="form-control" placeholder="Ending Age"
                        value="{{ $stock->eage }}" required>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    Status:
                    <select name="status" id="status" class="form-control" required>
                        <option value="">Select Status</option>
                        @php
                        $arr = array("Active","Inactive")
                        @endphp
                        @foreach($arr as $val)
                            @if($val == $stock->status)
                            <option value='{{$val}}' selected>{{$val}}</option>
                            @else
                            <option value='{{$val}}'>{{$val}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <hr>
                    <center><input type="submit" name="submit" id="submit" class="btn btn-info"></center>
                </div>
            </div>
        </div>
    </form>
@endsection
