<style>
    .header_section {
        display: none;
    }
</style>
    <link rel="stylesheet" type="text/css" href="frontend/css/viewgrid.css">
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>CoCARE</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="/frontend/css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="/frontend/css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="/frontend/css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="/frontend/images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="/frontend/css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/frontend/css/font-awesome.css">
      <!-- owl stylesheets --> 
      <link rel="stylesheet" href="/frontend/css/owl.carousel.min.css">
      <link rel="stylesheet" href="/frontend/css/owl.theme.default.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <link rel="icon" href="/frontend/images/inject.png">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <!-- ################################################################ -->
    <div class="container">
        <!-- ################################################################ -->
<div id="divprintarea">	   
	   <table class="table table-bordered" style="width: 100%">
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
	   <table class="table table-bordered" style="width: 100%">
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
	   <table class="table table-bordered" style="width: 100%">
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