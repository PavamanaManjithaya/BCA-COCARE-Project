@extends('admin.layouts.form')
@section('title', 'Update Profile')
@section('formpage')
@if(Session::has('message'))
	<div class="alert alert-info">
		{{Session::get('message')}}
	</div>
@endif
<form action="{{ route('updateaccount') }}" method="POST" onsubmit="return validatesubmission()">
@csrf
<input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}" >
<div class="row">
	<div class="col-lg-6">
		<div class="form-group">
			State <span class="errmsg" id="id_state_id"></span>
			<select name="state_id" id="state_id" class="form-control" >
				<option value="0">Select State</option>
				@foreach(App\Models\State::where('status','Active')->get() as $state)
					@if($state->id == $user->state_id)  
					<option value="{{$state->id}}" selected>{{$state->state}}</option>
					@else
					<option value="{{$state->id}}">{{$state->state}}</option>
					@endif
				@endforeach
			</select>
		</div>
	</div>

	<div class="col-lg-6">
		<div class="form-group">
			District: <span class="errmsg" id="id_district_id"></span>
			<select name="district_id" id="district_id" class="form-control" >
				<option value="0">Select District</option>
				@foreach(App\Models\District::where('status','Active')->get() as $district)
                    @if($district->id == $user->district_id)  
					<option value="{{$district->id}}" selected>{{$district->district}}</option>
					@else
					<option value="{{$district->id}}">{{$district->district}}</option>
					@endif
				@endforeach
			</select>
		</div>
	</div>
	
	<div class="col-lg-6">
		<div class="form-group">
			User Type: <span class="errmsg" id="id_user_role"></span>
			<select name="user_role" id="user_role" class="form-control" >
				<option value="">Select User Type</option>
				@php
				$arr = array("Admin","District Admin","Vaccinator","Verifier");
				@endphp
				@foreach($arr as $val)
                    @if($val == $user->user_role)
					<option value='{{$val}}' selected>{{$val}}</option>
					@else
					<option value='{{$val}}'>{{$val}}</option>
					@endif
				@endforeach
			</select>
		</div>
	</div>

    <div class="col-lg-6">
		<div class="form-group" >
			Name: <span class="errmsg" id="id_name"></span>
			<input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" value="{{ $user->name }}" >
		</div>
	</div>

    <div class="col-lg-6">
		<div class="form-group">
			Mobile No: <span class="errmsg" id="id_mob_no"></span>
			<input type="number" name="mob_no" id="mob_no" class="form-control" placeholder="Enter Mobile No" value="{{ $user->mob_no }}" pattern="^\d{10}$" >
		</div>
	</div>

    <div class="col-lg-6">
		<div class="form-group">
			Email ID: <span class="errmsg" id="id_email"></span>
			<input type="email" name="email" id="email" class="form-control" placeholder="Enter Email ID"  value="{{ $user->email }}" >
		</div>
	</div>
	

    <div class="col-lg-6">
		<div class="form-group">
			Password: <span class="errmsg" id="id_password"></span>
			<input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"   >
		</div>
	</div>

	
    <div class="col-lg-6">
		<div class="form-group">
			Confirm Password: <span class="errmsg" id="id_cpassword"></span>
			<input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Confirm Password"  >
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
					@if($val == $user->status)
					<option value='{{$val}}' selected>{{$val}}</option>
					@else
					<option value='{{$val}}'>{{$val}}</option>
					@endif
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="form-group"><hr>
			<center><input type="submit" name="submit" id="submit" class="btn btn-info" value="update" ></center>
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
		if($("#state_id").val() == 0)
		{
			$("#id_state_id").html("Kindly Select State..");
			validate = "false";
		}
		if($("#district_id").val() == 0)
		{
			$("#id_district_id").html("Kindly Select District..");
			validate = "false";
		}
		if($("#user_role").val() == "")
		{
			$("#id_user_role").html("Kindly select User Role..");
			validate = "false";
		}
		if(!$("#name").val().match(alphaspaceexp))
		{
			$("#id_name").html("Customer name should contain text..");
			validate = "false";
		}
		if($("#name").val() == "")
		{
			$("#id_name").html("Customer Name Should not be empty..");
			validate = "false";
		}
		if($("#mob_no").val().length != 10)
		{
			$("#id_mob_no").html("Mobile Number should contain 10 digits.");
			validate = "false";
		}
		if($("#mob_no").val() == "")
		{
			$("#id_mob_no").html("Mobile Number Should not be empty..");
			validate = "false";
		}
		if(!$("#email").val().match(emailexp))
		{
			$("#id_email").html("Entered Email ID is not valid..");
			validate = "false";
		}
		if($("#email").val() == "")
		{
			$("#id_email").html("Email ID Should not be empty..");
			validate = "false";
		}
	if($("#password").val() != "")
	{
		if($("#password").val().length<6)
		{
			$("#id_password").html("Password Should contain more than 6 characters..");
			validate = "false";
		}
		if($("#password").val() != $("#cpassword").val())
		{
			$("#id_cpassword").html("Password and Confirm password not matching..");
			validate = "false";
		}
		if($("#cpassword").val() == "")
		{
			$("#id_cpassword").html("Confirm Password Should not be empty..");
			validate = "false";
		}
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