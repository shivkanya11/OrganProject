<?php
require_once('config/dbconfig.php');

class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function userchk($uname,$umail)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM admin WHERE ad_name=:uname OR ad_email=:umail ");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$userchk=$stmt->fetch(PDO::FETCH_ASSOC);
			return $userchk;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function register($uname,$umail,$ucont,$uaddr,$upass,$ad_flag)
	{
		try
		{
			
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
			
			$stmt = $this->conn->prepare("INSERT INTO admin (ad_name,ad_email,ad_cont,ad_addr,ad_pass,ad_flag) 
		                                               VALUES(:uname, :umail, :ucont, :uaddr, :upass, :ad_flag)");
												  
			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":ucont", $ucont);
			$stmt->bindparam(":uaddr", $uaddr);
			$stmt->bindparam(":upass", $new_password);										  
			$stmt->bindparam(":ad_flag", $ad_flag);		
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	
	public function doLogin($uname,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM admin WHERE ad_email=:uname");
			$stmt->execute(array(':uname'=>$uname));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				if(password_verify($upass, $userRow['ad_pass']))
				{
				$myusername=$userRow['ad_email'];
				$myuser_id=$userRow['ad_id'];
				$salt=hash("sha512", rand() . rand() . rand());
				setcookie("a_user", hash("sha512", $myusername), time() + 24 * 60 * 60, "/");
				setcookie("a_salt", $salt,  time() + 24 * 60 * 60, "/");
				//return $salt;
				return array('salt'=>$salt, 'ad_id'=>$myuser_id);
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function updsalt($slt,$sluid)
	{
		try
		{
			$stmt = $this->conn->prepare("UPDATE admin SET salt =:slt WHERE ad_id =:sluid");
			$stmt->bindparam(":slt", $slt);
			$stmt->bindparam(":sluid", $sluid);	
			$stmt->execute();
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	public function updtreq($ad_id, $r_id)
	{
		try
		{
			$stmt = $this->conn->prepare("UPDATE requester SET acc_to = :ad_id WHERE r_id = :r_id");
			$stmt->bindparam(":ad_id", $ad_id);
			$stmt->bindparam(":r_id", $r_id);	
			$stmt->execute();
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	public function is_loggedin()
	{
		if(isset($_COOKIE["a_user"])  && isset($_COOKIE["a_salt"]))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function doLogout()
	{
		$cuser=$_COOKIE["a_user"]; 
		$csalt=$_COOKIE["a_salt"];
		setcookie("a_user", $cuser, time() - 24 * 60 * 60, "/");
		setcookie("a_salt", $csalt,  time() - 24 * 60 * 60, "/");
		return true;
	}
	
	//add history
	public function addgrf($gdate, $gyear, $gmonth, $gcage, $gcgender, $gcontry, $gstate, $gpcat, $gpscat, $gqty, $guntcost, $guntprice, $gtotal, $grevenue, $gflag, $user_id)
	{
		try
		{
			$stmt = $this->conn->prepare("INSERT INTO graph_his (gdate, gyear, gmonth, gcage, gcgender, gcontry, gstate, gpcat, gpscat, gqty, guntcost, guntprice, gtotal, grevenue, gflag, user_id) VALUES (:gdate, :gyear, :gmonth, :gcage, :gcgender, :gcontry, :gstate, :gpcat, :gpscat, :gqty, :guntcost, :guntprice, :gtotal, :grevenue, :gflag, :user_id)");
												  
			$stmt->bindparam(":gdate", $gdate);
			$stmt->bindparam(":gyear", $gyear);
			$stmt->bindparam(":gmonth", $gmonth);	
			$stmt->bindparam(":gcage", $gcage);
			$stmt->bindparam(":gcgender", $gcgender);
			$stmt->bindparam(":gcontry", $gcontry);
			$stmt->bindparam(":gstate", $gstate);
			$stmt->bindparam(":gpcat", $gpcat);
			$stmt->bindparam(":gpscat", $gpscat);
			$stmt->bindparam(":gqty", $gqty);
			$stmt->bindparam(":guntcost", $guntcost);
			$stmt->bindparam(":guntprice", $guntprice);	
			$stmt->bindparam(":gtotal", $gtotal);	
			$stmt->bindparam(":grevenue", $grevenue);
			$stmt->bindparam(":gflag", $gflag);
			$stmt->bindparam(":user_id", $user_id);
			$stmt->execute();
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
		public function fetchgrf($user_id)
	{
		try
		{
	        $stmt = $this->conn->prepare("SELECT * FROM graph_his WHERE user_id=:user_id AND gflag='1'");
			$stmt->execute(array(':user_id'=>$user_id));
			$fetchhis=$stmt->fetchAll(PDO::FETCH_ASSOC);
			return $fetchhis;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}	
	}
	
	public function getdonner()
	{
		try
		{
	        $stmt = $this->conn->prepare("SELECT d.*, a.ad_name FROM donner d,admin a WHERE a.ad_id=d.ad_id AND d.d_flag='1' AND d.d_exdt != 'null'");
			$stmt->execute();
			$getdonner=$stmt->fetchAll(PDO::FETCH_ASSOC);
			return $getdonner;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}	
	}
	
	public function getrequester()
	{
		try
		{
	        $stmt = $this->conn->prepare("SELECT r.*, a.ad_name FROM requester r,admin a WHERE a.ad_id=r.ad_id  AND r.r_flag='1' AND r.r_ondt != 'null' ORDER BY r.r_id DESC");
			$stmt->execute();
			$getdonner=$stmt->fetchAll(PDO::FETCH_ASSOC);
			return $getdonner;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}	
	}
	//add director team
	public function addteam($d_name,$d_desc,$dtype,$filename,$ntime,$dflag)
	{
		try
		{
			$stmt = $this->conn->prepare("INSERT INTO d_team (dt_name, dt_desc, dt_type, dt_img, dt_time, dt_flag) VALUES (:d_name, :d_desc, :dtype, :filename, :ntime, :dflag)");
												  
			$stmt->bindparam(":d_name", $d_name);
			$stmt->bindparam(":d_desc", $d_desc);
			$stmt->bindparam(":dtype", $dtype);	
			$stmt->bindparam(":filename", $filename);
			$stmt->bindparam(":ntime", $ntime);
			$stmt->bindparam(":dflag", $dflag);
			$stmt->execute();
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	//add certificates AND AWARDS
	public function adddonner($d_name, $d_cont, $d_email, $d_age, $d_bgrp, $d_gender, $d_addr, $d_organ, $d_exdt, $d_flag, $user_id)
	{
		try
		{
			$stmt = $this->conn->prepare("INSERT INTO donner (d_name, d_cont, d_email, d_age, d_bgrp, d_gender, d_addr, d_organ, d_exdt, d_flag, ad_id) VALUES (:d_name, :d_cont, :d_email, :d_age, :d_bgrp, :d_gender, :d_addr, :d_organ, :d_exdt, :d_flag, :user_id)");
												  
			$stmt->bindparam(":d_name", $d_name);	
			$stmt->bindparam(":d_cont", $d_cont);
			$stmt->bindparam(":d_email", $d_email);
			$stmt->bindparam(":d_age", $d_age);
			$stmt->bindparam(":d_bgrp", $d_bgrp);
			$stmt->bindparam(":d_gender", $d_gender);
			$stmt->bindparam(":d_addr", $d_addr);
			$stmt->bindparam(":d_organ", $d_organ);
			$stmt->bindparam(":d_exdt", $d_exdt);
			$stmt->bindparam(":d_flag", $d_flag);
			$stmt->bindparam(":user_id", $user_id);
			$stmt->execute();
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	public function addreq($r_name, $r_cont, $r_email, $r_age, $r_bgrp, $r_gender, $r_addr, $r_organ, $r_ondt, $r_flag, $user_id)
	{
		try
		{
			$stmt = $this->conn->prepare("INSERT INTO requester (r_name, r_cont, r_email, r_age, r_bgrp, r_gender, r_addr, r_organ, r_ondt, r_flag, ad_id) VALUES (:r_name, :r_cont, :r_email, :r_age, :r_bgrp, :r_gender, :r_addr, :r_organ, :r_ondt, :r_flag, :user_id)");
												  
			$stmt->bindparam(":r_name", $r_name);	
			$stmt->bindparam(":r_cont", $r_cont);
			$stmt->bindparam(":r_email", $r_email);
			$stmt->bindparam(":r_age", $r_age);
			$stmt->bindparam(":r_bgrp", $r_bgrp);
			$stmt->bindparam(":r_gender", $r_gender);
			$stmt->bindparam(":r_addr", $r_addr);
			$stmt->bindparam(":r_organ", $r_organ);
			$stmt->bindparam(":r_ondt", $r_ondt);
			$stmt->bindparam(":r_flag", $r_flag);
			$stmt->bindparam(":user_id", $user_id);
			$stmt->execute();
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	//add Products
	public function addproducts($p_name,$p_short,$p_type,$filename,$ntime,$dflag)
	{
		try
		{
			$stmt = $this->conn->prepare("INSERT INTO product ( pr_type, pr_name, pr_short, pr_img, pr_time, pr_flag) VALUES (:p_type, :p_name, :p_short, :filename, :ntime, :dflag)");
												  
			$stmt->bindparam(":p_name", $p_name);
			$stmt->bindparam(":p_short", $p_short);
			$stmt->bindparam(":p_type", $p_type);
			$stmt->bindparam(":filename", $filename);
			$stmt->bindparam(":ntime", $ntime);
			$stmt->bindparam(":dflag", $dflag);
			$stmt->execute();
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	//add Media
	public function addmedia($m_link,$filename,$ntime,$dflag)
	{
		try
		{
			$stmt = $this->conn->prepare("INSERT INTO media (m_link, m_img, m_time, m_flag) VALUES (:m_link, :filename, :ntime, :dflag)");		  
			$stmt->bindparam(":m_link", $m_link);	
			$stmt->bindparam(":filename", $filename);
			$stmt->bindparam(":ntime", $ntime);
			$stmt->bindparam(":dflag", $dflag);
			$stmt->execute();
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	//add job opening
	public function addjob($desi,$j_desc,$loc,$j_quali,$j_skill,$j_expi,$nop,$ntime,$n_flag)
	{
		try
		{
			$stmt = $this->conn->prepare("INSERT INTO job (j_desc, j_desi, j_quli, j_skill, j_expri, j_nop, j_time, j_flag) VALUES (:j_desc, :desi, :j_quali, :j_skill, :j_expi, :nop, :ntime, :n_flag)");		  
			$stmt->bindparam(":j_desc", $j_desc);	
			$stmt->bindparam(":desi", $desi);
			$stmt->bindparam(":j_quali", $j_quali);
			$stmt->bindparam(":j_skill", $j_skill);
			$stmt->bindparam(":j_expi", $j_expi);
			$stmt->bindparam(":nop", $nop);
			$stmt->bindparam(":ntime", $ntime);
			$stmt->bindparam(":n_flag", $n_flag);
			$stmt->execute();
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	// fetch parent tab
	public function shwtab()
	{
		try
		{
	        $stmt = $this->conn->prepare("SELECT * FROM finan where parent= 0");
			$stmt->execute();
			$shwtab=$stmt->fetchAll(PDO::FETCH_ASSOC);
			return $shwtab;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}	
	}
	
	public function shwsubtab($parent)
	{
		try
		{
	        $stmt = $this->conn->prepare("SELECT * FROM finan where parent=:parent");
			$stmt->execute(array(':parent'=>$parent));
			$shwsubtab=$stmt->fetchAll(PDO::FETCH_ASSOC);
			return $shwsubtab;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}	
	}
	
		public function units()
	{
		try
		{
	        $stmt = $this->conn->prepare("SELECT * FROM units where un_flag='1'");
			$stmt->execute();
			$units=$stmt->fetchAll(PDO::FETCH_ASSOC);
			return $units;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}	
	}
	
		public function department()
	{
		try
		{
	        $stmt = $this->conn->prepare("SELECT * FROM department where dept_flag='1'");
			$stmt->execute();
			$units=$stmt->fetchAll(PDO::FETCH_ASSOC);
			return $units;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}	
	}
	
	// add tabs
		public function addtab($fi_head,$parent,$fi_flag)
	{
		try
		{
			$stmt = $this->conn->prepare("INSERT INTO finan (fi_head, parent, fi_flag) VALUES (:fi_head, :parent, :fi_flag)");
												  
			$stmt->bindparam(":fi_head", $fi_head);
			$stmt->bindparam(":parent", $parent);
			$stmt->bindparam(":fi_flag", $fi_flag);	
			$stmt->execute();
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	//add pdf reports
	public function addreport($rep_name,$parent,$subtab,$exname,$ttime,$rflag)
	{
		try
		{
			$stmt = $this->conn->prepare("INSERT INTO report ( rep_name, parent, subtab, rep_file, rep_time, rep_flag) VALUES (:rep_name, :parent, :subtab, :exname, :ttime, :rflag)");
												  
			$stmt->bindparam(":rep_name", $rep_name);
			$stmt->bindparam(":parent", $parent);
			$stmt->bindparam(":subtab", $subtab);
			$stmt->bindparam(":exname", $exname);
			$stmt->bindparam(":ttime", $ttime);
			$stmt->bindparam(":rflag", $rflag);
			$stmt->execute();
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
}
?>