<?php 
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
    var_dump($dbh);
?>