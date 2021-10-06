            <!-- Sidebar  -->
            <nav id="sidebar">
               <div class="sidebar_blog_1">
                  <div class="sidebar-header">
                     <div class="logo_section">
                        @if (Auth::user()->user_role == 'Vaccinator' || Auth::user()->user_role == 'Verifier')
                        <a href="index.html"><img class="logo_icon img-responsive" src="{{ asset('admin/images/layout_img/vaccinator.jpg') }}" alt="#" /></a>

                        @else
                        <a href="index.html"><img class="logo_icon img-responsive" src="{{ asset('admin/images/layout_img/dept.jpg') }}" alt="#" /></a>
                        @endif

                     </div>
                  </div>
                  <div class="sidebar_user_info">
                     <div class="icon_setting"></div>
                     <div class="user_profle_side">
                        @if (Auth::user()->user_role == 'Vaccinator' || Auth::user()->user_role == 'Verifier')
                        <div class="user_img"><img class="img-responsive" src="{{ asset('admin/images/layout_img/vaccinator.jpg') }}" alt="#" /></div>
                        @else
                        <div class="user_img"><img class="img-responsive" src="{{ asset('admin/images/layout_img/dept.jpg') }}" alt="#" /></div>
                        @endif
                        <div class="user_info">
                           <h6>{{  Auth::user()->name }}</h6>
                           <p><span class="online_animation"></span> Online</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="sidebar_blog_2">
                  <h4>{{Auth::user()->user_role}}</h4>
                  <ul class="list-unstyled components">

@if(Auth::user()->user_role == "Admin") 

<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard yellow_color"></i> <span>Dashboard</span></a></li>


<li>
   <a href="#stockentry" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-briefcase purple_color"></i> <span>Stock Entry</span></a>
   <ul class="collapse list-unstyled" id="stockentry">
      <li><a href="{{ route('stock.create') }}">> <span>Add Stocks</span></a></li>
      <li><a href="{{ route('stock.index') }}">> <span>Stocks Entry Report</span></a></li>
   </ul>
</li>

<li>
   <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-users purple_color"></i> <span>Staff Accounts</span></a>
   <ul class="collapse list-unstyled" id="users">
      <li><a href="{{ route('createaccount') }}">> <span>Add Staff</span></a></li>
      <li><a href="{{ route('viewaccount', 'Verifier')}}">> <span>View Verifier Accounts</span></a></li>
      <li><a href="{{ route('viewaccount', 'Vaccinator')}}">> <span>View Vaccinator Accounts</span></a></li>
      <li><a href="{{ route('viewaccount', 'District Admin')}}">> <span>View District Admin Accounts</span></a></li>
      <li><a href="{{ route('viewaccount', 'Admin')}}">> <span>View Admin Accounts</span></a></li>
   </ul>
</li>


<li>
   <a href="#vaccinemaster" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-eyedropper purple_color"></i> <span>Vaccine Master</span></a>
   <ul class="collapse list-unstyled" id="vaccinemaster">
      <li><a href="{{ route('vaccinecenter.create') }}">> <span>Add Vaccine Center</span></a></li>
      <li><a href="{{ route('vaccinecenter.index') }}">> <span>View Vaccine Center</span></a></li>
      <li><a href="{{ route('vaccinetype.create') }}">> <span>Add Vaccine Type</span></a></li>
      <li><a href="{{ route('vaccinetype.index') }}">> <span>View Vaccine Types</span></a></li>
   </ul>
</li>

<li>
   <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-cog purple_color"></i> <span>Settings</span></a>
   <ul class="collapse list-unstyled" id="element">
      <li><a href="{{ route('state.create') }}">> <span>Add State</span></a></li>
      <li><a href="{{ route('state.index') }}">> <span>View States</span></a></li>
      <li><a href="{{ route('district.create') }}">> <span>Add District</span></a></li>
      <li><a href="{{ route('district.index') }}">> <span>View Districts</span></a></li>
   </ul>
</li>


<li><a href="{{ route('logout') }}"><i class="fa fa-times-circle red_color"></i> <span>Logout</span></a></li>

@elseif(Auth::user()->user_role == "District Admin")

      <li><a href="{{ route('dashboard') }}"><i class="fa fa-diamond purple_color"></i> <span>District Admin Panel</span></a></li>

      <li>
         <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-clock-o orange_color"></i> <span>Stock Report</span></a>
         <ul class="collapse list-unstyled" id="element">
            <li><a href="{{ route('stockbalance') }}">> <span>Stock Allotment</span></a></li>
            <li><a href="{{ route('stockallotmentreport') }}">> <span>Stock Allotment Report</span></a></li>
            <li><a href="{{ route('stock.index') }}">> <span>Stocks Received Report</span></a></li>
            <li><a href="{{ route('stockwastageview') }}">> <span>Stocks Wastage Report</span></a></li>
         </ul>
      </li>
      
      <li>
         <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-users purple_color"></i> <span>Staff Accounts</span></a>
         <ul class="collapse list-unstyled" id="users">
            <li><a href="{{ route('createaccount') }}">> <span>Add Verifier/Vaccinator</span></a></li>
            <li><a href="{{ route('viewaccount', 'Verifier')}}">> <span>View Verifier Accounts</span></a></li>
            <li><a href="{{ route('viewaccount', 'Vaccinator')}}">> <span>View Vaccinator Accounts</span></a></li>
         </ul>
      </li>
      
      <li><a href="{{ route('logout') }}"><i class="fa fa-times-circle red_color"></i> <span>Logout</span></a></li>

@elseif(Auth::user()->user_role == "Verifier")
      <li><a href="{{ route('dashboard') }}"><i class="fa fa-diamond purple_color"></i> <span>Verifier Panel</span></a></li>

      <li><a href="{{ route('appointmentschedule') }}"><i class="fa fa-gg-circle  yellow_color2"></i> <span>Conduct Session</span></a></li>

      <li><a href="{{ route('verifiedview') }}"><i class="fa fa-users red_color2"></i> <span>View Appointments</span></a></li>

      <li><a href="{{ route('offlineappointment') }}"><i class="fa fa-table purple_color2"></i> <span>Offline Appointment</span></a></li>
      
      <li><a href="{{ route('logout') }}"><i class="fa fa-times-circle red_color"></i> <span>Logout</span></a></li>

@elseif(Auth::user()->user_role == "Vaccinator")
      <li><a href="{{ route('dashboard') }}"><i class="fa fa-diamond purple_color"></i> <span>Vaccinator Panel</span></a></li>
      <li><a href="{{ route('vaccinationprocess') }}"><i class="fa fa-bitbucket-square yellow"></i> <span>Vaccination Process</span></a></li>
      <li><a href="{{ route('vaccinatorreport') }}"><i class="fa fa-table purple_color2"></i> <span>Stock Usage Report</span></a></li>
      <li><a href="{{ route('logout') }}"><i class="fa fa-times-circle red_color"></i> <span>Logout</span></a></li>
@endif

                  </ul>
               </div>
            </nav>
            <!-- end sidebar -->