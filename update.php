<?php
//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//   POSTデータ受信 → DB接続 → SQL実行 → 前ページへ戻る
//2. $id = POST["id"]を追加
$id = $_POST["id"];
// var_dump($id);
// exit();
//var_dump($_POST);
// eixt();


//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更
//1. POSTデータ取得
$name = $_POST["name"];
$email = $_POST["email"];
$employees = $_POST["employees"];
// $bottlenecks = implode(", ", $_POST["bottlenecks"]);
// $conditions = implode(", ", $_POST["conditions"]);
$bottlenecks = isset($_POST["bottlenecks"]) && !empty($_POST["bottlenecks"]) ? implode(", ", $_POST["bottlenecks"]) : '';
// Check if $_POST["conditions"] is set and not empty before using implode()
$conditions = isset($_POST["conditions"]) && !empty($_POST["conditions"]) ? implode(", ", $_POST["conditions"]) : '';
$memo = $_POST["memo"];


//2. DB接続します
//*** function化する！  *****************

include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "UPDATE company_interview SET name=:name,email=:email,employees=:employees,bottlenecks=:bottlenecks,conditions=:conditions,memo=:memo WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':employees', $employees, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bottlenecks', $bottlenecks, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':conditions', $conditions, PDO::PARAM_STR);
$stmt->bindValue(':memo', $memo, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT); 
$status = $stmt->execute(); //true or false


//４．データ登録処理後
// if($status==false){
//     //*** function化する！*****************

//     sql_error($stmt);
// }else{
//     //*** function化する！*****************

//     redirect("select.php");
// }

// ４．データ登録処理後
if($status==false){
    // SQLエラーがある場合は、エラーメッセージを表示して終了する
    $errorInfo = $stmt->errorInfo();
    exit("SQLエラー：" . $errorInfo[2]);
}else{
    // 更新が成功した場合は、リダイレクトする
    redirect("select.php");
}







?>