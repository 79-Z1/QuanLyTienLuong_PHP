<?php 
    class HocSinh {
        private $ma;
        private $ho;
        private $ten;
        private $ngaySinh;
        private $diemTB;
        const HESO = 2;

        function setMa($ma) {
            $this->ma = $ma;
        }

        function getMa() {
            return $this->ma;
        }

        function setDiemTB($diemTB) {
            $this->diemTB = $diemTB;
        }

        function getDiemTB() {
            return $this->diemTB;
        }

        function setHoTen($ho,$ten) {
            $this->ho = $ho;
            $this->ten = $ten;
        }

        function getHoTen() {
            return $this->ho." ".$this->ten;
        }

        function setNgaySinh($ngaySinh) {
            $this->ngaySinh=$ngaySinh;
        }

        function getTuoi() {
            $ns = explode("/", $this->ngaySinh);
            return date("Y") - $ns[2];
        }

        function tinhDiem() {
            return $this->diemTB * self::HESO;
        }
    }

    $hs = new HocSinh();
    $hs->setMa("62130607");
    $hs->setHoTen("Trương Khánh", "Hòa");
    $hs->setNgaySinh("12/09/2002");
    $hs->setDiemTB(10);
    echo "<h3>Thông tin học sinh</h3>";
    echo "Mã học sinh: ".$hs->getMa();
    echo "<br>Họ tên học sinh: ".$hs->getHoTen();
    echo "<br>Tuổi học sinh: {$hs->getTuoi()}";
    echo "<br>Điểm đạt được: {$hs->tinhDiem()}";
    echo " theo hệ số điểm là: ". HocSinh::HESO;
?>