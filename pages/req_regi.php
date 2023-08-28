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
	var r_name=$("#r_name").val();
	var r_cont=$("#r_cont").val();
	var r_email=$("#r_email").val();
	var r_age=$("#r_age").val();
	var r_bgrp=$("#r_bgrp").val();
	var r_gender=$("#r_gender").val();
	var r_addr=$("#r_addr").val();
	if(r_name!="" && r_cont!="" && r_email!="" && r_age!="" && r_bgrp!="" && r_gender!="" && r_addr!=""){
		//alert(head+"xxxx"+desc);
		var form = $("#fform");
	$.ajax({
            type: 'POST',
            url: 'save_req.php',
            data: form.serialize(),
            success: function(data){  
			//alert(data);
		  if(data == "Success")
		{ 
		//alert(data);
		  $('#fform')[0].reset();
			$('#sucess').text("Requester Added Successfully");
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
                            Organ Requester
                          </header>
                          <div class="panel-body">
                <form id="fform" action='javascript:;' name="fform" onsubmit="savehis()" Method="POST" enctype="multipart/form-data">
				
						<input type="text" id="r_name" class="form-control" name="r_name" style="margin-bottom:10px;" value="" placeholder="Requester Name"/>
						<input type="text" id="r_cont" class="form-control" name="r_cont" style="margin-bottom:10px;" value="" placeholder="Emergency Contact No"/>
						<input type="text" id="r_email" class="form-control" name="r_email" style="margin-bottom:10px;" value="" placeholder="Emergency Email"/>
						<input type="text" id="r_age" style="margin-bottom:10px;" class="form-control" name="r_age" maxlength="3" style="margin-bottom:10px;" value="" placeholder="Age"/>
						<select id="r_bgrp" style="margin-bottom:10px;" class="form-control" name="r_bgrp">
							<option value="">Select Blood Group</option>
							<option value="A Positive">A Positive </option>
							<option value="A Negative">A Negative </option>
							<option value="B Positive">B Positive </option>
							<option value="B Negative">B Negative </option>
							<option value="AB Positive">AB Positive </option>
							<option value="AB Negative">AB Negative </option>
							<option value="O Positive">O Positive</option>
							<option value="O Negative">O Negative</option>
						</select>
						<select id="r_gender" style="margin-bottom:10px;" class="form-control" name="r_gender">
							<option value="">Select Gender </option>							<option value="Male">Male </option>
							<option value="Female">Female </option>
						</select>
							<input type="text" id="r_addr" class="form-control" name="r_addr" style="margin-bottom:10px;" value="" placeholder="Address"/>
							 <Strong>Wanted Body Part</strong><br>
							<input name="rq1[]" type="checkbox" value="corneas">corneas<br>
							<input name="rq1[]" type="checkbox" value="Kidneys">Kidneys<br>
							<input name="rq1[]" type="checkbox" value="Heart">Heart<br>
							<input name="rq1[]" type="checkbox" value="Lungs">Lungs<br>
							<input name="rq1[]" type="checkbox" value="Liver">Liver<br>
							<input name="rq1[]" type="checkbox" value="Pancreas">Pancreas<br><br>
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
