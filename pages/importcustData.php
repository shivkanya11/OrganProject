<?php
ini_set('max_execution_time', '0'); // for infinite time of execution 
require_once("lock.php");
if(isset($_POST['importSubmit'])){
    //validate whether uploaded file is a csv file
    $csvMimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
	$_FILES['file']['type'];
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)){
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            //open uploaded csv file with read only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            //skip first line
            fgetcsv($csvFile);
            //parse data from csv file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
			$gdate=$line[0];
			$gyear=$line[1];
			$gmonth=$line[2];
			$gcage=$line[3];
			$gcgender=$line[4];
			$gcontry=$line[5];
			$gstate=$line[6];
			$gpcat=$line[7];
			$gpscat=$line[8];
			$gqty=$line[9];
			$guntcost=$line[10];
			$guntprice=$line[11];
			$gtotal=$line[12];
			$grevenue=$line[13];
			$org_id=1;
			$gflag=1;
			$user_id=$userRow['ad_id'];
			$insitm=$auth_user->addgrf($gdate, $gyear, $gmonth, $gcage, $gcgender, $gcontry, $gstate, $gpcat, $gpscat, $gqty, $guntcost, $guntprice, $gtotal, $grevenue, $gflag, $user_id);
            }
            fclose($csvFile);
          echo  $qstring = '?status=succ';
        }else{
          echo  $qstring = '?status=err';
        }
    }else{
      echo  $qstring = '?status=invalid_file';
    }
}

//redirect to the listing page
header("Location: certi.php".$qstring);