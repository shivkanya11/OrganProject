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
                 ITEM DATA REPORTS
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
                  <th class="center"> Date </th>
                  <th class="center">Year</th>
                  <th class="center" >Month</th>
				  <th class="center">Customer Age</th>
                  <th class="center">Customer Gender</th>
                  <th class="center">Country</th>
				  <th class="center">State</th>
				  <th class="center"> Product Category </th>
                  <th class="center">Product sub Category</th>
                  <th class="center" >Quantity</th>
				  <th class="center">Unit Cost</th>
                  <th class="center">Unit Price</th>
                  <th class="center">Cost</th>
				  <th class="center">Revenue</th>
              </tr>
              </thead>
              <tbody>
			<?php $certi=$auth_user->fetchgrf($user_id);
			  foreach($certi as $certirow){ 
		  ?>
              <tr class="gradec">
			   <td class="center"><?php echo $certirow['gdate']; ?></td>
			     <td class="center"><?php echo $certirow['gyear']; ?></td>
				   <td class="center"><?php echo $certirow['gmonth']; ?></td>
				     <td class="center"><?php echo $certirow['gcage']; ?></td>
					   <td class="center"><?php echo $certirow['gcgender']; ?></td>
					     <td class="center"><?php echo $certirow['gcontry']; ?></td>
						   <td class="center"><?php echo $certirow['gstate']; ?></td>
				<td class="center"><?php echo $certirow['gpcat']; ?></td>
			     <td class="center"><?php echo $certirow['gpscat']; ?></td>
				   <td class="center"><?php echo $certirow['gqty']; ?></td>
				     <td class="center"><?php echo $certirow['guntcost']; ?></td>
					   <td class="center"><?php echo $certirow['guntprice']; ?></td>
					     <td class="center"><?php echo $certirow['gtotal']; ?></td>
						   <td class="center"><?php echo $certirow['grevenue']; ?></td>		   
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
      <div class="sb-slidebar sb-right sb-style-overlay">
          <h5 class="side-title">Online Customers</h5>
          <ul class="quick-chat-list">
              <li class="online">
                  <div class="media">
                      <a href="#" class="pull-left media-thumb">
                          <img alt="" src="img/chat-avatar2.jpg" class="media-object">
                      </a>
                      <div class="media-body">
                          <strong>John Doe</strong>
                          <small>Dream Land, AU</small>
                      </div>
                  </div><!-- media -->
              </li>
              <li class="online">
                  <div class="media">
                      <a href="#" class="pull-left media-thumb">
                          <img alt="" src="img/chat-avatar.jpg" class="media-object">
                      </a>
                      <div class="media-body">
                          <div class="media-status">
                              <span class=" badge bg-important">3</span>
                          </div>
                          <strong>Jonathan Smith</strong>
                          <small>United States</small>
                      </div>
                  </div><!-- media -->
              </li>

              <li class="online">
                  <div class="media">
                      <a href="#" class="pull-left media-thumb">
                          <img alt="" src="img/pro-ac-1.png" class="media-object">
                      </a>
                      <div class="media-body">
                          <div class="media-status">
                              <span class=" badge bg-success">5</span>
                          </div>
                          <strong>Jane Doe</strong>
                          <small>ABC, USA</small>
                      </div>
                  </div><!-- media -->
              </li>
              <li class="online">
                  <div class="media">
                      <a href="#" class="pull-left media-thumb">
                          <img alt="" src="img/avatar1.jpg" class="media-object">
                      </a>
                      <div class="media-body">
                          <strong>Anjelina Joli</strong>
                          <small>Fockland, UK</small>
                      </div>
                  </div><!-- media -->
              </li>
              <li class="online">
                  <div class="media">
                      <a href="#" class="pull-left media-thumb">
                          <img alt="" src="img/mail-avatar.jpg" class="media-object">
                      </a>
                      <div class="media-body">
                          <div class="media-status">
                              <span class=" badge bg-warning">7</span>
                          </div>
                          <strong>Mr Tasi</strong>
                          <small>Dream Land, USA</small>
                      </div>
                  </div><!-- media -->
              </li>
          </ul>
          <h5 class="side-title"> pending Task</h5>
          <ul class="p-task tasks-bar">
              <li>
                  <a href="#">
                      <div class="task-info">
                          <div class="desc">Dashboard v1.3</div>
                          <div class="percent">40%</div>
                      </div>
                      <div class="progress progress-striped">
                          <div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success">
                              <span class="sr-only">40% Complete (success)</span>
                          </div>
                      </div>
                  </a>
              </li>
              <li>
                  <a href="#">
                      <div class="task-info">
                          <div class="desc">Database Update</div>
                          <div class="percent">60%</div>
                      </div>
                      <div class="progress progress-striped">
                          <div style="width: 60%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-warning">
                              <span class="sr-only">60% Complete (warning)</span>
                          </div>
                      </div>
                  </a>
              </li>
              <li>
                  <a href="#">
                      <div class="task-info">
                          <div class="desc">Iphone Development</div>
                          <div class="percent">87%</div>
                      </div>
                      <div class="progress progress-striped">
                          <div style="width: 87%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar" class="progress-bar progress-bar-info">
                              <span class="sr-only">87% Complete</span>
                          </div>
                      </div>
                  </a>
              </li>
              <li>
                  <a href="#">
                      <div class="task-info">
                          <div class="desc">Mobile App</div>
                          <div class="percent">33%</div>
                      </div>
                      <div class="progress progress-striped">
                          <div style="width: 33%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar progress-bar-danger">
                              <span class="sr-only">33% Complete (danger)</span>
                          </div>
                      </div>
                  </a>
              </li>
              <li>
                  <a href="#">
                      <div class="task-info">
                          <div class="desc">Dashboard v1.3</div>
                          <div class="percent">45%</div>
                      </div>
                      <div class="progress progress-striped active">
                          <div style="width: 45%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="45" role="progressbar" class="progress-bar">
                              <span class="sr-only">45% Complete</span>
                          </div>
                      </div>

                  </a>
              </li>
              <li class="external">
                  <a href="#">See All Tasks</a>
              </li>
          </ul>
      </div>
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
