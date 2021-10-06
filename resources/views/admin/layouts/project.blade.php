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
      <title>Pluto - Responsive Bootstrap Admin Panel Templates</title>
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
      <!-- calendar file css -->
      <link rel="stylesheet" href="admin/js/semantic.min.css" />
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body class="inner_page project_page">
      <div class="full_container">
         <div class="inner_container">
            <!-- Sidebar  -->
@include('admin.layouts.leftsidebar')
			<!-- end sidebar -->
            <!-- right content -->
			
            <div id="content">
               <!-- topbar -->
@include('admin.layouts.topbar')
			   <!-- end topbar -->
               <!-- dashboard inner -->
               <div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <h2>Project</h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row column1">
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Project <small>( Listing Design )</small></h2>
                                 </div>
                              </div>
                              <div class="full price_table padding_infor_info">
                                 <div class="row">
                                    <div class="col-lg-12">
                                       <div class="table-responsive-sm">
                                          <table class="table table-striped projects">
                                             <thead class="thead-dark">
                                                <tr>
                                                   <th style="width: 2%">No</th>
                                                   <th style="width: 30%">Project Title</th>
                                                   <th>Members</th>
                                                   <th>Project Progress</th>
                                                   <th>Status</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <tr>
                                                   <td>1</td>
                                                   <td>
                                                      <a>Sed ut perspiciatis unde omnis iste natus error sit volup tatem accus antium doloremque</a>
                                                   </td>
                                                   <td>
                                                      <ul class="list-inline">
                                                         <li>
                                                            <img width="40" src="admin/images/layout_img/msg2.png" class="rounded-circle" alt="#">
                                                         </li>
                                                         <li>
                                                            <img width="40" src="admin/images/layout_img/msg3.png" class="rounded-circle" alt="#">
                                                         </li>
                                                      </ul>
                                                   </td>
                                                   <td class="project_progress">
                                                      <div class="progress progress_sm">
                                                         <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="97" aria-valuemin="0" aria-valuemax="100" style="width: 98%;"></div>
                                                      </div>
                                                      <small>Almost Completed</small>
                                                   </td>
                                                   <td>
                                                      <button type="button" class="btn btn-success btn-xs">Success</button>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>2</td>
                                                   <td>
                                                      <a>At vero eos et accusamus et iusto odio dignissimos ducimus qui bland itiis praesentium</a>
                                                   </td>
                                                   <td>
                                                      <ul class="list-inline">
                                                         <li>
                                                            <img width="40" src="admin/images/layout_img/msg2.png" class="rounded-circle" alt="#">
                                                         </li>
                                                         <li>
                                                            <img width="40" src="admin/images/layout_img/msg3.png" class="rounded-circle" alt="#">
                                                         </li>
                                                         <li>
                                                            <img width="40" src="admin/images/layout_img/msg4.png" class="rounded-circle" alt="#">
                                                         </li>
                                                      </ul>
                                                   </td>
                                                   <td class="project_progress">
                                                      <div class="progress progress_sm">
                                                         <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                                                      </div>
                                                      <small>25% Complete</small>
                                                   </td>
                                                   <td>
                                                      <button type="button" class="btn btn-success btn-xs">Success</button>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>3</td>
                                                   <td>
                                                      <a>Sed ut perspiciatis unde omnis iste natus error sit volup tatem accus antium doloremque</a>
                                                   </td>
                                                   <td>
                                                      <ul class="list-inline">
                                                         <li>
                                                            <img width="40" src="admin/images/layout_img/msg1.png" class="rounded-circle" alt="#">
                                                         </li>
                                                         <li>
                                                            <img width="40" src="admin/images/layout_img/msg3.png" class="rounded-circle" alt="#">
                                                         </li>
                                                         <li>
                                                            <img width="40" src="admin/images/layout_img/msg4.png" class="rounded-circle" alt="#">
                                                         </li>
                                                         <li>
                                                            <img width="40" src="admin/images/layout_img/msg5.png" class="rounded-circle" alt="#">
                                                         </li>
                                                      </ul>
                                                   </td>
                                                   <td class="project_progress">
                                                      <div class="progress progress_sm">
                                                         <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100" style="width: 58%;"></div>
                                                      </div>
                                                      <small>58% Complete</small>
                                                   </td>
                                                   <td>
                                                      <button type="button" class="btn btn-success btn-xs">Success</button>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>4</td>
                                                   <td>
                                                      <a>The point of using Lorem Ipsum</a>
                                                      <br>
                                                      <small>Created 25.july.2018</small>
                                                   </td>
                                                   <td>
                                                      <ul class="list-inline">
                                                         <li>
                                                            <img width="40" src="admin/images/layout_img/msg4.png" class="rounded-circle" alt="#">
                                                         </li>
                                                         <li>
                                                            <img width="40" src="admin/images/layout_img/msg3.png" class="rounded-circle" alt="#">
                                                         </li>
                                                         <li>
                                                            <img width="40" src="admin/images/layout_img/msg1.png" class="rounded-circle" alt="#">
                                                         </li>
                                                      </ul>
                                                   </td>
                                                   <td class="project_progress">
                                                      <div class="progress progress_sm">
                                                         <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="47" aria-valuemin="0" aria-valuemax="100" style="width: 47%;"></div>
                                                      </div>
                                                      <small>47% Complete</small>
                                                   </td>
                                                   <td>
                                                      <button type="button" class="btn btn-success btn-xs">Success</button>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>5</td>
                                                   <td>
                                                      <a>At vero eos et accusamus et iusto odio dignissimos ducimus qui bland itiis praesentium</a>
                                                   </td>
                                                   <td>
                                                      <ul class="list-inline">
                                                         <li>
                                                            <img width="40" src="admin/images/layout_img/msg1.png" class="rounded-circle" alt="#">
                                                         </li>
                                                         <li>
                                                            <img width="40" src="admin/images/layout_img/msg2.png" class="rounded-circle" alt="#">
                                                         </li>
                                                      </ul>
                                                   </td>
                                                   <td class="project_progress">
                                                      <div class="progress progress_sm">
                                                         <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="63" aria-valuemin="0" aria-valuemax="100" style="width: 63%;"></div>
                                                      </div>
                                                      <small>63% Complete</small>
                                                   </td>
                                                   <td>
                                                      <button type="button" class="btn btn-success btn-xs">Success</button>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>6</td>
                                                   <td>
                                                      <a>On the other hand, we denounce with righteous</a>
                                                      <br>
                                                      <small>Created 25.july.2018</small>
                                                   </td>
                                                   <td>
                                                      <ul class="list-inline">
                                                         <li>
                                                            <img width="40" src="admin/images/layout_img/msg1.png" class="rounded-circle" alt="#">
                                                         </li>
                                                         <li>
                                                            <img width="40" src="admin/images/layout_img/msg2.png" class="rounded-circle" alt="#">
                                                         </li>
                                                         <li>
                                                            <img width="40" src="admin/images/layout_img/msg3.png" class="rounded-circle" alt="#">
                                                         </li>
                                                      </ul>
                                                   </td>
                                                   <td class="project_progress">
                                                      <div class="progress progress_sm">
                                                         <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="27" aria-valuemin="0" aria-valuemax="100" style="width: 27%;"></div>
                                                      </div>
                                                      <small>27% Complete</small>
                                                   </td>
                                                   <td>
                                                      <button type="button" class="btn btn-success btn-xs">Success</button>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>7</td>
                                                   <td>
                                                      <a>Nam libero tempore, cum soluta nobis est eligendi..</a>
                                                      <br>
                                                      <small>Created 25.july.2018</small>
                                                   </td>
                                                   <td>
                                                      <ul class="list-inline">
                                                         <li>
                                                            <img width="40" src="admin/images/layout_img/msg4.png" class="rounded-circle" alt="#">
                                                         </li>
                                                         <li>
                                                            <img width="40" src="admin/images/layout_img/msg3.png" class="rounded-circle" alt="#">
                                                         </li>
                                                      </ul>
                                                   </td>
                                                   <td class="project_progress">
                                                      <div class="progress progress_sm">
                                                         <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;"></div>
                                                      </div>
                                                      <small>85% Complete</small>
                                                   </td>
                                                   <td>
                                                      <button type="button" class="btn btn-success btn-xs">Success</button>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td>8</td>
                                                   <td>
                                                      <a>Nor again is there anyone who loves or pursues</a>
                                                      <br>
                                                      <small>Created 25.july.2018</small>
                                                   </td>
                                                   <td>
                                                      <ul class="list-inline">
                                                         <li>
                                                            <img width="40" src="admin/images/layout_img/msg1.png" class="rounded-circle" alt="#">
                                                         </li>
                                                      </ul>
                                                   </td>
                                                   <td class="project_progress">
                                                      <div class="progress progress_sm">
                                                         <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100" style="width: 18%;"></div>
                                                      </div>
                                                      <small>18% Complete</small>
                                                   </td>
                                                   <td>
                                                      <button type="button" class="btn btn-success btn-xs">Success</button>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- end row -->
                     </div>
                     <!-- footer -->
@include('admin.layouts.footer')
                  </div>
                  <!-- end dashboard inner -->
               </div>
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
      <!-- calendar file css -->     
      <script src="admin/js/semantic.min.js"></script>
   </body>
</html>