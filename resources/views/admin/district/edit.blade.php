@extends('admin.layouts.form')
@section('title', 'Add District')
@section('formpage')
<form action="{{ route('district.update',$district->id) }}" method="POST" onsubmit="return validatesubmission()" >
@csrf
 @method('PATCH')
<div class="row">
	<div class="col-lg-12">
		<div class="form-group">
			State: <span class="errmsg" id="id_state_id"></span>
			<select name="state_id" id="state_id" class="form-control" >
				<option value="">Select State</option>
				@foreach(App\Models\State::where('status','Active')->get() as $state)
					@if($state->id == $district->id)  
					<option value="{{$state->id}}" selected>{{$state->state}}</option>
					@else
					<option value="{{$state->id}}">{{$state->state}}</option>
					@endif
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="form-group">
			District: <span class="errmsg" id="id_district"></span>
			<input type="text" name="district" id="district" class="form-control" value="{{ $district->district }}" >
		</div>
	</div>
	<div class="col-lg-12">
		<div class="form-group">
			Status: <span class="errmsg" id="id_status"></span>
			<select name="status" id="status" class="form-control" >
				<option value="">Select Status</option>
				@php
				$arr = array("Active","Inactive")
				@endphp
				@foreach($arr as $val)
					@if($val == $district->status)
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
			<center><input type="submit" class="btn btn-info" ></center>
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
		if($("#state_id").val() == "")
		{
			$("#id_state_id").html("Kindly select State..");
			validate = "false";
		}
		if($("#district").val() == "")
		{
			$("#id_district").html("Kindly Select District..");
			validate = "false";
		}
		if(!$("#district").val().match(alphaspaceexp))
		{
			$("#id_district").html("District should contain text..");
			validate = "false";
		}
		if($("#district").val() == "")
		{
			$("#id_district").html("Kindly enter value for District..");
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