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
          <div class="news_section" style="padding-bottom: 25px;border: thick solid rgb(10, 10, 10)" class="px-4">
             <div class="container">
                <div id="main_slider" class="carousel slide  px-4" data-ride="carousel">
                   <div class="carousel-inner">
                      <div class="carousel-item active">
                         <div class="news_section_2 layout_padding">
                            <div class="box_main" style="width: 100%;" id="divprintarea">
                                <br>
    <center><img src="frontend/images/minister.jpg" style="width: 250px;"></center>
        @if($data['rsvprocessrec'][0]['doseno'] == 1)
        <h2 class="design_text">Provisional Certificate for COVID-19 Vaccination - 1
            st Dose</h2>
            @else
            <h2 class="design_text">Final Certificate for COVID-19 Vaccination </h2>
            @endif
    <!-- ################################################################ -->
    <div class="container">
        <!-- ################################################################ -->
        <h3><b><u>Beneficiary Details</u></b></h3>
        <table style="width: 100%;" class="table table-bordered">
            <tr>
                <th style="width: 50%;">Beneficiary Name</th>
                <td style="width: 50%;">{{ $data['rsvprocessrec'][0]['name'] }}</td>
            </tr>
            <tr>
                <th>Age</th>
                <td>@php 
                $birthDate = $data['rsvprocessrec'][0]['dob'];
                $currentDate = date("Y-m-d");
                $age = date_diff(date_create($birthDate), date_create($currentDate));
                echo $age->format("%y");
                @endphp</td>
            </tr>
            <tr>
                <th>Gender</th>
                <td>{{ $data['rsvprocessrec'][0]['gender'] }}</td>
            </tr>
            <tr>
                <th>ID Verified</th>
                <td>{{ $data['rsvprocessrec'][0]['id_proof'] }} # 
                @if($data['rsvprocessrec'][0]['id_proof']=="PAN Card")
                   {{ "******" . substr($data['rsvprocessrec'][0]['id_number'], -4) }}
                @elseif($data['rsvprocessrec'][0]['id_proof']=="Aadhaar Card")
                   {{ "********" . substr($data['rsvprocessrec'][0]['id_number'], -4) }}
                @endif
                </td>
            </tr>
            <tr>
                <th>Beneficiary Reference ID </th>
                <td>{{ $data['rsvprocessrec'][0]['referenceid'] }}</td>
            </tr>
        </table>
<br>
        <h3><b><u>Vaccination Details</u></b></h3>
        <table style="width: 100%;" class="table table-bordered">
            <tr>
                <th style="width: 50%;">Vaccine Name</th>
                <td style="width: 50%;">{{ $data['rsvprocessrec'][0]['vname'] }}</td>
            </tr>
            <tr>
                <th>Date of 1st Dose</th>
                <td>{{ date("d M Y",strtotime($data['rsvprocessrec'][0]['vaccinedate'])) }}</td>
            </tr>
            <tr>
                <th>Next due date </th>
                <td>Between
                    @php
                        $todaysdate = date("Y-m-d");
                        $nextvaccinedate = date('Y-m-d', strtotime($data['rsvprocessrec'][0]['vaccinedate'] . "+ " . $data['rsvprocessrec'][0]['period'] . " days"));
                        //Number of days difference starts 
                        $datediff = strtotime($nextvaccinedate) - strtotime($todaysdate);
                        $tday = round($datediff / (60 * 60 * 24));
                        //Number of 
                        $daysleft = $tday;
                        echo date("d M Y",strtotime($nextvaccinedate));
                    @endphp
                    and
                    @php
                        $todaysdate = date("Y-m-d");
                        $nextvaccinedate = date('Y-m-d', strtotime($data['rsvprocessrec'][0]['vaccinedate'] . "+ " . $data['rsvprocessrec'][0]['period'] ."days+ " . $data['rsvprocessrec'][0]['seconddose'] . " days"));
                        //Number of days difference starts 
                        $datediff = strtotime($nextvaccinedate) - strtotime($todaysdate);
                        $tday = round($datediff / (60 * 60 * 24));
                        //Number of 
                        $daysleft = $tday;
                        echo date("d M Y",strtotime($nextvaccinedate));
                    @endphp
                </td>
            </tr>
            <tr>
                <th>Vaccinated by</th>
                <td>Dr. {{ $data['vaccinatorrec'][0]['name'] }}</td>
            </tr>
            <tr>
                <th>Vaccination at</th>
                <td>{{ $data['rsvprocessrec'][0]['cvcname'] }}, {{ $data['rsvprocessrec'][0]['address'] }},<br>{{ $data['districtrec'][0]['district'] }}, {{ $data['staterec'][0]['state'] }}</td>
            </tr>
        </table>
        <!-- ################################################################ -->
        
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
    
<script src="/frontend/js/jquery.min.js"></script>
<script src="/frontend/js/popper.min.js"></script>
<script src="/frontend/js/bootstrap.bundle.min.js"></script>
<script src="/frontend/js/jquery-3.0.0.min.js"></script>
<!--<script src="frontend/js/plugin.js"></script>-->
<!-- sidebar -->
<script src="/frontend/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="/frontend/js/custom.js"></script>
<!-- javascript -->
<script src="/frontend/js/owl.carousel.js"></script>
<script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>