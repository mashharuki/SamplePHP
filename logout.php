<?php
    // セッションをスタートする。
    session_start();
    // セッションを初期化する。
    $_SESSION = array();
    // セッションを破棄する。
    session_destroy();
    // ログインフォームを表示する。
    header("Location: login.php");
?>