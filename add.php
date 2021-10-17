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
        $sql = "INSERT INTO books (id, title, isbn, price, publish, author) 
                    VALUES (NULL, :title, :isbn, :price, :publish, :author)";
        $statement = $dbh->prepare($sql);
        $price = (int) $_POST['price'];
        // 値を当てはめていく。
        $statement->bindParam(":title", $_POST['title'], PDO::PARAM_STR);
        $statement->bindParam(":isbn", $_POST['isbn'], PDO::PARAM_STR);
        $statement->bindParam(":price", $price, PDO::PARAM_INT);
        $statement->bindParam(":publish", $_POST['publish'], PDO::PARAM_STR);
        $statement->bindParam(":author", $_POST['author'], PDO::PARAM_STR);
        // SQL実行
        $statement->execute();
        echo "データが追加されました。";
        echo "<a href='list.php'>リストへ戻る</a>";
    } catch (PDOException $e) {
        echo "エラー!：" . str2html($e->getMessage()) . "<br>";
        exit;
    }
?>