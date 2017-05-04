<?php
	require_once("header.php");
	require_once("class.teach.php");
 if (isset($_GET['test']) && $_GET['test'] == "delete")
 {
	 $d= new USER();
	 $idd=$_GET['id'];
	 $d->delPara($idd);
}
$poi=$auth_user->runQuery("SELECT * FROM yomi_abittoteach INNER JOIN abit_infotbl ON yomi_abittoteach.id_abit=abit_infotbl.id WHERE yomi_abittoteach.id_prep=:id_prep");
$poi->execute(array(":id_prep"=>$_SESSION['toteach']));
if($poi->rowCount()==0)
{
	$err="Вы еще не выбрали абитуриентов ";
}

	 ?>
  <div class="container" style="margin-top:80px;">
      <div class="row">
				<div id="error">
		    <?php
if (isset($err))
{
		    ?>
				<div class="alert alert-success">
							<strong><?php echo $err?>.</strong> Перейдите <a href="abitlist.php" class="alert-link">по данной ссылке</a> для добавления студентов.
										</div>
		            <?php
}
		  ?>
		</div>
  		  <div class="col-md-12">
        <h1 class="text-center h1-tbl">Список моих студентов</h1>
        <div class="table-responsive right-side1">
            <?php
            $poi=$auth_user->runQuery("SELECT * FROM yomi_abittoteach INNER JOIN abit_infotbl ON yomi_abittoteach.id_abit=abit_infotbl.id WHERE yomi_abittoteach.id_prep=:id_prep");
            $poi->execute(array(":id_prep"=>$_SESSION['toteach']));

            if($poi->rowCount() > 0)
            { echo '<form method="post" action="">';
              echo '<table class="table table-bordred table-striped">';
              echo '<thead>';
              echo '<th>Фамилия</th>';
              echo '<th>Имя</th>';
              echo '<th>Отчество</th>';
              echo '<th>Редактирование</th>';
							echo '<th>Удаление</th>';
              echo '</thead>';
              echo '<tbody>';
                while($tY=$poi->fetch(PDO::FETCH_ASSOC))
                  {
                  echo '<tr>';
                  echo '<td>' .$tY['full_name'].'</td>';
                  echo '<td>'.$tY['name'].'</td>';
                  echo '<td>' .$tY['sec_name']. '</td>';
                  echo '<td><a href="abitcompletetest.php?saw=true&id='.$tY['id_abit'].'" class="btn btn-info btn-block" name="txt_saw" value="'.$tY['id_abit'].'">Просмотреть результаты<span class="glyphicon glyphicon-book"></span></button></td>';
									echo '<td><a href="myabit.php?test=delete&id='.$tY['id_par'].'" class="btn btn-danger btn-block" name="txt_delete">Удалить<span class="glyphicon glyphicon-fire"></span></a></td>';
                  echo '</tr>';
									}
               echo '</tbody>';
               echo '</table>';
                 }


        ?>

              </div>

          </div>
  	</div>
  </div>
  <script src="bootstrap/js/bootstrap.min.js"></script>


  </body>
  </html>
