<?php
require_once '../../../template.php';
$page = $_GET['page'] ?? '';
$template = new Template('');
echo $template->render('navbar_exercise', []);
echo $template->render('footer', []);

switch ($page) {
    case 'TNT-form-dt_cv_hcn':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_Form/dt_hcn', []);
        break;
    case 'TNT-form-dt_cv':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_Form/Form_ChuVi_DienTich', []);
        break;
    case 'TNT-form-tien-dien':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_Form/Form_Tinh_Tien_Dien', []);
        break;
    case 'TNT-form-phep-tinh':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_Form/pheptinh', []);
        break;
    case 'TNT-form-nhapTT':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_Form/nhapThongTin', []);
        break;
    case 'TNT-form-ket-qua-PT':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_Form/ketquapheptinh', []);
        break;
    case 'TNT-form-xu-ly-TT':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_Form/xulythongtin', []);
        break;

    case 'TNT-Mang-1':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_Mang/btMang_1', []);
        break;
    case 'TNT-Mang-2':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_Mang/btMang_2', []);
        break;
    case 'TNT-Mang-3':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_Mang/btMang_3', []);
        break;
    case 'TNT-Mang-4':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_Mang/btMang_4', []);
        break;
    case 'TNT-Mang-5':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_Mang/btMang_5', []);
        break;
    case 'TNT-Mang-6':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_Mang/btMang_6', []);
        break;
    case 'TNT-Mang-7':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_Mang/btMang_7', []);
        break;
    case 'TNT-Mang-8':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_Mang/btMang_8', []);
        break;
    case 'TNT-Mang-9':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_Mang/btMang_9', []);
        break;
    case 'TNT-Mang-10':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_Mang/btMang_10', []);
        break;
    case 'TNT-Mang-2-Chieu':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_Mang/btMang_2Chieu', []);
        break;
    case 'TNT-Mang-KT':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_Mang/TranNgocTien_62132217', []);
        break;    

    case 'TNT-Object-1':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_Object/btObject_1', []);
        break;    
    case 'TNT-Object-2':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_Object/btObject_2', []);
        break;    
    case 'TNT-Object-3':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_Object/btObject_3', []);
        break;    
    case 'TNT-Object-VD':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_Object/vidu', []);
        break;    
    case 'TNT-Object-KT':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_Object/62132217_TranNgocTien_De2', []);
        break;
        
    case 'TNT-QLBS-List-Sua':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_MySQL/thongtinsua', []);
        break;
    case 'TNT-QLBS-Find-Sua':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_MySQL/timkiemsua', []);
        break;
    case 'TNT-QLBS-List-KH':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_MySQL/thongtinkhachhang', []);
        break;
    case 'TNT-QLBS-Find-KH':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_MySQL/timkiemkhachhang', []);
        break;
    case 'TNT-QLBS-Add-Sua':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_MySQL/themsua', []);
        break;
    case 'TNT-QLBS-Anh-Sua':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_MySQL/Bai_2-5', []);
        break;
    case 'TNT-QLBS-Login':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_MySQL/login', []);
        break;
    case 'TNT-QLBS-Register':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_MySQL/register', []);
        break;
    case 'TNT-QLBS-Detail-Sua':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_MySQL/chitietsua', []);
        break;
    case 'TNT-QLBS-Edit-KH':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_MySQL/edit_kh', []);
        break;
    case 'TNT-QLBS-Delete-KH':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TranNgocTien/Bai_Tap_MySQL/xoakhachhang', []);
        break;
    default:
        echo $template->render('header_exercise', ['css' => 'TranNgocTien/TranNgocTien.css']);
        echo $template->render('pages/exercise/TranNgocTien/TranNgocTien', []);
        break;
}