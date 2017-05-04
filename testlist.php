<?php
	require_once("header.php");
	require_once("class.teach.php");
 if (isset($_GET['test']) && $_GET['test'] == "delete")
 {
	 $d= new TEACH();
	 $idd=$_GET['id'];
	 $d->delTest($idd);
}
$poi=$auth_user->runQuery("SELECT * FROM yomi_testname INNER JOIN teach_infotbl ON yomi_testname.id_prep=teach_infotbl.id INNER JOIN userrole ON teach_infotbl.login=userrole.user INNER JOIN users ON userrole.user=users.user_name WHERE users.user_id=:id_prep");
$poi->execute(array(":id_prep"=>$user_id));

if($poi->rowCount() == 0)
{
	$err="Вы еще не создали тестов";
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
							<strong><?php echo $err?>.</strong> Перейдите <a href="newtest.php" class="alert-link">по данной ссылке</a> для создания теста.
										</div>
								<?php
}
			?>
		</div>
  		  <div class="col-md-12">
        <h1 class="text-center h1-tbl">Список тестов</h1>
        <div class="table-responsive right-side1">
            <?php
            $poi=$auth_user->runQuery("SELECT * FROM yomi_testname INNER JOIN teach_infotbl ON yomi_testname.id_prep=teach_infotbl.id INNER JOIN userrole ON teach_infotbl.login=userrole.user INNER JOIN users ON userrole.user=users.user_name WHERE users.user_id=:id_prep");
            $poi->execute(array(":id_prep"=>$user_id));

            if($poi->rowCount() > 0)
            { echo '<form method="post" action="changetest.php">';
              echo '<table class="table table-bordred table-striped">';
              echo '<thead>';
              echo '<th>Название теста</th>';
              echo '<th>Ф.И.О преподавателя</th>';
              echo '<th>Редактирование</th>';
							echo '<th>Удаление</th>';
              echo '</thead>';
              echo '<tbody>';
                while($tY=$poi->fetch(PDO::FETCH_ASSOC))
                  {
                  echo '<tr>';
                  echo '<td>' .$tY['name_test']. '</td>';
                  echo '<td>' .$tY['full_name'].' '.$tY['name'].' ' .$tY['sec_name']. '</td>';
                  echo '<td><button class="btn btn-warning btn-block" type="submit" name="txt_change" value="'.$tY['id_test'].'">Редактировать<span class="glyphicon glyphicon-pencil"></span></button></td>';
									echo '<td><a href="testlist.php?test=delete&id='.$tY['id_test'].'" class="btn btn-danger btn-block" name="txt_delete">Удалить<span class="glyphicon glyphicon-fire"></span></a></td>';
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
