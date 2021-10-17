<?php
    // 他のファイルを読み込む
    require_once 'function.php';
    // IDについてのバリデーション
    if (empty($_GET['id'])) {
        echo "idを指定してください。";
        exit;
    }
    if (!preg_match('/¥A¥d{1, 11}+¥z/u', $_GET['id'])) {
        echo "idが正しくありません。";
        exit;
    }
    $id = (int) $_GET['id'];
    // DB接続用のインスタンス生成
    $dbh = db_open();
    // SQL
    $sql = "SELECT id, title, isbn, price, publish, author FROM books WHERE id = :id";
    $statement =  $dbh->prepare($sql);
    $statement->bindParam(":id", $id, PDO::PARAM_INT);
    // 実行
    $statement->execute();
    // 取得した結果を取得する。
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    if(!$result) {
        echo "指定したデータがありません。";
        exit;
    } 
    // 取得した結果から値を得る。
    $title = str2html($result['title']);
    $isbn = str2html($result['isbn']);
    $price = str2html($result['price']);
    $publish = str2html($result['publish']);
    $author = str2html($result['author']);
    $id = str2html($result['id']);

    $html_form =  <<< EOD
    <from action="update.php" method="post">
            <p>
            <label for="title">タイトル（必須・200文字まで）：</label>
            <input type="text" name="title" value='$title'>
        </p>
        <p>
            <label for="isbn">ISBN（13桁までの数字）：</label>
            <input type="text" name="isbn" value='$isbn'>
        </p>
        <p>
            <label for="price">定価（6桁の数字まで）：</label>
            <input type="text" name="price" value='$price'>
        </p>
        <p>
            <label for="publish">出版日（YYYY-MM-DD形式）：</label>
            <input type="text" name="publish" value='$publish'>
        </p>
        <p>
            <label for="author">著者（80文字まで）：</label>
            <input type="text" name="author" value='$author'>
        </p>
        <p class="button">
            <input type="hidden" name="id" value='$id'>
            <input type="submit" value="送信する" >
        </p>
    </from>
    EOD;
    echo $html_form;
?>