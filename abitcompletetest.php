<?php
require_once('header.php');
if (isset($_GET['saw']) && $_GET['saw'] == "true")
{
   $rty=$_GET['id'];
}
?>
<div class="container" style="margin-top:80px;">
    <div class="row">
      <div class="col-md-12">
      <h1 class="text-center h1-tbl">Результаты тестирования</h1>
      <div class="table-responsive right-side1">
          <?php
          $poi=$auth_user->runQuery("SELECT * FROM yomi_testresult INNER JOIN yomi_testname ON yomi_testresult.id_test=yomi_testname.id_test INNER JOIN abit_infotbl ON yomi_testresult.id_abit=abit_infotbl.id  WHERE yomi_testresult.id_abit=:id_abit AND yomi_testname.id_prep=:id_prep");
          $poi->execute(array(":id_abit"=>$rty,"id_prep"=>$mn));

          if($poi->rowCount() > 0)
          { echo '<form method="post" action="">';
            echo '<table class="table table-bordred table-striped">';
            echo '<thead>';
            echo '<th>Название теста</th>';
            echo '<th>Ф.И.О абитуриента</th>';
            echo '<th>Результат</th>';
            echo '</thead>';
            echo '<tbody>';
              while($tY=$poi->fetch(PDO::FETCH_ASSOC))
                {
                echo '<tr>';
                echo '<td>' .$tY['name_test']. '</td>';
                echo '<td>' .$tY['full_name'].' '.$tY['name'].' ' .$tY['sec_name']. '</td>';
                echo '<td>'.$tY['mark'].'</td>';
                echo '</tr>';
                }
             echo '</tbody>';
             echo '</table>';

               }
               else
               {
                    $err="Студент не проходил ни одного тестирования";
               }
               ?>
               <div id="error">
               <?php
             if(isset($err))
             {
               ?>
                       <div class="alert alert-danger">
                          <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $err; ?> !
                       </div>
                       <?php
             }
             ?>
               </div>

 <a href="myabit.php" class="btn btn-info btn-block" name="but_go">Вернуться</a>

      <script src="bootstrap/js/bootstrap.min.js"></script>

      </body>
      </html>
