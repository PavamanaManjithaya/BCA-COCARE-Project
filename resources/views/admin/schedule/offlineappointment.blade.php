
@extends('admin.layouts.tables')
@section('title', 'Offline Appointment')
@section('viewpage')

    <link rel="stylesheet" type="text/css" href="frontend/css/viewgrid.css">
    <form action="{{ route('insertofflineappt') }}" method="POST">
        @csrf
        <input type="hidden" name="verifier_id" id="verifier_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="vaccinator_id" id="vaccinator_id" value="0">
        <input type="hidden" name="verifierstatus" id="verifierstatus" value="1">
        <input type="hidden" name="vaccinatorstatus" id="vaccinatorstatus" value="0">
        <input type="hidden" name="vaccinedate" id="vaccinedate" value="{{ date('Y-m-d H:i:s') }}">
        <input type="hidden" name="vaccinecenter_id" id="vaccinecenter_id" value="{{ Auth::user()->vaccine_center_id }}">
        <input type="hidden" name="secretcode" id="secretcode" value="0">
        <!--###########Search User Starts Here -->
        <div class="div_ac_verification"
            style="border-color:#ff3366;border-width: 1px; /* this allows you to adjust the thickness */border-style: solid; padding: 10px;">
            <center>
                <h5>Account Verification</h5>
            </center>
            <hr>
            <div class="div_search_user">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            Document : <span class="errmsg" id="id_id_proofs"></span>
                            <select name="id_proofs" id="id_proofs" class="form-control"
                                onchange="funchangelabel(this.value)" >
                                <option value=''>Select Document</option>
                                <?php
                                $arr = ['Aadhaar Card', 'PAN Card'];
                                foreach ($arr as $val) {
                                    echo "<option value='$val'>$val</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <span id="lblidnumber">Photo ID Number</span> <span class="errmsg" id="id_id_numbers"></span>
                            <input type="text" name="id_numbers" id="id_numbers" class="form-control"
                                placeholder="Enter Photo ID Number" >
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <center><button type="button" name="submitrequest" id="submitrequest"
                                    class="btn btn-info btn-lg" onclick="load_verify_idproof()">Verify Data</button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        <!--###########Search User Ends Here -->
        <div class="alert alert-info" id="alertloadingdata" style="display: none;">
            <centeR><i class="fa fa-spinner fa-spin fa-3x" aria-hidden="true"></i>
                <h4>Loading...</h4>
            </center>
        </div>
        <div class="alert alert-danger" id="alertnodata" style="display: none;">
            <centeR><i class="fa fa-exclamation-circle" aria-hidden="true" style="color: red;font-size: 20px;"></i>
                <h4>Entered data is not valid..</h4>
            </center>
        </div>
        <div class="alert alert-success" id="alertsuccessdata" style="display: none;">
            <centeR><i class="fa fa-exclamation-circle" aria-hidden="true"
                    style="color: rgb(12, 209, 71);font-size: 20px;"></i>
                <h4>Entered Data found in the database..</h4>
            </center>
        </div>
        <!-- ############################################-->
        <div class="search_result"
            style="display: none; border-color:#ff3366;border-width: 1px; border-style: solid; padding: 10px;">
            <center>
                <h5>Account Detail</h5>
            </center>
            <hr>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        Name :
                        <input type="text" name="name" id="name" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        Date of Birth :
                        <input type="text" name="dob" id="dob" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        Mobil No. :
                        <input type="text" name="contact" id="contact" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        Email ID. :
                        <input type="text" name="email" id="email" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        id_proof. :
                        <input type="text" name="id_proof" id="id_proof" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        ID Number. :
                        <input type="text" name="id_number" id="id_number" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        Gender :
                        <input type="text" name="gender" id="gender" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        Dose :
                        <input type="text" name="dose" id="dose" class="form-control" readonly>
                    </div>
                </div>
            </div>
        </div>
        <!-- ############################################-->
        <!-- ############################################-->
        <div class="search_result"
            style="display: none; border-color:#ff3366;border-width: 1px; border-style: solid; padding: 10px;">
            <center>
                <h5>Vaccine</h5>
            </center>
            <hr>
            <div class="row">
               
                <div class="col-lg-6">
                    <div class="vaccinetype_id">
                    
                        <div class="form-group">
                            Select Vaccine Type:
                            <select name="vaccinetype_id" id="vaccinetype_id" class="form-control"
                                onchange="load_vaccine_qty()">
                                <option value="">Select Vaccine Type</option>
                                @foreach (App\Models\Vaccinetype::where('status', 'Active')->get() as $state)
                                    <option value="{{ $state->id }}">{{ $state->vname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                <div class="vaccinetype">
                    <div class="select">
                        <input type="text" name="vaccinetype_id" id="vaccinetype" class="form-control" readonly>
                    </div>
                   
                        Vaccine Type:
                        <input type="text" name="vaccine" id="vaccinetype1" class="form-control" readonly>

                    </div>
                </div>
            
            <div class="col-lg-6">
                <div class="form-group">
                    Quantities Available:
                    <input type="number" name='vaccine_qty' id="vaccine_qty" class="form-control" readonly>
                </div>
            </div>
        </div>
        </div>
        <!-- ############################################-->
        <!-- ############################################-->
        <div class="submit_scheduler"
            style="display: none; border-color:#ff3366;border-width: 1px; border-style: solid; padding: 10px;">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <center><input type="button" name="button" class="btn btn-info" value="Verify with OTP"
                                data-toggle="modal" data-target="#otpmyModal" onclick="generate_otp_number()"></center>
                    </div>
                </div>
            </div>
        </div>
        <!-- ############################################-->
        <div id="otpmyModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">OTP Verification</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="otpnumber" id="otpnumber">
                        <input type="text" class="form-control" name="txtotpnumber" id="txtotpnumber"
                            placeholder="Enter OTP Number" required>
                    </div>
                    <div class="modal-footer">
                        <button type="Submit" class="btn btn-info" onclick="return otpverification()">submit</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- ############################################-->
    </form>
    <script>
        //  lblidnumber id_number lblname name
        function funchangelabel(id_type) {
            if (id_type == "Aadhaar Card") {
                /*$('#lblidnumber').attr('placeholder','Some New Text 1');*/
                $('#id_number').attr('placeholder', 'Enter Aadhaar Card Number');
                /*$('#lblname').attr('placeholder','Some New Text 1');*/
                $('#name').attr('placeholder', 'Name (As in Aadhaar Card)');
            }
            if (id_type == "PAN Card") {
                /*$('#lblidnumber').attr('placeholder','Some New Text 1');*/
                $('#id_number').attr('placeholder', 'Enter PAN Card Number');
                /*$('#lblname').attr('placeholder','Some New Text 1');*/
                $('#name').attr('placeholder', 'Name (As in PAN Card)');
            }
        }
    </script>
<script>
function load_verify_idproof() {            
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
    //id_id_proofs id_proofs id_id_numbers id_numbers
	if($("#id_proofs").val() == "")
	{
		$("#id_id_proofs").html("Kindly select User Role..");
		validate = "false";
	}
	if($("#id_numbers").val() == "")
	{
		$("#id_id_numbers").html("Kindly Select State..");
		validate = "false";
	}
	if(validate == "true")
	{
            $('#alertloadingdata').show();
            $('#alertnodata').hide();
            $('#alertsuccessdata').hide();
            var token = $("input[name=_token]").val();
            var id_proof = $('#id_proofs').val();
            var id_number = $('#id_numbers').val();
            $.ajax({
                url: 'verify_offlineidproofs',
                type: 'POST',
                data: {
                    _token: token,
                    id_proof: id_proof,
                    id_number: id_number,
                },
                success: function(data) {
                    if (data == 0) {
                        $('#alertloadingdata').hide();
                        $('#alertnodata').show();
                        $('#alertsuccessdata').hide();
                    } else {
                        $('#alertloadingdata').hide();
                        $('#alertnodata').hide();
                        $('#alertsuccessdata').show();
                        $('#alertsuccessdata').delay(5000).fadeOut('slow');
                        $('.search_result').show();
                        $('#name').val(data.idproofs[0].name);
                        $('#dob').val(data.idproofs[0].dob);
                        $('#contact').val(data.idproofs[0].contact);
                        $('#email').val(data.idproofs[0].email);
                        $('#id_proof').val(data['id_proof']);
                        $('#id_number').val(data['id_number']);
                        $('#gender').val(data.idproofs[0].gender);
                        $('#dose').val(data.dosecount + 1);
                        if (data.dosecount == 1) {
                            $('#vaccinetype1').val(data.vtype);
                            $('#vaccinetype').val(data.vtypeid);
                            $('#vaccine_qty').val(data.qty);
                            $('.vaccinetype_id').remove();
                            $('.submit_scheduler').show();
                            $('.select').hide();
                            console.log(data.vtypeid)

                        } else {
                            $('.vaccinetype').remove();
                        }
                        $('.div_ac_verification').hide();
                    }
                },
            });
    }
}
</script>
    <script>
        function load_vaccine_qty() {
            var vaccinetype_id = $('#vaccinetype_id').val();
            var dose = $('#dose').val();
            var dob = $('#dob').val();
            $.ajax({
                url: 'load_vaccine_qty_rec',
                type: 'GET',
                data: {
                    vaccinetype_id: vaccinetype_id,
                    dose: dose,
                    dob: dob
                },
                success: function(data) {
                    if (data == 0) {
                        alert("Not in Stock");
                        $('.submit_scheduler').hide();
                    } else {
                        $('#vaccine_qty').val(data);
                        $('.submit_scheduler').show();
                    }
                },
            });
        }
    </script>
    <script>
        function generate_otp_number() {
            var name = $('#name').val();
            var email = $('#email').val();
            //email name
            //otpnumber txtotpnumber
            $.ajax({
                url: 'load_otp_num',
                type: 'GET',
                data: {
                    name: name,
                    email: email
                },
                success: function(data) {
                    $('#otpnumber').val(data);
                },
            });
        }
    </script>
    <script>
        function otpverification() {
            if ($('#otpnumber').val() == $('#txtotpnumber').val()) {
                return true;
            } else {
                alert("OTP Not matching...");
                return false;
            }
        }
    </script>
@endsection
