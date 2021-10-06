@extends('admin.layouts.form')
@section('title', 'Assign Stock')
@section('formpage')

@if(Auth::user()->user_role == "Admin") 
    <form action="{{ route('stock.store') }}" method="POST" onsubmit="return validatesubmission()" >
        <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}" >
        <input type="hidden" name="vaccinecenter_id" id="vaccinecenter_id" value="0" >
        <input type="hidden" name="sage" id="sage" value="0" >
        <input type="hidden" name="eage" id="eage" value="0" >
        <input type="hidden" name="dose" id="dose" value="0" >
        <input type="hidden" name="stock_id" id="stock_id" value="0" >
        <input type="hidden" name="status" id="status" value="Admin2District" >
        @csrf
        <div class="row">
            
            <div class="col-lg-6">
                <div class="form-group">
                    State: <span class="errmsg" id="id_state_id"></span>
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
                    District: <span class="errmsg" id="id_district_id"></span>
                    <select name="district_id" id="district_id" class="form-control" >
                        <option value="">Select District</option>
                    </select>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="form-group">
                    Vaccine Type: <span class="errmsg" id="id_vaccinetype_id"></span>
                    <select name="vaccinetype_id" id="vaccinetype_id" class="form-control" >
                        <option value="">Select Vaccine Type</option>
                        @foreach (App\Models\Vaccinetype::all() as $vtype)
                            <option value="{{ $vtype->id }}">{{ $vtype->vname }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    Dispatch Date: <span class="errmsg" id="id_date"></span>
                    <input type="date" name="date" id="date" class="form-control" placeholder="Enter a date"
                        value="@php $tomorrow = new DateTime('tomorrow'); echo $tomorrow->format('Y-m-d'); @endphp" min="@php $tomorrow = new DateTime('tomorrow'); echo $tomorrow->format('Y-m-d'); @endphp" >
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="form-group">
                    Quantity: <span class="errmsg" id="id_qty"></span>
                    <input type="number" name="qty" id="qty" class="form-control" min="10" placeholder="Vaccine Quantity"
                        value="{{ old('qty') }}" >
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
@endif
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
    //###################################
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
	if($("#vaccinetype_id").val() == "")
	{
		$("#id_vaccinetype_id").html("Kindly Select Vaccine Type..");
		validate = "false";
	}
	if($("#date").val() == "")
	{
		$("#id_date").html("Kindly Select Vaccine Type..");
		validate = "false";
	}
	if($("#qty").val() == "")
	{
		$("#id_qty").html("Quantity Should not be empty..");
		validate = "false";
	}
    //###################################
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
