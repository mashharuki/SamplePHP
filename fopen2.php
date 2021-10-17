<?php
    // データを読み込み
    $fp = fopen('bookdata.csv', 'r');
    if($fp === false) {
        echo "ファイルのオープンに失敗しました。";
        exit;
    }
    // 1行ずつ出力する。
    while($row = fgetcsv($fp)) {
        echo "書籍名：" . $row[0] . "<br>";
        echo "著者名：" . $row[4] . "<br>";
    }
?>