<?php
    class HocSinh{
        const heSo = 10;
        var $ho;
        var $ten;
        var $ngaySinh;
        var $diemTB;

        function setHoTen($ho, $ten){
            $this->ho = $ho;
            $this->ten = $ten;
        }

        function getHoTen(){
            return $this->ho . " " . $this->ten;
        }

        function TinhTuoi(){
            $ns = explode("/",$this->ngaySinh);
            return date("Y") - $ns[2];
        }

        function TinhDiem(){
            return $this->diemTB * self::heSo;
        }

    }


    $hs1 = new HocSinh();
    $hs1->setHoTen("Trần Ngọc","Tiến");
    $hs1->ngaySinh = "10/05/2019";
    $hs1->diemTB = 10.0;



    echo "Họ tên: " . $hs1->getHoTen();
    echo " Tuổi: " . $hs1->TinhTuoi();
    echo " Điểm: " . $hs1->TinhDiem();

    echo "Hệ số là: " . $hs1::heSo;


?>