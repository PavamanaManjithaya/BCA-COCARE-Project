<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>CoCare - Staff Dashboard</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- site icon -->
    <link rel="icon" href="admin/images/fevicon.png" type="image/png" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="admin/css/bootstrap.min.css" />
    <!-- site css -->
    <link rel="stylesheet" href="admin/style.css" />
    <!-- responsive css -->
    <link rel="stylesheet" href="admin/css/responsive.css" />
    <!-- color css -->
    <link rel="stylesheet" href="admin/css/colors.css" />
    <!-- select bootstrap -->
    <link rel="stylesheet" href="admin/css/bootstrap-select.css" />
    <!-- scrollbar css -->
    <link rel="stylesheet" href="admin/css/perfect-scrollbar.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="admin/css/custom.css" />
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body class="dashboard dashboard_1">
    <div class="full_container">
        <div class="inner_container">
            @include('admin.layouts.leftsidebar')
            <!-- right content -->
            <div id="content">
                @include('admin.layouts.topbar')
                <!-- dashboard inner -->
                <div class="midde_cont">
                    <div class="container-fluid">
                        <div class="row column_title">
                            <div class="col-md-12">
                                <div class="page_title">
                                    <h2>Dashboard</h2>
                                </div>
                            </div>
                        </div>
                        @if (Session::has('message'))
                            <div class="alert alert-success">
                                {{ Session::get('message') }}
                            </div>
                        @endif

                        @if (Auth::user()->user_role == 'Vaccinator' || Auth::user()->user_role == 'Verifier')

                            @php
                                $dt = date('Y-m-d');
                                $data['totalstocks'] = App\Models\Stock::select('stocks.*')
                                    ->where('stocks.status', 'DistAdmin2Vcenter')
                                    ->where('stocks.date', $dt)
                                    ->where('stocks.vaccinecenter_id', Auth::user()->vaccine_center_id)
                                    ->sum('stocks.qty');
                                $data['stk_processed'] = App\Models\Vprocess::leftJoin('schedules', 'schedules.id', '=', 'vprocesses.schedules_id')
                                    ->where('vprocesses.vaccinecenter_id', Auth::user()->vaccine_center_id)
                                    ->where('vprocesses.vaccinedate', $dt)
                                    ->count();
                                $data['schedule'] = App\Models\Schedule::select('schedules.*')
                                    ->where('schedules.vaccinecenter_id', Auth::user()->vaccine_center_id)
                                    ->WHERE('bookingdate', $dt)
                                    ->where('status', 'Active')
                                    ->count();
                                $data['available'] = $data['totalstocks'] - $data['stk_processed'] - $data['schedule'];
                            @endphp

                            <div class="row column1">
                                <div class="col-md-6 col-lg-4">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-user yellow_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                                <p class="total_no">{{ $data['totalstocks'] }}</p>
                                                <p class="head_couter">Total Stock</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-eyedropper blue1_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                                <p class="total_no">{{ $data['available'] }}</p>
                                                <p class="head_couter">Available Stock</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-cloud-download green_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                                <p class="total_no">{{ $data['schedule'] }}</p>
                                                <p class="head_couter">Scheduled Slots</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-comments-o red_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                                <p class="total_no">WELCOME {{ Auth::user()->user_role }}
                                                    {{ Auth::user()->name }}</p>
                                                <p class="head_couter">Thank you for your grate service towards
                                                    Covid...</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        @endif
                        @if (Auth::user()->user_role == 'District Admin')

                            
                            <div class="row column1">
                                <div class="col-md-6 col-lg-4">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-user yellow_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                                <p class="total_no">{{ $data['countvaccinator'] }}</p>
                                                <p class="head_couter">Total Vaccinators </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-user blue1_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                                <p class="total_no">{{ $data['countverifier'] }}</p>
                                                <p class="head_couter">Total Verifier</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-briefcase green_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                                <p class="total_no">{{ $data['stocksfromadmin'] }}</p>
                                                <p class="head_couter">Total Stock</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-eyedropper green_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                                <p class="total_no">{{ $data['countvprocessesdose1'] }}</p>
                                                <p class="head_couter">Dose1 Vaccinated</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-eyedropper red_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                                <p class="total_no">{{ $data['countvprocessesdose2'] }}</p>
                                                <p class="head_couter">Dose2 Vaccinated</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-users green_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                                <p class="total_no">{{ $data['countvprocessesdose2']+$data['countvprocessesdose1'] }}</p>
                                                <p class="head_couter">Total Vaccinated</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-comments-o red_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                                <p class="total_no">WELCOME {{ Auth::user()->user_role }}
                                                    {{ Auth::user()->name }}</p>
                                                <p class="head_couter">Thank you for your grate service towards
                                                    Covid...</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                        @endif
                        @if (Auth::user()->user_role == 'Admin')

                            
                            <div class="row column1">

                                <div class="col-md-12 col-lg-12">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-comments-o red_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                                <p class="total_no">WELCOME 
                                                    {{ Auth::user()->name }} ({{ Auth::user()->user_role }})</p>
                                                <p class="head_couter">Thank you for your great service towards
                                                    Covid...</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-institution yellow_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                                <p class="total_no">{{  $data['countvaccinecenters'] }}</p>
                                                <p class="head_couter">Total CVC </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-user red_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                                <p class="total_no">{{ $data['countadmins'] }}</p>
                                                <p class="head_couter">Total District Admins </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-user green_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                                <p class="total_no">{{ $data['countvaccinator'] }}</p>
                                                <p class="head_couter">Total Vaccinators </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-user blue1_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                                <p class="total_no">{{ $data['countverifier'] }}</p>
                                                <p class="head_couter">Total Verifier</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-briefcase green_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                                <p class="total_no">{{ $data['stocksfromadmin'] }}</p>
                                                <p class="head_couter">Total Stock</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-eyedropper green_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                                <p class="total_no">{{ $data['countvprocessesdose1'] }}</p>
                                                <p class="head_couter">Dose 1 Vaccinated</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-eyedropper red_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                                <p class="total_no">{{ $data['countvprocessesdose2'] }}</p>
                                                <p class="head_couter">Dose 2 Vaccinated</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="full counter_section margin_bottom_30">
                                        <div class="couter_icon">
                                            <div>
                                                <i class="fa fa-users green_color"></i>
                                            </div>
                                        </div>
                                        <div class="counter_no">
                                            <div>
                                                <p class="total_no">{{ $data['counttotalvaccinated'] }}</p>
                                                <p class="head_couter">Total Vaccinated</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @endif

                    </div>
                    <!-- footer -->
                    @include('admin.layouts.footer')
                </div>
                <!-- end dashboard inner -->
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="admin/js/jquery.min.js"></script>
    <script src="admin/js/popper.min.js"></script>
    <script src="admin/js/bootstrap.min.js"></script>
    <!-- wow animation -->
    <script src="admin/js/animate.js"></script>
    <!-- select country -->
    <script src="admin/js/bootstrap-select.js"></script>
    <!-- owl carousel -->
    <script src="admin/js/owl.carousel.js"></script>
    <!-- chart js -->
    <script src="admin/js/Chart.min.js"></script>
    <script src="admin/js/Chart.bundle.min.js"></script>
    <script src="admin/js/utils.js"></script>
    <script src="admin/js/analyser.js"></script>
    <!-- nice scrollbar -->
    <script src="admin/js/perfect-scrollbar.min.js"></script>
    <script>
        var ps = new PerfectScrollbar('#sidebar');
    </script>
    <!-- custom js -->
    <script src="admin/js/custom.js"></script>
    <script src="admin/js/chart_custom_style1.js"></script>
</body>

</html>
