<?php include("lock.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Katare">
    <meta name="keyword" content="Mipltools, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="views/img/favicon.html">
    <title><?php echo TITLE; ?></title>
    <!-- Bootstrap core CSS -->
    <link href="views/css/bootstrap.min.css" rel="stylesheet">
    <link href="views/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="views/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="views/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="views/css/owl.carousel.css" type="text/css">
      <!--right slidebar-->
      <link href="css/slidebars.css" rel="stylesheet">
	  	  	<!--Datepicker table-->
	<link rel="stylesheet" type="text/css" href="views/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
    <link rel="stylesheet" type="text/css" href="views/assets/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="views/assets/bootstrap-timepicker/compiled/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="views/assets/bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="views/assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
    <link rel="stylesheet" type="text/css" href="views/assets/bootstrap-datetimepicker/css/datetimepicker.css" />
	<link href="views/assets/toastr-master/toastr.css" rel="stylesheet" type="text/css" />
    <!-- Custom styles for this template -->
    <link href="views/css/style.css" rel="stylesheet">
    <link href="views/css/style-responsive.css" rel="stylesheet" />
<script type="text/javascript">
function savehis(){ 
	var d_name=$("#d_name").val();
	var d_cont=$("#d_cont").val();
	var d_email=$("#d_email").val();
	var d_age=$("#d_age").val();
	var d_bgrp=$("#d_bgrp").val();
	var d_gender=$("#d_gender").val();
	var d_addr=$("#d_addr").val();
	var ex_dt=$("#ex_dt").val();
	if(d_name!="" && d_cont!="" && d_email!="" && d_age!="" && d_bgrp!="" && d_gender!="" && d_addr!="" && ex_dt!=""){
		//alert(head+"xxxx"+desc);
		var form = $("#fform");
	$.ajax({
            type: 'POST',
            url: 'save_donner.php',
            data: form.serialize(),
            success: function(data){  
			//alert(data);
		  if(data == "Success")
		{ 
		//alert(data);
		  $('#fform')[0].reset();
			$('#sucess').text("Donner Added Successfully");
			$('.toast-top-right').show();
			$('.toast-top-right').focus();
			$('.toast-top-right').fadeOut(5000);
			//location.replace('blog_bank.php'); 
		}
		else
		{ 
		//alert(data);
		 $('#error').text("Please Fill All Mandatory Fields");
			$('.toast-top-center').show();
			$('.toast-top-center').focus();
			$('.toast-top-center').fadeOut(5000);
			$('#fform')[0].reset();
		}
		}                                    	  
         }); 
	}else{
			$('#error').text("Please Fill All Mandatory Fields");
			$('.toast-top-center').show();
			$('.toast-top-center').focus();
			$('.toast-top-center').fadeOut(5000);
			$('#fform')[0].reset();
	}
	}
</script>

  </head>

  <body>

  <section id="container" class="">
      <!--header start-->
      <?php include"header.php"; ?>
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  <div class="col-lg-6">
                      <section class="panel">
                          <header class="panel-heading">
                            Donner Registration
                          </header>
                          <div class="panel-body">
                <form id="fform" action='javascript:;' name="fform" onsubmit="savehis()" Method="POST" enctype="multipart/form-data">
				
						<input type="text" id="d_name" class="form-control" name="d_name" style="margin-bottom:10px;" value="" placeholder="Donner Name"/>
						<input type="text" id="d_cont" class="form-control" name="d_cont" style="margin-bottom:10px;" value="" placeholder="Emergency Contact No"/>
						<input type="text" id="d_email" class="form-control" name="d_email" style="margin-bottom:10px;" value="" placeholder="Emergency Email"/>
						<input type="text" id="d_age" class="form-control" name="d_age" maxlength="3" style="margin-bottom:10px;" value="" placeholder="Age"/>
						<select id="d_bgrp" style="margin-bottom:10px;" class="form-control" name="d_bgrp">
							<option value="">Select Blood Group </option>
							<option value="A+">A +ve </option>
							<option value="A-">A -ve </option>
							<option value="B+">B +ve </option>
							<option value="B-">B -ve </option>
							<option value="AB+">AB +ve </option>
							<option value="AB-">AB -ve </option>
							<option value="O+">O +ve</option>
							<option value="O-">O -ve</option>
						</select>
						<select id="d_gender" style="margin-bottom:10px;" class="form-control" name="d_gender">
							<option value="">Select Gender </option>
							<option value="Male">Male </option>
							<option value="Female">Female </option>
						</select>
							<input type="text" id="d_addr" class="form-control" name="d_addr" style="margin-bottom:10px;" value="" placeholder="Address"/>
							 <Strong>After the death</strong><br>
							<input name="q1[]" Checked type="checkbox" value="Any body Part">Any part of body<br>
							<input name="q1[]" type="checkbox" value="corneas">corneas<br>
							<input name="q1[]" type="checkbox" value="Kidneys">Kidneys<br>
							<input name="q1[]" type="checkbox" value="Heart">Heart<br>
							<input name="q1[]" type="checkbox" value="Lungs">Lungs<br>
							<input name="q1[]" type="checkbox" value="Liver">Liver<br>
							<input name="q1[]" type="checkbox" value="Pancreas">Pancreas<br><br>
                             <div  style="margin-bottom:10px; width:97%; "  data-date-viewmode="years" data-date-format="dd-mm-yyyy"  class="input-append date dpYears">
                            <input type="text" readonly="" id="ex_dt" name="ex_dt" placeholder="Death date" value="" size="16" class="form-control">
                                              <span class="input-group-btn add-on">
                                                <button class="btn btn-danger" style="margin-left: -17px" type="button"><i class="fa fa-calendar"></i></button>
                                              </span>
                            </div>
               <input type="submit" id="login" class="btn btn-primary" value="Add">
            </form>
                          </div>
                      </section>
                  </div>             
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
	   <div id="toast-container" style="display:none; " class="toast-top-right" aria-live="polite" role="alert"><div class="toast toast-success"><div class="toast-progress" style="width: 99.9218%;"></div><button type="button" class="toast-close-button" role="button">×</button><div class="toast-title">Toastr Notification</div><div id="sucess" class="toast-message"> </div></div></div>
	  <div  id="toast-container"style="display:none; " class="toast-top-center" aria-live="polite" role="alert"><div class="toast toast-error"><button type="button" class="toast-close-button" role="button">×</button><div class="toast-title">Error Notification</div><div id="error" class="toast-message"></div></div></div>
  </section>
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="views/js/jquery.js"></script>
    <script src="views/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="views/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="views/js/jquery.scrollTo.min.js"></script>
    <script src="views/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script type="text/javascript" src="views/js/jquery.validate.min.js"></script>
    <script src="views/js/respond.min.js" ></script>
  <!--right slidebar-->
  <script src="views/js/slidebars.min.js"></script>
    <!--common script for all pages-->
    <script src="views/js/common-scripts.js"></script>
  <script type="text/javascript" src="views/assets/fuelux/js/spinner.min.js"></script>
  <script type="text/javascript" src="views/assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>
  <script type="text/javascript" src="views/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
  <script type="text/javascript" src="views/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
  <script type="text/javascript" src="views/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="views/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
  <script type="text/javascript" src="views/assets/bootstrap-daterangepicker/moment.min.js"></script>
  <script type="text/javascript" src="views/assets/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="views/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
  <script type="text/javascript" src="views/assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
  <script type="text/javascript" src="views/assets/jquery-multi-select/js/jquery.multi-select.js"></script>
  <script type="text/javascript" src="views/assets/jquery-multi-select/js/jquery.quicksearch.js"></script>
  <script src="views/js/advanced-form-components.js"></script>
    <!--script for this page-->
    <script src="views/js/form-validation-script.js"></script>
  </body>
</html>
