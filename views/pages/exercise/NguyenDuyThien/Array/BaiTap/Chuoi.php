<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<?php
    $str = "Sun - Mon - Tue - Wed - Thu - Fri - Sat";
    $arr = explode("-",$str);
    var_dump($arr);
    $s = implode("+",$arr);
    var_dump($s);
?>
<form action="" method="get">
<input class="btn btn-primary" style="margin-top:40px" type="submit" value="trở về">
</form>
<?php $this->end(); ?>