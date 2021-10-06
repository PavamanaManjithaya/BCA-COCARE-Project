@extends('admin.layouts.form')
@section('title', 'Add Vaccine Type')
@section('formpage')
<form action="{{ route('vaccinetype.store') }}" method="POST" onsubmit="return validatesubmission()" >
@csrf
<div class="row">
	<div class="col-lg-12">
		<div class="form-group">
			Vaccine Name: <span class="errmsg" id="id_vname"></span>
			<input type="text" name="vname" id="vname" class="form-control" placeholder="Enter vaccine Name" >
		</div>
	</div>
	<div class="col-lg-12">
		<div class="form-group">
        Description: <span class="errmsg" id="id_description"></span>
			<textarea type="text" class="form-control" id="description" name="description" placeholder="Description" ></textarea>
		</div>
	</div>
	
    <div class="col-lg-6">
		<div class="form-group">
			Days Gap between 1st Dose & 2nd Dose: <span class="errmsg" id="id_period"></span>
			<input type="number" name="period" id="period" class="form-control" min="0" placeholder="Vaccine period">
		</div>
	</div>
    <div class="col-lg-6">
		<div class="form-group">
			Due Date for 2nd Dose.: <span class="errmsg" id="id_seconddose"></span>
			<input type="number" name="seconddose" id="seconddose" class="form-control" min="0" placeholder="Due Date for 2nd Dose." >
		</div>
	</div>
    <div class="col-lg-6">
		<div class="form-group">
			Cost (Only for Paid Category): <span class="errmsg" id="id_cost"></span>
			<input type="number" name="cost" id="cost" class="form-control" min="0" placeholder="Vaccine cost" >
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
			<center><input type="submit" name="submit" id="submit" class="btn btn-info" ></center>
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
	if($("#vname").val() == "")
	{
		$("#id_vname").html("Kindly select User Role..");
		validate = "false";
	}
	if($("#description").val() == "")
	{
		$("#id_description").html("Kindly Select State..");
		validate = "false";
	}
	if($("#period").val() == "")
	{
		$("#id_period").html("Kindly enter Days Gap between 1st Dose & 2nd Dose..");
		validate = "false";
	}       
	if($("#seconddose").val() == "")
	{
		$("#id_seconddose").html("Kindly enter Due Date for Second Dose.");
		validate = "false";
	}
	if($("#cost").val() == "")
	{
		$("#id_cost").html("Kindly enter Due Date for Second Dose.");
		validate = "false";
	}
	if($("#status").val() == "")
	{
		$("#id_status").html("Vaccine Center should not be empty...");
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