@include('frontend.layouts.header')
      </div>
      <!-- header section end -->
<style>
   .header_section {
    width: 100%;
    float: left;
    background-image: url(../images/banner-bg.png);
    height: auto;
    height: auto;
    padding: 0px 0px;
    background-size: 100%;
}
.layout_padding {
    padding-top: 25px;
    padding-bottom: 0px;
}
</style>
      <!-- news section start -->
      <div class="news_section layout_padding">
         <div class="container">
            <div id="main_slider" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                      <div class="news_section_2 layout_padding">
                        <div class="box_main">
                           <div class="image_1"><img src="{{ asset('frontend/images/cocare.png') }}"></div>
                           <h2 class="design_text">Welcome</h2>
                          <center><b>You can register 4 members with one mobile number</b></centeR>
                           
                           <div class="read_btn"><a href="/beneficiarycreate">Register Member</a></div>
                           <br><hr>
                           <p class="lorem_text" style="text-align: left;">
                              Note 
                              One registration per person is sufficient. Please do not register with multiple mobile numbers or different Photo ID Proofs for same individual.
                              <br><br>Scheduling of Second dose should be done from the same account (same mobile number) from which the first dose has been taken, for generation of final certificate. Separate registration for second dose is not necessary.
                              <br><br>Please carry the registered mobile phone and the requisite documents, including appointment slip, the Photo ID card used for registration, Employment Certificate (HCW/FLW) etc., while visiting the vaccination center, for verification at the time of vaccination.
                              <br><br>Please check for additional eligibility conditions, if any, prescribed by the respective State/UT Government for vaccination at Government Vaccination Centers, for 18-44 age group, and carry the other prescribed documents (e.g. Comorbidity Certificate etc.) as suggested by respective State/UT (on their website).
                              <br><br>The slots availability is displayed in the search (on district, pincode or map) based on the schedule populated by the DIOs (for Government Vaccination Centers) and private hospitals for their vaccination centers.
                              <br><br>The vaccination schedule published by DIOs and private hospitals displays the list of vaccination centers with the following information
                             <br> &nbsp;&nbsp;1. The vaccine type.<br>
                              &nbsp;&nbsp; 2. The age group (18-44/45+ etc.).<br>
                              &nbsp;&nbsp;3. The number of slots available for dose 1 and dose 2.<br>
                              &nbsp;&nbsp;4. Whether the service is Free or Paid (Vaccination is free of cost at all the Government Vaccination Centers).<br>
                              &nbsp;&nbsp;5. Per dose price charged by a private hospital.
                              <br><br>If you are seeking 1st dose vaccination, the system will show you only the available slots for dose 1. Similarly, if you are due for 2nd dose, the system will show you the available slots for dose 2 after the minimum period from the date of 1st dose vaccination has elapsed.
                              <br><br>Once a session has been published by the DIO/ private hospital, the session now can not be cancelled. However, the session may be rescheduled. In case you have booked an appointment in any such vaccination session that is rescheduled for any reason, your appointment will also be automatically rescheduled accordingly. You will receive a confirmation SMS in this regard. On such rescheduling, you would still have the option of cancelling or further rescheduling such appointment.
                              <br><br> When deleting any member from your account, please note they will lose access to their online vaccination certificate.
                           </p>
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