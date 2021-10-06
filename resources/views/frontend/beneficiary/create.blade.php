<style>
.header_section {
    display: none;
}
input[type="radio"] {
    -ms-transform: scale(1.5); /* IE 9 */
    -webkit-transform: scale(1.5); /* Chrome, Safari, Opera */
    transform: scale(1.5);
}
</style>
@include('frontend.layouts.header')
      </div>
      <!-- header section end -->
      <!-- news section start -->
      <div class="news_section">
         <div class="container">
            <div id="main_slider" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="news_section_2 layout_padding">
                        <div class="box_main">
                           <h2 class="design_text">Register for Vaccination</h2>
@if($data['BeneficiariesCount'] >= 4)
	<div class="alert alert-danger" id="alertdiv">
		Limit exceeded.<br>
        You can add maximum 4 beneficiaries..
    </div>
	<hr>
	<center><a href="beneficiaryview" class="btn btn-info" > <i class="fa fa-plus-square" ></i>	Add Member</a></center>
	<br>
@else
	<center><span style="color: green;">You can Register maximum 4 beneficiaries.</span></center><br>
	<form method="post" action="" >
		@csrf
		<div class="form-group">
			Photo ID Card Type, that you will bring to Vaccination Center  <span class="errmsg" id="id_id_proof"></span>
			<select name="id_proof" id="id_proof" class="form-control" onchange="funchangelabel(this.value)"required>
				<option value="">Select Photo ID Proof</option>
				<?php
				$arr = array("Aadhaar Card","PAN Card");
				foreach($arr as $val)
				{
				echo "<option value='$val'>$val</option>";
				}
				?>
			</select>
		</div>
		<div class="form-group">
			<span id="lblidnumber">Photo ID Number</span> <span class="errmsg" id="id_id_number"></span>
			<input type="text" name="id_number" id="id_number" class="form-control" placeholder="Enter Photo ID Number" required>
		</div>
		
		<div class="form-group">
			<span id="lblname">Name</span>  <span class="errmsg" id="id_name"></span>
			<input type="text" name="name" id="name" class="form-control" placeholder="Enter name" required>
		</div>
		
		<div class="form-group">
			Gender <span class="errmsg" id="id_gender"></span><br>
			&nbsp;&nbsp;
			<input type="radio" name="gender" id="gender" value="Male">&nbsp;&nbsp; Male
			&nbsp;&nbsp;&nbsp;
			<input type="radio" name="gender" id="gender" value="Female" > &nbsp;&nbsp;Female
			&nbsp;&nbsp;&nbsp;
			<input type="radio" name="gender" id="gender" value="Others" > &nbsp;&nbsp;Others
		</div>
		
		<div class="form-group">
			Year of Birth <span class="errmsg" id="id_birthyear"></span>
			<input type="number" name="birthyear" id="birthyear" class="form-control" placeholder="Year of Birth" required>
		</div>
		
		<div class="form-group"><hr>
		<div class="alert alert-danger" id="alertdiv" style="display: none;">
			This account not found..
		</div>
		<div class="alert alert-danger" id="alertexistsdiv" style="display: none;">
			Account Already exists..
		</div>
		<div class="alert alert-success" id="alertsuccessdiv" style="display: none;">
			Account Found in the Database
		</div>
			<center><button type="button" id="btnverifydoc" name="btnverifydoc" class="btn btn-primary" onclick="verifydocument()" data-toggle="modal" data-target="#otpmodal">Click Here to Add</button></center>
		</div>	<br>
	</form>
@endif                        
						</div>
                     </div>
                  </div>

			   </div>
            </div>
            </div>
         </div>
      </div>
      <!-- news section end -->

@include('frontend.layouts.footer')
<script>
//  lblidnumber id_number lblname name
function funchangelabel(id_type)
{
	if(id_type == "Aadhaar Card")
	{
		/*$('#lblidnumber').attr('placeholder','Some New Text 1');*/
		$('#id_number').attr('placeholder','Enter Aadhaar Card Number');
		/*$('#lblname').attr('placeholder','Some New Text 1');*/
		$('#name').attr('placeholder','Name (As in Aadhaar Card)');
	}
	if(id_type == "PAN Card")
	{
		/*$('#lblidnumber').attr('placeholder','Some New Text 1');*/
		$('#id_number').attr('placeholder','Enter PAN Card Number');
		/*$('#lblname').attr('placeholder','Some New Text 1');*/
		$('#name').attr('placeholder','Name (As in PAN Card)');
	}
}
</script>
<script>
function verifydocument()
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
	if($("#id_proof").val() == "")
	{
		$("#id_id_proof").html("Kindly select ID Proof..");
		validate = "false";
	}
	if($("#id_number").val() == "")
	{
		$("#id_id_number").html("ID number should not be empty..");
		validate = "false";
	}
	if($("#name").val() == "")
	{
		$("#id_name").html("Name should not be empty.");
		validate = "false";
	}   
	if($("#gender").val() == "")
	{
		$("#id_gender").html("Kindly select Gender..");
		validate = "false";
	}
	if($("#birthyear").val() == "")
	{
		$("#id_birthyear").html("Birth year should not be empty..");
		validate = "false";
	}
	if(validate == "true")
	{
		$('#btnverifydoc').html('<i class="fa fa-spinner fa-pulse" aria-hidden="true"></i> Verifying Document.. Please Wait..');
		var token = $("input[name=_token]").val();
		$('#btnverifydoc').prop('disabled', true);
		$('#alertdiv').hide();
		$('#alertexistsdiv').hide();
		$('#alertsuccessdiv').hide();
		$.ajax({
				url: 'docverification',
				type: 'POST',
				data: {
					_token: token,
					id_proof : $('#id_proof').val(),
					id_number : $('#id_number').val(),
					name : $('#name').val(),
					gender : $('input[name="gender"]:checked').val(),
					birthyear: $('#birthyear').val()
				},
				success: function(response) {
					if(response == 0)
					{
						$('#alertdiv').show();
						$('#alertexistsdiv').hide();
						$('#alertsuccessdiv').hide();
						$('#btnverifydoc').html('Click Here to Add');
						$('#btnverifydoc').prop('disabled', false);
					}
					else if(response == 1)
					{
						$('#alertdiv').hide();
						$('#alertexistsdiv').show();
						$('#alertsuccessdiv').hide();
						$('#btnverifydoc').html('Click Here to Add');
						$('#btnverifydoc').prop('disabled', false);
					}
					else
					{
						$('#alertdiv').hide();
						$('#alertexistsdiv').hide();
						$('#alertsuccessdiv').show();
						createbeneficiaries(response[0]['dob']);
					}
				}
			});
	}
}
</script>
<script>
	function createbeneficiaries(dob)
	{
		$('#btnverifydoc').html('<i class="fa fa-spinner fa-pulse" aria-hidden="true"></i> Creating Account.. Please Wait..');
		var token = $("input[name=_token]").val();
		$.ajax({
			url: 'insertbeneficiary',
			type: 'POST',
			data: {
				_token: token,
				id_proof : $('#id_proof').val(),
				id_number : $('#id_number').val(),
				name : $('#name').val(),
				gender : $('input[name="gender"]:checked').val(),
				dob: dob
			},
			success: function(response) {
				if(response== 1)
				{
					window.location='/beneficiaryview';
				}
			}
		});
	}
</script>