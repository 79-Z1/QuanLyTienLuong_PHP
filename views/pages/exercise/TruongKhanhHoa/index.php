<?php
require_once '../../../template.php';
$page = $_GET['page'] ?? '';
$template = new Template('');
echo $template->render('navbar_exercise', []);
echo $template->render('footer', []);

switch ($page) {
    case 'TKH-form-chuvi-dientich':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa/form/form-chuvi-dientich', []);
        break;
    case 'TKH-form-tinh-tien-dien':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa/form/form-tinh-tien-dien', []);
        break;
    case 'TKH-form-pheptinh':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa/form/pheptinh', []);
        break;
    case 'TKH-form-ketquapheptinh':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa/form/ketquapheptinh', []);
        break;
    case 'TKH-form-nhapthongtin':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa/form/nhapthongtin', []);
        break;
    case 'TKH-form-xulythongtin':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa/form/xulythongtin', []);
        break;
    case 'TKH-mangchuoi-binhchon':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa/mangchuoi/binhchon', []);
        break;
    case 'TKH-mangchuoi-mangsonguyen':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa/mangchuoi/mangsonguyen', []);
        break;
    case 'TKH-mangchuoi-timnamnhuan':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa/mangchuoi/timnamnhuan', []);
        break;
    case 'TKH-mangchuoi-timnamamlich':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa/mangchuoi/timnamamlich', []);
        break;
    case 'TKH-mangchuoi-ktragiuaki':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa/mangchuoi/ktra_giua_ki', []);
        break;
    case 'TKH-mangchuoi-timnamamlich':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa/mangchuoi/timnamamlich', []);
        break;
    case 'TKH-oop-nhanvien':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa/oop/nhan_vien', []);
        break;
    case 'TKH-oop-hinhhoc':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa/oop/hinh_hoc_form', []);
        break;
    case 'TKH-oop-phanso':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa/oop/phan_so_form', []);
        break;
    case 'TKH-oop-thidaihoc':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa/oop/thidaihoc', []);
        break;
    case 'TKH-mysql-ttsua':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa/mysql/Sua/thongtinsua', []);
        break;
    case 'TKH-mysql-chitietsua':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa/mysql/Sua/chitietsua', []);
        break;
    case 'TKH-mysql-timsuadongian':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa/mysql/Sua/timkiemdongian', []);
        break;
    case 'TKH-mysql-timsuanangcao':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa/mysql/Sua/timkiemnangcao', []);
        break;
    case 'TKH-mysql-themsua':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa/mysql/Sua/themsua', []);
        break;
    case 'TKH-mysql-ttkh':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa/mysql/KhachHang/thongtinkhachhang', []);
        break;
    case 'TKH-mysql-timkh':
        echo $template->render('header_exercise', []);
        echo $template->render('pages/exercise/TruongKhanhHoa/mysql/KhachHang/timkiemkhachhang', []);
        break;
    default:
        echo $template->render('header_exercise', ['css' => 'TruongKhanhHoa/TruongKhanhHoa.css']);
        echo $template->render('pages/exercise/TruongKhanhHoa/TruongKhanhHoa', []);
        break;
}