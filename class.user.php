<?php

require_once('dbconfig.php');

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

	public function register($uname,$umail,$upass)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);

			$stmt = $this->conn->prepare("INSERT INTO users(user_name,user_email,user_pass,dop)
		                                               VALUES(:uname, :umail, :upass,0)");

			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":upass", $new_password);
			$stmt->execute();
    	return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	public function regrole($uname,$urole)
	{
		try
		{
	  	$stmt = $this->conn->prepare("INSERT INTO userrole(user,role)
																							VALUES(:uname, :urole)");
			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":urole", $urole);
			$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	public function changeEmail($uemail,$uuserid)
	{
		try
		{
			$stmt = $this->conn->prepare("UPDATE users SET user_email=:uemail WHERE user_id=:user_id");
			$stmt->bindparam(":uemail", $uemail);
			$stmt->bindparam(":user_id", $uuserid);
			$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	public function updateAbit($ufullname,$uname,$usecname,$ustep,$ulang,$currentuser)
	{
		try
		{
				$st = $this->conn->prepare("UPDATE abit_infotbl SET full_name=:ufullname,name=:uname,sec_name=:usecname,lang=:ulang,st_lang=:ustep WHERE login=:login");
				$st->bindparam(":ufullname", $ufullname);
				$st->bindparam(":uname", $uname);
				$st->bindparam(":usecname", $usecname);
				$st->bindparam(":ulang", $ulang);
				$st->bindparam(":ustep", $ustep);
				$st->bindparam(":login", $currentuser);
				$st->execute();
				return $st;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

public function checkabit($currentuser)
{
	try
	{
		$stmt = $this->conn->prepare("SELECT login FROM abit_infotbl WHERE login=:login");
		$stmt->execute(array(':login'=>$currentuser));
				if($stmt->rowCount() == 0)
				{
return false;
				}
				else
				{
return true;
				}
	}
catch (Exception $e)
{
	echo $e->getMessage();
}


}
	public function insertAbit($ufullname,$uname,$usecname,$ustep,$ulang,$currentuser)
	{
		try
		{
			$st = $this->conn->prepare("INSERT INTO abit_infotbl (login,role,full_name,name,sec_name,lang,st_lang)
																									 VALUES(:ulogin,'Абитуриент', :ufullname, :uname,:usecname,:ulang,:ustep)");
			$st->bindparam(":ulogin", $currentuser);
			$st->bindparam(":ufullname", $ufullname);
			$st->bindparam(":uname", $uname);
			$st->bindparam(":usecname", $usecname);
			$st->bindparam(":ulang", $ulang);
			$st->bindparam(":ustep", $ustep);
			$st->execute();
			return $st;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	public function updateTeach($ufullname,$uname,$usecname,$uuch,$udol,$currentuser)
	{
		try
		{
				$st = $this->conn->prepare("UPDATE teach_infotbl SET full_name=:ufullname,name=:uname,sec_name=:usecname,uch_st=:ulang,dol=:ustep WHERE login=:login");
				$st->bindparam(":ufullname", $ufullname);
				$st->bindparam(":uname", $uname);
				$st->bindparam(":usecname", $usecname);
				$st->bindparam(":ulang", $uuch);
				$st->bindparam(":ustep", $udol);
				$st->bindparam(":login", $currentuser);
				$st->execute();
				return $st;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function checkteach($currentuser)
	{
	try
	{
		$stmt = $this->conn->prepare("SELECT login FROM teach_infotbl WHERE login=:login");
		$stmt->execute(array(':login'=>$currentuser));
				if($stmt->rowCount() == 0)
				{
	return false;
				}
				else
				{
	return true;
				}
	}
	catch (Exception $e)
	{
	echo $e->getMessage();
	}


	}
	public function insertTeach($ufullname,$uname,$usecname,$udol,$uuch,$currentuser)
	{
		try
		{
			$st = $this->conn->prepare("INSERT INTO teach_infotbl (login,role,full_name,name,sec_name,uch_st,dol)
																									 VALUES(:ulogin,'Преподаватель', :ufullname, :uname,:usecname,:ulang,:ustep)");
			$st->bindparam(":ulogin", $currentuser);
			$st->bindparam(":ufullname", $ufullname);
			$st->bindparam(":uname", $uname);
			$st->bindparam(":usecname", $usecname);
			$st->bindparam(":ulang", $uuch);
			$st->bindparam(":ustep", $udol);
			$st->execute();
			return $st;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
		public function doLogin($uname,$umail,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT user_id, user_name, user_email, user_pass,dop FROM users WHERE user_name=:uname OR user_email=:umail ");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				if ($userRow['dop']==0)
				{
					return false;
				}
				else
				{
				if(password_verify($upass, $userRow['user_pass']))
				{
					$_SESSION['user_session'] = $userRow['user_id'];
					$_SESSION['username_session'] = $userRow['user_name'];
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function doPara($id_prep,$id_abit)
	{
	try
	{
		$stmt=$this->conn->prepare("INSERT INTO yomi_abittoteach(id_prep,id_abit) VALUES(:id_prep,:id_abit)");
		$stmt->bindparam(":id_prep", $id_prep);
		$stmt->bindparam(":id_abit", $id_abit);
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
		if(isset($_SESSION['user_session']))
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
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}

public function delPara($id_para)
	  {
	   try
	   {
	     $st = $this->conn->prepare("DELETE FROM yomi_abittoteach WHERE id_par=:id_para");
	     $st->bindparam(":id_para", $id_para);
	     $st->execute();
	     return $st;
	   }
	   catch(PDOException $e)
	   {
	     echo $e->getMessage();
	   }
	  }


}
?>
