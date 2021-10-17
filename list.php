<?php
    // 他のファイルを読み込む
    require_once 'function.php'; 
    try {
        // ユーザーIDとパスワードの設定
        $user = "phpuser";
        $password = "phpuser";
        // オプションの設定
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
        ];
        // インスタンス生成
        $dbh = new PDO(
            'mysql:host=localhost;dbname=sample_db',
            $user,
            $password,
            $opt
        );
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