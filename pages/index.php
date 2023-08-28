<?php
session_start();
require_once("controller/class.user.php");
$login = new USER();

if($login->is_loggedin()!="")
{
	$login->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
	$email = strip_tags($_POST['txt_uname_email']);
	$upass = strip_tags($_POST['txt_password']);
		
	if($salt=$login->doLogin($email,$upass))
	{
		$slt=$salt['salt'];
		$sluid=$salt['ad_id'];
		if($login->updsalt($slt,$sluid)){
		$login->redirect('home.php');
		}
	}
	else
	{
		$error = "Wrong Details !";
	}	
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>K-Admin</title>
		<meta charset="utf-8">
		<link href="views/css/klogin.css" rel='stylesheet' type='text/css' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!--webfonts-->
		<link href='//fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
		<!--//webfonts-->
</head>
<body>
        <?php
			if(isset($error))
			{
				?>
                <div class="alert alert-danger">
                    &nbsp; <?php echo $error; ?> !
                </div>
                <?php
			}
		?>
				 <!-----start-main---->
				<div class="login-form">
				<div style="color: red; position: absolute; font-size: 15px; font-weight: 600; margin-top: -10px; margin-left: 35px; padding: 15px;"></div>
					<div class="head">
						<img src="views/img/ologo.png" alt=""/>
					</div>
				<form  method="POST">
						<input class="text" type="text" value="" class="form-control" name="txt_uname_email" placeholder=" E mail ID" required><a href="#" class=" icon user"></a>
				
						<input type="password" value="" name="txt_password" placeholder="Your Password"><a href="#" class=" icon lock"></a>
					
					<div class="p-container">
								<input type="submit"  name="btn-login" value="Log In" >
							<div class="clear"> </div>
					</div>
				</form>
			</div>
			<!--//End-login-form-->
		  <!-----start-copyright---->
   					<div class="copy-right">
					<p>Not Register ? please <a href="sign-up.php"> Signup Here</a></p>
					</div>
				<!-----//end-copyright---->
		 		
</body>
</html>