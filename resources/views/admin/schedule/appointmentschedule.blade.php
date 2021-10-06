@extends('admin.layouts.tables')
@section('title', 'Verify Appointment Schedule')
@section('viewpage')

<link rel="stylesheet" type="text/css" href="frontend/css/viewgrid.css">
<form action="{{ route('insertvprocesses') }}" method="POST" >
    <input type="hidden" name="beneficiaries_id" id="beneficiaries_id" value="0" >
    <input type="hidden" name="verifier_id" id="verifier_id" value="{{Auth::user()->id}}" >
    <input type="hidden" name="vaccinator_id" id="vaccinator_id" value="0" >
    <input type="hidden" name="verifierstatus" id="verifierstatus" value="1" >
    <input type="hidden" name="vaccinatorstatus" id="vaccinatorstatus" value="0" >
    <input type="hidden" name="vaccinedate" id="vaccinedate" value="{{ date('Y-m-d H:i:s') }}" >
    <input type="hidden" name="vaccinecenter_id" id="vaccinecenter_id" value="" > 
    <input type="hidden" name="schedules_id" id="schedules_id" value="0" >
    <input type="hidden" name="amount" id="amount" value="0" >
    <div class="">
            @csrf
            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        Reference ID: <span class="errmsg" id="id_referenceid"></span>
                        <input type="number" name="referenceid" id="referenceid" class="form-control" placeholder="Enter Reference ID" min="1" required>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="form-group">
                        Secret Code: <span class="errmsg" id="id_secretcode"></span>
                        <input type="number" name="secretcode" id="secretcode" class="form-control" placeholder="Enter Secret Code" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        Document : <span class="errmsg" id="id_id_proof"></span>
                        <select name="id_proof" id="id_proof" class="form-control" onchange="funchangelabel(this.value)"required>
                            <option value=''>Select Document</option>
                            <?php
                            $arr = array("Aadhaar Card","PAN Card");
                            foreach($arr as $val)
                            {
                            echo "<option value='$val'>$val</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <span id="lblidnumber">Photo ID Number</span> <span class="errmsg" id="id_id_number"></span>
                        <input type="text" name="id_number" id="id_number" class="form-control" placeholder="Enter Photo ID Number" required>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <hr>
                        <center><button type="button" name="submitrequest" id="submitrequest" class="btn btn-info" onclick="loadappointmentrec()">Verify Data</button></center>
                    </div>
                </div>
            </div>

    </div>
    <hr>
    <div class="alert alert-info" id="loadingdata"  style="display: none;"><centeR><i class="fa fa-spinner fa-spin fa-3x" aria-hidden="true"></i> <h4>Loading...</h4></center></div>
    <div class="alert alert-danger" id="nodata"  style="display: none;"><centeR><i class="fa fa-exclamation-circle" aria-hidden="true"  style="color: red;font-size: 20px;"></i> <h4>Entered data is not valid..</h4></center></div>
    <div class="alert alert-danger" id="alreadycompl"  style="display: none;"><centeR><i class="fa fa-exclamation-circle" aria-hidden="true"  style="color: red;font-size: 20px;"></i> <h4>Verification already completed..</h4></center></div>
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
                <th>Secret Code</th>                     
            </tr>
            <tr>
                <td id="lblrefid"></td>
                <td id="lblname"></td>
                <td id="lblvaccinename"></td>
                <td id="lbldosetype"></td>
                <td id="lblphotoid"></td>     
                <td id="lblidnumbers"></td>   
                <td id="lblsecretcode"></td>               
            </tr>
            </table>
            
            <table class="table table-bordered">
                <tr style="background-color: ghostwhite;">
                    <th>Payable Amount</th>      
                    <td id="amount_to_pay">0</td>                               
                </tr>
            </table>
            <centeR><input type="submit" name="btnverify" id="btnverify" value="Click Here to Confirm Verification" class="btn btn-success btn-lg" onclick="funverifydata()"></centeR>
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
            //id_referenceid referenceid id_secretcode secretcode id_id_proof id_proof id_id_number id_number
            if($('#referenceid').val() == "")
            {
                $("#id_referenceid").html("Kindly enter reference ID..");
		        validate = "false";
            }
            if($('#secretcode').val() == "")
            {
                $("#id_secretcode").html("Kindly enter Valid Secret code..");
		        validate = "false";
            }
            if($('#id_proof').val() == "")
            {
                $("#id_id_proof").html("Kindly select ID proof..");
		        validate = "false";
            }
            if($('#id_number').val() == "")
            {
                $("#id_id_number").html("ID number should not be empty..");
		        validate = "false";
            }
            if(validate == "true")
	        {
                $('#loadingdata').show();
                $('#nodata').hide();
                $('#contentdata').hide();
                var token = $("input[name=_token]").val();
                var referenceid = $('#referenceid').val();
                var secretcode = $('#secretcode').val();
                var id_proof = $('#id_proof').val();
                var id_number = $('#id_number').val();
                $.ajax({
                    url: 'verify_ben_data',
                    type: 'POST',
                    data: {
                        _token: token,
                        referenceid: referenceid,
                        secretcode: secretcode,
                        id_proof: id_proof,
                        id_number: id_number,
                    },
                    success: function(data) {
                        if(data== 0)
                        {
                            $('#loadingdata').hide();
                            $('#alreadycompl').hide();
                            $('#contentdata').hide();
                            $('#nodata').show();
                            $('#schedules_id').val(0);
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
                            $('#schedules_id').val(0);
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
                            $('#lblphotoid').html(data['beneficiariesrec'][0].id_proof);
                            $('#lblidnumbers').html(data['beneficiariesrec'][0].id_number);
                            $('#lblsecretcode').html(data['beneficiariesrec'][0].secretcode);
                            $('#schedules_id').val(data['beneficiariesrec'][0].scheduleid);
                            if(data['beneficiariesrec'][0].category == "Paid")
                            {
                                $('#amount_to_pay').html("₹ "+ data['beneficiariesrec'][0].cost);
                                $('#amount').val(data['beneficiariesrec'][0].cost);
                            }
                            if(data['beneficiariesrec'][0].category == "Free")
                            {
                                $('#amount_to_pay').html("₹ " + 0);
                                $('#txt_amount_to_pay').val(0);
                            }
                            $('#beneficiaries_id').val(data['beneficiariesrec'][0].beneficiaries_id);
                            $('#verifierstatus').val(1);
                            $('#vaccinatorstatus').val(0);
                            $('#vaccinecenter_id').val(data['beneficiariesrec'][0].vaccinecentersid);
                            $('#contentdata').show();
                        }
                    },
                });
            }
        }
        </script>
@endsection