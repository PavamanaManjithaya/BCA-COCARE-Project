@extends('admin.layouts.tables')
@section('title', 'Stock Report')
@section('viewpage')
<div class="row column1">
	@php
	$dt = date("Y-m-d");
        $dttim = date("Y-m-d 00:00:00");
        $stk_1 = App\Models\Stock::where('vaccinecenter_id',Auth::user()->vaccine_center_id)->where('vaccinetype_id',1)->where('date',$dt)->where('status','DistAdmin2Vcenter')->sum('qty');
		$stk_2 = App\Models\Stock::where('vaccinecenter_id',Auth::user()->vaccine_center_id)->where('vaccinetype_id',2)->where('date',$dt)->where('status','DistAdmin2Vcenter')->sum('qty');
        $stk_processed = App\Models\Vprocess::leftJoin('schedules','schedules.id','=','vprocesses.schedules_id')->where('vprocesses.vaccinecenter_id',Auth::user()->vaccine_center_id)->where('vprocesses.vaccinedate','>=',$dttim)->where('vprocesses.vaccinatorstatus','1')->count();
         $rem=($stk_2+$stk_1)-$stk_processed;		
		
	@endphp
	<div class="col-md-6 col-lg-3">
	   <div class="full counter_section margin_bottom_30">
		  <div class="couter_icon">
			 <div> 
				<i class="fa fa-briefcase red_color"></i>
			 </div>
		  </div>
		  <div class="counter_no">
			 <div>
				<p class="total_no">{{$stk_1 }}</p>
				<p class="head_couter">Covishield</p>
			 </div>
		  </div>
	   </div>
	</div>
	<div class="col-md-6 col-lg-3">
		<div class="full counter_section margin_bottom_30">
		   <div class="couter_icon">
			  <div> 
				 <i class="fa fa-briefcase purple_color"></i>
			  </div>
		   </div>
		   <div class="counter_no">
			  <div>
				 <p class="total_no">{{$stk_2 }}</p>
				 <p class="head_couter">Covaxin</p>
			  </div>
		   </div>
		</div>
	 </div>
	<div class="col-md-6 col-lg-3">
	   <div class="full counter_section margin_bottom_30">
		  <div class="couter_icon">
			 <div> 
				<i class="fa fa-square blue1_color"></i>
			 </div>
		  </div>
		  <div class="counter_no">
			 <div>
				<p class="total_no">{{$stk_processed}}</p>
				<p class="head_couter">Used Stocks</p>
			 </div>
		  </div>
	   </div>
	</div>
	<div class="col-md-6 col-lg-3">
	   <div class="full counter_section margin_bottom_30">
		  <div class="couter_icon">
			 <div> 
				<i class="fa fa-hourglass-3 green_color"></i>
			 </div>
		  </div>
		  <div class="counter_no">
			 <div>
				<p class="total_no">{{$rem}}</p>
				<p class="head_couter">Remaining Stock</p>
			 </div>
		  </div>
	   </div>
	</div>
	
 </div>
 
 <div class="">
	<form action="{{ route('stockwastageinsert') }}" method="POST">
		@csrf

	
		<input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
		<input type="hidden" name="vaccinecenter_id" id="vaccinecenter_id" value=" {{ Auth::user()->vaccine_center_id }} ">
		<input type="hidden" name="stock_id" id="stock_id" value="0">
		<input type="hidden" name="date" id="balqty" value="{{ $dt = date("Y-m-d")}}">;
		<input type="hidden" name="district_id" id="district_id" value="0">
		<input type="hidden" name="stock_id" id="stock_id" value="0">
		<input type="hidden" name="sage" id="sage" value="0">
		<input type="hidden" name="eage" id="eage" value="0">
		<input type="hidden" name="dose" id="dose" value="0">
		<input type="hidden" name="status" id="status" value="wastage">
		<div class="row">
			
		</div>
		
	<div class="row">
		<div class="col-lg-6">
			<div class="form-group"style="font-size: 25px;">
				<select name="vaccinetype_id" id="vaccinetype_id" class="form-control"style="font-size: 15px;" required>
					<option value="">Select Vaccine Type</option>
				@foreach(App\Models\Vaccinetype::where('status','Active')->get() as $state)
					<option value="{{$state->id}}">{{$state->vname}}</option>
				@endforeach
				</select>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group" style="font-size: 15px;">
				<input type="number" style="font-size: 15px;" name="qty" id="qty" class="form-control" placeholder="Enter Wastage stock" min="1" required>
			</div>
		</div>
		<div class="col-lg-3"></div>
		<div class="col-lg-12">
				<div class="form-group">
					<hr>
					<center><input type="submit" name="submit" id="submit" class="btn btn-info" ></center>
				</div>
		</div>
	</div>

</div>

@endsection