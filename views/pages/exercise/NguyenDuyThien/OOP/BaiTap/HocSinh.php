<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<?php
    class HocSinh{
        private $ma;
        public $ho;
        public $ten;
        public $ngaysinh;
        public $diemtb;
        const HESO = 2;
        
        function setMa($maHS){
            $this->ma = $maHS;
        }
        function getMa(){
            return $this->ma;
        }
        function getHoTen(){
            return $this->ho . " " . $this->ten;
        }
        function getTuoi(){
            $ns = explode("/",$this->ngaysinh);
            return date("Y") - $ns[2];
        }
        function tinhDiem(){
            return $this->diemtb * self::HESO;
        }
    }
    $hs1 = new HocSinh();
    $hs1->setMa(12345);
    $hs1->ho = "Dao Van";
    $hs1->ten = "Minh";
    $hs1->ngaysinh = "15/8/2002";
    $hs1->diemtb = 7;
    echo "<h3>Thong tin hoc sinh</h3>";
    echo "MaHS: " . $hs1->getMa();
    echo "<br>Ho ten: " . $hs1->getHoTen();
    echo "<br> Tuoi: " . $hs1->getTuoi();
    echo "<br> Diem dat duoc: " . $hs1->tinhDiem();
    echo " theo he so diem la " . HocSinh::HESO;
?>
<form action="" method="get">
<input class="btn btn-primary" style="margin-top:40px" type="submit" value="trở về">
</form>
<?php $this->end(); ?>