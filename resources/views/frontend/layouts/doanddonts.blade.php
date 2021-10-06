@include('frontend.layouts.header')
      <!-- banner section start -->
      <div class="banner_section layout_padding">
         <div class="container">
            <div id="my_slider" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="container">
                              <h1 class="banner_taital">@lang('dosanddonts.Title')</h1>
                              <p class="banner_text">@lang('dosanddonts.quote')</p>
                           </div>
                        </div>
                     </div>
                  </div>

			   </div>
            </div>
         </div>            
      </div>
      <!-- banner section end -->
      </div>
      <!-- header section end -->

      <!-- about section start -->
      <div class="about_section layout_padding">
         <div class="container">
            <div class="row">
              
               <div class="col-md-6">
                  <h1 class="about_taital">@lang('dosanddonts.dos')</span></h1>
                  <ul class="about_text" style="list-style: inherit">
                 <li>@lang('dosanddonts.dos1')</li>
                 <li>@lang('dosanddonts.dos2')</li>
                 <li>@lang('dosanddonts.dos3')</li>
                 <li>@lang('dosanddonts.dos4')</li>
                 <li>@lang('dosanddonts.dos5')</li>
                 <li>@lang('dosanddonts.dos6')</li>
                 <li>@lang('dosanddonts.dos7')</li>
                 <li>@lang('dosanddonts.dos8')</li>
                 <li>@lang('dosanddonts.dos9')</li>
                 <li>@lang('dosanddonts.dos10')</li>
                 <li>@lang('dosanddonts.dos11')</li>
                 <li>@lang('dosanddonts.dos12')</li>
                  </ul>
                  
               </div>
               <div class="col-md-6">
                  <h1 class="about_taital">@lang('dosanddonts.donts')</span></h1>
                  <ul class="about_text" style="list-style: inherit">
                     <li>@lang('dosanddonts.donts1')</li>
                     <li>@lang('dosanddonts.donts2')</li>
                     <li>@lang('dosanddonts.donts3')</li>
                     <li>@lang('dosanddonts.donts4')</li>
                     <li>@lang('dosanddonts.donts5')</li>
                     <li>@lang('dosanddonts.donts6')</li>
                  </ul>
                  <div class="about_img"><img src="frontend/images/registration.jpg" width="400" height="400"></div>

               </div>
            </div>
         </div>
      </div>
      <!-- about section end -->


@include('frontend.layouts.footer')