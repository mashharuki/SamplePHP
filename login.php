<?php
    // セッション開始
    session_start();
    // 他のファイルを読み込む
    require_once __DIR__ . '/inc/function.php';
    include __DIR__ . '/inc/header.php';
?>
<form method="post" action="login.php">
    <p>
        <label>ユーザー名：</label>
        <input type="text" name="username">
    </p>
    <p>
        <label>パスワード：</label>
        <input type="text" name="password" >
    </p>
    <input type="submit" value="送信する" >
</form>

<?php
    // ログイン済みかチェックする
    if (!empty($_SESSION['login'])) {
        echo "ログイン済みです。<br>";
        exit;
    }
    // 入力値に空欄があった場合
    if ((empty($_POST['username']) || empty($_POST['password']))){
        echo "ユーザー名、パスワードを入力してください。";
        exit;
    }
    // DBからアカウント情報を取得して確認する。
    try {
        $sql = "SELECT
                    password
                FROM
                    users
                WHERE
                    username = :username";

        $statement = $dbh->prepare($sql);
        $statement->bindParam(":username", $_POST['password'], PDO::PARAM_STR);
        $statement->execute();
        // 結果を格納する。
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        // ログインに失敗した場合
        if (!$result) {
            echo "ログインに失敗しました。";
            exit;
        }
        // パスワードが一致するかどうかチェックする。
        if (password_verify($_POST['password'], $result['password'])) {
            // 古いパスワードを破棄して新しいパスワードを生成する。
            session_regenerate_id(true);
            $_SESSION['login'] = true;
            header("Location: index.php");
        } else {
            echo "ログインに失敗しました。"; 
        }
    } catch (PDOException $e) {
        echo "エラー!：" . str2html($e->getMessage()) . "<br>";
        exit;
    }
?>