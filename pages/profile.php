<?php 
error_reporting(0);
include("lock.php");
$ad_id=base64_decode($_GET['source_ref']);
if(empty($_GET['source_ref'])) {
  header("location: 404");
}
else{
	$stmt = $auth_user->runQuery("SELECT * FROM admin WHERE ad_id=:ad_id");
	$stmt->execute(array(':ad_id'=>$ad_id));
	$rowup=$stmt->fetch(PDO::FETCH_ASSOC);
	//print_r($rowup);
	if($rowup<=0){
	header("location: 404");
	}else{
	$ad_name=$rowup['ad_name'];
	$ad_email=$rowup['ad_email'];
	$ad_cont=$rowup['ad_cont'];
	$ad_addr=$rowup['ad_addr'];
	
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.html">
    <title> CSV DATA REPORTS </title>
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
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" class="">
      <!--header start-->
      <?php require_once("header.php");?>
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                  <aside class="profile-nav col-lg-3">
                      <section class="panel">
                          <div class="user-heading round">
                              <h1><?php echo $ad_name; ?></h1>
                              <p><?php echo $ad_cont; ?></p>
                          </div>

                          <!-- <ul class="nav nav-pills nav-stacked">
                              <li><a href="#"> <i class="fa fa-edit"></i> Edit profile</a></li>
                          </ul> -->

                      </section>
                  </aside>
                  <aside class="profile-info col-lg-9">
                      <section class="panel">
                          
                          <div class="panel-body bio-graph-info">
                              <h1>Bio Graph</h1>
                              <div class="row">
                                  <div class="bio-row">
                                      <p><span> Name </span>: <?php echo $ad_name; ?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Address </span>: <?php echo $ad_addr; ?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Email </span>: <?php echo $ad_email; ?></p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Mobile </span>: <?php echo $ad_cont; ?></p>
                                  </div>
                              </div>
                          </div>
                      </section>
                      
                  </aside>
              </div>

              <!-- page end-->
          </section>
      </section>
      <!--main content end-->

      <!-- Right Slidebar start -->
     
      <!-- Right Slidebar end -->

      <!--footer start-->
      <!--footer end-->
  </section>

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
  <script>
      //knob
      $(".knob").knob();

  </script>
  </body>
</html>
