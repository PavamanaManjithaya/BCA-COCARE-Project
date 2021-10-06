@extends('admin.layouts.tables')
@section('title', 'Vaccination Process')
@section('viewpage')
<link rel="stylesheet" type="text/css" href="frontend/css/viewgrid.css">
<style>
    input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
</style>
@if(Session::has('message'))
	<div class="alert alert-success">
		{{Session::get('message')}}
	</div>
@endif
<form action="{{ route('insertvaccinactiondata') }}" method="POST" >
    <input type="hidden" name="vprocesses_id" id="vprocesses_id" value="0" >
    <input type="hidden" name="beneficiaries_id" id="beneficiaries_id" value="0" >
    <input type="hidden" name="verifier_id" id="verifier_id" value="0" >
    <input type="hidden" name="vaccinator_id" id="vaccinator_id" value="{{Auth::user()->id}}" >
    <input type="hidden" name="verifierstatus" id="verifierstatus" value="0" >
    <input type="hidden" name="vaccinatorstatus" id="vaccinatorstatus" value="1" >
    <input type="hidden" name="vaccinedate" id="vaccinedate" value="{{ date('Y-m-d H:i:s') }}" >
    <input type="hidden" name="vaccinecenter_id" id="vaccinecenter_id" value="" > 
    <input type="hidden" name="schedule_id" id="schedule_id" value="0" >
    <input type="hidden" name="amount" id="amount" value="0" >
    <input type="hidden" name="dose" id="dose" value="0" >
    <div class="">
            @csrf
            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6"><span id="id_referenceid" class="errmsg"></span> 
                    <div class="form-group" style="font-size: 25px;">
                        <input type="number" style="font-size: 25px;" name="referenceid" id="referenceid" class="form-control" placeholder="Enter Reference ID" min="1" required>
                    </div>
                </div>
                <div class="col-lg-3"></div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <center><button type="button" name="submitrequest" id="submitrequest" class="btn btn-info" onclick="loadappointmentrec()">Load Data</button></center>
                    </div>
                </div>
            </div>

    </div>
    <hr>
    <div class="alert alert-info" id="loadingdata"  style="display: none;"><centeR><i class="fa fa-spinner fa-spin fa-3x" aria-hidden="true"></i> <h4>Loading...</h4></center></div>
    <div class="alert alert-danger" id="nodata"  style="display: none;"><centeR><i class="fa fa-exclamation-circle" aria-hidden="true"  style="color: red;font-size: 20px;"></i> <h4>Entered data is not valid..</h4></center></div>
    <div class="alert alert-danger" id="alreadycompl"  style="display: none;"><centeR><i class="fa fa-exclamation-circle" aria-hidden="true"  style="color: red;font-size: 20px;"></i> <h4>Verification not completed yet.</h4></center></div>
        <div class="content" id="contentdata"  style="display: none;">
            <table class="table table-bordered">
            <tr style="background-color: ghostwhite;">
                <th colspan="6" style="text-align: center;">Appointment Details</th>
            </tr>
            <tr>
                <th style="background-color: ghostwhite;">Center</th>
                <td colspan="4" id="lblcenter"></td>
            </tr>
            <tr>
                <th style="background-color: ghostwhite;">Date:</th>
                <td id="lbldate"></td>
                <th style="background-color: ghostwhite;">Preferred Time:</th>
                <td id="lblpreftimeslot"></td>
            </tr>
            </table>
            <table class="table table-bordered">
            <tr style="background-color: ghostwhite;">
                <th>Reference ID</th>      
                <th>Name</th>          
                <th>Vaccine Name</th>      
                <th>Dose Type</th>       
                <th>Photo ID</th>      
                <th>ID Number</th>                      
            </tr>
            <tr>
                <td id="lblrefid"></td>
                <td id="lblname"></td>
                <td id="lblvaccinename"></td>
                <td id="lbldosetype"></td>
                <td id="lblphotoid"></td>     
                <td id="lblidnumbers"></td>               
            </tr>
            </table>
            
            <table class="table table-bordered">
                <tr style="background-color: ghostwhite;">
                    <th>Payable Amount</th>      
                    <td id="amount_to_pay">0</td>                               
                </tr>
            </table>
            <centeR><input type="submit" name="btnverify" id="btnverify" value="Click Here to Complete Vaccination Process" class="btn btn-success btn-lg" ></centeR>
        </div>
    </form>
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
        function loadappointmentrec()
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
            if($("#referenceid").val() == "")
            {
                $("#id_referenceid").html("Reference ID should not be empty..");
                validate = "false";
            }
	if(validate == "true")
	{
            $('#loadingdata').show();
            $('#nodata').hide();
            $('#contentdata').hide();
            var token = $("input[name=_token]").val();
            var referenceid = $('#referenceid').val();
            $.ajax({
                url: 'loaddatavprocess/' + referenceid,
                type: 'GET',
                success: function(data) {
                    if(data== 0)
                    {
                        $('#loadingdata').hide();
                        $('#alreadycompl').hide();
                        $('#contentdata').hide();
                        $('#nodata').show();
                        $('#schedule_id').val(0);
                        $('#amount_to_pay').html('0');
                        $('#amount').val(0);
                        $('#beneficiaries_id').val(0);
                        $('#verifier_id').val(0);
                        $('#vaccinator_id').val(0);
                        $('#verifierstatus').val('');
                        $('#vaccinatorstatus').val('');
                        $('#vaccinecenter_id').val(0);
                    }
                    else if(data== 1)
                    {
                        $('#loadingdata').hide();
                        $('#alreadycompl').show();
                        $('#contentdata').hide();
                        $('#nodata').hide();
                        $('#schedule_id').val(0);
                        $('#amount_to_pay').html('0');
                        $('#amount').val(0);
                        $('#beneficiaries_id').val(0);
                        $('#verifier_id').val(0);
                        $('#vaccinator_id').val(0);
                        $('#verifierstatus').val('');
                        $('#vaccinatorstatus').val('');
                        $('#vaccinecenter_id').val(0);
                    }
                    else
                    {
                        $('#loadingdata').hide();
                        $('#alreadycompl').hide();
                        $('#nodata').hide();
                        $('#lblcenter').html(data['beneficiariesrec'][0].address + ", " + data['beneficiariesrec'][0].cvcname);
                        $('#lbldate').html(data.scheduledate);
                        $('#lblpreftimeslot').html(data.scheduletime);
                        $('#lblrefid').html(data['beneficiariesrec'][0].referenceid);
                        $('#lblname').html(data['beneficiariesrec'][0].name);
                        $('#lblvaccinename').html(data['beneficiariesrec'][0].vname);
                        $('#lbldosetype').html("Dose No. " + data['beneficiariesrec'][0].doseno);
                        $('#dose').val(data['beneficiariesrec'][0].doseno);
                        $('#lblphotoid').html(data['beneficiariesrec'][0].id_proof);
                        $('#lblidnumbers').html(data['beneficiariesrec'][0].id_number);
                        $('#schedule_id').val(data['beneficiariesrec'][0].scheduleid);
                        if(data['beneficiariesrec'][0].category == "Paid")
                        {
                            $('#amount_to_pay').html("₹ " + data['beneficiariesrec'][0].cost);
                            $('#amount').val(data['beneficiariesrec'][0].cost);
                        }
                        if(data['beneficiariesrec'][0].category == "Free")
                        {
                            $('#amount_to_pay').html("₹ " + 0);
                            $('#txt_amount_to_pay').val(0);
                        }
                        $('#vprocesses_id').val(data.vprocesses_id);
                        $('#beneficiaries_id').val(data['beneficiariesrec'][0].beneficiaries_id);
                        $('#vaccinecenter_id').val(data['beneficiariesrec'][0].vaccinecentersid);
                        $('#contentdata').show();
                    }
                },
            });
    }
        }
        </script>
@endsection