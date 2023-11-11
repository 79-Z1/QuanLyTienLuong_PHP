<?php
require_once '../../../template.php';
$page = $_GET['page'] ?? '';
$template = new Template('');
echo $template->render('navbar_exercise', []);
echo $template->render('footer', []);

switch ($page) {
    case 'PNT-HV':
        echo $template->render('header_exercise', ['css' => 'PhamNgocTuyen/PhamNgocTuyen.css']);
        echo $template->render('pages/exercise/PhamNgocTuyen/BTTH/ChuVi_DienTichHV', []);
        break;
    case 'PNT-DS':
        echo $template->render('header_exercise', ['css' => 'PhamNgocTuyen/PhamNgocTuyen.css']);
        echo $template->render('pages/exercise/PhamNgocTuyen/BTTH/bai1', []);
        break;
    case 'PNT-SD':
        echo $template->render('header_exercise', ['css' => 'PhamNgocTuyen/PhamNgocTuyen.css']);
        echo $template->render('pages/exercise/PhamNgocTuyen/BTTH/btvn1', []);
        break;
    case 'PNT-FHH':
        echo $template->render('header_exercise', ['css' => 'PhamNgocTuyen/PhamNgocTuyen.css']);
        echo $template->render('pages/exercise/PhamNgocTuyen/BTTH/dt_hcn', []);
        break;
    case 'PNT-TTD':
        echo $template->render('header_exercise', ['css' => 'PhamNgocTuyen/PhamNgocTuyen.css']);
        echo $template->render('pages/exercise/PhamNgocTuyen/BTTH/Form_tinh_tien_dien', []);
        break;
    case 'PNT-FSTN':
        echo $template->render('header_exercise', ['css' => 'PhamNgocTuyen/PhamNgocTuyen.css']);
        echo $template->render('pages/exercise/PhamNgocTuyen/BTTH/formbt1', []);
        break;
    case 'PNT-BCC':
        echo $template->render('header_exercise', ['css' => 'PhamNgocTuyen/PhamNgocTuyen.css']);
        echo $template->render('pages/exercise/PhamNgocTuyen/BTTH/helloworld', []);
        break;
    case 'PNT-NVTH':
        echo $template->render('header_exercise', ['css' => 'PhamNgocTuyen/PhamNgocTuyen.css']);
        echo $template->render('pages/exercise/PhamNgocTuyen/BTTH/PhamNgocTuyen_62132593', []);
        break;
    case 'PNT-SV':
        echo $template->render('header_exercise', ['css' => 'PhamNgocTuyen/PhamNgocTuyen.css']);
        echo $template->render('pages/exercise/PhamNgocTuyen/BTTH/SinhVien', []);
        break;
    case 'PNT-2S':
        echo $template->render('header_exercise', ['css' => 'PhamNgocTuyen/PhamNgocTuyen.css']);
        echo $template->render('pages/exercise/PhamNgocTuyen/BTTH/tinh_2_so', []);
        break;
    case 'PNT-NC':
        echo $template->render('header_exercise', ['css' => 'PhamNgocTuyen/PhamNgocTuyen.css']);
        echo $template->render('pages/exercise/PhamNgocTuyen/BTTH/vidu', []);
        break;
    case 'PNT-VDHH':
        echo $template->render('header_exercise', ['css' => 'PhamNgocTuyen/PhamNgocTuyen.css']);
        echo $template->render('pages/exercise/PhamNgocTuyen/BTTH/viduhinhhoc', []);
        break;
        // KiemTra -------------------------------------------------------------
    case 'PNT-KTGK':
        echo $template->render('header_exercise', ['css' => 'PhamNgocTuyen/PhamNgocTuyen.css']);
        echo $template->render('pages/exercise/PhamNgocTuyen/kiemtra/62132593_PhamNgocTuyen_De1', []);
        break;
    case 'PNT-KTM':
        echo $template->render('header_exercise', ['css' => 'PhamNgocTuyen/PhamNgocTuyen.css']);
        echo $template->render('pages/exercise/PhamNgocTuyen/kiemtra/kiemtra', []);
        break;
        // Mang-------------------------------------------------------------
    case 'PNT-MS':
        echo $template->render('header_exercise', ['css' => 'PhamNgocTuyen/PhamNgocTuyen.css']);
        echo $template->render('pages/exercise/PhamNgocTuyen/Mang/mang', []);
        break;
    case 'PNT-MHC':
        echo $template->render('header_exercise', ['css' => 'PhamNgocTuyen/PhamNgocTuyen.css']);
        echo $template->render('pages/exercise/PhamNgocTuyen/Mang/mang2chieu', []);
        break;
        // Sua-------------------------------------------------------------
    case 'PNT-DNSua':
        echo $template->render('header_exercise', ['css' => 'PhamNgocTuyen/PhamNgocTuyen.css']);
        echo $template->render('pages/exercise/PhamNgocTuyen/QLBanSua/Login', []);
        break;
    case 'PNT-TTKH':
        echo $template->render('header_exercise', ['css' => 'PhamNgocTuyen/PhamNgocTuyen.css']);
        echo $template->render('pages/exercise/PhamNgocTuyen/QLBanSua/thongtinKH', []);
        break;
    case 'PNT-TTS':
        echo $template->render('header_exercise', ['css' => 'PhamNgocTuyen/PhamNgocTuyen.css']);
        echo $template->render('pages/exercise/PhamNgocTuyen/QLBanSua/thongtinSua', []);
        break;
    case 'PNT-TKKH':
        echo $template->render('header_exercise', ['css' => 'PhamNgocTuyen/PhamNgocTuyen.css']);
        echo $template->render('pages/exercise/PhamNgocTuyen/QLBanSua/timkiemkhachhang', []);
        break;
    case 'PNT-TKS':
        echo $template->render('header_exercise', ['css' => 'PhamNgocTuyen/PhamNgocTuyen.css']);
        echo $template->render('pages/exercise/PhamNgocTuyen/QLBanSua/timkiemsua', []);
        break;
    case 'PNT-editS':
        echo $template->render('header_exercise', ['css' => 'PhamNgocTuyen/PhamNgocTuyen.css']);
        echo $template->render('pages/exercise/PhamNgocTuyen/QLBanSua/edit_milk', []);
        break;
    case 'PNT-deleteKH':
        echo $template->render('header_exercise', ['css' => 'PhamNgocTuyen/PhamNgocTuyen.css']);
        echo $template->render('pages/exercise/PhamNgocTuyen/QLBanSua/delete_kh', []);
        break;


    default:
        echo $template->render('header_exercise', ['css' => 'PhamNgocTuyen/PhamNgocTuyen.css']);
        echo $template->render('pages/exercise/PhamNgocTuyen/PhamNgocTuyen', []);
        break;
}