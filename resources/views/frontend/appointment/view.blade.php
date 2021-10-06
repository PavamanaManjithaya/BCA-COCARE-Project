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
      <div class="news_section">
         <div class="container">
            <div id="main_slider" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="news_section_2 layout_padding">
                        <div class="box_main" style="width: 90%;">
                           <h2 class="design_text">Account Details</h2>
						   <center><b style="color: green;">Registered Mobile No. XXX-XXX-8114</b></center><br>
						   
<!-- ################################################################ -->
<div class="container">
    <div class="row">
@for($i=0;$i<3;$i++)
        <div class="col-md-12 col-sm-12" style="padding: 10px;">
            <div class="product-grid" >
                <div class="product-image">
                    <span class="product-new-label">Partially Vaccinated</span>
                    <span class="product-discount-label">33 days Left for Dose 2</span>
                </div>
				<div class="row">
					<div class="col-md-12">
						<br>
						<br>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4" style="padding-left: 25px;">
						<h2>Raj Kiran</h2>
					</div>
					<div class="col-md-4">
						<label>REF ID : 52633211658170</label>
					</div>
					<div class="col-md-4">
						<label>Secret Code : 8170</label>
					</div>
					<div class="col-md-4" style="padding-left: 25px;">
						<label>Year of Birth: 1991</label>
					</div>
					<div class="col-md-4">
						<label>Photo ID: Aadhaar Card</label>
					</div>
					<div class="col-md-4">
						<label>ID Number:XXXX-0006</label>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
					<hr>
					</div>
					<div class="col-md-9">
					<b style="color: green;"><i class="fa fa fa fa-thumbs-up fa-2x fa-pull-left fa-border" aria-hidden="true"></i> Dose 1</b> |
					<b>COVISHIELD</b><br>
<label style="color: green;">K S HEGDE (PENTAGON PUMPWELL), 10 Jul 2021, 09:00AM-11:00AM</label>
					</div>
					<div class="col-md-3">
<button class="btn btn-success"> <i class="fa fa-address-card-o" aria-hidden="true"></i> Certificate</button>
					</div>
					<div class="col-md-12">
					<hr>
					</div>
					<div class="col-md-9">
		<b style="color: red;"><i class="fa fa fa-thumbs-down fa-2x fa-pull-left fa-border" aria-hidden="true"></i> Dose 2</b>  |
<label style="color: red;" >Due date 02 Oct 2021, Last date  30 Oct 2021</label>
					</div>
					<div class="col-md-3">
<a href="/searchappvaccination" class="btn btn-warning"> <i class="fa fa-calendar" aria-hidden="true"></i> Schedule</a>
					</div>
				</div>
            </div>
        </div>
@endfor
   </div>
<hr>
<center><a href="" class="btn btn-info" > <i class="fa fa-plus-square" ></i>	Add Member</a></center>
<br>
<br>
</div>

<!-- ################################################################ -->

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
