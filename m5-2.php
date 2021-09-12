<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_5</title>
</head>
<body>

        <?php
        $dsn = 'データベース名';
        $user = "ユーザー名";
        $password = "パスワード";
        $pdo = new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        ?>

        <?php 
         /*$sql = "CREATE TABLE IF NOT EXISTS nission5"
        ." ("
        . "id INT AUTO_INCREMENT PRIMARY KEY,"
        . "name char(32),"
        . "comment TEXT"
        .");";
        $m5 = $pdo -> query($sql);*/
       
      /*  $sql ='SHOW TABLES';
        $result = $pdo -> query($sql);
        foreach ($result as $row){
        echo $row[0];
        echo '<br>';
    }
    echo "<hr>";*/

   /*$sql ='SHOW CREATE TABLE nission5';
    $result = $pdo -> query($sql);
    foreach ($result as $row){
        echo $row[1];
    }
    echo "<hr>";*/
    
    
//名前・コメント　入力　//m4-5
//$pdo -> beginTransaction();
   if(!empty($_POST["name"]) && !empty($_POST["comment"]) && !empty($_POST["submit"])){
    $sql = $pdo -> prepare("INSERT INTO nission5 (name, comment) VALUES (:name, :comment)");
    $sql -> bindParam(':name', $_POST["name"], PDO::PARAM_STR);
    $sql -> bindParam(':comment',  $_POST["comment"], PDO::PARAM_STR);
    
    $name = $_POST["name"];
    $comment = $_POST["comment"]; 
  
    $sql -> execute();
   }  

     /*$sql = 'SELECT * FROM nission5';
    $m5 = $pdo->query($sql);
    $results = $m5->fetchAll();
   // $sql = $pdo -> commit();
   if($sql){
    foreach ($results as $row){
        //$rowの中にはテーブルのカラム名が入る
        echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment'].',';
        echo "<hr>";
        }
   }*/
  

    
//入力データの抽出（m4-6）
   /* $sql = 'SELECT * FROM nission5';
    $m5 = $pdo->query($sql);
    $results = $m5->fetchAll();
   // $sql = $pdo -> commit();
    if($sql){
    foreach ($results as $row){
        //$rowの中にはテーブルのカラム名が入る
        echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment'].',';
        echo "<hr>";
        }
  } else {
     $error_message[] = "書き込みに失敗しました";
  }*/
    

  //編集（m4-7）
  if(!empty($_POST["edit"]) && !empty($_POST["editb"]) && empty($_POST["name"]) && empty($_POST["comment"])){
    $id = $_POST["edit"];
    $sql = 'SELECT * FROM nission5 where id=:id';
    $m5 = $pdo->prepare($sql);
    $m5->bindParam(':id', $id, PDO::PARAM_INT);
    $m5->execute();
    $results = $m5->fetchAll();
  foreach ($results as $row){
    $editname = $row['name'];
    $editcom = $row['comment'];
  }
  }

   if(!empty($_POST["edit"]) && !empty($_POST["name"]) && !empty($_POST["comment"]) && !empty($_POST["editb"])){ 
   /*$sql = 'SELECT * FROM nission5';
    $m5 = $pdo->query($sql);
    $results = $m5->fetchAll();
    if(!empty($_POST["edit"]) && !empty($_POST["name"]) && !empty($_POST["comment"]) && !empty($_POST["editb"])){*/
    $sql = 'UPDATE nission5 SET name=:name,comment=:comment WHERE id=:id';
    $m5 = $pdo->prepare($sql);
    $m5->bindParam(':name', $_POST["name"], PDO::PARAM_STR);
    $m5->bindParam(':comment', $_POST["comment"], PDO::PARAM_STR);
    $m5->bindParam(':id', $_POST["edit"], PDO::PARAM_INT);
    $m5->execute();
   }

    /*  $sql = 'SELECT * FROM nission5';
    $m5 = $pdo->query($sql);
    $results = $m5->fetchAll();
  foreach ($results as $row){
        //$rowの中にはテーブルのカラム名が入る
        echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment'].'<br>';
    echo "<hr>";
    }
 }*/



 //削除（m4-8）
  if($id = $_POST["delete"]){
    $sql = 'delete from nission5 where id=:id';
    $m5 = $pdo->prepare($sql);
    $m5->bindParam(':id', $id, PDO::PARAM_INT);
    $m5->execute();
 }
 ?>

<form action="" method="post">
        <label>　名前:
        <input type="text" name="name"
        placeholder="名前"  value = "<?php
                                        if(!empty($_POST["edit"]) && empty($_POST["name"]) && empty($_POST["comment"])){
                                          echo $editname;
                                        }
                                        ?>">
        </label>

        <label>　コメント:
        <input type="text" name="comment"
        placeholder="コメント" value = "<?php
                                        if(!empty($_POST["edit"]) && empty($_POST["name"]) && empty($_POST["comment"])){
                                                echo $editcom;                                            
                                                }
                                        ?>">
        </label>
        <input type="submit" name="submit">
       
        <div>
        <label>　削除対象番号:<input type="text" name="delete"
        placeholder="削除番号指定フォーム">
        </label>
        <input type="submit" name="delb" value="削除">
        </div>

        <div>
        <label>　編集対象番号:<input type="text" name="edit"
        placeholder="編集番号指定フォーム" value ="<?php
                                          if(!empty($_POST["edit"]) && empty($_POST["name"]) && empty($_POST["comment"])){
                                          echo $_POST["edit"];
                                         }
                                           ?>">
        </label>
        <input type="submit" name="editb" value="編集">
      </div>

        <input type = "hidden" name="edit_n" value = "<?php
                                                      if(!empty($_POST["edit"])){
                                                      echo "change";
                                                      }
                                                      ?>"
                                                      >
        </form> 

 <?php       
 $sql = 'SELECT * FROM nission5';
    $m5 = $pdo->query($sql);
    $results = $m5->fetchAll();
   // $sql = $pdo -> commit();     
if($sql){
    foreach ($results as $row){
        //$rowの中にはテーブルのカラム名が入る
        echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment'].',';
        echo "<hr>";
        }
      }
?>
 </body>
    </html>
</html>