<?php
abstract class HinhHoc{
    public abstract function Ve();
    public abstract function dienTich();
}
class HinhVuong extends HinhHoc{
    public $canh = 0;
    public function Ve(){
        echo "Ve hinh vuong";
    }
    public function dienTich(){
        return $this->canh * $this->canh;
    }
}
class HinhChuNhat extends HinhHoc{
    public $dai;
    public $rong;
    public function Ve(){
        echo "Ve hinh chu nhat";
    }
    public function dienTich(){
        return $this->dai * $this->rong;
    }
}
$hinhchunhat = new HinhChuNhat();
$hinhchunhat->Ve();
$hinhchunhat->dai = 25;
$hinhchunhat->rong = 20;
echo "<br> Dien tich hinh chu nhat: " . $hinhchunhat->dienTich() . "<br>";
$hinhvuong = new HinhVuong();
$hinhchunhat->Ve();
$hinhchunhat->$canh = 7;
echo "<br> Dien tich hinh vuong: " . $hinhvuong->dienTich();
?>