<?php
session_start();
require_once('class.user.php');
$user = new USER();

if($user->is_loggedin()!="")
{
	$user->redirect('home.php');
}

if(isset($_POST['btn-signup']))
{
	$uname = strip_tags($_POST['txt_uname']);
	$umail = strip_tags($_POST['txt_umail']);
	$upass = strip_tags($_POST['txt_upass']);
	$urole = strip_tags($_POST['txt_urole']);

	if($uname=="")	{
		$error[] = "Введите имя пользователя";
	}
	else if($umail=="")	{
		$error[] = "Введите email !";
	}
	else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
	    $error[] = 'Введи корректный email-адрес !';
	}
	else if($upass=="")	{
		$error[] = "Введите пароль !";
	}
	else if(strlen($upass) < 6){
		$error[] = "Пароль больше 6 символов";
	}
	else
	{
		try
		{
			$stmt = $user->runQuery("SELECT user_name, user_email FROM users WHERE user_name=:uname OR user_email=:umail");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);

			if($row['user_name']==$uname) {
				$error[] = "Имя пользователя занято!";
			}
			else if($row['user_email']==$umail) {
				$error[] = "Email-адрес уже используется!";
			}
			else
			{
				if($user->register($uname,$umail,$upass)){
					if ($user->regrole($uname,$urole)){
						$user->redirect('sign-up.php?joined');
					}
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Вирт-Трен : Регистрация</title>
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
						<?php
				 if(isset($error))
				 {
					 foreach($error as $error)
					 {
							?>
												<div class="alert alert-danger">
													 <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
												</div>
												<?php
					 }
				 }
				 else if(isset($_GET['joined']))
				 {
						?>
										<div class="alert alert-info">
												 <i class="glyphicon glyphicon-log-in"></i> &nbsp;Успешно! <a href='index.php'>Войдите</a> здесь
										</div>
										<?php
				 }
				 ?>

	        </div><!--col-sm-6-->
							<div class="col-sm-6 right-side">
										<!--Form with header-->
											<form class="form-sigin" method="post" action="">
												<h1>Регистрация</h1>
														<div class="form">
													            <div class="form-group">
													            <input type="text" class="form-control" name="txt_uname" placeholder="Введите логин" value="<?php if(isset($error)){echo $uname;}?>" />
													            </div>
													            <div class="form-group">
													            <input type="text" class="form-control" name="txt_umail" placeholder="Введите E-Mail" value="<?php if(isset($error)){echo $umail;}?>" />
													            </div>
													            <div class="form-group">
													            	<input type="password" class="form-control" name="txt_upass" placeholder="Введите пароль" />
													            </div>
																			<div class="form-group">
													            	<select class="form-control" name="txt_urole">
																					<option>Студент</option>
																					<option>Преподаватель</option>
																				</select>
													            </div>
														<div class="text-xs-center">
															<div class="row">
														<button type="submit" name="btn-signup" class="btn btn-deep-purple btn-block"><i class="glyphicon glyphicon-log-in"></i> &nbsp;Зарегистрироваться</button>
		                       			</div>
														</div>
														<br />
								            <label>Уже есть аккаунт? <a href="index.php">Войдите</a></label>

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
