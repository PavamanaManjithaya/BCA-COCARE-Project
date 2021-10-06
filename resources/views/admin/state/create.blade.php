@extends('admin.layouts.form')
@section('title', 'Add State')
@section('formpage')
<form action="{{ route('state.store') }}" method="POST" onsubmit="return validatesubmission()" >
@csrf
<div class="row">
	<div class="col-lg-6">
		<div class="form-group">
			State: <span class="errmsg" id="id_state"></span>
			<input type="text" name="state" id="state" class="form-control" placeholder="Enter name of state" value="{{ old('state') }}" >			
		</div>
	</div>
	<div class="col-lg-6">
		<div class="form-group">
			Status: <span class="errmsg" id="id_status"></span>
			<select name="status" id="status" class="form-control" >
				<option value="">Select Status</option>
				<?php
				$arr = array("Active","Inactive");
				foreach($arr as $val)
				{
				echo "<option value='$val'>$val</option>";
				}
				?>
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
	if(!$("#state").val().match(alphaspaceexp))
	{
		$("#id_state").html("State value not valid..");
		validate = "false";
	}
	if($("#state").val() == "")
	{
		$("#id_state").html("State Should not be empty..");
		validate = "false";
	}
	if($("#status").val() == "")
	{
		$("#id_status").html("Status Should not be empty..");
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