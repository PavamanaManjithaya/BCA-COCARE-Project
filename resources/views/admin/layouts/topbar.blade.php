<style>
.icon_info ul.user_profile_dd>li {
    width: 200px;
}
</style>
<!-- topbar -->
<div class="topbar">
  <nav class="navbar navbar-expand-lg navbar-light">
	 <div class="full">
		<button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
		<div class="logo_section">
		   <a href="index.html"><img class="img-responsive" src="{{ asset('admin/images/logo/cocarelogo.png') }}" alt="#" /></a>
		</div>
		<div class="right_topbar">
		   <div class="icon_info">
			  <ul class="user_profile_dd">
				 <li>
					<a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle" src="{{ asset('admin/images/layout_img/dept.jpg') }}" alt="#" /><span class="name_user">{{ Auth::user()->name }}</span></a>
					<div class="dropdown-menu">
					   <a class="dropdown-item" href="{{ route('staffprofile') }}"><i class="fa fa-user"></i> My Profile</a>
					   <a class="dropdown-item" href="{{ route('staffchangepassword') }}"><i class="fa fa-star"></i> Change Password</a>
					   <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> <span>Log Out</span></a>
					</div>
				 </li>
			  </ul>
		   </div>
		</div>
	 </div>
  </nav>
</div>
<!-- end topbar-->