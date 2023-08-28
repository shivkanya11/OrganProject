<?php
	require_once("session.php");
	require_once("controller/class.user.php");
	$auth_user = new USER();
	$csalt=$_COOKIE["a_salt"];
	$stmt = $auth_user->runQuery("SELECT * FROM admin WHERE salt=:csalt");
	$stmt->execute(array(":csalt"=>$csalt));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    $user_id=$userRow['ad_id'];
?>