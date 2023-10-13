<?php
    class NhanVien{
        var $maNV;
        var $hoNV;
        var $tenNV;
        var $gioiTinh;
        var $ngaySinh;
        var $diaChi;
        var $stk;
        var $cccd;
        var $soCon;
        var $maPhong;
        var $maChucVu;
        const troCapXang = 500000;
        const troCapCon = 350000;
        const dinhMucVang = 1;
        const donGiaPhat = 400000;
        function getHoTen(){
            return $this->hoNV . " " . $this->tenNV;
        }
        function getGioiTinh(){
            if($this->gioiTinh == 0) return "Nữ";
            else return "Nam";
        }
        function getTenChucVu(){
           // đợi chờ một điều gì đó...
        }
        function getTenPhong(){
            // đợi chờ một điều gì đó...
        }
        function getHSL(){
            // đợi chờ một điều gì đó...
         }
        function TinhTroCap(){
            if($this->gioiTinh == "0"){
                return self::troCapCon * $this->soCon * 1.5 + self::troCapXang;
            }
            return self::troCapCon * $this->soCon + self::troCapXang;
        }
        public function TinhTienPhat(){
            // if($this->soNgayVang > self::dinhMucVang){
            //     return ($this->soNgayVang - self::dinhMucVang) * self::donGiaPhat;
            // }
            // return 0;
        }
    }
?>