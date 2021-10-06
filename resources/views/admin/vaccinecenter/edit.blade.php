@extends('admin.layouts.form')
@section('title', 'Edit vaccine Center')
@section('formpage')
    <form action="{{ route('vaccinecenter.update',$vcenter->id) }}" method="POST" onsubmit="return validatesubmission()" onsubmit="return validatesubmission()">
        @csrf
        @method('PATCH')

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    Vaccine Center Name:  <span class="errmsg" id="id_cvcname"></span>
                    <input type="text" name="cvcname" id="cvcname" class="form-control" placeholder="Enter a vaccine center name" value="{{ $vcenter->cvcname }}" >
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    Category: <span class="errmsg" id="id_category"></span>
                    <select name="category" id="category" class="form-control" >
                        <option value="">Select Category</option>
                        @php
                            $arr = ['Paid', 'Unpaid'];
                        @endphp
                        @foreach($arr as $val)
                        @if($val == $vcenter->category)
                        <option value='{{$val}}' selected>{{$val}}</option>
                        @else
                        <option value='{{$val}}'>{{$val}}</option>
                        @endif
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    Address: <span class="errmsg" id="id_address"></span>
                    <input type="text" name="address" id="address" class="form-control" placeholder="Enter a vaccine center address" value="{{ $vcenter->address }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    Pincode: <span class="errmsg" id="id_pincode"></span>
                    <input type="text" name="pincode" id="pincode" class="form-control" placeholder="Enter a vaccine center pincode" value="{{ $vcenter->pincode }}" >
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    State: <span class="errmsg" id="id_state_id"></span>
                    <select name="state_id" id="state_id" class="form-control" >
                        <option value="">Select State</option>
                        @foreach(App\Models\State::where('status','Active')->get() as $state)
                        
                        <option value="{{$state->id}}"@if($state->id==$vcenter->state_id) selected @endif>{{$state->state}}</option>

                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    District:  <span class="errmsg" id="id_district_id"></span>
                    <select name="district_id" id="district_id" class="form-control" >
                        <option value="">Select District</option>
                        @foreach(App\Models\District::where('status','Active')->get() as $district)
                            <option value="{{$district->id}}"@if($district->id==$vcenter->district_id) selected @endif>{{$district->district}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    Start Time:  <span class="errmsg" id="id_starttime"></span>
                    <input type="text" name="starttime" id="starttime" class="form-control" placeholder="HH:MM"onfocus="(this.type='datetime-local')"
                        value="{{ $vcenter->starttime }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    End Time:  <span class="errmsg" id="id_endtime"></span>
                    <input type="text" name="endtime" id="endtime" class="form-control" placeholder="HH:MM" onfocus="(this.type='datetime-local')"
                        value="{{ $vcenter->endtime }}" >
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    Status: <span class="errmsg" id="id_status"></span>
                    <select name="status" id="status" class="form-control" >
                        <option value="">Select Status</option>
                        @php
                        $arr = array("Active","Inactive")
                        @endphp
                        @foreach($arr as $val)
                            @if($val == $vcenter->status)
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
    <script>
        function validatesubmission()
        {
            $(".errmsg").html('');
            //Regex starts
            var alphaexp = /^[a-zA-Z]+$/;
            var alphaspaceexp = /^[a-zA-Z\s]+$/;
            var alphanumericspaceExp = /^[0-9a-zA-Z\s]+$/;
            var emailexp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,5}$/;
            var numericexp = /^[0-9]+$/;
            var passwordexp = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/;
            //Regex Ends
            var validate = "true";    
            if($("#cvcname").val() == "")
            {
                $("#id_cvcname").html("Vaccine Center should not be empty..");
                validate = "false";
            }
            if($("#category").val() == "")
            {
                $("#id_category").html("Kindly select Payment Category..");
                validate = "false";
            }
            if($("#address").val() == "")
            {
                $("#id_address").html("Address Should not be empty..");
                validate = "false";
            }
            if($("#pincode").val() == "")
            {
                $("#id_pincode").html("PIN Code should not be empty..");
                validate = "false";
            }
            if($("#state_id").val() == "")
            {
                $("#id_state_id").html("Kindly select State..");
                validate = "false";
            }
            if($("#district_id").val() == "")
            {
                $("#id_district_id").html("Kindly select District..");
                validate = "false";
            }
            if($("#starttime").val() == "")
            {
                $("#id_starttime").html("Kindly enter start time.");
                validate = "false";
            }
            if($("#endtime").val() == "")
            {
                $("#id_endtime").html("Kindly enter End time.");
                validate = "false";
            }
            if($("#status").val() == "")
            {
                $("#id_status").html("Kindly Select the status..");
                validate = "false";
            }
            if(validate == "true")
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        </script>  
@endsection