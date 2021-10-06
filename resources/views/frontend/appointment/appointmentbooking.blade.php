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
<form method="post" action="{{ route('insertschedule') }}" onsubmit="return validateform()">
@csrf
<input type="hidden" name="beneficiaries_id" id="beneficiaries_id" value="{{ $data['beneficiaries'][0]->id }}" >
<input type="hidden" name="bookingdate" id="bookingdate" value="{{ date('Y-m-d') }}" >
<input type="hidden" name="scheduledate" id="scheduledate" value="{{ $data['appdate'] }}" >
<input type="hidden" name="vaccinecenter_id" id="vaccinecenter_id" value="{{ $data['vaccinecenter_id'] }}" >
<input type="hidden" name="vaccinetype_id" id="vaccinetype_id" value="{{ $data['vaccinetypes']->id }}" >
<input type="hidden" name="secretcode" id="secretcode" value="{{ substr(crc32($data['beneficiaries'][0]->referenceid), -4) }}" >
<input type="hidden" name="status" id="status" value="Active" >
<input type="hidden" name="doseno" id="doseno" value="{{ $data['beneficiaries'][0]->dose + 1 }}" >
<input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}" >
<input type="hidden" name="scheduleid" id="scheduleid" value="{{ $data['scheduleid'] }}" >
    <div class="box_main" style="width: 90%;">
     <h2 class="design_text">Appointment Confirmation</h2>    
    <!-- ################################################################ -->
        <div class="container">
        <!-- ################################################################ -->
        <table class="table table-bordered">
                <tr>
                    <th style="width: 25%;">Vaccination Center: </th>
                    <td>{{ $data['vaccinecenterrec'][0]->cvcname }}</td>
                </tr>
                <tr>
                    <th>Address:</th>
                    <td>{{ $data['vaccinecenterrec'][0]->address }}<br>
                        {{ $data['vaccinecenterrec'][0]->district }}<br>
                        {{ $data['vaccinecenterrec'][0]->state }}
                    </td>
                </tr>
                <tr>
                    <th>Vaccine Name</th>
                    <td>{{ $data['vaccinetypes']->vname }}</td>
                </tr>
                <tr>
                    <th>Vaccine Price</th>
                    <td>
                    @if($data['vaccinecenterrec'][0]->category == "Paid")
                        ₹  {{ $data['vaccinetypes']->cost }}
                    @elseif($data['vaccinecenterrec'][0]->category == "Unpaid")
                        Free
                    @endif
                    </td>
                </tr>
                <tr>
                    <th>Appointment Date</th>
                    <td>{{ date("d-m-Y",strtotime($data['appdate'])) }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $data['beneficiaries'][0]->name }}</td>
                </tr>
        </table>
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
        </style>
            <b>Select Time Slot </b> <span class="errmsg" id="id_scheduletime"></span>
        <div class="wrapper" style="height: auto;">
            @php
                $scheduleddt = $data['appdate'];
                $sthr =  date("Y-m-d H:i:s",strtotime($scheduleddt . " " . $data['vaccinecenterrec'][0]->starttime));
                $endhr =  date("Y-m-d H:i:s",strtotime($scheduleddt . " " . $data['vaccinecenterrec'][0]->endtime));
                $time1 = strtotime($sthr);
                $time2 = strtotime($endhr);
                $difference = round(abs($time2 - $time1) / 3600,2);
                //echo $difference;
                $totalslots = $difference+1;
                $appoint_per_slot = $data['stockcounter'][0]['qty'] / $totalslots;
               $chkremainder = $data['stockcounter'][0]['qty'] % $totalslots;
               if($chkremainder > 0) {
                    $appoint_per_slot = intval($appoint_per_slot) + 1;
               }
               else {
                    $appoint_per_slot = intval($appoint_per_slot);
               }
            @endphp
            <div class="row">
                @for($it=0;$it<=$difference;$it = $it+2)
                    @php $stmy_date_time = date("H:00:00", strtotime("+$it hours",strtotime($sthr) )) @endphp
                    @php $my_date_time = date("h:00 A", strtotime("+$it hours",strtotime($sthr) )) @endphp
@php
$scheduletime = $data['appdate'] . " " . $stmy_date_time;
$doseno = $data['beneficiaries'][0]->dose + 1;
$countschedules = App\Models\Schedule::where('scheduletime',$scheduletime)->where('vaccinetype_id',$data['vaccinetype_id'])->where('doseno',$doseno)->where('schedules.status','Active')->where('vaccinecenter_id',$data['vaccinecenter_id'])->count();
//echo $countschedules;
//echo $appoint_per_slot;
@endphp
@if($appoint_per_slot > $countschedules)
<div class="col-md-2 option" style="padding: 10px;"  >
    <input type="radio" name="scheduletime" id="scheduletime"  value="{{ $stmy_date_time }}" style="width: 20px;height: 20px;">
    <label style="margin-bottom: .1rem;cursor: pointer;" for="selected{{ $my_date_time }}">{{ $my_date_time }}</label>
</div>
@else
<div  class="col-md-2 option" style="padding: 10px;text-decoration: line-through;color: red;"  >
    <input type="radio" name="scheduletime" id="scheduletime" disabled value="{{ $stmy_date_time }}" style="width: 20px;height: 20px;">
    <label style="margin-bottom: .1rem;cursor: pointer;" for="selected{{ $my_date_time }}">{{ $my_date_time }}</label>
</div>
@endif
                @endfor
            </div>
        </div>
        <!-- ################################################################ -->
        <hr>
        <div class="wrapper">
<center><button type="submit" name="submit" class="btn btn-info">Click Here to Confirm</button></center>
        </div><br>&nbsp;
    </div>
</form>   
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
function validateform()
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
	if (!$("input[name='scheduletime']:checked").val()) 
    {
        $("#id_scheduletime").html("Kindly Schedule your Vaccine Time Slot....");
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