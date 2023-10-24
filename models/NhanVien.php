<?php

use LDAP\Result;

    include_once($_SERVER['DOCUMENT_ROOT'].'/'.explode('/', $_SERVER['PHP_SELF'])[1]."/connect.php");
    class NhanVien{
        protected $maNV, $soCon, $gioiTinh, $heSL;


        function __construct($maNV, $gioiTinh, $soCon, $heSL){
            $this->maNV = $maNV;
            $this->gioiTinh = $gioiTinh;
            $this->soCon = $soCon;
            $this->heSL = $heSL;
        }
        const luongTT = 4_160_000;
        const troCapXang = 500_000;
        const troCapCon = 350_000;
        const dinhMucVang = 1;
        const donGiaPhat = 400_000;

        function getLuongTheoGio(){
            return self::luongTT * $this->heSL / 30 / 8;
        }
        function getLuongTheoNgay(){
            return self::luongTT * $this->heSL / 30;
        }
        
        function LuongTT(){
            return self::luongTT * $this->heSL;
        }

        function getSoNgayCong($conn, $thang, $nam){
            $sql = "SELECT COUNT(MaCong) as SoNgayCong FROM `cham_cong` where MaNV = '$this->maNV' and month(Ngay) = $thang and year(Ngay) = $nam and (TinhTrang = 1 or NghiHL = 1)";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            return $row['SoNgayCong'];
        }
        function getSoNgayVang($conn, $thang, $nam){
            $sql = "SELECT COUNT(MaCong) - 4 as SoNgayVang FROM `cham_cong` where MaNV = '$this->maNV' and month(Ngay) = $thang and year(Ngay) = $nam and TinhTrang = 0 and NghiHL = 0";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            return $row['SoNgayVang'] < 0 ? 0 : $row['SoNgayVang'];
        }
        function TinhTienLuong($conn, $thang, $nam){
            return $this->getLuongTheoNgay() * $this->getSoNgayCong($conn, $thang, $nam); 
        }
        function TinhTroCap(){
            if($this->gioiTinh == "0"){
                return self::troCapCon * $this->soCon * 1.5 + self::troCapXang;
            }
            return self::troCapCon * $this->soCon + self::troCapXang;
        }
        function LuongTangCa($conn, $thang, $nam){
            $tienTC = 0;
            $sql = "SELECT LoaiTC FROM `tang_ca` WHERE MaNV = '$this->maNV' and month(NgayTC) = $thang and year(NgayTC) = $nam";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) <> 0){
                while($row = mysqli_fetch_array($result)){
                    if($row["LoaiTC"] == 0){
                        $tienTC += ($this->getLuongTheoGio() * 1.5 + $this->getLuongTheoGio() * 0.3 + 0.2 * ($this->getLuongTheoGio() * 1.5)) * 4;
                    }
                    else if($row["LoaiTC"] == 1){
                        $tienTC += ($this->getLuongTheoGio() * 2 + $this->getLuongTheoGio() * 0.3 + 0.2 * ($this->getLuongTheoGio() * 2)) * 4;
                    }
                    else {
                        $tienTC += ($this->getLuongTheoGio() * 3 + $this->getLuongTheoGio() * 0.3 + 0.2 * ($this->getLuongTheoGio() * 3)) * 4;
                    }
                }
            }
            return $tienTC;
        }
        function TienTamUng($conn, $thang, $nam){
            $sql = "SELECT SoTien FROM `phieu_ung_luong` WHERE MaNV = '$this->maNV' and month(NgayUng) = $thang and year(NgayUng) = $nam";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) != 0){
                $row = mysqli_fetch_array($result);
                return $row['SoTien'];
            }
            else{
                return 0;
            }
           
        }
        function TruBaoHiem($conn, $thang, $nam){
            return $this->TinhTienLuong($conn, $thang, $nam) * 0.105;
        }
        
        function TinhTienPhat($conn, $thang, $nam){
            if($this->getSoNgayVang($conn, $thang, $nam) > self::dinhMucVang){
                return ($this->getSoNgayVang($conn, $thang, $nam) - self::dinhMucVang) * self::donGiaPhat;
            }
            return 0;
        }
    }
?>