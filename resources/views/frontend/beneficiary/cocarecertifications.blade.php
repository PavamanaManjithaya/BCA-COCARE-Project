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
                            <div class="box_main" style="width: 90%;" id="divprintarea">
                                <br>
    <center><img src="{{ asset('frontend/images/ministry-of-health.webp')}}" style="width: 250px;"></center>
    @if($data['rsvprocessrec'][0]['doseno'] == 1)
    <h2 class="design_text">Provisional Certificate for COVID-19 Vaccination - 1
        st Dose</h2>
        @else
        <h2 class="design_text">Final Certificate for COVID-19 Vaccination </h2>
        @endif
        <br>
    <!-- ################################################################ -->
    <div class="container">
        <!-- ################################################################ -->
        <h3><b><u>Beneficiary Details</u></b></h3>
        <table style="width: 100%;" class="table table-bordered">
            <tr>
                <th style="width: 50%;">Beneficiary Name / ಫಲಾನುಭವಿ ಹೆಸರು</th>
                <td style="width: 50%;">{{ $data['rsvprocessrec'][0]['name'] }}</td>
            </tr>
            <tr>
                <th>Age / ವಯಸ್ಸು</th>
                <td>@php 
                $birthDate = $data['rsvprocessrec'][0]['dob'];
                $currentDate = date("Y-m-d");
                $age = date_diff(date_create($birthDate), date_create($currentDate));
                echo $age->format("%y");
                @endphp</td>
            </tr>
            <tr>
                <th>Gender / ಲಿಂಗ</th>
                <td>{{ $data['rsvprocessrec'][0]['gender'] }}</td>
            </tr>
            <tr>
                <th>ID Verified  / ಐ.ಡಿ. ಗುರುತು</th>
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
                <th style="width: 50%;">Vaccine Name  / ಲಸಿಕೆಯ ಹೆಸರು</th>
                <td style="width: 50%;">{{ $data['rsvprocessrec'][0]['vname'] }}</td>
            </tr>
@if($data['rsvprocessrec'][0]['doseno'] == 1)
            <tr>
                <th>Date of 1st Dose / ಮೊದಲ ಡೋಸ್ ದಿನಾಂಕ</th>
                <td>{{ date("d M Y",strtotime($data['rsvprocessrec'][0]['vaccinedate'])) }}</td>
            </tr>
            <tr>
                <th>Next due date / ಮುಂದಿನ ಲಸಿಕೆ ನೀಡುವ ದಿನಾಂಕ</th>
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
                         //echo $data['rsvprocessrec'][0]->seconddose;
                      // echo date("d M Y",strtotime($nextvaccinedate. "+ " .$data['rsvprocessrec'][0]->seconddose));
                    @endphp
                    {{date("d M Y",strtotime($nextvaccinedate))}}
                </td>
            </tr>

@elseif($data['rsvprocessrec'][0]['doseno'] == 2)
<tr>
    <th>Date of Dose / ಡೋಸ್ ದಿನಾಂಕ</th>
    <td>{{ date("d M Y",strtotime($data['rsvprocessrec'][0]['vaccinedate'])) }}</td>
</tr>
@endif
            <tr>
                <th>Vaccinated by  / ಲಸಿಕೆ ನೀಡಿದವರು</th>
                <td>Dr. {{ $data['vaccinatorrec'][0]['name'] }}</td>
            </tr>
            <tr>
                <th>Vaccination at /  ಲಸಿಕೆ ಹಾಕಿದ ಸ್ಥಳ</th>
                <td>{{ $data['rsvprocessrec'][0]['cvcname'] }}, {{ $data['rsvprocessrec'][0]['address'] }},<br>{{ $data['districtrec'][0]['district'] }}, {{ $data['staterec'][0]['state'] }}</td>
            </tr>
        </table>
        <!-- ################################################################ -->
        <br><br>
    </div>
    <!-- ################################################################ -->
   
                          </div>
<center><a href="{{route('cocarecertificatepdf',[$data['id']])}}" name="btndownloadpdf" class="btn btn-primary" style="color: white;" target="_blank">Download PDF</a>
<button type="button" name="submit" class="btn btn-info" onclick="printreceipt('divprintarea')">Click Here to Print</button>
</center>
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
    function printreceipt(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
}
	</script>