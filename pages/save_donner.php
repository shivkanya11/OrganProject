<?php
error_reporting(0);
include('lock.php');
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
	$d_name=$_POST['d_name'];
	$d_cont	=$_POST['d_cont'];
	$d_email=$_POST['d_email'];
	$d_age=$_POST['d_age'];
	$d_bgrp=$_POST['d_bgrp'];
	$d_gender=$_POST['d_gender'];
	$d_addr=$_POST['d_addr'];
	$d_exdt=strtotime($_POST['ex_dt']);
	$d_organ=implode(',', $_POST['q1']);
	$d_flag="1";
				if($auth_user->adddonner($d_name, $d_cont, $d_email, $d_age, $d_bgrp, $d_gender, $d_addr, $d_organ, $d_exdt, $d_flag, $user_id))
				{	
				echo "Success" ;
				}
				else
				{
					echo "Fails upload ";
				}
}
?>