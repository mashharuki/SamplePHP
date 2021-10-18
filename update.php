<?php require_once __DIR__ . '/login_check.php'; ?>
<?php
    // 他のファイルを読み込む
    require_once __DIR__ . '/token_check.php';
    require_once __DIR__ . '/inc/function.php';
    require_once __DIR__ . '/inc/error_check.php';
    include __DIR__ . '/inc/header.php';

    // IDについてのバリデーション
    if (empty($_POST['id'])) {
        echo "idを指定してください。";
        exit;
    }
    if (!preg_match('/¥A¥d{1, 11}+¥z/u', $_POST['id'])) {
        echo "idが正しくありません。";
        exit;
    }
    
    try {
        $sql = "UPDATE 
                    books 
                SET 
                    title = :title, 
                    isbn = :isbn,
                    price = :price,
                    publish = :publish, 
                    author = :author
                WHERE 
                    id = :id";

        $statement = $dbh->prepare($sql);
        $price = (int) $_POST['id'];
        // 値を当てはめていく。
        $statement->bindParam(":title", $_POST['title'], PDO::PARAM_STR);
        $statement->bindParam(":isbn", $_POST['isbn'], PDO::PARAM_STR);
        $statement->bindParam(":price", $price, PDO::PARAM_INT);
        $statement->bindParam(":publish", $_POST['publish'], PDO::PARAM_STR);
        $statement->bindParam(":author", $_POST['author'], PDO::PARAM_STR);
        $statement->bindParam(":id", $_POST['id'], PDO::PARAM_INT);
        // SQL実行
        $statement->execute();
        echo "データが更新されました。";
        echo "<a href='index.php'>リストへ戻る</a>";
        // インスタンス生成
        $dbh = db_open();
        // SQL
    } catch (PDOException $e) {
        echo "エラー!：" . str2html($e->getMessage()) . "<br>";
        exit;
    }
?>
<?php include __DIR__ .'/inc/footer.php'; ?>