@include('frontend.layouts.header')
<style>
	.errmsg{
	   color: red;
	}
 </style>
 <style>
    .header_section {
        display: none;
    }

</style>
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
                            <h2 class="design_text">WELCOME</h2>
                            @if (Route::current()->getName() == 'deptlogin')
							<div class="about_img d-flex justify-content-center"><img src="{{ asset('admin/images/login.png') }}" width="100" height="100"></div>
                                <p class="text-center text-secondary">Health Facility Managers</p>
                            @else
							<div class="about_img d-flex justify-content-center"><img src="{{ asset('admin/images/vaccinator.png') }}" width="100" height="100"></div>
                                <p class="text-center text-secondary">Vaccinator and Verifier</p>
                            @endif
<div id="divwithpassword" >
	@if(isset($message))
	<div class="alert alert-danger">
		{{ $message }}
	</div>
	@endif
	<form method="post" action="{{ route('checklogin') }}" onsubmit="return validatesubmission()" >
		@csrf
		<div class="form-group">
			<input type="text" name="email" id="email" class="form-control"
				placeholder="Enter Email">
				<span class="errmsg" id="id_email"></span>
		</div>
		<div class="form-group">
			<input type="password" name="password" id="password" class="form-control"
				placeholder="Enter Password">
				<span class="errmsg" id="id_password"></span>
		</div>
		
		<div class="form-group">
			<center><button type="submit"
					class="btn btn-primary btn-lg btn-block" name="btnpasswordlogin"  id="btnpasswordlogin" >Login</button></center>
		</div>
		<p class="text-center text-secondary">Or</p>
		<div class="form-group">
			<center><button type="button"  class="btn btn-outline-primary" onclick="funloginwithotp()">Login Using OTP</button></center>
		</div>
		<br>
	</form>
</div>
<div id="divwithotp" style="display: none;" >
	<form method="post" action="" onsubmit="return false;">
		@csrf
	<div class="alert alert-danger" id="alertdiv" style="display: none;">
		This account not registered in our system..
	</div>
		<div class="form-group">
			<input type="text" name="emailotp" id="emailotp" class="form-control"
				placeholder="Enter Email">
			<span class="errmsg" id="id_emailotp"></span>
		</div>
		<div class="form-group">
			<center><button type="button" id="btnotplogin" id="btnotplogin" class="btn btn-primary btn-lg btn-block" onclick="loadotp()"><i class="fa fa-envelope-o" aria-hidden="true"></i> Get OTP</button></center>
		</div>
		<p class="text-center text-secondary">Or</p>
		<div class="form-group">
			<center><button type="button" class="btn btn-outline-primary" onclick="funloginwithpassword()">Login Using Password</button></center>
		</div>
		<br>
	</form>
</div>
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
	$("#emailotp").keyup(function(event) {
		if (event.keyCode === 13) {
			event.preventDefault();
			$("#btnotplogin").click();
		}
	});
</script>
<script>
function funloginwithotp()
{
	  document.getElementById("divwithpassword").style.display = "none";
	  document.getElementById("divwithotp").style.display = "block";
}
</script>
<script>
function funloginwithpassword()
{
	  document.getElementById("divwithpassword").style.display = "block";
	  document.getElementById("divwithotp").style.display = "none";
}
</script>
<div class="modal fade" id="otpmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">OTP Verification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
	<div class="alert alert-danger" id="otperroralertdiv" style="display: none;">
		You have entered invalid OTP.
	</div>
                <p>An OTP sent to <span id="idotp"></span></p>
                <form method="post" action="">
					<input type="hidden" name="hiddenemailid" id="hiddenemailid" >
					<input type="hidden" name="uid" id="uid" >
                    <div class="form-group">
                        <input type="text" name="otp" id="otp" class="form-control" placeholder="Enter OTP Here">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnotp" name="btnotop" onclick="otploginprocess()"><i class="fa fa-envelope-o" aria-hidden="true"></i> Verify OTP</button>
            </div>
        </div>
    </div>
</div>
<script>
    function loadotp() {
	//############################################################################
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
		if(!$("#emailotp").val().match(emailexp))
		{
			$("#id_emailotp").html("Entered Email ID is not valid..");
			validate = "false";
		}
		else if($("#emailotp").val() == "")
		{
			$("#id_emailotp").html("Email ID should not be empty..");
			validate = "false";
		}
		else
		{
			$('#btnotp').prop('disabled', false);
			$('#btnotp').html('<i class="fa fa-envelope-o" aria-hidden="true"></i> Verify OTP..');
			$('#otperroralertdiv').hide();
			$('#idotp').html($('#emailotp').val());
			$('#hiddenemailid').val($('#emailotp').val());
			$('#otp').val('');
			var token = $("input[name=_token]").val();
			$('#btnotplogin').html('<i class="fa fa-spinner fa-pulse" aria-hidden="true"></i> Checking Data.. Please wait..');
			$('#btnotplogin').prop('disabled', true);
			$.ajax({
				url: 'otpgeneratemail',
				type: 'POST',
				data: {
					_token: token,
					emailotp: $('#emailotp').val()
				},
				success: function(response) {
					if(response>= 1)
					{
						$('#uid').val(response);
						$('#alertdiv').hide();
						$('#otpmodal').modal('show');
						$('#btnotplogin').prop('disabled', false);
						$('#btnotplogin').html('<i class="fa fa-envelope-o" aria-hidden="true"></i> Get OTP..');
					}
					else
					{
						$('#alertdiv').show();
						$('#btnotplogin').prop('disabled', false);
						$('#btnotplogin').html('<i class="fa fa-envelope-o" aria-hidden="true"></i> Get OTP..');
					}
				}
			});
		}
    }
</script>
<script>
function otploginprocess() {
	//hiddenemailid otp btnotp
	$('#btnotp').html('<i class="fa fa-spinner fa-pulse" aria-hidden="true"></i> Verifying OTP.. Please Wait..');
	var token = $("input[name=_token]").val();
	$('#btnotp').prop('disabled', true);
	$.ajax({
			url: 'otploginverification',
			type: 'POST',
			data: {
				_token: token,
				emailotp: $('#hiddenemailid').val(),
				otp:$('#otp').val(),
				uid:$('#uid').val()
			},
			success: function(response) {
				if(response== 1)
				{
					$('#otperroralertdiv').hide();
					$('#btnotp').prop('disabled', false);
					$('#otp').val('');
					$('#btnotp').html('<i class="fa fa-envelope-o" aria-hidden="true"></i> Logged In Successfully..');
					window.location="/dashboard";
				}
				else
				{
					$('#otperroralertdiv').show();
					$('#btnotp').prop('disabled', false);
					$('#otp').val('');
					$('#btnotp').html('<i class="fa fa-envelope-o" aria-hidden="true"></i> Verify OTP..');
				}
			},
			
		});
}
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