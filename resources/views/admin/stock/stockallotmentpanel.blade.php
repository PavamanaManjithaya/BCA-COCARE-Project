@extends('admin.layouts.tables')
@section('title', 'Stock Allotment')
@section('viewpage')
@if(Session::has('message'))
	<div class="alert alert-info">
		{{Session::get('message')}}
	</div>
@endif
@if(Session::has('errmessage'))
	<div class="alert alert-danger">
		{{Session::get('errmessage')}}
	</div>
@endif
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Detail</th>
                            <th>Total Received Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $data['vtype'] as $vtype)
                @php
                $dt  = date("Y-m-d");
                $stkreceived = App\Models\Stock::where('district_id',Auth::user()->district_id)->where('vaccinetype_id',$vtype->id)->where('date','<=',$dt)->where('status','Admin2District')->sum('qty');
                $stkspent = App\Models\Stock::where('vaccinetype_id',$vtype->id)->where('status','DistAdmin2Vcenter')->sum('qty');
                $balqty = $stkreceived - $stkspent;
                @endphp
                            <tr>
                                <td>{{ $vtype->vname }}</td>
                                <td>{{ $balqty }}</td>
                            </tr>
                        @endforeach                        
                        <tr>
                            <td>Remaining Stock</td>
                            <td id="div_rem_stock">0</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Total Balance</th>
                            <th id="div_tot_bal">{{ $balqty }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <hr>
    <div class="">
        <div class="col-md-12">
            <center><h4>Vaccine Allotment Form</h4><br></center>
        </div>
        <form action="{{ route('stockinsert') }}" method="POST" onsubmit="return validatesubmission()">
            @csrf
            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="stock_id" id="stock_id" value="0">
            <input type="hidden" name="balqty" id="balqty" value="{{ $balqty }}">
            <input type="hidden" name="rem" id="rem" value="0">
            <input type="hidden" name="district_id" id="district_id" value="0">
            <input type="hidden" name="vaccinetype_id" id="vaccinetype_id" value="{{ $data['vtype'][0]['id'] }}">
            <input type="hidden" name="status" id="status" value="DistAdmin2Vcenter">
            <div class="row">

                <div class="col-lg-6">
                    <div class="form-group">
                        Vaccine Center:  <span class="errmsg" id="id_vaccinecenter_id"></span>
                        <select name="vaccinecenter_id" id="vaccinecenter_id" class="form-control" onchange="fun_load_previous_bal('{{ $data['vtype'][0]['id'] }}')" >
                            <option value="">Select Vaccine Center</option>
                            @foreach (App\Models\Vaccinecenter::where('status', 'Active')->where('district_id', Auth::user()->district_id)->get()
        as $vcenter)
                                <option value="{{ $vcenter->id }}">{{ $vcenter->cvcname }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                


                <div class="col-lg-6">
                    <div class="form-group">
                        Allotment Date:  <span class="errmsg" id="id_date"></span>
                        <input type="date" name="date" id="date" class="form-control" placeholder="Enter a date" min="{{ date('Y-m-d') }}">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        Age:  <span class="errmsg" id="id_frmtoage"></span>
                        <select class="form-control" name="frmtoage" id="frmtoage" onchange="load_vaccine_age(this.value)">
                            <option value="">Select Age</option>
                            @php
                            $arr = array("18 to 44","45 and Above");
                            foreach($arr as $val)
                            {
                                echo "<option value='$val'>$val</option>";
                            }
                            @endphp
                        </select>
                        <input type="hidden" name="sage" id="sage" class="form-control" placeholder="Enter a date" >
                        <input type="hidden" name="eage" id="eage" class="form-control" placeholder="Enter a date" >
                    </div>
                </div>
                
                
                <div class="col-lg-6">
                    <div class="form-group">
                        Quantity:  <span class="errmsg" id="id_qty"></span>
                        <input type="number" name="qty" id="qty" class="form-control" min="1" placeholder="Vaccine Quantity"
                            max="0">
                    </div>
                </div>

                
                <div class="col-lg-6">
                    <div class="form-group">
                        Vaccine Alloted for : <span class="errmsg" id="id_dose"></span>
                        <select name="dose" id="dose" class="form-control">
                            <option value=''>Select Dose</option>
                            <option value="1">First Dose</option>
                            <option value="2">Second Dose</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-lg-12">
                    <div class="form-group">
                        <hr>
                        <center><input type="submit" name="submit" id="submit" class="btn btn-info" ></center>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        function confirmdelete(id) {
            if (confirm("Are you sure want to delete this record?") == true) {
                let _url = `/deleteallotstock/${id}`;
                let _token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: _url,
                    type: 'GET',
                    data: {
                        _token: _token
                    },
                    success: function(response) {
                        $("#row_" + id).remove();
                        location.reload();
                        alert("Record Deleted...");
                    },

                });
            }
        }
    </script>
    <script>
    //load_vaccine(this.value) sage eage
    function load_vaccine_age(agetype)
    {
        if(agetype == "18 to 44")
        {
            $('#sage').val('18');
            $('#eage').val('44');
        }
        if(agetype == "45 and Above")
        {
            $('#sage').val('45');
            $('#eage').val('100');
        }
    }
    </script>
    <script>
    function fun_load_previous_bal(vtypeid)
    {
        let _url = '/load_previous_stock/' + vtypeid + '/' + $('#vaccinecenter_id').val();
        let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: _url,
            type: 'GET',
            data: {
                _token: _token
            },
            success: function(response) {
                console.log(response);
                //div_rem_stock div_tot_bal  stkreceived  qty
                var totalstock = 0;
                $('#div_rem_stock').html(response);
                totalstock =  parseInt($('#balqty').val()) + parseInt(response);
                $('#div_tot_bal').html(totalstock);
                $("#rem").val(parseInt(response));
                $('#qty').attr('max', totalstock);
            }
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
	if($("#vaccinecenter_id").val() == "")
	{
		$("#id_vaccinecenter_id").html("Kindly select vaccine center...");
		validate = "false";
	}  
	if($("#date").val() == "")
	{
		$("#id_date").html("Date Should not be empty..");
		validate = "false";
	}        
	if($("#frmtoage").val() =="")
	{
		$("#id_frmtoage").html("Kindly select Age range.");
		validate = "false";
	}
	if($("#qty").val() =="")
	{
		$("#id_qty").html("Quantity Should not be empty..");
		validate = "false";
	}
	if($("#dose").val() == "")
	{
		$("#id_dose").html("Kindly select dose..");
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
