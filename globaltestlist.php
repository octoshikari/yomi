<?php
	require_once("header.php");
	require_once("class.teach.php");

  	 ?>
  <div class="container" style="margin-top:80px;">
  		  <div class="col-md-12">
        <h1 class="text-center h1-tbl">Список тестов</h1>
        <div class="table-responsive right-side1">
            <?php
            $poi=$auth_user->runQuery("SELECT * FROM yomi_testname
							INNER JOIN teach_infotbl ON yomi_testname.id_prep=teach_infotbl.id
							INNER JOIN userrole ON teach_infotbl.login=userrole.user
							INNER JOIN users ON userrole.user=users.user_name
							INNER JOIN yomi_abittoteach ON yomi_testname.id_prep=yomi_abittoteach.id_prep WHERE yomi_abittoteach.id_abit=:id_prep");
            $poi->execute(array(":id_prep"=>$_SESSION['curr_abit']));

            if($poi->rowCount() > 0)
            { echo '<form method="post" action="solvetest.php">';
              echo '<table class="table table-bordred table-striped">';
              echo '<thead>';
              echo '<th>Название теста</th>';
              echo '<th>Ф.И.О преподавателя</th>';
              echo '<th>Прохождение</th>';
              echo '</thead>';
              echo '<tbody>';
                while($tY=$poi->fetch(PDO::FETCH_ASSOC))
                  { $hgf=$auth_user->runQuery("SELECT id_test FROM yomi_testresult WHERE id_test=:id_test AND id_abit=:id_abit");
										$hgf->execute(array(":id_test"=>$tY['id_test'],":id_abit"=>$_SESSION['curr_abit']));
										$fgh=$hgf->fetch(PDO::FETCH_ASSOC);
										if ($hgf->rowCount() == 0)
										{
									echo '<tr>';
                  echo '<td>' .$tY['name_test']. '</td>';
                  echo '<td>' .$tY['full_name'].' '.$tY['name'].' ' .$tY['sec_name']. '</td>';
                  echo '<td><button class="btn btn-info btn-block" type="submit" name="txt_go" value="'.$tY['id_test'].'">Пройти тестирование<span class="glyphicon glyphicon-play"></span></button></td>';
								  echo '</tr>';
									}
								}
               echo '</tbody>';
               echo '</table>';
                 }

        ?>

              </div>

          </div>
  </div>
  <script src="bootstrap/js/bootstrap.min.js"></script>


  </body>
  </html>
