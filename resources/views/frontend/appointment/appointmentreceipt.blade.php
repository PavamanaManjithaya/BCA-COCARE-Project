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
          <div class="news_section" style="padding-bottom: 25px;">
             <div class="container">
                <div id="main_slider" class="carousel slide" data-ride="carousel">
                   <div class="carousel-inner">
                      <div class="carousel-item active">
                         <div class="news_section_2 layout_padding">
                            <div class="box_main" style="width: 90%;">
                               <h2 class="design_text">Appointment Receipt</h2>
    <!-- ################################################################ -->
    <div class="container">
        <!-- ################################################################ -->
        <div class="alert alert-SUCCESS" >
            <b>Your Vaccination Appointment is confirmed.</b>
            <!-- <br>
            <label>Your appointment details have also been sent on your registered mobile number through an SMS.</label> -->
        </div>
       <br>
<div id="divprintarea">	   
	   <table class="table table-bordered">
                <tr style="background-color: ghostwhite;">
					<th colspan="6" style="text-align: center;">Appointment Details</th>
                </tr>
                <tr>
					<th style="background-color: ghostwhite;">Center</th>
					<td colspan="5">{{ $data['vaccinecenterrec'][0]->address }}</td>
                </tr>
                <tr>
					<th style="background-color: ghostwhite;">Date:</th>
                    <td>{{ date("d-m-Y",strtotime($data['vaccinecenterrec'][0]->scheduletime)) }}</td>
					<th style="background-color: ghostwhite;">Time:</th>
                    <td>{{ date("h:i A",strtotime($data['vaccinecenterrec'][0]->starttime)) }} - {{ date("h:i A",strtotime($data['vaccinecenterrec'][0]->endtime)) }}</td>
					<th style="background-color: ghostwhite;">Preferred Time Slot:</th>
                    <td>{{ date("h:i A",strtotime($data['vaccinecenterrec'][0]->scheduletime)) }}</td>
                </tr>
        </table>
	   <table class="table table-bordered">
                <tr style="background-color: ghostwhite;">
					<th colspan="6" style="text-align: center;">DETAILS OF INDIVIDUALS</th>
                </tr>
                <tr style="background-color: ghostwhite;">
                    <th>Reference ID</th>      
                    <th>Name</th>          
                    <th>Vaccine Name</th>      
                    <th>Dose Type</th>       
                    <th>Photo ID to Carry</th>      
                    <th>Secret Code</th>                     
                </tr>
                <tr>
                    <td>{{ $data['vaccinecenterrec'][0]->referenceid }}</td>
					<td>{{ $data['vaccinecenterrec'][0]->name }}</td>
					<td>{{ $data['vaccinecenterrec'][0]->vname }}</td>
					<td>
                        @if($data['vaccinecenterrec'][0]->dose  == 0)
                            First Dose
                        @else
                            Second Dose
                        @endif
                    </td>
                    <td>{{ $data['vaccinecenterrec'][0]->id_proof }}</td>     
                    <td>{{ $data['vaccinecenterrec'][0]->secretcode }}</td>               
                </tr>
        </table>
		<hr>
        <div class="wrapper table table-bordered">
	   <table class="table table-bordered">
                <tr style="background-color: ghostwhite;">
                    <th><center>Instructions</center></th>                      
                </tr>
        </table>
<div style="padding-left: 15px;padding-right: 15px;">
<b>Instructions</b><br>
1. Please carry the Photo ID card mentioned in your Appointment details for vaccination.<br>
2. If you have any commodities, please carry a medical certificate with you for the vaccination appointment.<br>
3. You can also call the COCARE helpline number 1075 for any additional details.
</div>
        </div>
</div>
        <!-- ################################################################ -->
        <hr>
        <div class="wrapper">
<center>
    <a href="{{route('bookappointmentpdf',[$data['id']])}}" name="btndownloadpdf" class="btn btn-primary" style="color: white;" target="_blank">Download PDF</a>
    <button type="button" name="submit" class="btn btn-info" onclick="printreceipt('divprintarea')">Click Here to Print</button> 
</center>
        </div><br>&nbsp;
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
	function printreceipt(printarea)
	{
		var printContents = "<CENTER><H2>COCARE</H2></CENTER><BR>" + document.getElementById(printarea).innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
	}
	</script>