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
                                <h1 class="banner_taital">@lang('faq.TITLE')</h1>
                                <p class="banner_text">Citizen Registration and Appointment for
                                    Vaccination</p>
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
            <div class="col-md-12">
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button"
                                    data-toggle="collapse" data-target="#collapseOne" aria-expanded="false"
                                    aria-controls="collapseOne">
                                    @lang('faq.FAQ_A')
                                </button>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <ol style="list-style: decimal">
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ1')</h5>
                                        <p style="margin: 1px">@lang('faq.FAQ1_ANS')</p>
                                    </li>
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ2')</h5>
                                        <p>@lang('faq.FAQ2_ANS')</p>
                                    </li>
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ3')</h5>
                                        <p>@lang('faq.FAQ3_ANS')</p>
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ4')</h5>
                                        <p>@lang('faq.FAQ4_ANS')</p>
                                    </li>

                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ5')</h5>
                                        <p>@lang('faq.FAQ5_ANS')</p>
                                    </li>
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ6')</h5>
                                        <p>@lang('faq.FAQ6_ANS')</p>
                                    </li>
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ7')</h5>
                                        <p>@lang('faq.FAQ7_ANS')</p>
                                    </li>
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ8')</h5>
                                        <p>@lang('faq.FAQ8_ANS')</p>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button"
                                    data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                    @lang('faq.FAQ_B')
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <ol style="list-style: decimal" start="9">
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ9')</h5>
                                        <p>@lang('faq.FAQ9_ANS')</p>
                                    </li>
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ10')</h5>
                                        <p>@lang('faq.FAQ10_ANS')</p>
                                    </li>
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ11')</h5>
                                        <p>@lang('faq.FAQ11_ANS')</p>
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ12')</h5>
                                        <p>@lang('faq.FAQ12_ANS')</p>
                                    </li>

                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ13')</h5>
                                        <p>@lang('faq.FAQ13_ANS')</p>
                                    </li>
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ14')</h5>
                                        <p>@lang('faq.FAQ14_ANS')</p>
                                    </li>
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ15')</h5>
                                        <p>@lang('faq.FAQ15_ANS')</p>
                                    </li>
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ16')</h5>
                                        <p>@lang('faq.FAQ16_ANS')</p>
                                    </li>
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ17')</h5>
                                        <p>@lang('faq.FAQ17_ANS')</p>
                                    </li>
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ18')</h5>
                                        <p>@lang('faq.FAQ18_ANS')</p>
                                    </li>
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ19')</h5>
                                        <p>@lang('faq.FAQ19_ANS')</p>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button"
                                    data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    @lang('faq.FAQ_C')
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <ol style="list-style: decimal" start="20">
                                    <li>
                                       <h5 style="font-weight: 600;">@lang('faq.FAQ20')</h5>
                                        <p>@lang('faq.FAQ20_ANS')</p>
                                    </li>
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ21')</h5>
                                        <p>@lang('faq.FAQ21_ANS')</p>
                                    </li>
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ22')</h5>
                                        <p>@lang('faq.FAQ22_ANS')</p>
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ23')</h5>
                                        <p>@lang('faq.FAQ23_ANS')</p>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                                    data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    @lang('faq.FAQ_D')
                                </button>
                            </h2>
                        </div>

                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <ol style="list-style: decimal" start="24">
                                    <li>
                                       <h5 style="font-weight: 600;">@lang('faq.FAQ24')</h5>
                                        <p>@lang('faq.FAQ24_ANS')</p>
                                    </li>
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ25')</h5>
                                        <p>@lang('faq.FAQ25_ANS')</p>
                                    </li>
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ26')</h5>
                                        <p>@lang('faq.FAQ26_ANS')</p>
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ27')</h5>
                                        <p>@lang('faq.FAQ27_ANS')</p>
                                    </li>
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ28')</h5>
                                         <p>@lang('faq.FAQ28_ANS')</p>
                                     </li>
                                     <li>
                                         <h5 style="font-weight: 600;">@lang('faq.FAQ29')</h5>
                                         <p>@lang('faq.FAQ29_ANS')</p>
                                     </li>
                                     <li>
                                         <h5 style="font-weight: 600;">@lang('faq.FAQ30')</h5>
                                         <p>@lang('faq.FAQ30_ANS')</p>
                                     <li>
                                         <h5 style="font-weight: 600;">@lang('faq.FAQ31')</h5>
                                         <p>@lang('faq.FAQ31_ANS')</p>
                                     </li>
                                </ol>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button"
                                    data-toggle="collapse" data-target="#collapseFive" aria-expanded="false"
                                    aria-controls="collapseFive">
                                    @lang('faq.FAQ_E')
                                </button>
                            </h2>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <ol style="list-style: decimal" start="32">
                                    <li>
                                       <h5 style="font-weight: 600;">@lang('faq.FAQ32')</h5>
                                        <p>@lang('faq.FAQ32_ANS')</p>
                                    </li>
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ33')</h5>
                                        <p>@lang('faq.FAQ33_ANS')</p>
                                    </li>
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ34')</h5>
                                        <p>@lang('faq.FAQ34_ANS')</p>
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ35')</h5>
                                        <p>@lang('faq.FAQ35_ANS')</p>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingSix">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button"
                                    data-toggle="collapse" data-target="#collapseSix" aria-expanded="false"
                                    aria-controls="collapseSix">
                                    @lang('faq.FAQ_F')
                                </button>
                            </h2>
                        </div>
                        <div id="collapseSix" class="collapse" aria-labelledby="headingSix"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <ol style="list-style: decimal" start="36">
                                    <li>
                                        <h5 style="font-weight: 600;">@lang('faq.FAQ36')</h5>
                                        <p>@lang('faq.FAQ36_ANS_A')</p>
                                         <p>@lang('faq.FAQ36_ANS_B')</p>
                                         <p>@lang('faq.FAQ36_ANS_D')</p>
                                    </li>
                                    
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- about section end -->


@include('frontend.layouts.footer')
