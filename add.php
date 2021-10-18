<?php
    // 他のファイルを読み込む
    require_once __DIR__ . '/inc/function.php';
    require_once __DIR__ . '/inc/error_check.php';
    include __DIR__ . '/inc/header.php';

    try {
        // インスタンス生成
        $dbh = db_open();
        // SQL
        $sql = "INSERT INTO 
                    books (id, title, isbn, price, publish, author) 
                VALUES 
                    (NULL, :title, :isbn, :price, :publish, :author)";

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
        echo "<a href='index.php'>リストへ戻る</a>";
    } catch (PDOException $e) {
        echo "エラー!：" . str2html($e->getMessage()) . "<br>";
        exit;
    }
?>
<?php include __DIR__ .'/inc/footer.php'; ?>