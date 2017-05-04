<?php
	require_once("session.php");
	require_once("class.user.php");
	$auth_user = new USER();
	$user_id = $_SESSION['user_session'];
	$stmt = $auth_user->runQuery("SELECT * FROM users INNER JOIN userrole ON users.user_name=userrole.user WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	if (isset($_GET['test']))
  {
		if($_GET['test'] == "delete")
		{
			 $idd=$_GET['id'];
	  	 $dd=$auth_user->runQuery("DELETE FROM users WHERE user_id=:user_id");
			 $dd->execute(array(":user_id"=>$idd));
		}
		elseif ($_GET['test'] == "update")
		{
			$idd=$_GET['id'];
			$dd=$auth_user->runQuery("UPDATE users SET dop=1 WHERE user_id=:user_id");
			$dd->execute(array(":user_id"=>$idd));
		}

 }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
<link rel="stylesheet" href="table.css" type="text/css"/>


<title>Добро пожаловать - <?php print($userRow['user_name']); ?></title>
</head>

<body>
	<div class="container-fluid" style="margin-top:80px;position:center">
	    <div class="container">
				<a href="home.php"> Вернуться на главную</a>
				<?php
					$req= new USER();
						$result =$req->runQuery("SELECT users.user_id,users.user_name, users.user_email, userrole.role FROM users
							INNER JOIN userrole ON users.user_name=userrole.user WHERE users.dop=0");
						$result->execute();
						if($result->rowCount() > 0){
							echo '<form action="" method="POST">';
							echo '<table border="1">';
 							echo '<thead>';
 							echo '<tr>';
 							echo '<th>Имя пользователя</th>';
 							echo '<th>Электронная почта</th>';
 							echo '<th>Роль</th>';
							echo '<th>Активировать</th>';
							echo '<th>Удалить</th>';
 							echo '</tr>';
 							echo '</thead>';
 							echo '<tbody>';
						    while($res = $result->fetch(PDO::FETCH_ASSOC)){
									echo '<tr>';
									echo '<td>' . $res['user_name'] . '</td>';
									echo '<td>' . $res['user_email'] . '</td>';
									echo '<td>' . $res['role'] . '</td>';
									echo '<td><a href="newuserlist.php?test=update&id='.$res['user_id'].'" class="btn btn-success btn-block" name="upd">Активировать<span class="glyphicon glyphicon-plus"></span></a></td>';
									echo '<td><a href="newuserlist.php?test=delete&id='.$res['user_id'].'" class="btn btn-danger btn-block" name="del">Удалить<span class="glyphicon glyphicon-fire"></span></a></td>';
									echo '</tr>';
						    }
								echo '</form>';
						}
			?>



	    </div>

	</div>


<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
