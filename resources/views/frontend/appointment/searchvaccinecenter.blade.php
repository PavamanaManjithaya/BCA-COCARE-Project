<style>
.badge-pill {
    padding-right: .6em;
    padding-left: .6em;
    border-radius: 0rem;
}
</style>
<link rel="stylesheet" type="text/css" href="/frontend/css/viewgrid.css">
      </div>
      <!-- header section end -->
      <!-- news section start -->
      <div class="news_section"  style="padding-bottom: 5px;">
         <div>
            <div id="main_slider" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="news_section_2 layout_padding">
                        <div class="box_main" style="width: 90%;">
                           <h2 class="design_text">Search</h2>
<input type="hidden" name="benid" id="benid" value="0" >
<input type="hidden" name="scheduleid" id="scheduleid" value="0" >

<!-- ################################################################ -->
<div class="container">
	<style>
		.wrapper{
		  display: inline-flex;
		  background: #fff;
		  height: 90px;
		  width: 100%;
		  align-items: center;
		  justify-content: space-evenly;
		  border-radius: 5px;
		  padding: 20px 15px;
		  box-shadow: 5px 5px 30px rgba(0,0,0,0.2);
		}
		.wrapper .option{
		  background: #fff;
		  height: 100%;
		  width: 100%;
		  display: flex;
		  align-items: center;
		  justify-content: space-evenly;
		  margin: 0 10px;
		  border-radius: 5px;
		  cursor: pointer;
		  padding: 0 10px;
		  border: 2px solid lightgrey;
		  transition: all 0.3s ease;
		}
		.wrapper .option .dot{
		  height: 20px;
		  width: 20px;
		  background: #d9d9d9;
		  border-radius: 50%;
		  position: relative;
		}
		.wrapper .option .dot::before{
		  position: absolute;
		  content: "";
		  top: 4px;
		  left: 4px;
		  width: 12px;
		  height: 12px;
		  background: #0069d9;
		  border-radius: 50%;
		  opacity: 0;
		  transform: scale(1.5);
		  transition: all 0.3s ease;
		}
		input[type="radio"]{
		  display: none;
		}
		#option-1:checked:checked ~ .option-1,
		#option-2:checked:checked ~ .option-2{
		  border-color: #0069d9;
		  background: #0069d9;
		}
		#option-1:checked:checked ~ .option-1 .dot,
		#option-2:checked:checked ~ .option-2 .dot{
		  background: #fff;
		}
		#option-1:checked:checked ~ .option-1 .dot::before,
		#option-2:checked:checked ~ .option-2 .dot::before{
		  opacity: 1;
		  transform: scale(1);
		}
		.wrapper .option span{
		  font-size: 20px;
		  color: #808080;
		}
		#option-1:checked:checked ~ .option-1 span,
		#option-2:checked:checked ~ .option-2 span{
		  color: #fff;
		}
		</style>
		<style>
			
#ck-button {
    margin:4px;
    background-color:#EFEFEF;
    border-radius:4px;
    border:1px solid #D0D0D0;
    overflow:auto;
    float:left;
}

#ck-button:hover {
    background:red;
}

#ck-button label {
    float:left;
    width:4.0em;
}

#ck-button label span {
    text-align:center;
    padding:3px 0px;
    display:block;
}

#ck-button label input {
    position:absolute;
    top:-20px;
}

#ck-button input:checked + span {
    background-color:#911;
    color:#fff;
}
</style>
		<div class="wrapper">
		  <input type="radio" name="select" id="option-1" checked value="pin" onclick="funloaddiv(this.value)">
		  <input type="radio" name="select" id="option-2" value="district" onclick="funloaddiv(this.value)">
		  <label for="option-1" class="option option-1">
			<div class="dot"></div>
			<span>Search By PIN</span>
		  </label>
		  <label for="option-2" class="option option-2">
			<div class="dot"></div>
			<span>Search By District</span>
		  </label>
		</div>
		<div>
		<div id="searchbypin"><br>
			<table class="table table-bordered table-strip">
				<thead>
					<tr>
						<th>Enter PIN
						</th>
						<th>
							<input type="text" name="pincode" id="pincode" class="form-control" onkeyup="changeVal(this.value,'pincode')">
						</th>
					</tr>
				</thead>
			</table>
		</div>
		<div id="searchbydistrict" style="display: none;" ><br>
		<form name="searchdist">
			<table class="table table-bordered table-strip">
				<thead>
					<tr>
						<th>Select State
							<select name="state_id" id="state_id" class="form-control">
								<option value="">Select State</option>
								@foreach(App\Models\State::where('status','Active')->get() as $state)
									<option value="{{$state->id}}">{{$state->state}}</option>
								@endforeach
							</select>
						</th>
						<th>Select District
		<select name="district_id" id="district_id" class="form-control">
			<option value="">Select District</option>
		</select>
						</th>
					</tr>
				</thead>
			</table>
		</form>
		</div>
		</div>

