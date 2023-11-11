<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<?php 
    class hocSinh{
        private $maSV;
        public $ho;
        public $ten;
        public $ngaySinh;
        private $diemtb;
        function __setMaSV($maSV){
            $this->maSV = $maSV;
        }   
        function __getMaSV(){
            return $this->maSV;
        }
        function __getHoTen(){
            return $this->ho . " " . $this->ten;    
        }
        function __getTuoi(){
            $ns = explode("/",$this->ngaySinh);
            return date("Y") - $ns[2];
        }
    }
    $hs1 = new hocSinh();
    $hs1->__setMaSV("62132593");
    $hs1->ho="Phạm Ngọc";
    $hs1->ten="Tuyển";
    $hs1->ngaySinh="27/03/2002";
    echo "<h4>Thông Tin Sinh Viên<h4>";
    echo "MSSV: ".$hs1->__getMaSV();
    echo "<br>Họ tên: ".$hs1->__getHoTen();
    echo "<br> Tuổi: {$hs1->__getTuoi()}";
?>
<?php $this->end(); ?>
