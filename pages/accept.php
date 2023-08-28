<?php
error_reporting(0);
include('lock.php');
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
	$ad_id=$_POST['ad_id'];
	$r_id=$_POST['r_id'];
				if($auth_user->updtreq($ad_id, $r_id))
				{	
				echo "success" ;
				}
				else
				{
					echo "Fails upload ";
				}
}
?>