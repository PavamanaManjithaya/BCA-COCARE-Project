      <!-- footer section start -->
      <div class="footer_section layout_padding">
          <div class="container">
              <div class="footer_section_2">
                  <div class="row">
                      <div class="col-lg-3 col-sm-6">
                          <h2 class="useful_text">Resources</h2>
                          <div class="footer_menu">
                              <ul>
                                  <li><a href="./howtogetvaccined">@lang('messages.how to get vaccinated')</a></li>
                                  <li><a href="./doanddonts">@lang('dosanddonts.Title')</a></li>
                                  <li><a href="./faqs">@lang('messages.faq')</a></li>
                              </ul>
                          </div>
                      </div>
                      <div class="col-lg-3 col-sm-6">
                          <h2 class="useful_text">Platforms</h2>
                          <!-- <div class="map_image"><img src="images/map-bg.png"></div> -->
                          <div class="footer_menu">
                              <ul>
                                  <li><a href="{{ route('deptlogin') }}">@lang('messages.dept login')</a></li>
                                  <li><a href="{{ route('vaccinatorlogin') }}">@lang('messages.vaccinator login')</a>
                                  </li>
                              </ul>
                          </div>
                      </div>
                      <div class="col-lg-3 col-sm-6">
                          <h2 class="useful_text">About</h2>
                          <p class="footer_text">@lang('messages.aboutdes')</p>
                      </div>
                      <div class="col-lg-3 col-sm-6">
                          <h2 class="useful_text">Contact Us</h2>
                          <div class="location_text">
                              <ul>
                                  <li>
                                      <a href="tel:0120 4473222"><i class="fa fa-phone" aria-hidden="true"></i>
                                          <span class="padding_15">@lang('messages.THelpline'): 0120 4473222</span></a>
                                  </li>
                                  <li>
                                      <a href="tel:+91 11 23978046"><i class="fa fa-phone" aria-hidden="true"></i>
                                          <span class="padding_15">@lang('messages.Helpline'): +91 11 23978046 (Toll Free - 1075
                                              )</span></a>
                                  </li>
                                  <li>
                                      <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>
                                          <span class="padding_15">cocare@gmail.com</span></a>
                                  </li>
                              </ul>
                          </div>
                      </div>

                  </div>
              </div>
          </div>
      </div>
      <!-- footer section end -->
      <!-- copyright section start -->
      <div class="copyright_section">
          <div class="container">
              <div class="row">
                  <div class="col-sm-12">
                      <p class="copyright_text">© {{ date('Y') }} All Rights Reserved.<a href="/"> CoCARE</a></p>
                  </div>
              </div>
          </div>
      </div>
      <!-- copyright section end -->
      <!-- Javascript files-->
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
      <script>
          $(document).ready(function() {
              $(".fancybox").fancybox({
                  openEffect: "none",
                  closeEffect: "none"
              });

              $(".zoom").hover(function() {

                  $(this).addClass('transition');
              }, function() {

                  $(this).removeClass('transition');
              });
          });
      </script>
      </body>

      </html>