<!-- ######################################## -->
<div class="row">
	<div class="col-md-3">
		<b>Cost</b>
		<br>
		<div class="bs-example">
			<div class="btn-group btn-group-toggle" data-toggle="buttons">
				<label class="btn btn-outline-primary active">
					<input type="radio" name="cost" id="cost" value="All" checked onchange="loadradio()" > All
				</label>
				<label class="btn btn-outline-primary">
					<input type="radio" name="cost" id="cost" value="Unpaid" onchange="loadradio()" > Free
				</label>
				<label class="btn btn-outline-primary ">
					<input type="radio" name="cost" id="cost" value="Paid" onchange="loadradio()" > Paid
				</label>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<b>Enter age</b>
		<br>
		<div class="btn-group btn-group-toggle" data-toggle="buttons">
			<label class="btn btn-outline-primary active">
				<input type="radio" name="age" id="age" value="All" checked onchange="loadradio()" > All
			</label>
			<label class="btn btn-outline-primary">
				<input type="radio" name="age" id="age" value="1844"  onchange="loadradio()" > 18-44
			</label>
			<label class="btn btn-outline-primary">
				<input type="radio" name="age" id="age" value="45100"   onchange="loadradio()" > 45 & Above
			</label>
		</div>
	</div>
	<div class="col-md-3">
		<b>Vaccine Type</b>
		<br>
		<div class="btn-group btn-group-toggle" data-toggle="buttons">
			<label class="btn btn-outline-primary active">
				<input type="radio" name="vaccinetype" id="vaccinetype" value="All" checked  onchange="loadradio()" > All
			</label>
		@foreach(App\Models\Vaccinetype::where('status','Active')->get() as $vtype)
			<label class="btn btn-outline-primary">
				<input type="radio" name="vaccinetype" id="vaccinetype" value="{{ $vtype->id }}" onchange="loadradio()"  > {{ $vtype->vname }}
			</label>
		@endforeach
		</div>
	</div>
	<div class="col-md-3">
		<b>Dose</b>
		<br>
		<div class="btn-group btn-group-toggle" data-toggle="buttons">
			<label class="btn btn-outline-primary active">
				<input type="radio" name="dose" id="dose" value="All" checked onchange="loadradio()"  > All
			</label>
			<label class="btn btn-outline-primary">
				<input type="radio" name="dose" id="dose" value="1" onchange="loadradio()"  > Dose 1
			</label>
			<label class="btn btn-outline-primary">
				<input type="radio" name="dose" id="dose" value="2"  onchange="loadradio()"  > Dose 2
			</label>
		</div>
	</div>
</div>
<!-- ######################################## -->
	<hr>
	<table name="tblsearch" id="tblsearch" class="table table-bordered table-strip " style="width: 100%;">
		<thead>
			<tr>
				<th style="width: 250px;">Vaccination Center</th>
@php
$begin = new DateTime(date('Y-m-d'));
$NewDate=Date('Y-m-d', strtotime('+7 days'));
$end = new DateTime($NewDate);
$interval = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($begin, $interval, $end);
/*
foreach ($period as $dt) {
    echo $dt->format("l Y-m-d H:i:s\n");
}
*/
@endphp
				@foreach($period as $dt)
				<td>
					<input type="hidden" name="dt[]" id="dt[]" value="{{ $dt->format("Y-m-d") }}" >
					<label style='font-size: 13px;'>
					{{ $dt->format("l") }}<br>
					{{ $dt->format("d M Y") }}
					</label>
				</td>
				@endforeach
			</tr>
		</thead>
		<tbody>
			<?php
			/*
			<tr>
				<td style='font-size: 13px;'>Vaccination Center 1 <br>(18-44Yr) (Paid)</td>
				@foreach($period as $dt)
				<td style="text-align: center;">
					<span class="btn badge badge-pill badge-primary" style="margin-bottom: 5px;
					width: 100%;cursor: pointer;" >12<br>Covaxin</span><br>
					<span class="btn badge badge-pill badge-warning" style="margin-bottom: 5px;
					width: 100%;cursor: pointer;" >42<br>Covishield</span>
				</td>
				@endforeach
			</tr>
			<tr>
				<td style='font-size: 13px;'>Vaccination center 2 <br>(44-74Yr) (Free)</td>
				@foreach($period as $dt)
				<td>
					<span class="btn badge badge-pill badge-secondary" style="margin-bottom: 5px;
					width: 100%;cursor: pointer;" >42<br>Covishield</span>
				</td>
				@endforeach
			</tr>
			*/
			?>
		</tbody>
	</table>
