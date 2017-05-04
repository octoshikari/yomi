<?php
	require_once("session.php");
	require_once("class.user.php");
	$auth_user = new USER();
	$user_id = $_SESSION['user_session'];

	$stmt = $auth_user->runQuery("SELECT * FROM users INNER JOIN userrole ON users.user_name=userrole.user WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	$mnb=$auth_user->runQuery("SELECT * FROM teach_infotbl INNER JOIN users ON teach_infotbl.login=users.user_name WHERE users.user_id=:user_id");
  $mnb->execute(array(":user_id"=>$user_id));
  $bnm=$mnb->fetch(PDO::FETCH_ASSOC);
  $mn=$bnm['id'];
  $_SESSION['toteach']=$mn;

 if ($userRow['role']=="Абитуриент")
 {
	$zxc=$auth_user->runQuery("SELECT abit_infotbl.id FROM abit_infotbl INNER JOIN users ON abit_infotbl.login=users.user_name WHERE users.user_id=:user_id");
	$zxc->execute(array(":user_id"=>$user_id));
	$cxz=$zxc->fetch(PDO::FETCH_ASSOC);
	$_SESSION['curr_abit']=$cxz['id'];
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
<link rel="stylesheet" href="stylef.css" type="text/css"/>


<title>Добро пожаловать - <?php print($userRow['user_name']); ?></title>
</head>

<body>
<nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="home.php" >Виртуальный Тренажер</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
						 <?php
              if ($userRow['role']=="Абитуриент")
							{
                echo '<li><a  href="globaltestlist.php" class="navbar-btn  navtxt">Список тестов</a></li>';
							 	 echo '<li><a href="mycomplete.php" class="navbar-btn  navtxt" >Мои результаты</a></li>';
							}
							elseif ($userRow['role']=="Преподаватель")
							{
								echo '<li><a href="testlist.php" class="navbar-btn navtxt">Список моих тестов</a></li>';
								echo '<li><a href="newtest.php" class="navbar-btn  navtxt">Новый тест</a></li>';
								echo '<li><a href="abitlist.php" class="navbar-btn navtxt">Список студентов</a></li>';
								echo '<li><a href="myabit.php" class="navbar-btn  navtxt">Мои студенты</a></li>';
							}
							elseif ($userRow['role']=="Администратор")
							{
								echo '<li><a href="newuserlist.php" class="navbar-btn navtxt">Новые пользователи</a></li>';

							}
					 ?>


          </ul>
          <ul class="nav navbar-nav navbar-right">
						<li><a href="profile.php" class="btn-deep-purple1 navbar-btn  navtxt"><span class="glyphicon glyphicon-user"></span>&nbsp;Профиль</a></li>
						<li><a href="logout.php?logout=true" class="navbar-btn  navtxt"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Выйти</a></li>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
