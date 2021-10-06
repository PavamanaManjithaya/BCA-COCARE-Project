@extends('admin.layouts.form')
@section('title', 'Create New Account')
@section('formpage')
@if(Session::has('message'))
	<div class="alert alert-info">
		{{Session::get('message')}}
	</div>
@endif
<form action="{{ route('insertaccount') }}" method="POST" name="frmaccountcreate" id="frmaccountcreate" onsubmit="return validatesubmission()" >
@csrf
<div class="row">

	<div class="col-lg-6">
		<div class="form-group">
			User Type: <span class="errmsg" id="id_user_role"></span>
			<select name="user_role" id="user_role" class="form-control">
				<option value="">Select User Type</option>
				@php
				if(Auth::user()->user_role == "Admin")
				{
					$arr = array("Admin","District Admin","Vaccinator","Verifier");
				}
				else if(Auth::user()->user_role == "District Admin")
				{
					$arr = array("Vaccinator","Verifier");
				}
				@endphp
				@foreach($arr as $val)
				<option value='{{ $val }}'>{{ $val }}</option>
				@endforeach
			</select>
		</div>
	</div>

	<div class="col-lg-6" id="divstatebox" style="display: none;" >
		<div class="form-group">
			State <span class="errmsg" id="id_state_id"></span>
			<select name="state_id" id="state_id" class="form-control" >
				<option value="0">Select State</option>
				@php
					if(Auth::user()->user_role == "District Admin")
					{
						$staterec = App\Models\State::where('status','Active')->where('id',Auth::user()->state_id)->get();
					}
					else 
					{
						$staterec = App\Models\State::where('status','Active')->get();
					}
				@endphp
				@foreach($staterec as $state)
					<option value="{{$state->id}}">{{$state->state}}</option>
				@endforeach
			</select>
		</div>
	</div>
	
	<div class="col-lg-6" id="divdistrictbox"  style="display: none;" >
		<div class="form-group">
			District: <span class="errmsg" id="id_district_id"></span>
			<select name="district_id" id="district_id" class="form-control" >
				<option value="0">Select District</option>
			</select>
		</div>
	</div>
	
	<div class="col-lg-6" id="divvaccinecenter" style="display: none;" >
		<div class="form-group">
			Vaccine Center: <span class="errmsg" id="id_vaccine_center_id"></span>
			<select name="vaccine_center_id" id="vaccine_center_id" class="form-control" >
				<option value="0">Select Vaccine Center</option>
			</select>
		</div>
	</div>

    <div class="col-lg-6">
		<div class="form-group">
			Name: <span class="errmsg" id="id_name"></span>
			<input type="text" name="name" id="name" class="form-control" placeholder="Enter Name"  >
		</div>
	</div>
    <div class="col-lg-6">
		<div class="form-group">
			Mobile No: <span class="errmsg" id="id_mob_no"></span>
			<input type="number" name="mob_no" id="mob_no" class="form-control" placeholder="Enter Mobile No" pattern="^\d{10}$" >
		</div>
	</div>

    <div class="col-lg-6">
		<div class="form-group">
			Email ID: <span class="errmsg" id="id_email"></span>
			<input type="email" name="email" id="email" class="form-control" placeholder="Enter Email ID" >
		</div>
	</div>

    <div class="col-lg-6">
		<div class="form-group">
			Password: <span class="errmsg" id="id_password"></span>
			<input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" >
		</div>
	</div>
    <div class="col-lg-6">
		<div class="form-group">
			Confirm Password: <span class="errmsg" id="id_cpassword"></span>
			<input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Confirm Password" >
		</div>
	</div>
    <div class="col-lg-6">
		<div class="form-group">
			Status: <span class="errmsg" id="id_status"></span>
			<select name="status" id="status" class="form-control">
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
<script src="https://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
<script>var $j = jQuery.noConflict(true);</script>
<script>
	/*
    $(document).ready(function(){
    console.log($j().jquery); // This prints v1.9.1
    });
	*/
</script>
<script type="text/javascript">
    $j("document").ready(function(){
        $j('select[name="state_id"]').on('change',function(){
            var state_id=$(this).val();
            if(state_id != 0)
            {
                $j.ajax({
                    url:'/load_district_rec/'+state_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data){
                        $j('select[name="district_id"]').empty();
                        $('select[name="district_id"]').append('<option value="">Select District</option>');
                        $j.each(data,function(key,value){
                            $('select[name="district_id"]').append('<option value="'+key+'">'+value+'</option>');
                        });
                    }
                });
            }
            else
            {
                $j('select[name="subcategory"]').empty();
            }
        });
    });
</script>
<script> 
    $j("document").ready(function(){
        $j('select[name="district_id"]').on('change',function(){
            var district_id=$(this).val();
			var user_role=$('#user_role').val();
            if(district_id != 0)
            {
				if(user_role == "Vaccinator" || user_role == "Verifier")
				{
                $j.ajax({
                    url:'/load_vaccinecenter_rec/'+district_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data){
                        $j('select[name="vaccine_center_id"]').empty();
                        $('select[name="vaccine_center_id"]').append('<option value="">Select Vaccine Center</option>');
                        $j.each(data,function(key,value){
                            $('select[name="vaccine_center_id"]').append('<option value="'+key+'">'+value+'</option>');
                        });
                    }
                });
				}
            }
            else
            {
                $j('select[name="vaccine_center_id"]').empty();
                $('select[name="vaccine_center_id"]').append('<option value="">Select Vaccine Center</option>');
            }
        });
    });
</script>
<script type="text/javascript">
    $j("document").ready(function(){
        $j('select[name="user_role"]').on('change',function(){
            var user_role=$(this).val();
			//alert(user_role);
            if(user_role != "")
            {
				if(user_role == "Admin")
				{
					$('#divstatebox').hide();
					$('#divdistrictbox').hide();
					$('#divvaccinecenter').hide();
				}
				else if(user_role == "District Admin")
				{
					$('#divstatebox').show();
					$('#divdistrictbox').show();
					$('#divvaccinecenter').hide();
				}
				else if(user_role == "Vaccinator")
				{
					$('#divstatebox').show();
					$('#divdistrictbox').show();
					$('#divvaccinecenter').show();
				}
				else if(user_role == "Verifier")
				{
					$('#divstatebox').show();
					$('#divdistrictbox').show();
					$('#divvaccinecenter').show();
				}
            }
            else
            {
				$('#divstatebox').hide();
				$('#divdistrictbox').hide();
				$('#divvaccinecenter').hide();
            }
        });
    });
</script>
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
	if($("#user_role").val() == "")
	{
		$("#id_user_role").html("Kindly select User Role..");
		validate = "false";
	}
	if($("#state_id").val() == "")
	{
		$("#id_state_id").html("Kindly Select State..");
		validate = "false";
	}
	if($("#district_id").val() == "")
	{
		$("#id_district_id").html("Kindly Select District..");
		validate = "false";
	}
	if($("#vaccine_center_id").val() == "")
	{
		$("#id_vaccine_center_id").html("Vaccine Center should not be empty...");
		validate = "false";
	}
	if(!$("#name").val().match(alphaspaceexp))
	{
		$("#id_name").html("Name should contain text..");
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
	if(!$("#password").val().match(passwordexp))
	{
		$("#id_password").html("Entered Password is not valid..");
		validate = "false";
	}
	if($("#password").val().length<6)
	{
		$("#id_password").html("Password Should contain more than 6 characters..");
		validate = "false";
	}
	if($("#password").val() == "")
	{
		$("#id_password").html("Password Should not be empty..");
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