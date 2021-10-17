<?php
    require_once 'function.php';
    // 身長と体重を取得する。
    $height = (float) $_POST['height'];
    $weight = (float) $_POST['weight'];
    // 体重と身長の入力値に問題が無いかチェックする。
    if (( 0 < $height ) && ( $height < 3 )) {
        echo "身長を正しく入力してください。";
        exit;
    } 
    if (( $weight < 50 ) || ( 200 < $weight )) {
        echo "体重を正しく入力してください。";
        exit;
    }
    // 適正体重の算出
    $goal_weight = $height * $height * 22;
    // 適正体重までの差を算出
    $difference = abs($goal_weight - $weight);

    echo "体重" . str2html($weight) . "kg<br>";
    echo "理想" . str2html($goal_weight) . "kg<br>";
    echo '後' . str2html($difference) . 'kgで適正体重です。 <br>';
?>