<br>
<br>
</div>
<!-- ################################################################ -->
					  </div>
                     </div>
                  </div>
			   </div>
            </div>
            </div>
         </div>
      </div>
      <!-- news section end -->

<script src="https://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
<script>var $j = jQuery.noConflict(true);</script>
<script>
    $(document).ready(function(){
    console.log($j().jquery); // This prints v1.9.1
    });
</script>
<script>
function funloaddiv(funtype)
{
	if(funtype == "pin")
	{
		document.getElementById("searchbypin").style.display = "block";
	  	document.getElementById("searchbydistrict").style.display = "none";
	}
	if(funtype == "district")
	{
		document.getElementById("searchbypin").style.display = "none";
	  	document.getElementById("searchbydistrict").style.display = "block";
	}
	
}
</script>
<script>
function funsearchrecord(pincode,benid,searchtype)
{
	var cost = $('input[name="cost"]:checked').val();
	var age  = $('input[name="age"]:checked').val();
	var vaccinetype = $('input[name="vaccinetype"]:checked').val();
	var dose = $('input[name="dose"]:checked').val();
	var inprec=0;
	var inputrec = document.getElementsByName('dt[]');
		$("#tblsearch > tbody").html("");
		tblrow="";
			$j.ajax({
			url:'/load_appointment_search/'+pincode+'/'+benid+'/searchtype'+searchtype+'/'+cost+'/'+age+'/'+vaccinetype+'/'+dose,
			type:"GET",
			dataType:"json",
			success:function(data)
			{
				var balqty = 0;
				var arrvaccinecenter = [];
				var uniqueval = -1;
				for (var x = 0; x < data.vaccinestocksrec.length; x++)
				{
					inprec=0;
					if(jQuery.inArray(data.vaccinestocksrec[x].vaccinecenter_id, arrvaccinecenter) == -1)
					{
						uniqueval = "yes";
					}
					else
					{
						uniqueval = "no";
					}
					if(uniqueval == "yes")
					{
					tblrow = "<tr id='trow" + data.vaccinestocksrec[x].vaccinecenter_id + "' >";
					tblrow = tblrow  + "<td id='tcol" + data.vaccinestocksrec[x].vaccinecenter_id + "' style='font-size: 13px;width: 10%;'><input type='hidden' name='vaccinecenter_id[]' id='vaccinecenter_id' value='" +  data.vaccinestocksrec[x].vaccinecenter_id + "' >";
					tblrow = tblrow  +  data.vaccinestocksrec[x].cvcname + "<Br>";
					tblrow = tblrow  +  data.vaccinestocksrec[x].address;
					tblrow = tblrow  + " <br><a class='btn-warning' > &nbsp;" +  data.vaccinestocksrec[x].category + "&nbsp; </a>";
					}
					if(uniqueval == "yes")
					{
					tblrow = tblrow  + "</td>";
					}
//#############################################
if(uniqueval == "yes")
{
	for (var i = 0; i < inputrec.length; i++) {
		var a = inputrec[i];
		tblrow = tblrow  + "<td style='text-align: center;width: 10%;' id='c" + data.vaccinestocksrec[x].vaccinecenter_id + "d" + a.value.replaceAll("-", "") + "' ><input type='hidden' name='vc" + data.vaccinestocksrec[x].vaccinecenter_id + "d" + a.value.replaceAll("-", "") + "' id='vc" + data.vaccinestocksrec[x].vaccinecenter_id + "d" + a.value.replaceAll("-", "") + "' value='0' ><span class='btn badge badge-pill badge-secondary' style='margin-bottom: 5px;width: 100%;cursor: pointer;font-size: smaller;' >NA</span></td>";
	}
}
balqty = parseInt(data.vaccinestocksrec[x].qty) - parseInt(data.vaccinestocksrec[x].countbooking);
if(balqty == 0)
{
	if($('#vc'+ data.vaccinestocksrec[x].vaccinecenter_id + "d" + data.vaccinestocksrec[x].date.replaceAll("-", "")).val() == 0)
	{
		$("#c" + data.vaccinestocksrec[x].vaccinecenter_id + "d" + data.vaccinestocksrec[x].date.replaceAll("-", "")).html('<span class="btn badge badge-pill badge-danger" style="margin-bottom: 5px;width: 100%;cursor: pointer;font-size: smaller;" ><input type="hidden" name="vc' + data.vaccinestocksrec[x].vaccinecenter_id + 'd' + data.vaccinestocksrec[x].date.replaceAll("-", "") + '" id="vc' + data.vaccinestocksrec[x].vaccinecenter_id + "d" + data.vaccinestocksrec[x].date.replaceAll("-", "") + '" value="1" >Booked<br>' + data.vaccinestocksrec[x].vname + '</span>');
	}
	else
	{
		$("#c" + data.vaccinestocksrec[x].vaccinecenter_id + "d" + data.vaccinestocksrec[x].date.replaceAll("-", "") ).append('<span class="btn badge badge-pill badge-danger" style="margin-bottom: 5px;width: 100%;cursor: pointer;font-size: smaller;" >Booked<br>' + data.vaccinestocksrec[x].vname + '</span>');
	}
}
else
{
	if ($("#vc"+ data.vaccinestocksrec[x].vaccinecenter_id + "d" + data.vaccinestocksrec[x].date.replaceAll("-", "")).val() === undefined)
	{
    	inprec = 0;
	}
	else
	{

    	inprec = $("#vc"+ data.vaccinestocksrec[x].vaccinecenter_id + "d" + data.vaccinestocksrec[x].date.replaceAll("-", "")).val()
	}
	if(inprec == 0)
	{
		$("#c" + data.vaccinestocksrec[x].vaccinecenter_id + "d" + data.vaccinestocksrec[x].date.replaceAll("-", "") ).html('<span class="btn badge badge-pill badge-primary" style="margin-bottom: 5px;width: 100%;cursor: pointer;font-size: smaller;"  ><input type="hidden" name="vc' + data.vaccinestocksrec[x].vaccinecenter_id + 'd' + data.vaccinestocksrec[x].date.replaceAll("-", "") + '" id="vc' + data.vaccinestocksrec[x].vaccinecenter_id + "d" + data.vaccinestocksrec[x].date.replaceAll("-", "") + '" value="1" >' + '(' + data.vaccinestocksrec[x].sage +  "-" + data.vaccinestocksrec[x].eage +  'Yr)<br>'  + 'Dose ' + data.vaccinestocksrec[x].dose + '<br>' + balqty + '<br>' + data.vaccinestocksrec[x].vname + '</span>');
	}
	else
	{
		$("#c" + data.vaccinestocksrec[x].vaccinecenter_id + "d" + data.vaccinestocksrec[x].date.replaceAll("-", "") ).append('<span class="btn badge badge-pill badge-primary" style="margin-bottom: 5px;width: 100%;cursor: pointer;font-size: smaller;"  >' + '(' + data.vaccinestocksrec[x].sage +  "-" + data.vaccinestocksrec[x].eage +  'Yr)'  + '<br>Dose ' + data.vaccinestocksrec[x].dose + '<br>' + balqty + '<br>' + data.vaccinestocksrec[x].vname + '</span>');
	}
}
//#############################################
					if(uniqueval == "yes")
					{
					tblrow =tblrow  + "</tr>";
					}
					if(uniqueval == "yes")
					{
					$("#tblsearch > tbody").append(tblrow);
					}
					arrvaccinecenter.push(data.vaccinestocksrec[x].vaccinecenter_id);
				}
			}
		});
}
</script>
<script>
function changeVal(pincode,searchtype) {
	var inputrec = document.getElementsByName('dt[]');
	var benid = $('#benid').val();
	if(pincode.length == 6 && searchtype=="pincode")
	{
		funsearchrecord(pincode,benid,searchtype);
	}
	if(searchtype=="district")
	{
		funsearchrecord(pincode,benid,searchtype);
	}
}
</script>
<script>
function loadradio()
{
	if($('input[name="select"]:checked').val() == "pin")
	{
		changeVal($j('#pincode').val(),"pincode");
	}
	if($('input[name="select"]:checked').val() == "district")
	{
		changeVal($j('#district_id').val(),"district");
	}
}
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
<script type="text/javascript">
$j("document").ready(function(){
	$j('select[name="district_id"]').on('change',function(){
		changeVal($j('#district_id').val(),"district");
	});
});
</script>