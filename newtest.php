<?php
	require_once("header.php");
  require_once("class.teach.php");
	$newtes =  new TEACH();

	  if(isset($_POST['txt_savetestname']))
	{
		$nametest=$_POST['txt_testname'];
    $curr=$newtes->currentPrep($user_id);
		$_SESSION['curr_test']=$newtes->newTest($nametest,$curr);
    $yui=$_SESSION['curr_test'];
	}

 if (isset($_POST['txt_savetest']))
 {
	 $count_questname=count($_POST['txt_questname']);
   $newtes->insertCount($count_questname,$_SESSION['curr_test']);
	 for ($i=0; $i <$count_questname ; $i++)
 {
	 $quest=$_POST['txt_questname'][$i];
   $last_quest=$newtes->newQuest($quest,$_SESSION['curr_test']);
	 for ($j=1;$j<5;$j++)
	 {
		 $ans=$_POST['txt_ans'.$j.''][$i];
		 $ansp=$_POST['txt_ans'.$j.'p'][$i];
     $newtes->newAnswer($ans,$last_quest,$ansp);
	 }


 }
 unset($_SESSION['curr_test']);

 }
	 ?>
  <div class="panel panel-default" style="margin-top:80px;">
    <div class="panel-heading">Добавление нового тестирования</div>
    <?php
  if ($_SESSION['curr_test'])
	{
		$stmt=$newtes->runQuery("SELECT name_test FROM yomi_testname WHERE id_test=:id_test");
		$stmt->execute(array(":id_test"=>$_SESSION['curr_test']));
		$uR=$stmt->fetch(PDO::FETCH_ASSOC);
		include 'newtestq.php';
	}
		else
		{
			include 'newtestn.php';}

		?>


<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="func.js"></script>

</body>
</html>
