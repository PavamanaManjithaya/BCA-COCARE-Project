@extends('admin.layouts.form')
@section('title', 'Create New Account')
@section('formpage')
@if(Session::has('message'))
	<div class="alert alert-info">
		{{Session::get('message')}}
	</div>
@endif
<form action="{{ route('updstaffpwd') }}" method="POST" onsubmit="return validatesubmission()" >
@csrf
<div class="row">

    <div class="col-lg-6">
		<div class="form-group">
			Old Password:  <span class="errmsg" id="id_opassword"></span>
			<input type="password" name="opassword" id="opassword" class="form-control" placeholder="Enter Password" >
		</div>
	</div>
    <div class="col-lg-6">
		<div class="form-group">
		</div>
	</div>
	
    <div class="col-lg-6">
		<div class="form-group">
			New Password:   <span class="errmsg" id="id_npassword"></span>
			<input type="password" name="npassword" id="npassword" class="form-control" placeholder="Enter Password" >
		</div>
	</div>

    <div class="col-lg-6">
		<div class="form-group">
			Confirm Password:   <span class="errmsg" id="id_cpassword"></span>
			<input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Confirm Password" >
		</div>
	</div>

	<div class="col-lg-12">
		<div class="form-group"><hr>
			<center><input type="submit" name="submit" id="submit" class="btn btn-info" value="Change password" ></center>
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
		if($("#opassword").val() == "")
		{
			$("#id_opassword").html("Old Password Should not be empty..");
			validate = "false";
		}
		if($("#npassword").val() == "")
		{
			$("#id_npassword").html("New Password Should not be empty..");
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