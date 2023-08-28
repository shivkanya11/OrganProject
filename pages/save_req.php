<?php

include('lock.php');
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
	$r_name=$_POST['r_name'];
	$r_cont	=$_POST['r_cont'];
	$r_email=$_POST['r_email'];
	$r_age=$_POST['r_age'];
	$r_bgrp=$_POST['r_bgrp'];
	$r_gender=$_POST['r_gender'];
	$r_addr=$_POST['r_addr'];
	$r_ondt=strtotime(date("d-m-Y"));
	$r_organ=implode(',', $_POST['rq1']);
	$r_flag="1";
	
			if($auth_user->addreq($r_name, $r_cont, $r_email, $r_age, $r_bgrp, $r_gender, $r_addr, $r_organ, $r_ondt, $r_flag, $user_id))
				{	
				echo "Success" ;
				}
				else
				{
					echo "Fails upload ";
				}
}
?>