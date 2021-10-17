<?php
    require_once 'function.php';
    // データを読み込み
    $fp = fopen('bookdata.csv', 'r');
    if($fp === false) {
        echo "ファイルのオープンに失敗しました。";
        exit;
    }
    // 1行ずつ出力する。
    // ENT_QUOTES：「'」をエスケープ処理するためのオプション
    while($row = fgetcsv($fp)) {
        echo "書籍名：" . str2html($row[0]) . "<br>";
        echo "著者名：" . str2html($row[4]) . "<br><br>";
    }
?>