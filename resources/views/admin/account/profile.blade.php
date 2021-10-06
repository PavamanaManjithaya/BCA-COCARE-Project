@extends('admin.layouts.form')
@section('title', 'Update Profile')
@section('formpage')
@if(Session::has('message'))
	<div class="alert alert-info">
		{{Session::get('message')}}
	</div>
@endif
<form action="{{ route('updatestaffaccount') }}" method="POST"  onsubmit="return validatesubmission()" >
@csrf
<input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}" >
<div class="row">

	@if(Auth::user()->user_role == "Vaccinator" || Auth::user()->user_role == "Verifier")
	<div class="col-lg-6">
		<div class="form-group">
			State <span class="errmsg" id="id_state_id"></span>
			<select name="state_id" id="state_id" class="form-control">
				<option value="0">Select State</option>
				@foreach(App\Models\State::where('status','Active')->get() as $state)
					@if($state->id == $user->state_id)  
					<option value="{{$state->id}}" selected>{{$state->state}}</option>
					@endif
				@endforeach
			</select>
		</div>
	</div>
	
	<div class="col-lg-6">
		<div class="form-group">
			District:  <span class="errmsg" id="id_district_id"></span>
			<select name="district_id" id="district_id" class="form-control">
				@foreach(App\Models\District::where('status','Active')->get() as $district)
                    @if($district->id == $user->district_id)  
					<option value="{{$district->id}}" selected>{{$district->district}}</option>
					@endif
				@endforeach
			</select>
		</div>
	</div>

	<div class="col-lg-6" id="divvaccinecenter" >
		<div class="form-group">
			Vaccine Center:   <span class="errmsg" id="id_vaccine_center_id"></span>
			<select name="vaccine_center_id" id="vaccine_center_id" class="form-control">
				@foreach(App\Models\Vaccinecenter::where('status','Active')->get() as $vcenter)
                    @if($vcenter->id == $user->vaccine_center_id)  
					<option value="{{$vcenter->id}}" selected>{{$vcenter->cvcname}}</option>
					@endif
				@endforeach
			</select>
		</div>
	</div>
	@elseif(Auth::user()->user_role == "District Admin")
	<span class="errmsg" id="id_state_id"></span>
	<input type="hidden" name="state_id" id="state_id" value="0" >
	<div class="col-lg-6">
		<div class="form-group">
			District: <span class="errmsg" id="id_district_id"></span>
			<select name="district_id" id="district_id" class="form-control">
				@foreach(App\Models\District::where('status','Active')->get() as $district)
                    @if($district->id == $user->district_id)  
					<option value="{{$district->id}}" selected>{{$district->district}}</option>
					@endif
				@endforeach
			</select>
		</div>
	</div>
	@else 
	<span class="errmsg" id="id_state_id"></span>
	<input type="hidden" name="state_id" id="state_id" value="0" >
	<span class="errmsg" id="id_district_id"></span>
	<input type="hidden" name="district_id" id="district_id" value="0" >
	@endif
	
	<div class="col-lg-6">
		<div class="form-group">
			User Type:
			<span class="errmsg" id="id_user_role"></span>
			<select name="user_role" id="user_role" class="form-control">
				@php
				$arr = array("Admin","District Admin","Vaccinator","Verifier");
				@endphp
				@foreach($arr as $val)
                    @if($val == $user->user_role)
					<option value='{{$val}}' selected>{{$val}}</option>
					@endif
				@endforeach
			</select>
		</div>
	</div>

    <div class="col-lg-6">
		<div class="form-group">
			Name:
			<span class="errmsg" id="id_name"></span>
			<input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" value="{{ $user->name }}" >
		</div>
	</div>
    <div class="col-lg-6">
		<div class="form-group">
			Mobile No:
			<span class="errmsg" id="id_mob_no"></span>
			<input type="number" name="mob_no" id="mob_no" class="form-control" placeholder="Enter Mobile No" value="{{ $user->mob_no }}"  >
		</div>
	</div>

    <div class="col-lg-6">
		<div class="form-group">
			Email ID:
			<span class="errmsg" id="id_email"></span>
			<input type="email" name="email" id="email" class="form-control" placeholder="Enter Email ID"  value="{{ $user->email }}" >
		</div>
	</div>

	<div class="col-lg-12">
		<div class="form-group"><hr>
			<center><input type="submit" name="submit" id="submit" class="btn btn-info btn-lg" value="Update Profile" ></center>
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
	if(!$("#name").val().match(alphaspaceexp))
	{
		$("#id_name").html("Customer name should contain text..");
		validate = "false";
	}
	if($("#name").val() == "")
	{
		$("#id_name").html("Name Should not be empty..");
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