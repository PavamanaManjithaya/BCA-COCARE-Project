@include('frontend.layouts.header')
      <!-- banner section start -->
      <div class="banner_section layout_padding">
         <div class="container">
            <div id="my_slider" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="container">
                              <h1 class="banner_taital">@lang('messages.head1')</h1>
                              <p class="banner_text">@lang('messages.des1')</p>
                              <div class="more_bt"><a href="/login">@lang('messages.signin')</a></div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="banner_img"><img src="frontend/images/banner1-img.png"></div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="container">
                              <h1 class="banner_taital">@lang('messages.head2')</h1>
                              <p class="banner_text">@lang('messages.des2')</p>
                              <div class="more_bt"><a href="/login">@lang('messages.signin')</a></div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="banner_img"><img src="frontend/images/banner2-img.png"></div>
                        </div>
                     </div>
                  </div>
                  
               </div>
               <a class="carousel-control-prev" href="#my_slider" role="button" data-slide="prev">
               <i class="fa fa-angle-left"></i>
               </a>
               <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
               <i class="fa fa-angle-right"></i>
               </a>
            </div>
         </div>            
      </div>
      <!-- banner section end -->
      </div>
      <!-- header section end -->
      <!-- protect section start -->
      <div class="protect_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-sm-12">
                  <h1 class="protect_taital">How to Protect Yourself</h1>
                  <p class="protect_text">If COVID-19 is spreading in your community, stay safe by taking some simple precautions, such as physical distancing, wearing a mask, keeping rooms well ventilated, avoiding crowds, cleaning your hands, and coughing into a bent elbow or tissue. Check local advice where you live and work.</p>
               </div>
            </div>
            <div class="protect_section_2 layout_padding">
               <div class="row">
                  <div class="col-md-6">
                     <h1 class="hands_text"><a href="#">Wash your <br>hands frequently</a></h1>
                     <h1 class="hands_text_2"><a href="#">Maintain social <br>distancing</a></h1>
                     <h1 class="hands_text"><a href="#">Avoid touching eyes,<br>nose and mouth</a></h1>
                  </div>
                  <div class="col-md-6">
                     <div class="image_2"><img src="frontend/images/img-2.png"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- protect section end -->
      <!-- about section start -->
      <div class="about_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
                  <div class="about_img"><img src="frontend/images/img-1.png"></div>
               </div>
               <div class="col-md-6">
                  <h1 class="about_taital">Coronavirus what it is?</span></h1>
                  <p class="about_text">Coronaviruses (CoV) are a large family of viruses that cause illness ranging from the common cold to more severe diseases. A novel coronavirus (nCoV) is a new strain that has not been previously identified in humans.</p>
                 
               </div>
            </div>
         </div>
      </div>
      <!-- about section end -->
      <!-- doctor section start -->
      <div class="doctors_section layout_padding">
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="taital_main">
                     <div class="taital_left">
                        <div class="play_icon"><img src="frontend/images/play-icon.png"></div>
                     </div>
                     <div class="taital_right">
                        <h1 class="doctor_taital">What is vaccine...</h1>
                        <p class="doctor_text">We???re protected from infectious disease by our immune system, which destroys disease-causing germs ??? also known as pathogens ??? when they invade the body. If our immune system isn???t quick or strong enough to prevent pathogens taking hold, then we get ill. 

                           We use vaccines to stop this from happening. A vaccine provides a controlled exposure to a pathogen, training and strengthening the immune system so it can fight that disease quickly and effectively in future. By imitating an infection, the vaccine protects us against the real thing. </p>
                        <div class="readmore_bt"><a target="_blank" href="https://www.youtube.com/watch?v=EETuOY3JjfM">Read More</a></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- doctor section end -->
<!-- ############ Search Starts Here ############  -->
@include('frontend.appointment.searchvaccinecenter')
<!-- ############ Search Ends Here ############  -->      
      <!-- news section start
      <div class="news_section layout_padding">
         <div class="container">
            <div id="main_slider" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <h1 class="news_taital">Latest News</h1>
                     <p class="news_text">when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using</p>
                     <div class="news_section_2 layout_padding">
                        <div class="box_main">
                           <div class="image_1"><img src="frontend/images/news-img.png"></div>
                           <h2 class="design_text">Coronavirus is Very dangerous</h2>
                           <p class="lorem_text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look</p>
                           <div class="read_btn"><a href="#">Read More</a></div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item">
                    <h1 class="news_taital">Latest News</h1>
                     <p class="news_text">when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using</p>
                     <div class="news_section_2 layout_padding">
                        <div class="box_main">
                           <div class="image_1"><img src="frontend/images/news-img.png"></div>
                           <h2 class="design_text">Coronavirus is Very dangerous</h2>
                           <p class="lorem_text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look</p>
                           <div class="read_btn"><a href="#">Read More</a></div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item">
                    <h1 class="news_taital">Latest News</h1>
                     <p class="news_text">when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using</p>
                     <div class="news_section_2 layout_padding">
                        <div class="box_main">
                           <div class="image_1"><img src="frontend/images/news-img.png"></div>
                           <h2 class="design_text">Coronavirus is Very dangerous</h2>
                           <p class="lorem_text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look</p>
                           <div class="read_btn"><a href="#">Read More</a></div>
                        </div>
                     </div>      
                  </div>
               </div>
               <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
               <i class="fa fa-angle-left"></i>
               </a>
               <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
               <i class="fa fa-angle-right"></i>
               </a>
            </div>
            </div>
         </div>
      </div> -->
      <!-- news section end -->
      <!-- update section start 
      <div class="update_section">
         <div class="container">
            <h1 class="update_taital">Get Every Update.... </h1>
            <form action="/action_page.php">
               <div class="form-group">
                   <textarea class="update_mail" placeholder="Massage" rows="5" id="comment" name="Massage"></textarea>
               </div>
               <div class="subscribe_bt"><a href="#">Subscribe Now</a></div>
            </form>
         </div>
      </div>-->
      <!-- update section end -->
@include('frontend.layouts.footer')