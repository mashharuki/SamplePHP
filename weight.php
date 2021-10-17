<?php
    $height = (float) $_POST['height'];
    if ((0 < $height) && ($height < 3)) {
        echo '適正体重は'. $height * $height * 22 . "kgです";
    } else {
        echo '身長を正しく入力してください。';
    }
?>