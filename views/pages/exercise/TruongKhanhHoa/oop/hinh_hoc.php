<?php 
    abstract class HinhHoc {
        abstract public function ve();
        abstract public function tinhDienTich();
    }

    class HinhVuong extends HinhHoc {
        public $canh = 0;
        public function __construct($canh) {
            $this->canh = $canh;
        }
        public function ve() {
            return "Vẽ hình vuông";
        }
        public function tinhDienTich(){
            return $this->canh * $this->canh;
        }
    }

    class HinhChuNhat extends HinhHoc {
        public $dai = 0;
        public $rong = 0;

        public function __construct($dai, $rong) {
            $this->dai = $dai;
            $this->rong = $rong;
        }

        public function ve() {
            return "Vẽ hình chữ nhật";
        }
        public function tinhDienTich(){
            return $this->dai * $this->rong;
        }
    }

    $hinhVuong = new HinhVuong(5);
    $hinhChuNhat = new HinhChuNhat(3,2);
    echo "<h3>HÌNH VUÔNG</h3>";
    echo "<ul>
        <li>Vẽ: {$hinhVuong->ve()}</li>
        <li>Diện tích: {$hinhVuong->tinhDienTich()}</li>
    </ul>";
    echo "<br><h3>HÌNH CHỮ NHẬT</h3>";
    echo "<ul>
        <li>Vẽ: {$hinhChuNhat->ve()}</li>
        <li>Diện tích: {$hinhChuNhat->tinhDienTich()}</li>
    </ul>";
?>