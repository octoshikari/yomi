<?php
require_once('header.php');
if ($userRow['role']=="Абитуриент")
{
$dfg=$auth_user->runQuery("SELECT * FROM abit_infotbl INNER JOIN users ON abit_infotbl.login=users.user_name WHERE users.user_id=:userid ");
$dfg->execute(array("userid"=>$user_id));
if($dfg->rowCount()==0)
{
  $err="Для дальнейшего пользования системой убедительно просим заполнить профиль. Ссылка на профиль находится в верхнем правом углу";
}
}
elseif ($userRow['role']=="Преподаватель")
{
$dfg=$auth_user->runQuery("SELECT * FROM teach_infotbl INNER JOIN users ON teach_infotbl.login=users.user_name WHERE users.user_id=:userid ");
$dfg->execute(array("userid"=>$user_id));
if($dfg->rowCount()==0)
{
  $err="Для дальнейшего пользования системой убедительно просим заполнить профиль. Ссылка на профиль находится в верхнем правом углу";
}
}

 ?>
<div class="clearfix"></div>
<div class="container-fluid" style="margin-top:80px;">
    <div class="container">
    <div id="error">
    <?php
  if(isset($err))
  {
    ?>
            <div class="alert alert-warning">
               <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $err; ?> !
            </div>
            <?php
  }
  ?>
    </div>

</div>

<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
