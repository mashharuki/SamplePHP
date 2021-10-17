<?php
    // 他のファイルを読み込む
    require_once 'function.php'; 
    try {
        // インスタンス生成
        $dbh = db_open();
        // SQL
        $sql = "SELECT title, author FROM books";
        $statement = $dbh->query($sql);
        // 取得した結果について1行ずつ処理
        while ($row = $statement->fetch()) {
            echo "書籍名：" . str2html($row[0]) . "<br>";
            echo "著者名：" . str2html($row[4]) . "<br><br>";
        }
    } catch (PDOException $e) {
        echo "エラー!：" . $e->getMessage() . "<br>";
        exit;
    }
?>