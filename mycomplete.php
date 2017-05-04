<?php
require_once('header.php');
require_once('class.teach.php');
$poi=$auth_user->runQuery("SELECT * FROM yomi_testresult");
$poi->execute();

if($poi->rowCount()==0)
{
  $err="Вы еще не проходили тестов";
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
            <strong><?php echo $err?>.</strong> Перейдите <a href="globaltestlist.php" class="alert-link">по данной ссылке</a> для выбора тестов.
                  </div>
              <?php
}
    ?>
  </div>
      <div class="col-md-12">
      <h1 class="text-center h1-tbl">Мои результаты тестирования</h1>
      <div class="table-responsive right-side1">
          <?php
          $poi=$auth_user->runQuery("SELECT * FROM yomi_testresult INNER JOIN yomi_testname ON yomi_testresult.id_test=yomi_testname.id_test INNER JOIN abit_infotbl ON yomi_testresult.id_abit=abit_infotbl.id WHERE yomi_testresult.id_abit=:id_abit");
          $poi->execute(array(":id_abit"=>$_SESSION['curr_abit']));

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
 echo '<a href="home.php" class="btn btn-info btn-block" name="but_go">Перейти на главную</a>';
      ?>
      <script src="bootstrap/js/bootstrap.min.js"></script>

      </body>
      </html>
