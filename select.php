<?php
// //1.  DB接続します
// try {
//   //Password:MAMP='root',XAMPP=''
//   $pdo = new PDO('mysql:dbname=user_interview1;charset=utf8;host=localhost','root','');
// } catch (PDOException $e) {
//   exit('DB_CONECT'.$e->getMessage());
// }

//【重要】
//insert.phpを修正（関数化）してからselect.phpを開く！！
 include("funcs.php");
 $pdo = db_conn();


//２．データ登録SQL作成
$sql = "SELECT * FROM company_interview";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute(); //true or false

//３．データ表示
//$view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
//JSONい値を渡す場合に使う
//$json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>
div{padding: 10px;font-size:16px;}
td{border: 1px solid red;}
</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->


<!-- Main[Start] -->
<div>
    <div class="container jumbotron">
      <table>
      <?php foreach($values as $value){ ?>
        <tr>
        <td><?=h($value["id"])?></td>
        <td><?=h($value["name"])?></td>
        <td><?=h($value["email"])?></td>
        <td><?=h($value["employees"])?></td>
        <td><?=h($value["bottlenecks"])?></td>
        <td><?=h($value["conditions"])?></td>
        <td><?=h($value["memo"])?></td>
        <td><?=h($value["indate"])?></td>
        <td><a href="detail.php?id=<?=$value["id"]?>">[更新]</a></td>
        <td><a href="delete.php?id=<?=$value["id"]?>">[削除]</a></td>
      </tr>
      <?php } ?>
      </table>
    </div>
</div>
<!-- Main[End] -->


<script>
  //JSON受け取り



</script>
</body>
</html>