<?php
 require_once('header.php');
 require_once('class.teach.php');
 $edittest= new TEACH();
if (isset($_POST['txt_change']))
 {
	 $testid=$_POST['txt_change'];
   $_SESSION['current_test']=$testid;
 };

if (isset($_POST['del_que']))
	{
		$delid=$_POST['del_que'];
$edittest->delQuest($delid);
	};

	if (isset($_POST['savetest']))
		{
			$newname=$_POST['txt_testname'];
      $edittest->updateTest($newname,$_SESSION['current_test']);
			$count_questname1=count($_POST['txt_1questname']);
	 	 for ($i=0; $i <$count_questname1 ; $i++)
	  {
	 	  $quest=$_POST['txt_1questname'][$i];
			$idquest=$_POST['id_1que'][$i];
	    $edittest->updateQuest($quest,$idquest);
	 	for ($j=1;$j<5;$j++)
	 	 {
	 		 $ans=$_POST['txt_1ans'.$j.''][$i];
	 		 $ansp=$_POST['txt_1ans'.$j.'p'][$i];
			 $id_answ=$_POST['id_1ans'.$j.''][$i];
	     $edittest->updateAnswer($ans,$id_answ,$ansp);
	 	 }
	  }

			$count_questname=count($_POST['txt_questname']);

			for ($q=0; $q <$count_questname ; $q++)
		{
			$quest=$_POST['txt_questname'][$q];
			$last_quest=$edittest->newQuest($quest,$_SESSION['current_test']);
			for ($j=1;$j<5;$j++)
			{
				$ans=$_POST['txt_ans'.$j.''][$q];
				$ansp=$_POST['txt_ans'.$j.'p'][$q];
				$edittest->newAnswer($ans,$last_quest,$ansp);
			}
		}
    $all=$count_questname+$count_questname1;
    $edittest->insertCount($all,$_SESSION['current_test']);
		}

if (isset($_POST['easy_back'])) {
	unset($_SESSION['current_test']);
}

?>
   <div class="container-fluid" style="margin-top:80px;position:center">
 	    <div class="container">
<?php
$re= new TEACH();
	$result =$re->runQuery("SELECT * FROM yomi_testname WHERE id_test=:id_prep");
	$result->execute(array(":id_prep"=>$_SESSION['current_test']));
	$uR=$result->fetch(PDO::FETCH_ASSOC);
	$testn=$uR['id_test'];
    echo '<form role="form" method="post" action="" enctype="multipart/form-data">';
    echo '<div class="form-group">';
	  echo '<input type="text" class="form-control" name="txt_testname" value="' .$uR['name_test'] .'" >';
	  echo '</div>';
	     $resu =$re->runQuery("SELECT yomi_testquest.name_quest,yomi_testquest.id_quest FROM yomi_testquest INNER JOIN yomi_testname ON yomi_testquest.id_test=yomi_testname.id_test WHERE yomi_testquest.id_test=:id_test");
       $resu->execute(array(":id_test"=>$testn));
       $countq=$resu->rowCount();
         while ($lkj=$resu->fetch(PDO::FETCH_ASSOC))
           {
						 	$testq=$lkj['id_quest'];
							echo '<div class="col-sm-4 nopadding">';
							echo '<div class="form-group">';
							echo '<div class="input-group">';
              echo '<span class="input-group-btn glyphicon glyphicon-remove">';
              echo '<button class="btn btn-danger" value="'.$testq.'" name="del_que">Удалить!</button>';
              echo '</span>';
							echo '<input type="text" class="form-control"  name="txt_1questname[]" value="'.$lkj['name_quest'].'" required>';
							echo '<input type="hidden" name="id_1que[]" value="'.$lkj['id_quest'].'"></input>';
              echo '</div>';
							echo '</div>';
							echo '</div>';
							   $resul=$re->runQuery("SELECT * FROM yomi_testanswer
								 INNER JOIN yomi_testquest ON yomi_testanswer.id_quest=yomi_testquest.id_quest
								 WHERE yomi_testanswer.id_quest=:id_quest");
	 						   $resul->execute(array(":id_quest"=>$testq));
								 $countdo=1;
								 	while ($jkl=$resul->fetch(PDO::FETCH_ASSOC))
										{
	 										if ($countdo<5)
												{
													echo '<div class="col-sm-2 nopadding">';
													echo '<div class="form-group">';
													echo '<div class="input-group">';
													echo '<input type="text" class="form-control" name="txt_1ans'.$countdo.'[]" value="'.$jkl['name_answer'].'" required>';
													echo '<input type="hidden" name="id_1ans'.$countdo.'[]" value="'.$jkl['id_answer'].'"></input>';
													echo '<input type="text" class="form-control"  name="txt_1ans'.$countdo.'p[]" value="'.$jkl['procent'].'">';
													echo '</div>';
													echo '</div>';
													echo '</div>';
													$countdo++;
												}
										};
						}
echo '<div class="clear"></div>';
echo '<div id="education_fields">';
echo '</div>';
echo '<button class="btn btn-warning btn-block" type="button" onclick="education_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>';
 echo '<button class="btn btn-success btn-block" type="submit"name="savetest">Сохранить</button>';
  echo '<a href="testlist.php" class="btn btn-info btn-block" name="easy_back">Вернуться</a>';
 echo '</form>';
?>

 <script src="bootstrap/js/bootstrap.min.js"></script>
 <script src="func.js"></script>
 </body>
 </html>
