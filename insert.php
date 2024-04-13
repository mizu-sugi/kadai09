<?php
//1. POSTデータ取得
$name = $_POST["name"];
$email = $_POST["email"];
$employees = $_POST["employees"];
$bottlenecks = implode(", ", $_POST["bottlenecks"]);
$conditions = implode(", ", $_POST["conditions"]);
$memo = $_POST["memo"];


//2. DB接続します
//*** function化する！  *****************

include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "INSERT INTO company_interview(id,name,email,employees,bottlenecks,conditions,memo,indate)VALUES(NULL, :name, :email, :employees, :bottlenecks, :conditions, :memo, sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':employees', $employees, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bottlenecks', $bottlenecks, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':conditions', $conditions, PDO::PARAM_STR);
$stmt->bindValue(':memo', $memo, PDO::PARAM_STR);
$status = $stmt->execute(); //true or false


//４．データ登録処理後
if($status==false){
    //*** function化する！*****************

    sql_error($stmt);
}else{
    //*** function化する！*****************

    redirect("index.php");
}
?>