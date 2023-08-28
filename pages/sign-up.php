<?php
session_start();
require_once("controller/class.user.php");
$user = new USER();

if($user->is_loggedin()!="")
{
	$user->redirect('home.php');
}

if(isset($_POST['btn-signup']))
{
	$uname = strip_tags($_POST['txt_uname']);
	$umail = strip_tags($_POST['txt_umail']);
	$ucont = strip_tags($_POST['txt_cont']);
	$uaddr = strip_tags($_POST['txt_addr']);
	$upass = strip_tags($_POST['txt_upass']);	
	
	if($uname=="")	{
		$error[] = "provide username !";	
	}
	else if($umail=="")	{
		$error[] = "provide email id !";	
	}
	else if($ucont=="")	{
		$error[] = "provide Contact !";	
	}
	else if($uaddr=="")	{
		$error[] = "provide Contact !";	
	}
	else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
	    $error[] = 'Please Enter A Valid email address !';
	}
	else if($upass=="")	{
		$error[] = "provide password !";
	}
	else if(strlen($upass) < 6){
		$error[] = "Password must be atleast 6 characters";	
	}
	else
	{
		try
		{
			$row=$user->userchk($uname,$umail);
			if($row['ad_name']==$uname) {
				$error[] = "Sorry username already taken !";
			}
			else if($row['ad_email']==$umail) {
				$error[] = "Sorry email id already taken !";
			}
			else
			{
				$ad_flag="1";
				if($user->register($uname,$umail,$ucont,$uaddr,$upass,$ad_flag)){	
					$user->redirect('sign-up.php?joined');
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
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
	 <div id="error">
        <?php
			if(isset($error))
			{
			 	foreach($error as $error)
			 	{
					 ?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                     </div>
                     <?php
				}
			}
			else if(isset($_GET['joined']))
			{
				 ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='index.php'>login</a> here
                 </div>
                 <?php
			}
			?>
        </div>
				 <!-----start-main---->
				<div class="login-form">
				<div style="color: red; position: absolute; font-size: 15px; font-weight: 600; margin-top: -10px; margin-left: 35px; padding: 15px;"></div>
					<div style="color: red; position: absolute; font-size: 15px; font-weight: 600; margin-top: -10px; margin-left: 35px; padding: 15px;"></div>
					<div class="head" style="top: -32%;">
						<img src="views/img/ologo.png" alt=""/>
					</div>
					<form  method="POST">
						<input type="text" class="text" name="txt_uname" placeholder="Enter Hospital Name" value="" /><a href="#" class=" icon user"></a>
						<input type="text" class="text" name="txt_umail" placeholder="Enter Hospital E-Mail ID" value="" /><a href="#" class=" icon user"></a>
						<input type="text" class="text" maxlength="10" name="txt_cont" placeholder="Enter Hospital Contact" value="" /><a href="#" class="icon user"></a>
						<input type="text" class="text" name="txt_addr" placeholder="Enter Hospital Address" value="" /><a href="#" class=" icon user"></a>
						<input type="password" class="text" name="txt_upass" placeholder="Enter Password" /><a href="#" class="icon user"></a>
						<div class="p-container">
						<input type="submit" name="btn-signup" value="SignUp" >
						<div class="clear"> </div>
						</div>
					</form>
			</div>
			<!--//End-login-form-->
		  <!-----start-copyright---->
   					<div class="copy-right">
					<p>Already Register ? please <a href="index.php"> Login Here</a></p>
					</div>
				<!-----//end-copyright---->
		 		
</body>
</html>