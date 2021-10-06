<style>
.header_section {
    display: none;
}
input[type="radio"] {
    -ms-transform: scale(1.5); /* IE 9 */
    -webkit-transform: scale(1.5); /* Chrome, Safari, Opera */
    transform: scale(1.5);
}
</style>
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
                        <div class="box_main">
                           <h2 class="design_text">Register for Vaccination</h2>
						   <center><span style="color: green;">You can Register maximum 4 beneficiaries.</span></center><br>
						   
<form method="post" action="">
	<div class="form-group">
		Photo ID Card Type, that you will bring to Vaccination Center
		<select name="id_proof" id="id_proof" class="form-control">
			<option value="">Select Photo ID Proof</option>
			<?php
			$arr = array("Aadhaar Card","PAN Card");
			foreach($arr as $val)
			{
			echo "<option value='$val'>$val</option>";
			}
			?>
		</select>
	</div>
	
	<div class="form-group">
		Photo ID Number
		<input type="text" name="id_number" id="id_number" class="form-control" placeholder="Enter Photo ID Number" >
	</div>
	
	<div class="form-group">
		Name
		<input type="text" name="name" id="name" class="form-control" placeholder="Enter name" >
	</div>
	
	<div class="form-group">
		Gender<br>
		<input type="radio" name="gender" id="gender"   >&nbsp;&nbsp; Male
		&nbsp;&nbsp;&nbsp;
		<input type="radio" name="gender" id="gender" > &nbsp;&nbsp;Female
		&nbsp;&nbsp;&nbsp;
		<input type="radio" name="gender" id="gender" > &nbsp;&nbsp;Others
	</div>
	
	<div class="form-group">
		Year of Birth
		<input type="text" name="birthyear" id="birthyear" class="form-control" placeholder="Year of Birth" >
	</div>

	<div class="form-group">
		<center><button type="button" class="btn btn-primary" onclick="loadotp()" data-toggle="modal" data-target="#otpmodal">Get OTP</button></center>
	</div>	<br>
</form>
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
