<style>
	.header_section {
		display: none;
	}
	</style>
	<link rel="stylesheet" type="text/css" href="frontend/css/viewgrid.css">
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
							<div class="box_main" style="width: 90%;">
							   <h2 class="design_text">Account Details</h2>
							   <center><b style="color: green;">Registered Email ID - {{ Auth::User()->email }}</b></center><br>
							   
	<!-- ################################################################ -->
	<div class="container">
	<div class="alert alert-warning" id="alertdiv" style="display: none;" >
	<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Beneficiary record deleted successfully...
	</div>
		<div class="row">
	@foreach($data['Beneficiariesrec'] as $Beneficiariesrec)
			<div class="col-md-12 col-sm-12" style="padding: 10px;" id="benrec{{ $Beneficiariesrec->id }}">
				<div class="product-grid" >
					<div class="product-image">
						@if($Beneficiariesrec->dose == 0)
						<span class="product-new-label">Not Vaccinated</span>
						@elseif($Beneficiariesrec->dose == 1)
						<span class="product-new-label">Partially Vaccinated</span>
						@elseif($Beneficiariesrec->dose == 2)
						<span class="product-new-label" style="background-color: green;">Vaccinated</span>
						@endif
						@if($Beneficiariesrec->dose == 0)
						<button class="product-discount-label" style="cursor: pointer;" onclick="fun_del_rec({{ $Beneficiariesrec->id }})" >DELETE</button>
						@elseif($Beneficiariesrec->dose == 1)
	@php
	$schedulerec = App\Models\Schedule::leftjoin('vaccinetypes','vaccinetypes.id','=','schedules.vaccinetype_id')->leftjoin('vprocesses','vprocesses.schedules_id','=','schedules.id')->where('schedules.beneficiaries_id',$Beneficiariesrec->id)->where('doseno',1)->where('schedules.status','Active')->get();
	if(count($schedulerec) >= 1)
	{
		$todaysdate = date("Y-m-d");
		$nextvaccinedate = date('Y-m-d', strtotime($schedulerec[0]->vaccinedate. "+ " . $schedulerec[0]->period . " days"));
		$lastvaccinedate = date('Y-m-d', strtotime($schedulerec[0]->vaccinedate. "+ " . $schedulerec[0]->period . " days". "+ ".$schedulerec[0]->seconddose ));

		//Number of days difference starts 
		$datediff = strtotime($nextvaccinedate) - strtotime($todaysdate);
		$tday = round($datediff / (60 * 60 * 24));
		//Number of 
		$daysleft = $tday;
	}
	else
	{
		$daysleft = 0;
	}
	@endphp
	@if($daysleft > 0)
	<span class="product-discount-label">{{$daysleft}} days Left for Dose 2</span>
	@elseif($daysleft == 0)
	<span class="product-discount-label" style="background-color: #f10000;"> Due Date for Dose 2</span>
	@elseif($todaysdate>$lastvaccinedate)
	<span class="product-discount-label" style="background-color: #f10000;">Due Date Expired</span>
	@endif
						@endif
					</div>
					<br>
					<br>
					<div class="row">
						<div class="col-md-4" style="padding-left: 25px;">
							<h2>{{ ucfirst($Beneficiariesrec->name) }}</h2>
						</div>
						<div class="col-md-4">
							<label>REF ID: {{ $Beneficiariesrec->referenceid }}</label>
							</div>
						<div class="col-md-4">
							<label>Secret Code: <b style='color: red;'> {{ substr(crc32($Beneficiariesrec->referenceid), -4) }}</b></label>
						</div>
						<div class="col-md-4" style="padding-left: 25px;">
							<label>Year of Birth: {{ date("Y",strtotime($Beneficiariesrec->dob)) }}</label>
						</div>
						<div class="col-md-4">
							<label>Photo ID: {{ $Beneficiariesrec->id_proof }}</label>
						</div>
						<div class="col-md-4">
							<label>ID Number:
								@if($Beneficiariesrec->id_proof=="PAN Card")
									 {{ "******" . substr($Beneficiariesrec->id_number, -4) }}
								@elseif($Beneficiariesrec->id_proof=="Aadhaar Card")
									{{ "********" . substr($Beneficiariesrec->id_number, -4) }}
								@endif
								</label>
						</div>
					</div>
					<div class="row">
	@if($Beneficiariesrec->dose == 0)
			@php
			$arrrec = App\Models\Schedule::select('schedules.*','vaccinecenters.cvcname','vaccinecenters.address','states.state','districts.district')->leftjoin('vaccinecenters','vaccinecenters.id','=','schedules.vaccinecenter_id')
			->leftjoin('states','states.id','=','vaccinecenters.state_id')
			->leftjoin('districts','districts.id','=','vaccinecenters.district_id')
			->where('schedules.beneficiaries_id',$Beneficiariesrec->id)->where('schedules.status','Active')->where('schedules.doseno',1)->get();
			@endphp
			@if(count($arrrec) == 0)
				<div class="col-md-12"><hr></div>
				<div class="col-md-9">
					<b style="color: red;"><i class="fa fa fa fa-medkit fa-2x fa-pull-left fa-border" aria-hidden="true"></i> Dose 1</b> <br>
					<label style="color: red;">Appointment not scheduled</label>
				</div>
				<div class="col-md-3" style="text-align: right;padding-right: 25px;" >
					<a href="{{route('searchvcenter',[$Beneficiariesrec->id,0])}}" class="btn btn-warning"> <i class="fa fa-calendar" aria-hidden="true"></i> Schedule</a> 
				</div>
			@elseif(count($arrrec) == 1)
				@foreach($arrrec as $recx)
                @php
                $dateTimestamp1 = strtotime(date("Y-m-d",strtotime($recx->scheduletime))); 
                $dateTimestamp2 = strtotime(date("Y-m-d"));
                @endphp
                    @if($dateTimestamp1 >= $dateTimestamp2)				
                        <!-- ################################################## -->
                        <div class="col-md-12"><hr></div>
                        <div class="col-md-6">
                            <b style="color: rgb(10, 10, 134);"><i class="fa fa fa fa-medkit fa-2x fa-pull-left fa-border" aria-hidden="true"></i> Dose 1  </b> | Scheduled on {{ date("d-M-Y h:i A",strtotime($recx->scheduletime)) }}<br>
                            <label style="color: blue;">{{ $recx->address }}, {{ $recx->district }}, {{ $recx->state }} </label>
                        </div>
                        <div class="col-md-6" style="text-align: right;padding-right: 25px;" >
                            <a href="{{route('searchvcenter',[$Beneficiariesrec->id,$recx->id])}}" class="btn btn-primary"> <i class="fa fa-calendar" aria-hidden="true"></i> Reschedule</a> 
                            <a href="{{route('appointmentreceipt',[$recx->id])}}" target="_blank" class="btn btn-info"> <i class="fa fa-print" aria-hidden="true"></i> Appointment Slip</a> 
                        </div>
                        <!-- ################################################## -->
                    @else
                        <!-- ################################################## -->
                        <div class="col-md-12"><hr></div>
                        <div class="col-md-9">
                            <b style="color: red;"><i class="fa fa fa fa-medkit fa-2x fa-pull-left fa-border" aria-hidden="true"></i> Dose 1</b> <br>
                            <label style="color: red;">Appointment not scheduled</label>
                        </div>
                        <div class="col-md-3" style="text-align: right;padding-right: 25px;" >
                            <a href="{{route('searchvcenter',[$Beneficiariesrec->id,0])}}" class="btn btn-warning"> <i class="fa fa-calendar" aria-hidden="true"></i> Schedule</a> 
                        </div>
                        <!-- ################################################## -->
                    @endif
				@endforeach
			@endif
	@elseif($Beneficiariesrec->dose == 1)
			<div class="col-md-12"><hr></div>
			<div class="col-md-9">
				<b style="color: green;"><i class="fa fa fa fa-thumbs-up fa-2x fa-pull-left fa-border" aria-hidden="true"></i> Dose 1</b> |
				<b>{{ $schedulerec[0]->vname }}</b><br>
				<label style="color: green;">First Vaccine on {{ date("d-m-Y",strtotime($schedulerec[0]->vaccinedate)) }}</label>
			</div>
			<div class="col-md-3" style="text-align: right;padding-right: 25px;">
				@php
					$rsprocessrec = App\Models\Vprocess::select('vprocesses.id')->leftjoin('schedules','schedules.id','=','vprocesses.schedules_id')->where('schedules.beneficiaries_id',$Beneficiariesrec->id)->where('schedules.doseno',1)->where('schedules.status','Active')->where('vprocesses.vaccinatorstatus',1)->get();
				@endphp
				<a class="btn btn-success" target="_blank" style="color: white;" href="{{route('cocarecertificate',$rsprocessrec[0]['id'])}}"> <i class="fa fa-address-card-o" aria-hidden="true"></i> Certificate</a>
			</div>
	@endif
	@if($Beneficiariesrec->dose == 1 && $daysleft<=0)
		@php
		$arrrec = App\Models\Schedule::select('schedules.*','vaccinecenters.cvcname','vaccinecenters.address','states.state','districts.district')->leftjoin('vaccinecenters','vaccinecenters.id','=','schedules.vaccinecenter_id')
		->leftjoin('states','states.id','=','vaccinecenters.state_id')
		->leftjoin('districts','districts.id','=','vaccinecenters.district_id')
		->where('schedules.beneficiaries_id',$Beneficiariesrec->id)->where('schedules.status','Active')->where('schedules.doseno',2)->get();
		@endphp
		@if(count($arrrec) == 0)
			<div class="col-md-12">
				<hr>
			</div>
			@if (date('Y-m-d', strtotime($nextvaccinedate. "+ " . $schedulerec[0]->seconddose . " days"))>=$todaysdate)

			<div class="col-md-9">
				<b style="color: red;"><i class="fa fa fa-thumbs-down fa-2x fa-pull-left fa-border" aria-hidden="true"></i> Dose 2</b>  |<br>		
				
				<label style="color: red;" >Due date {{ date("d-m-Y",strtotime($nextvaccinedate)) }}, Last date  {{ date('d-m-Y', strtotime($nextvaccinedate. "+ " . $schedulerec[0]->seconddose . " days")); }}</label>
			</div>
			<div class="col-md-3" style="text-align: right;padding-right: 25px;">
				<a href="{{route('searchvcenter',[$Beneficiariesrec->id,0])}}" class="btn btn-warning"> <i class="fa fa-calendar" aria-hidden="true"></i> Schedule</a>
			</div>
			@else
			<div class="col-md-9">
				<b style="color: red;"><i class="fa fa fa-thumbs-down fa-2x fa-pull-left fa-border" aria-hidden="true"></i> Dose 2</b>  |<br>		
				
				<label style="color: red;" >Please contact near Vaccice center</label>
			</div>
			<div class="col-md-3" style="text-align: right;padding-right: 25px;">
				<a href="{{route('searchvcenter',[$Beneficiariesrec->id,0])}}" class="btn btn-warning disabled"> <i class="fa fa-calendar" aria-hidden="true"></i> Schedule</a>
			</div>
			@endif
		@elseif(count($arrrec) == 1)
			@foreach($arrrec as $recx)
			@php
			$dateTimestamp1 = strtotime(date("Y-m-d",strtotime($recx->scheduletime))); 
			$dateTimestamp2 = strtotime(date("Y-m-d"));
			@endphp
			@if($dateTimestamp1 >= $dateTimestamp2)				
				<!-- ################################################## -->
				<div class="col-md-12"><hr></div>
				<div class="col-md-6">
					<b style="color: rgb(10, 10, 134);"><i class="fa fa fa fa-medkit fa-2x fa-pull-left fa-border" aria-hidden="true"></i> Dose 2  </b> | Scheduled on {{ date("d-M-Y h:i A",strtotime($recx->scheduletime)) }}<br>
					<label style="color: blue;">{{ $recx->address }}, {{ $recx->district }}, {{ $recx->state }} </label>
				</div>
				<div class="col-md-6" style="text-align: right;padding-right: 25px;" >
					<a href="{{route('searchvcenter',[$Beneficiariesrec->id,$recx->id])}}" class="btn btn-primary"> <i class="fa fa-calendar" aria-hidden="true"></i> Reschedule</a> 
					<a href="{{route('appointmentreceipt',[$recx->id])}}" target="_blank" class="btn btn-info"> <i class="fa fa-print" aria-hidden="true"></i> Appointment Slip</a> 
				</div>
				<!-- ################################################## -->
			@else
				<!-- ################################################## -->
				<div class="col-md-12">
					<hr>
				</div>
				
				@if (date('Y-m-d', strtotime($nextvaccinedate. "+ " . $schedulerec[0]->seconddose . " days"))>=$todaysdate)

				<div class="col-md-9">
					<b style="color: red;"><i class="fa fa fa-thumbs-down fa-2x fa-pull-left fa-border" aria-hidden="true"></i> Dose 2</b>  |<br>
					<label style="color: red;" >Due date {{ date("d-m-Y",strtotime($nextvaccinedate)) }}, Last date  {{ date('d-m-Y', strtotime($nextvaccinedate. "+ " . $schedulerec[0]->seconddose . " days")); }}</label>
				</div>
				<div class="col-md-3" style="text-align: right;padding-right: 25px;">
					<a href="{{route('searchvcenter',[$Beneficiariesrec->id,0])}}" class="btn btn-warning"> <i class="fa fa-calendar" aria-hidden="true"></i> Schedule</a>
				</div>
				@else
				<div class="col-md-9">
					<b style="color: red;"><i class="fa fa fa-thumbs-down fa-2x fa-pull-left fa-border" aria-hidden="true"></i> Dose 2</b>  |<br>		
					
					<label style="color: red;" >Please contact near Vaccice center</label>
				</div>
				<div class="col-md-3" style="text-align: right;padding-right: 25px;">
					<a href="{{route('searchvcenter',[$Beneficiariesrec->id,0])}}" class="btn btn-warning disabled"> <i class="fa fa-calendar" aria-hidden="true"></i> Schedule</a>
				</div>
				@endif
				<!-- ################################################## -->
			@endif
			@endforeach
		@endif
	@endif
	<!--  ############################################# -->
	@if($Beneficiariesrec->dose == 2)
		@php
		$certrec = App\Models\Schedule::leftjoin('vaccinetypes','vaccinetypes.id','=','schedules.vaccinetype_id')->leftjoin('vaccinecenters','vaccinecenters.id','=','schedules.vaccinecenter_id')->leftjoin('vprocesses','vprocesses.schedules_id','=','schedules.id')
		->leftjoin('states','states.id','=','vaccinecenters.state_id')
		->leftjoin('districts','districts.id','=','vaccinecenters.district_id')->where('schedules.beneficiaries_id',$Beneficiariesrec->id)->where('schedules.status','Active')->get();
		$dose=1;
		@endphp
			@foreach($certrec as $recx)
			<div class="col-md-12"><hr></div>
			<div class="col-md-9">
				<b style="color: green;"><i class="fa fa fa fa-thumbs-up fa-2x fa-pull-left fa-border" aria-hidden="true"></i> Dose {{$dose}} </b> | {{$recx['vname']}}
				<b></b><br>
				<label style="color: green;"> {{ $recx->address }}, {{ $recx->district }}, {{ $recx->state }} on {{ date("d-m-Y",strtotime($recx['vaccinedate'])) }}</label>
			</div>
			<div class="col-md-3" style="text-align: right;padding-right: 25px;">
			@php
				$rsprocessrec = App\Models\Vprocess::select('vprocesses.id')->leftjoin('schedules','schedules.id','=','vprocesses.schedules_id')->where('schedules.beneficiaries_id',$Beneficiariesrec->id)->where('schedules.doseno',2)->where('schedules.status','Active')->where('vprocesses.vaccinatorstatus',1)->get();
			@endphp
				@if($dose == 2)
				<a class="btn btn-success" target="_blank" style="color: white;" href="{{route('cocarecertificate',$rsprocessrec[0]['id'])}}"> <i class="fa fa-address-card-o" aria-hidden="true"></i> Certificate</a>
				@endif
			</div>
			@php $dose++ @endphp
			@endforeach
	@endif
	<!--  ############################################# -->
					</div>
				</div>
			</div>
	@endforeach
	   </div>
	<hr>
	@if($data['BeneficiariesCount'] >= 4)
	<div class="alert alert-danger" id="alertdiv">Limit exceeded. You can add maximum 4 beneficiaries..</div>
	<center><a href="#" class="btn btn-secondary" disabled style="cursor: not-allowed;" > <i class="fa fa-plus-square" ></i>	Add Member</a></center>
	@else
	<center><a href="beneficiarycreate" class="btn btn-info" > <i class="fa fa-plus-square" ></i>	Add Member</a></center>
	@endif
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
	@include('frontend.layouts.footer')
	<script>
	function fun_del_rec(beneficiariesid)
	{
		if(confirm("Are you sure want to delete this beneficiary record?") == true)
		{
			$.ajax({
				url:'/del_ben_rec/'+beneficiariesid,
				type:"GET",
				dataType:"json",
				success:function(data){
					$('#benrec'+beneficiariesid).remove();
					$('#alertdiv').show();
					$('#alertdiv').delay(5000).fadeOut();
				}
			});
		}
	}
	</script>