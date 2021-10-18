<?php
    // 他のファイルを読み込む
    require_once 'function.php';
    // IDについてのバリデーション
    if (empty($_POST['id'])) {
        echo "idを指定してください。";
        exit;
    }
    if (!preg_match('/¥A¥d{1, 11}+¥z/u', $_POST['id'])) {
        echo "idが正しくありません。";
        exit;
    }
    // 各入力項目用のバリデーション
    if (empty($_POST['title'])) {
        echo "タイトルは必須です。";
        exit;
    }
    if (!preg_match('/¥A[[:^cntrl:]]{1, 200}¥z/u', $_POST['title'])) {
        echo "タイトルは200文字以内です。";
        exit;
    }
    if (!preg_match('/¥A¥d{0, 13}¥z/', $_POST['isbn'])) {
        echo "ISBNは数字13桁までです。";
        exit;
    }
    if (!preg_match('/¥A¥d{0, 6}¥z/u', $_POST['price'])) {
        echo "価格は数字6桁までです。";
        exit;
    }
    if (empty($_POST['publish'])) {
        echo "日付は必須です。";
        exit;
    }
    if (!preg_match('/¥A¥d{4}-¥d{1,2}-¥d{1,2}¥z/u', $_POST['publish'])) {
        echo "日付のフォーマットが違います。";
        exit;
    }
    $date = explode('-', $_POST['publish']);
    if (!checkdate($date[1], $date[2], $date[0])) {
        echo "正しい日付を入力してください。";
        exit;
    }
    if (!preg_match('/¥A[[:^cntrl:]]{0, 80}¥z/u', $_POST['author'])) {
        echo "著者名は80文字以内で入力してください。";
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
        echo "<a href='list.php'>リストへ戻る</a>";
        // インスタンス生成
        $dbh = db_open();
        // SQL
    } catch (PDOException $e) {
        echo "エラー!：" . str2html($e->getMessage()) . "<br>";
        exit;
    }
?>