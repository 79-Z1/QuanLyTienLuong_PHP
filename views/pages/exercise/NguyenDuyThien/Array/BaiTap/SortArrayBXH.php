<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<?php
 $list = array( 3 => "Em cua ngay hom qua",
 4 => "Si tinh",
 1 => "Chung ta khong thuoc ve nhau",
 2 => "Bigcity Boy",
 5 => "Lac troi"
);
krsort ($list);
echo"<h1>BXH</h1>";
echo "<ul>";
 foreach($list as $key => $value){
    echo"<li>$key - $value</li>";
 }
echo "</ul>";

asort ($list);
echo"<h1>BXH</h1>";
echo "<ul>";
 foreach($list as $key => $value){
    echo"<li>$key - $value</li>";
 }
echo "</ul>";
?>
<form action="" method="get">
<input class="btn btn-primary" style="margin-top:40px" type="submit" value="trở về">
</form>
<?php $this->end(); ?>