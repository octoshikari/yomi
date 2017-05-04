<?php
require_once('header.php');
require_once('class.teach.php');
$re= new TEACH();
$_SESSION['date_test']=date("Y-m-d H:i:s");
if(isset($_POST['but_save']))
{
$count_questname=count($_POST['id_que']);
for ($i=0;$i<$count_questname;$i++)
{
  $j=$i+1;
  $quest=$_POST['id_que'][$i];
  if (isset($_POST['radios'.$j.'']))
  {
    $radans=$_POST['radios'.$j.''];
    $wq=$re->runQuery("SELECT * FROM yomi_testanswer WHERE id_answer=:id_answer");
    $wq->execute(array(":id_answer"=>$radans));
    $er=$wq->fetch(PDO::FETCH_ASSOC);
    $wq=$er['procent'];
    $re->newSolveMark($_SESSION['abit_test'],$quest,$radans,$wq,$_SESSION['curr_abit'],$_SESSION['date_test']);
  }
  else
    {
      $radans=0;
      $wq=0;
    $re->newSolveMark($_SESSION['abit_test'],$quest,$radans,$wq,$_SESSION['curr_abit'],$_SESSION['date_test']);
  };
}
  $zx=$re->runQuery("SELECT SUM(procent) AS sum_test FROM yomi_testmark WHERE id_test=:id_test AND id_abit=:id_abit AND curr_date=:curr_date");
  $zx->execute(array(":id_test"=>$_SESSION['abit_test'],":id_abit"=>$_SESSION['curr_abit'],":curr_date"=>$_SESSION['date_test']));
  $xz=$zx->fetch(PDO::FETCH_ASSOC);
  $cx=(int)$xz['sum_test'];
  if ($cx!=0)
  {
  $sumat=$cx/$count_questname;
  }
  else {$sumat=0;}
  $lastid=$re->newSolve($_SESSION['abit_test'],$_SESSION['curr_abit'],$sumat);
  unset($_SESSION['abit_test']);
  unset($_SESSION['curr_date']);
  }
?>
<div class="container" style="margin-top:80px;">
    <div class="row">
      <div class="col-md-12">
      <h1 class="text-center h1-tbl">Результат тестирования</h1>
      <div class="table-responsive right-side1">
          <?php
          $poi=$auth_user->runQuery("SELECT * FROM yomi_testresult INNER JOIN yomi_testname ON yomi_testresult.id_test=yomi_testname.id_test INNER JOIN abit_infotbl ON yomi_testresult.id_abit=abit_infotbl.id WHERE yomi_testresult.id_solve=:id_abit");
          $poi->execute(array(":id_abit"=>$lastid));

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
               ?>
        <a href="home.php" class="btn btn-info btn-block" name="but_go">Перейти на главную</a>

      <script src="bootstrap/js/bootstrap.min.js"></script>

      </body>
      </html>
