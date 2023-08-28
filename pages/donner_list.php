<?php include("lock.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.html">
    <title>  DONNER REPORTS</title>
    <!-- Bootstrap core CSS -->
    <link href="views/css/bootstrap.min.css" rel="stylesheet">
    <link href="views/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="views/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!--dynamic table-->
    <link href="views/assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
    <link href="views/assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="views/assets/data-tables/DT_bootstrap.css" />
	<link href="views/assets/toastr-master/toastr.css" rel="stylesheet" type="text/css" />
      <!--right slidebar-->
      <link href="views/css/slidebars.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="views/css/style.css" rel="stylesheet">
    <link href="views/css/style-responsive.css" rel="stylesheet" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="views/js/html5shiv.js"></script>
      <script src="views/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <section id="container" class="">
      <!--header start-->
  <?php include("header.php"); ?>
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                <div class="col-sm-12">
              <section class="panel">
              <header class="panel-heading">
                 DONNER REPORTS
             <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-times"></a>
             </span>
              </header>
              <div class="panel-body">
              <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
              <tr>
			      <th class="center"> Hospital Name </th>
                  <th class="center"> Donner Name </th>
                  <th class="center">Emergency email</th>
                  <th class="center" >Emergency Contact</th>
				  <th class="center">Donner Age</th>
                  <th class="center">Donner Gender</th>
                  <th class="center">Donner Address</th>
				  <th class="center">Donner Blood Group</th>
				  <th class="center">Donate Organ </th>
				  <th class="center">Death Date </th>
              </tr>
              </thead>
              <tbody>
			<?php $certi=$auth_user->getdonner();
			  foreach($certi as $certirow){ 
		  ?>
              <tr class="gradec">
			  <td class="center"><?php echo $certirow['ad_name']; ?></td>
			   <td class="center"><?php echo $certirow['d_name']; ?></td>
			     <td class="center"><?php echo $certirow['d_email']; ?></td>
				   <td class="center"><?php echo $certirow['d_cont']; ?></td>
				     <td class="center"><?php echo $certirow['d_age']; ?></td>
					   <td class="center"><?php echo $certirow['d_gender']; ?></td>
					     <td class="center"><?php echo $certirow['d_addr']; ?></td>
						   <td class="center"><?php echo $certirow['d_bgrp']; ?></td>
						   <td class="center"><?php echo $certirow['d_organ']; ?></td>
				<td class="center"><?php echo date("d-m-Y",$certirow['d_exdt']); ?></td>
			      
              </tr>
			<?php } ?>
              </tbody>
             <!-- <tfoot>
              <tr>
                  <th>Date</th>
                  <th>Certificate/lisence Name</th>
                  <th >Certificate/lisence No</th>
                  <th >Department</th>
                  <th >Task Owner</th>
              </tr>
              </tfoot> -->
              </table>
              </div>
              </div>
              </section>
              </div>
              </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
      <!-- Right Slidebar start -->
      
      <!-- Right Slidebar end -->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              <?php echo date("Y"); ?> &copy; Alert System by Katare Informatics.
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
	  <div id="toast-container" style="display:none; " class="toast-top-right" aria-live="polite" role="alert"><div class="toast toast-success"><div class="toast-progress" style="width: 99.9218%;"></div><button type="button" class="toast-close-button" role="button">×</button><div class="toast-title">Toastr Notification</div><div id="sucess" class="toast-message"> </div></div></div>
	  <div  id="toast-container"style="display:none; " class="toast-top-center" aria-live="polite" role="alert"><div class="toast toast-error"><button type="button" class="toast-close-button" role="button">×</button><div class="toast-title">Error Notification</div><div id="error" class="toast-message"></div></div></div>
      <!--footer end-->
  </section>
<script>
	function mailpdf(dt1,crnm,crno,un,townr,eto){
	 $.ajax({
			type:'POST',
			url:'mail.php',
			data: {dt1:dt1,crnm:crnm,crno:crno,un:un,townr:townr,eto:eto},
			success: function(result){
			if(result == "success"){
		$('#sucess').text("Mail has been Sent");
		$('.toast-top-right').show();
		$('.toast-top-right').fadeOut(5000);
			}else{
		$('#error').text(result);
		$('.toast-top-center').show();
		$('.toast-top-center').fadeOut(5000);
			     }
		     }
	    })
	}
</script>
    <!-- js placed at the end of the document so the pages load faster -->

    <script src="views/js/jquery.js"></script>
    <script src="views/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="views/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="views/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="views/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="views/js/jquery.scrollTo.min.js"></script>
    <script src="views/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script type="text/javascript" language="javascript" src="views/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="views/assets/data-tables/DT_bootstrap.js"></script>
    <script src="views/js/respond.min.js" ></script>

    <!--right slidebar-->
    <script src="views/js/slidebars.min.js"></script>

    <!--dynamic table initialization -->
    <script src="views/js/dynamic_table_init.js"></script>


    <!--common script for all pages-->
    <script src="views/js/common-scripts.js"></script>
  </body>
</html>
