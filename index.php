<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>

    <div class = "main">
        <div class = "form-title">採用担当者様へのアンケート</div>


        <form action="insert.php" method="POST">
            <div class = "form-item">お名前</div>
            <input type="text" name="name">

            <div class = "form-item">Eメール</div>
            <input type="text" name="email">

            <div class="form-item">会社の規模</div>
            <select name = "employees">
                <option value = "未選択">選択してください</option>
                <option value = "～30人">従業員～30人</option>
                <option value = "31～100人">従業員31～100人</option>
                <option value = "101～500人">従業員101～500人</option>
                <option value = "501～1000人">従業員501～1000人</option>
                <option value = "1001人～">従業員1001人～</option>
            </select>

            <div class="form-item">がんサバイバーを採用するにあたり、心配なことはありますか？<br>
                （※当てはまるもの全てにチェックしてください）
            </div>
            <input type="checkbox" name="bottlenecks[]" value="休みが多くなるのではないか">休みが多くなるのではないか<br>
            <input type="checkbox" name="bottlenecks[]" value="突然辞めるのではないか">突然辞めるのではないか<br>
            <input type="checkbox" name="bottlenecks[]" value="残業ができないのではないか">残業ができないのではないか<br>
            <input type="checkbox" name="bottlenecks[]" value="その他">その他<br>
            

            <div class="form-item">通常の採用条件以外にどのようなことが事前に明確になれば、がんサバイバーを採用しますか？<br>
                （※当てはまるもの全てにチェックしてください）
            </div>
            <input type="checkbox" name="conditions[]" value="種類やステージ">種類やステージ<br>
            <input type="checkbox" name="conditions[]" value="治療期間とその内容">治療期間とその内容<br>
            <input type="checkbox" name="conditions[]" value="今までの治療期間に欠勤した日数">今までの治療期間に欠勤した日数<br>
            <input type="checkbox" name="conditions[]" value="本人の人柄、やる気">本人の人柄、やる気<br>
            <input type="checkbox" name="conditions[]" value="その他">その他<br>
            


            <div class = "form-item">実際にがんサバイバーを採用したことがある企業の担当者様へ<br>
            採用して良かった点、悪かった点がありましたら記入お願いします。</div>
            <textarea name="memo"></textarea>

            <input type = "submit" value = "送信">
        </form>


    </div>
</body>
</html>