<?php
require_once('dbconfig.php');
class TEACH
{
  private $conn;

public function __construct()
  	{
  		$database = new Database();
  		$db = $database->dbConnection();
  		$this->conn = $db;
      }

public function runQuery($sql)
      {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
      }

public function newTest($name,$teach)
      {
        try
        {
          $st = $this->conn->prepare("INSERT INTO yomi_testname (name_test,id_prep,count_quest)
                                                       VALUES(:unametest,:uteach,0)");
          $st->bindparam(":unametest", $name);
          $st->bindparam(":uteach", $teach);
          $st->execute();
          $id=$this->conn->lastInsertId();
          return $id;
        }
        catch(PDOException $e)
        {
          echo $e->getMessage();
        }
      }

public function updateTest($name,$idtest)
            {
              try
              {
                $st = $this->conn->prepare("UPDATE yomi_testname SET name_test=:unametest WHERE id_test=:uteach");
                $st->bindparam(":unametest", $name);
                $st->bindparam(":uteach", $idtest);
                $st->execute();
               return $st;
              }
              catch(PDOException $e)
              {
                echo $e->getMessage();
              }
            }

  public function currentPrep($user_id)
            {
              try
              {
                $stmt = $this->conn->prepare("SELECT id FROM teach_infotbl INNER JOIN userrole ON teach_infotbl.login=userrole.user INNER JOIN users ON userrole.user=users.user_name WHERE users.user_id=:user_id");
              	$stmt->execute(array(":user_id"=>$user_id));
                $curr=$stmt->fetch(PDO::FETCH_ASSOC);
                $cur=$curr['id'];
              return $cur;
              }
              catch(PDOException $e)
              {
                echo $e->getMessage();
              }
            }

public function newQuest($quest,$id_test)
 {
  try
  {
    $st = $this->conn->prepare("INSERT INTO yomi_testquest (name_quest,id_test)
                                                 VALUES(:unametest,:uteach)");
    $st->bindparam(":unametest", $quest);
    $st->bindparam(":uteach", $id_test);
    $st->execute();
    $id=$this->conn->lastInsertId();
    return $id;
  }
  catch(PDOException $e)
  {
    echo $e->getMessage();
  }
 }

public function insertCount($count,$id_test)
  {
   try
   {
     $st = $this->conn->prepare("UPDATE yomi_testname SET count_quest=:unametest WHERE id_test=:uteach");
     $st->bindparam(":unametest", $count);
     $st->bindparam(":uteach", $id_test);
     $st->execute();
     return $st;
   }
   catch(PDOException $e)
   {
     echo $e->getMessage();
   }
  }

public function updateQuest($quest,$id_quest)
  {
   try
   {
     $st = $this->conn->prepare("UPDATE yomi_testquest SET name_quest=:uquest WHERE id_quest=:uidq");
     $st->bindparam(":uquest", $quest);
     $st->bindparam(":uidq", $id_quest);
     $st->execute();
     return $st;
   }
   catch(PDOException $e)
   {
     echo $e->getMessage();
   }
  }

public function newAnswer($answer,$id_quest,$procent)
 {
  try
  {
    $st = $this->conn->prepare("INSERT INTO yomi_testanswer (name_answer,id_quest,procent)
                                                 VALUES(:unametest,:uteach,:uprocent)");
    $st->bindparam(":unametest", $answer);
    $st->bindparam(":uteach", $id_quest);
    $st->bindparam(":uprocent", $procent);
    $st->execute();
    return $st;
  }
  catch(PDOException $e)
  {
    echo $e->getMessage();
  }
 }

public function updateAnswer($answer,$id_answer,$procent)
  {
   try
   {
     $st = $this->conn->prepare("UPDATE yomi_testanswer SET name_answer=:unametest,procent=:uprocent WHERE id_answer=:uteach");
     $st->bindparam(":unametest", $answer);
     $st->bindparam(":uteach", $id_answer);
     $st->bindparam(":uprocent", $procent);
     $st->execute();
     return $st;
   }
   catch(PDOException $e)
   {
     echo $e->getMessage();
   }
  }

public function delQuest($id_quest)
  {
   try
   {
     $st = $this->conn->prepare("DELETE FROM yomi_testquest WHERE id_quest=:id_quest");
     $st->bindparam(":id_quest", $id_quest);
     $st->execute();
     return $st;
   }
   catch(PDOException $e)
   {
     echo $e->getMessage();
   }
  }

public function delTest($id_test)
    {
     try
     {
       $st = $this->conn->prepare("DELETE FROM yomi_testname WHERE id_test=:id_quest");
       $st->bindparam(":id_quest", $id_test);
       $st->execute();
       return $st;
     }
     catch(PDOException $e)
     {
       echo $e->getMessage();
     }
    }

public function newSolve($test,$abit,$mark)
     {
      try
      {
        $st = $this->conn->prepare("INSERT INTO yomi_testresult (id_test,id_abit,mark,status)
                                                     VALUES(:unametest,:uteach,:umark,1)");
        $st->bindparam(":unametest",$test);
        $st->bindparam(":uteach", $abit);
        $st->bindparam(":umark", $mark);
        $st->execute();
        $id=$this->conn->lastInsertId();
        return $id;
      }
      catch(PDOException $e)
      {
        echo $e->getMessage();
      }
     }

public function newSolveMark($test,$quest,$answer,$mark,$abit,$curr_date)
          {
           try
           {
             $st = $this->conn->prepare("INSERT INTO yomi_testmark (id_test,id_quest,id_answer,procent,id_abit,curr_date)
                                                          VALUES(:unametest,:uquest,:uanswer,:umark,:uabit,:curr_date)");
             $st->bindparam(":unametest",$test);
             $st->bindparam(":uquest", $quest);
             $st->bindparam(":uanswer", $answer);
             $st->bindparam(":umark", $mark);
             $st->bindparam(":uabit", $abit);
              $st->bindparam(":curr_date", $curr_date);
             $st->execute();
             return $st;
           }
           catch(PDOException $e)
           {
             echo $e->getMessage();
           }
          }

}
?>
