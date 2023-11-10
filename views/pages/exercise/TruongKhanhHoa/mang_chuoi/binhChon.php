<?php 
    $listBH = array(
        3 => "Em của ngày hôm qua",
        2 => "Em của quá khứ",
        4 => "Vợ người ta",
        5 => "Buồn của anh",
        1 => "Sóng gió"
    );
    krsort($listBH);
    echo "<h1>Danh sách bài hát sau khi sắp xếp giảm dần theo STT</h1>  <br>";
    echo "<ul>";
    foreach ($listBH as $stt => $baihat) {
        echo "<li>STT: $stt - $baihat</li>";
    }
    echo "</ul> <br>";

    asort($listBH);
    echo "<h1>Danh sách bài hát sau khi sắp xếp tăng dần theo tên</h1>  <br>";
    echo "<ul>";
    foreach ($listBH as $stt => $baihat) {
        echo "<li>STT: $stt - $baihat</li>";
    }
    echo "</ul> <br>";
?>