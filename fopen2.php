<?php
    // データを読み込み
    $fp = fopen('bookdata.csv', 'r');
    if($fp === false) {
        echo "ファイルのオープンに失敗しました。";
        exit;
    }
    // 1行ずつ出力する。
    // ENT_QUOTES：「'」をエスケープ処理するためのオプション
    while($row = fgetcsv($fp)) {
        echo "書籍名：" . htmlspecialchars($row[0], ENT_QUOTES, 'UTF-8') . "<br>";
        echo "著者名：" . htmlspecialchars($row[4], ENT_QUOTES, 'UTF-8') . "<br><br>";
    }
?>