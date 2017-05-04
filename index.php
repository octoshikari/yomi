<?php
session_start();
require_once("class.user.php");
$login = new USER();

if($login->is_loggedin()!="")
{
	$login->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
	$uname = strip_tags($_POST['txt_uname_email']);
	$umail = strip_tags($_POST['txt_uname_email']);
	$upass = strip_tags($_POST['txt_password']);

	if($login->doLogin($uname,$umail,$upass))
	{
		$login->redirect('home.php');
	}
	else
	{
		$error = "Не совпадает пара логин/пароль";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Вирт-Трен : Авторизация</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="stylef.css" type="text/css"  />
</head>
<body>

<div class="container" style="margin-top:70px;">
	<div class="row">
		<div class="container">
			<div class="col-sm-8 col-sm-offset-2 main">
				<div class="col-sm-6 left-side">
					<h1>Виртуальный<br>тренажер</h1>
					<p>словарного запаса по курсу информатики для иноязычных иностранных студентов</p>

        </div><!--col-sm-6-->
						<div class="col-sm-6 right-side">
									<!--Form with header-->
										<form class="form-sigin" method="post" action="">
											<h1>Авторизация</h1>
											<div id="error">
											<?php
										if(isset($error))
										{
											?>
															<div class="alert alert-danger">
																 <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
															</div>
															<?php
										}
										?>
									</div>
											<div class="form">
												<div class="form-group">
													<label for="form2">Введите логин или e-mail</label>
													<input type="text" id="form2" name="txt_uname_email" class="form-control">

												</div>
												<div class="form-group">
														<label for="form4">Введите ваш пароль</label>
															<input type="password" id="form4" name="txt_password" class="form-control">
												</div>
													<div class="text-xs-center">
														<div class="row">
													<button type="submit" name="btn-login" class="btn btn-deep-purple col-md-4"><i class="glyphicon glyphicon-log-in"></i> &nbsp;Войти</button>
	                        <a href="sign-up.php" class="btn btn-deep-green col-md-7">&nbsp; Зарегистрироваться</a>
												</div>
													</div>
											</div>
<!--/Form with header-->
									</form>
</div><!--col-sm-6-->


	</div><!--col-sm-8-->

	</div><!--container-->
</div>
</div>



</body>
</html>
