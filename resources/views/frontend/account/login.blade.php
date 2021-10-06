
<style>
    .header_section {
        display: none;
    }
</style>
<style>
	.errmsg{
	   color: red;
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
                            <h2 class="design_text">@lang('messages.register/signin')</h2>
        <div class="about_img d-flex justify-content-center"><img src="{{ asset('frontend/images/login.png') }}" width="150" height="1200"></div>
        <p>@lang('messages.otpsent')</p>
        <form method="post" action=""  onsubmit="return false;">
            @csrf
            <div class="alert alert-danger" id="alertdiv" style="display: none;">
                This account not registered in our system..
            </div>
            <div class="form-group">
                <input type="email" name="emailotp" id="emailotp" class="form-control"
				placeholder="@lang('messages.email')">
			    <span class="errmsg" id="id_emailotp"></span>
            </div>
            <div class="form-group">
                <center><button type="button" id="btnotplogin" id="btnotplogin" class="btn btn-primary btn-lg btn-block" onclick="loadotp()"><i class="fa fa-envelope-o" aria-hidden="true"></i> @lang('messages.otp')</button></center>
            </div><br>
        </form>
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

<div class="modal fade" id="otpmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('messages.otpverify')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" id="otperroralertdiv" style="display: none;">
                    @lang('messages.invalidotp')
                </div>
                <div class="alert alert-warning" id="alertnewacdiv" style="display: none;">
                  Account Not Found - Kindly create New Account By entering Valid OTP.
                </div>
                <div class="alert alert-success" id="alertlogindiv" style="display: none;">
                  Account Found - Kindly Login By entering Valid OTP.
                </div>
                <p>An OTP sent to <span id="idotp"></span></p>
                <form method="post" action=""    onsubmit="return false;" >
                    <input type="hidden" name="hiddenemailid" id="hiddenemailid" >
                    <input type="hidden" name="uid" id="uid" >
                    <div class="form-group">
                        <input type="text" name="otp" id="otp" class="form-control" placeholder="Enter OTP Here" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnotp" name="btnotop" onclick="otploginprocess()">@lang('messages.verifyotp')</button>
            </div>
        </div>
    </div>
</div>
<script>
$("#otp").keyup(function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        $("#btnotp").click();
    }
});
</script>
<script>
$("#emailotp").keyup(function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        $("#btnotplogin").click();
    }
});
</script>
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
            $('#alertnewacdiv').hide();
            $('#alertlogindiv').hide();
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
                    url: 'userotpgeneratemail',
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
                            $('#alertlogindiv').show();
                            $('#otpmodal').modal('show');
                            $('#btnotplogin').prop('disabled', false);
                            $('#btnotplogin').html('<i class="fa fa-envelope-o" aria-hidden="true"></i> Get OTP..');
                        }
                        else if(response == "New")
                        {
                            $('#uid').val(0);
                            $('#alertdiv').hide();
                            $('#otpmodal').modal('show');
                            $('#alertnewacdiv').show();
                            $('#btnotplogin').prop('disabled', false);
                            $('#btnotplogin').html('<i class="fa fa-envelope-o" aria-hidden="true"></i> Get OTP..');
                        }
                    },
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
			url: 'userotploginverification',
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
					window.location="/welcome";
				}
                  else if(response== 2)
				{
					$('#otperroralertdiv').hide();
					$('#btnotp').prop('disabled', false);
					$('#otp').val('');
					$('#btnotp').html('<i class="fa fa-envelope-o" aria-hidden="true"></i> Logged In Successfully..');
					window.location="/beneficiaryview";
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
