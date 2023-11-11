<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<?php 

    $list = array("CNTT" => array("KTPM" =>array("Hang", "Minh", "Ngoan"),
                 "HTTH" =>array("Thuy", "Nga", "Son", "Trang"),
                "MMT" => array("Nam", "Anh", "Phuong")),
                "NN" => array("PD" =>array("BPD" => "Binh", "Hoa") , "DL" => array("Khanh, Quynh")));
    
    foreach($list as $khoa => $bomon){
        echo "<h2>$khoa</h2> <ul>";
        foreach($bomon as $bm => $gv){
            echo "<li>$bm </li>\n";
            foreach ($gv as $key => $value){
                echo"$value";
            }
        }
        echo "</ul>";
    }
?>
<form action="" method="get">
<input class="btn btn-primary" style="margin-top:40px" type="submit" value="trở về">
</form>

<?php $this->end(); ?>