<?php error_reporting(0);
require_once("lock.php");
 $cdate=strtotime("now"); 
 if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusMsgClass = 'alert-success';
            $statusMsg = 'Items data has been inserted successfully.';
            break;
        case 'err':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusMsgClass = '';
            $statusMsg = '';
    }
}?>
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
			  <?php if(!empty($statusMsg)){
        echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
    } ?>
                  <div class="col-lg-6">
                      <section class="panel">
                          <header class="panel-heading">
                              Upload Item records 
                          </header>
                          <div class="panel-body">
                              <form action="importcustData.php" method="POST" enctype="multipart/form-data" id="importFrm">
                <input type="file" name="file" style="display: inline;"/>
                <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
            </form>
                          </div>
                      </section>
                  </div>  
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
