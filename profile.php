<?php require_once("header.php"); ?>
<?php
$infoup=new USER();
$user_id = $_SESSION['user_session'];
$currentuser = $_SESSION['username_session'];
if (isset($_POST['txt_save']))
{
$ufullname = strip_tags($_POST['txt_fullname']);
$uname = strip_tags($_POST['txt_name']);
$usecname = strip_tags($_POST['txt_secname']);
$uemail = strip_tags($_POST['txt_email']);
$ustep = strip_tags($_POST['txt_step']);
$ulang = strip_tags($_POST['txt_lang']);
if ($infoup->checkabit($currentuser)==false)
{
$infoup->insertAbit($ufullname,$uname,$usecname,$ustep,$ulang,$currentuser);
$infoup->changeEmail($uemail,$user_id);
}
else
{
$infoup->updateAbit($ufullname,$uname,$usecname,$ustep,$ulang,$currentuser);
$infoup->changeEmail($uemail,$user_id);
}
}
if (isset($_POST['txt_savet']))
{
$ufullname = strip_tags($_POST['txt_fullname']);
$uname = strip_tags($_POST['txt_name']);
$usecname = strip_tags($_POST['txt_secname']);
$uemail = strip_tags($_POST['txt_email']);
$udol = strip_tags($_POST['txt_dol']);
$uuch = strip_tags($_POST['txt_uch']);
if ($infoup->checkteach($currentuser)==false)
{
$infoup->insertTeach($ufullname,$uname,$usecname,$udol,$uuch,$currentuser);
$infoup->changeEmail($uemail,$user_id);
}
else
{
$infoup->updateTeach($ufullname,$uname,$usecname,$udol,$uuch,$currentuser);
$infoup->changeEmail($uemail,$user_id);
}
}
if ($userRow['role']=="Абитуриент")
{
	$auth_u= new USER();
	$st = $auth_u->runQuery("SELECT * FROM users INNER JOIN userrole ON users.user_name=userrole.user INNER JOIN abit_infotbl ON userrole.user=abit_infotbl.login WHERE user_id=:user_id");
	$st->execute(array(":user_id"=>$user_id));
	$userRo=$st->fetch(PDO::FETCH_ASSOC);
include 'abit_prof.php';
}

if ($userRow['role']=="Преподаватель")
{
	$auth_u= new USER();
	$st = $auth_u->runQuery("SELECT * FROM users INNER JOIN userrole ON users.user_name=userrole.user INNER JOIN teach_infotbl ON userrole.user=teach_infotbl.login WHERE user_id=:user_id");
	$st->execute(array(":user_id"=>$user_id));
	$userRo=$st->fetch(PDO::FETCH_ASSOC);
	include 'teach_prof.php';
}


?>
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
