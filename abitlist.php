<?php
	require_once("header.php");
  $mnb=$auth_user->runQuery("SELECT * FROM teach_infotbl INNER JOIN users ON teach_infotbl.login=users.user_name WHERE users.user_id=:user_id");
  $mnb->execute(array(":user_id"=>$user_id));
  $bnm=$mnb->fetch(PDO::FETCH_ASSOC);
  $mn=$bnm['id'];
  $_SESSION['toteach']=$mn;
  if (isset($_POST['para_go']))
  {
   $abitid=$_POST['para_go'];
   if ($auth_user->doPara($mn,$abitid))
   {
     $err = "Студент успешно добавлен в список";
   }
  }
?>
  <div class="container" style="margin-top:80px;">
      <div class="row">
  		  <div class="col-md-12">
          <div id="error">
          <?php
        if(isset($err))
        {
          ?>
                  <div class="alert alert-success">
                     <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $err; ?> !
                  </div>
                  <?php
        }
        ?>
      </div>
        <h1 class="text-center h1-tbl">Список студентов</h1>
        <div class="table-responsive right-side1">
            <?php
            $poi=$auth_user->runQuery("SELECT * FROM abit_infotbl");
            $poi->execute(array("id_prep"=>$mn));
            if($poi->rowCount() > 0)
            { echo '<form method="post" action="">';
              echo '<table class="table table-bordred table-striped">';
              echo '<thead>';
              echo '<th>Фамилия</th>';
              echo '<th>Имя</th>';
              echo '<th>Отчество</th>';
              echo '<th>Добавить студента</th>';
							echo '</thead>';
              echo '<tbody>';
                while($tY=$poi->fetch(PDO::FETCH_ASSOC))
                  {
                  echo '<tr>';
                  echo '<td>' .$tY['full_name'].'</td>';
                  echo '<td>'.$tY['name'].'</td>';
                  echo '<td>' .$tY['sec_name']. '</td>';
                  echo '<td><button class="btn btn-warning btn-block" type="submit" name="para_go" value="'.$tY['id'].'"><span class="glyphicon glyphicon-plus"></span>Добавить студента</button></td>';
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
