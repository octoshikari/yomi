<?php
 require_once('header.php');
 require_once('class.teach.php');
$re= new TEACH();

if (isset($_POST['txt_go'])) {
  $_SESSION['abit_test']=$_POST['txt_go'];
};

 ?>
   <div class="container-fluid" style="margin-top:80px;position:center">
 	    <div class="container">
<?php


	$result =$re->runQuery("SELECT * FROM yomi_testname WHERE id_test=:id_prep");
	$result->execute(array(":id_prep"=>$_POST['txt_go']));
	$uR=$result->fetch(PDO::FETCH_ASSOC);
	$testn=$uR['id_test'];
    echo '<form role="form" method="post" action="testresult.php" enctype="multipart/form-data">';
    echo '<h1 class="text-center h1-tbl">' .$uR['name_test'] .'</h1 >';

	     $resu =$re->runQuery("SELECT yomi_testquest.name_quest,yomi_testquest.id_quest FROM yomi_testquest INNER JOIN yomi_testname ON yomi_testquest.id_test=yomi_testname.id_test WHERE yomi_testquest.id_test=:id_test");
       $resu->execute(array(":id_test"=>$testn));
       $countq=$resu->rowCount();
$rad=0;
         while ($lkj=$resu->fetch(PDO::FETCH_ASSOC))
           {
             $rad++;
             if ($rad<=$countq)
             {
              echo '<div class="row">';
 						 	$testq=$lkj['id_quest'];
							echo '<div class="col-sm-4 left-side11 nopadding ">';
							echo '<div class="form-group">';
							echo '<p class="left-sidep">'.$rad. '. '.$lkj['name_quest'].'<p>';
              echo '<input type="hidden" name="id_que[]" value="'.$lkj['id_quest'].'"></input>';
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
                          echo '<div class="col-md-2 right-side11">';
                          echo '<div class="form-group">';
                          echo '<label>';
                          echo '<input type="radio" name="radios'.$rad.'" value="'.$jkl['id_answer'].'">';
                          echo $jkl['name_answer'];
                          echo '</label>';
  	                      echo '</div>';
                          echo '</div>';
 													$countdo++;
												}
										}
                    echo '</div>';
                    echo '</br>';

                  }
              }

echo '<div class="clear"></div>';
echo '<button class="btn btn-success btn-block" type="submit" name="but_save">Завершить тестирование</button>';
echo '</form>';
?>

 <script src="bootstrap/js/bootstrap.min.js"></script>

 </body>
 </html>
