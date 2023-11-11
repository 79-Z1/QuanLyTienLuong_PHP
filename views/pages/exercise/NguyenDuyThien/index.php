<?php
require_once '../../../template.php';
$page = $_GET['page'] ?? '';
$template = new Template('');
echo $template->render('navbar_exercise', []);
echo $template->render('footer', []);

switch ($page) {
    case 'BTArr1':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien/Array/BaiTap/Array1', []);
        break;
    case 'BTArr2':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien/Array/BaiTap/Array2', []);
        break;
    case 'BTChuoi':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien/Array/BaiTap/Chuoi', []);
        break;
    case 'BTBXH':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien/Array/BaiTap/SortArrayBXH', []);
        break;
    case 'BTThucHanhArr1':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien/Array/ThucHanh/Bai1', []);
        break;
    case 'BTThucHanhArr2':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien/Array/ThucHanh/Bai2', []);
        break;
    case 'BTThucHanhArr3':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien/Array/ThucHanh/Bai3/Bai3', []);
        break;
    case 'BTFormTimSach':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien/Form/BaiTap/timSach', []);
        break;
    case 'KQFormTimSach':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien/Form/BaiTap/xlTimSach', []);
        break;
    case 'BTThucHanhForm1':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien/Form/ThucHanh/Bai1/FormChuViDienTich', []);
        break;
    case 'BTThucHanhForm2':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien/Form/ThucHanh/Bai2/TinhTienDien', []);
        break;
    case 'BTThucHanhForm3':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien/Form/ThucHanh/Bai3/PhepTinh', []);
        break;
    case 'KQThucHanhForm3':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien/Form/ThucHanh/Bai3/KetQua', []);
        break;
    case 'BTThucHanhForm4':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien/Form/ThucHanh/Bai4/ThongTin', []);
        break;
    case 'KQThucHanhForm4':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien/Form/ThucHanh/Bai4/XuLyThongTin', []);
        break;
    case 'BTOOPHinhHoc':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien/OOP/BaiTap/FormHinhHoc', []);
        break;
    case 'BTOOPHocSinh':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien/OOP/BaiTap/HocSinh', []);
        break;
    case 'BTThucHanhOOP2':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien/OOP/ThucHanh/Bai2', []);
        break;
    case 'QLBSttkh':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien/QLBS/thongtinkhachhang', []);
        break;
    case 'QLBSttsua':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien/QLBS/thongtinsua', []);
        break;
    case 'QLBSttsuapt':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien/QLBS/thongtinsua2', []);
        break;
    case 'QLBSTimKiemSuaNC':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien/QLBS/timkiemsuanangcao', []);
        break;
    case 'QLBSThemSua':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien/QLBS/themsua', []);
        break;
    case 'QLBSXoaTTKH':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien/QLBS/xoattkh', []);
        break;
    case 'QLBSSuaTTKH':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/NguyenDuyThien/QLBS/chinhsuattkh', []);
        break;
    default:
        echo $template->render('header_exercise', ['css' => 'NguyenDuyThien/NguyenDuyThien.css']);
        echo $template->render('pages/exercise/NguyenDuyThien/NguyenDuyThien', []);
        break;
}
