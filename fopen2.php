<?php
    // データを読み込み
    $fp = fopen('bookdata.csv', 'r');
    if($fp === false) {
        echo "ファイルのオープンに失敗しました。";
        exit;
    }
    // 1行ずつ出力する。
    while($row = fgetcsv($fp)) {
        var_dump($row);
    }
?>