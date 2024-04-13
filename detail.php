<?php
$id = $_GET["id"];

//１．PHP
//select.phpのPHPコードをマルっとコピーしてきます。
//※SQLとデータ取得の箇所を修正します。
//【重要】
//insert.phpを修正（関数化）してからselect.phpを開く！！
include("funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM company_interview WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //integer（数値の場合）
$status = $stmt->execute();




//３．データ表示
 $values = "";
 if($status==false) {
   sql_error($stmt);
 }

// //全データ取得
 $v =  $stmt->fetch(); 
//PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
//$json = json_encode($values,JSON_UNESCAPED_UNICODE);




?>
<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
理由：入力項目は「登録/更新」はほぼ同じになるからです。
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>フリーアンケート更新</title>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div class = "main">
        <div class = "form-title">採用担当者様へのアンケート</div>


        <form action="update.php" method="POST">
            <div class = "form-item">お名前</div>
            <input type="text" name="name" value="<?=$v["name"]?>">

            <div class = "form-item">Eメール</div>
            <input type="text" name="email" value="<?=$v["email"]?>">

            <div class="form-item">会社の規模</div>
            <select name = "employees">
                <option value = "未選択">選択してください</option>
                <option value = "～30人" <?php if ($v["employees"] == "～30人") echo "selected"; ?>>>従業員～30人</option>
                <option value = "31～100人" <?php if ($v["employees"] == "31～100人") echo "selected"; ?>>>従業員31～100人</option>
                <option value = "101～500人" <?php if ($v["employees"] == "101～500人") echo "selected"; ?>>>従業員101～500人</option>
                <option value = "501～1000人" <?php if ($v["employees"] == "501～1000人") echo "selected"; ?>>>従業員501～1000人</option>
                <option value = "1001人～" <?php if ($v["employees"] == "1001人～") echo "selected"; ?>>>従業員1001人～</option>
            </select>

            <div class="form-item">がんサバイバーを採用するにあたり、心配なことはありますか？<br>
                （※当てはまるもの全てにチェックしてください）
            </div>
     <?php       // データベースから取得した文字列を配列に変換
$bottlenecks_array = isset($v["bottlenecks"]) ? explode(",", $v["bottlenecks"]) : []; ?>

            <input type="checkbox" name="bottlenecks[]" value="休みが多くなるのではないか" <?php if (in_array("休みが多くなるのではないか", $bottlenecks_array)) echo "checked"; ?>>休みが多くなるのではないか<br>
            <input type="checkbox" name="bottlenecks[]" value="突然辞めるのではないか" <?php if (in_array("突然辞めるのではないか", $bottlenecks_array)) echo "checked"; ?>>突然辞めるのではないか<br>
            <input type="checkbox" name="bottlenecks[]" value="残業ができないのではないか" <?php if (in_array("残業ができないのではないか", $bottlenecks_array)) echo "checked"; ?>>残業ができないのではないか<br>
            <input type="checkbox" name="bottlenecks[]" value="その他" <?php if (in_array("その他", $bottlenecks_array)) echo "checked"; ?>>その他<br>
            

            <div class="form-item">通常の採用条件以外にどのようなことが事前に明確になれば、がんサバイバーを採用しますか？<br>
                （※当てはまるもの全てにチェックしてください）
            </div>
            <?php       // データベースから取得した文字列を配列に変換
$conditions_array = isset($v["conditions"]) ? explode(",", $v["conditions"]) : []; ?>

            <input type="checkbox" name="conditions[]" value="種類やステージ" <?php if (in_array("種類やステージ", $conditions_array)) echo "checked"; ?>>種類やステージ<br>
            <input type="checkbox" name="conditions[]" value="治療期間とその内容" <?php if (in_array("治療期間とその内容", $conditions_array)) echo "checked"; ?>>治療期間とその内容<br>
            <input type="checkbox" name="conditions[]" value="今までの治療期間に欠勤した日数" <?php if (in_array("今までの治療期間に欠勤した日数", $conditions_array)) echo "checked"; ?>>今までの治療期間に欠勤した日数<br>
            <input type="checkbox" name="conditions[]" value="本人の人柄、やる気" <?php if (in_array("本人の人柄、やる気", $conditions_array)) echo "checked"; ?>>本人の人柄、やる気<br>
            <input type="checkbox" name="conditions[]" value="その他" <?php if (in_array("その他", $conditions_array)) echo "checked"; ?>>その他<br>
            


            <div class = "form-item">実際にがんサバイバーを採用したことがある企業の担当者様へ<br>
            採用して良かった点、悪かった点がありましたら記入お願いします。</div>
            <textarea name="memo"><?=$v["memo"]?></textarea>
            <input type="hidden" name="id" value="<?=$v["id"]?>">
   

            <input type = "submit" value = "送信">
        </form>


    </div>
<!-- Main[End] -->


</body>
</html>