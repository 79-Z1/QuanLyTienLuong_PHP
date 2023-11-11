<?php
require_once '../../../template.php';
$page = $_GET['page'] ?? '';
$template = new Template('');
echo $template->render('navbar_exercise', []);
echo $template->render('footer', []);

switch ($page) {
    case 'LHT-form-DT_HCN':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/LeHoangThien/BT_Form/DT_HCN', []);
        break;
    case 'LHT-form-TinhTienDien':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/LeHoangThien/BT_Form/TinhTienDien', []);
        break;
    case 'LHT-form-PhepTinh':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/LeHoangThien/BT_Form/PhepTinh', []);
        break;
    case 'LHT-form-KQ_Phep_Tinh':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/LeHoangThien/BT_Form/KQ_Phep_Tinh', []);
        break;
    case 'LHT-form-nhapThongTin':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/LeHoangThien/BT_Form/nhapThongTin', []);
        break;
    case 'LHT-Mang-Chuoi-BT1':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/LeHoangThien/BT_Mang_Chuoi/BT1', []);
        break;
    case 'LHT-Mang-Chuoi-BT2':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/LeHoangThien/BT_Mang_Chuoi/BT2', []);
        break;
    case 'LHT-HDT-BT1':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/LeHoangThien/BT_HDT/BT1', []);
        break;
    case 'LHT-HDT-BT2':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/LeHoangThien/BT_BT_HDT/BT2', []);
        break;
    case 'LHT-CSDL_MySQL-PhanTrang':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/LeHoangThien/CSDL_MySQL/PhanTrang', []);
        break;
    case 'LHT-CSDL_MySQL-BT2_7':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/LeHoangThien/CSDL_MySQL/Bai2_7', []);
        break;
    case 'LHT-CSDL_MySQL-BT2_11':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/LeHoangThien/CSDL_MySQL/Bai2_11', []);
        break;
    default:
        echo $template->render('header_exercise', ['css' => 'LeHoangThien/LeHoangThien.css']);
        echo $template->render('pages/exercise/LeHoangThien/LeHoangThien', []);
        break;
}
