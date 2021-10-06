@extends('admin.layouts.form')
@section('title', 'Add Vaccine Center')
@section('formpage')
    <form action="{{ route('vaccinecenter.store') }}" method="POST" onsubmit="return validatesubmission()" >
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    Vaccine Center Name: <span class="errmsg" id="id_cvcname"></span>
                    <input type="text" name="cvcname" id="cvcname" class="form-control" placeholder="Enter a vaccine center name" >
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    Category: <span class="errmsg" id="id_category"></span>
                    <select name="category" id="category" class="form-control" >
                        <option value="">Select Category</option>
                        @php
                            $arr = ['Paid', 'Unpaid'];
                        @endphp
                        @foreach ($arr as $val)
                            <option value="{{ $val }}">{{ $val }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    Address: <span class="errmsg" id="id_address"></span>
                    <textarea name="address" id="address" class="form-control" placeholder="Enter a vaccine center address" ></textarea>                   
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
<!-- Multi Pin code starts here -->
Pincode: <span class="errmsg" id="id_pincode"></span><br>
<style>
    .bootstrap-tagsinput {
    background-color: #fff;
    border: 1px solid #ccc;
    box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
    display: inline-block;
    padding: 4px 6px;
    color: #555;
    vertical-align: middle;
    border-radius: 4px;
    max-width: 100%;
    line-height: 22px;
    cursor: text;
    width: 100%;
}
    .bootstrap-tagsinput .tag {
    margin-right: 2px;
    margin-top: 5px;
    color: #ffffff;
    background-color: gray;
    padding: 3px;
}
</style>
<input type="text" name="pincode" id="pincode" style="width: 100%;"  data-role="tagsinput"></input>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<style>
    select.form-control:not([size]):not([multiple]) {
    height: calc(3.25rem + 2px);
}
</style>
<!-- Multi Pin code ends here -->
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    State:  <span class="errmsg" id="id_state_id"></span>
                    <select name="state_id" id="state_id" class="form-control" >
                        <option value="">Select State</option>
                        @foreach(App\Models\State::where('status','Active')->get() as $state)
                            <option value="{{$state->id}}">{{$state->state}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    District:  <span class="errmsg" id="id_district_id"></span>
                    <select name="district_id" id="district_id" class="form-control" >
                        <option value="">Select District</option>
                        <!-- 
                        <option value="">Select District</option>
                        @foreach(App\Models\District::where('status','Active')->get() as $district)
                            <option value="{{$district->id}}">{{$district->district}}</option>
                        @endforeach
                        -->
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
Start Time:  <span class="errmsg" id="id_starttime"></span>
 <input type="time" name="starttime" id="starttime" class="form-control" placeholder="HH:MM" >
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
End Time:  <span class="errmsg" id="id_endtime"></span>
<input type="time" name="endtime" id="endtime" class="form-control" placeholder="HH:MM" >
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    Status:  <span class="errmsg" id="id_status"></span>
                    <select name="status" id="status" class="form-control" >
                        <option value="">Select Status</option>
                        @php
                            $arr = ['Active', 'Inactive'];
                        @endphp
                        @foreach ($arr as $val)
                            <option value="{{ $val }}">{{ $val }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <hr>
                    <center><input type="submit" name="submit" id="submit" class="btn btn-info"></center>
                </div>
            </div>
        </div>
    </form>

<script src="https://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
<script>var $j = jQuery.noConflict(true);</script>
<script>
    $(document).ready(function(){
    console.log($j().jquery); // This prints v1.9.1
    });
</script>
<script type="text/javascript">
    $j("document").ready(function(){
        $j('select[name="state_id"]').on('change',function(){
            var state_id=$(this).val();
            if(state_id)
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
                        })
                    }
                })
            }
            else
            {
                $j('select[name="subcategory"]').empty();
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
	if($("#cvcname").val() == "")
	{
		$("#id_cvcname").html("Vaccine Center should not be empty..");
		validate = "false";
	}
	if($("#category").val() == "")
	{
		$("#id_category").html("Kindly select Payment Category..");
		validate = "false";
	}
	if($("#address").val() == "")
	{
		$("#id_address").html("Address Should not be empty..");
		validate = "false";
	}
	if($("#pincode").val() == "")
	{
		$("#id_pincode").html("PIN Code should not be empty..");
		validate = "false";
	}
	if($("#state_id").val() == "")
	{
		$("#id_state_id").html("Kindly select State..");
		validate = "false";
	}
	if($("#district_id").val() == "")
	{
		$("#id_district_id").html("Kindly select District..");
		validate = "false";
	}
	if($("#starttime").val() == "")
	{
		$("#id_starttime").html("Kindly enter start time.");
		validate = "false";
	}
	if($("#endtime").val() == "")
	{
		$("#id_endtime").html("Kindly enter End time.");
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