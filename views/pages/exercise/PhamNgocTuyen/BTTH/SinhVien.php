<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<?php 
    class Nguoi{
        var $hoTen;
        var $diaChi;
        var $gioiTinh;
        function __construct($hoTen,$diaChi,$gioiTinh){
            $this->hoTen = $hoTen;
            $this->diaChi = $diaChi;
            $this->gioiTinh = $gioiTinh;    
        }
    }
        class sinhVien extends Nguoi{
            var $hoTen;
            var $diaChi;
            var $gioiTinh;
            var $lopHoc;
            var $nganhHoc;
            function __SinhVien($hoTen,$diaChi,$gioiTinh,$lopHoc,$nganhHoc){
                parent::__construct($hoTen,$diaChi,$gioiTinh);
                $this->lopHoc=$lopHoc;
                $this->nganhHoc=$nganhHoc;
                
            }
            function __tinhDiemThuong(){
                if($this->nganhHoc="CNTT"){
                    return 1;
                }
                elseif($this->nganhHoc="Kinh te"){
                    return 1.5;
                }else{
                    return 0;
                };
            }
        };
        class giangVien extends Nguoi{
            var $trinhDo;
            var $luongCB = 1500000;
            function __giangVien($hoTen,$diaChi,$gioiTinh,$trinhDo,$luongCB){
                parent::__construct($hoTen,$diaChi,$gioiTinh);
                $this->trinhDo=$trinhDo;
                $this->luongCB=$luongCB;
            }
            function __tinhLuong(){
                $luongCB = 1500000;
                if($this->trinhDo="Cu Nhan"){
                    return $luongCB * 2.34;
                }
                elseif($this->trinhDo="Thac Si"){
                    $luongCB * 3.67;
                }elseif($this->trinhDo="Tien Si"){
                    $luongCB * 5.66;
                }
            }
        };
        $sinhVien = new sinhVien("Phạm Ngọc Tuyển","54 Dang Lo","Nam","62CNTT3","CNTT");
        echo "Thông tin sinh viên:";
        echo "Họ tên: " . $sinhVien->hoTen . "<br>";
        echo "Địa chỉ: " . $sinhVien->diaChi . "<br>";
        echo "Giới tính: " . $sinhVien->gioiTinh . "<br>";
        echo "Lớp học: " . $sinhVien->lopHoc . "<br>";
        echo "Ngành học: " . $sinhVien->nganhHoc . "<br>";
    // $hs1->ngaySinh="27/03/2002";
    // echo "<h4>Họ tên: ",$hs1->__getHoTen(),"<h4>";
    
      
?>
<?php $this->end(); ?>