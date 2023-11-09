$(document).ready(async function () {
    const url = "http://localhost/QuanLyTienLuong_PHP/api/api-countnew-notification.php";
    const data = {
        NguoiNhan: MANV,
        LoaiTKNguoiNhan: LOAITK
    }
    const { message, status, newNotiNumber } = await postData(url, data);
    if (status && newNotiNumber > 0) {
        $('#num-noti').css({
            'background-color': 'red',
            'display': 'block'
        })
        $('#num-noti').text(`${newNotiNumber}`);
    } else {
        $('#num-noti').css({ 'display': 'none' })
    }
    $('input[type=radio][name=tabs]').change(async function () {
        if ($('#tab-5').is(':checked')) {
            $('#num-noti').css({ 'display': 'none' })
        }
    });

    $('#btn-logout').on('click', () => {
        sessionStorage.clear();
        localStorage.clear();
        clearAllCookie();
        location.href = 'http://localhost/QuanLyTienLuong_PHP'
    })
})

$('#change').on('click', async (e) => {
    e.preventDefault();
    let err = false;
    if (!$.trim($('#oldPass').val())) {
        err = true;
        $('#oldPass-err').text('*Mật khẩu cũ không được để trống');
        $('#oldPass-err').css({ 'color': 'red' });
    }

    if (!$.trim($('#newPass').val())) {
        err = true;
        $('#newPass-err').text('*Mật khẩu mới không được để trống');
        $('#newPass-err').css({ 'color': 'red' });
    }

    if (!$.trim($('#reNewPass').val())) {
        err = true;
        $('#reNewPass-err').text('*Nhập lại mật khẩu không được để trống');
        $('#reNewPass-err').css({ 'color': 'red' });
    } else if ($.trim($('#newPass').val()) != $.trim($('#reNewPass').val())) {
        err = true;
        $('#reNewPass-err').text('*Nhập lại mật khẩu không đúng');
        $('#reNewPass-err').css({ 'color': 'red' });
    } else {
        const url = "http://localhost/QuanLyTienLuong_PHP/api/api-check-old-pass.php";
        const data = {
            MaNV: MANV,
            OldPass: $('#oldPass').val()
        }
        const { message, status, check } = await postData(url, data);
        if (status && !check) {
            $('#oldPass-err').text('*Mật khẩu cũ không đúng');
            $('#oldPass-err').css({ 'color': 'red' });
        } else if (status && check) {
            const urlChange = "http://localhost/QuanLyTienLuong_PHP/api/api-update-pass.php";
            const dataChange = {
                TenTK: MANV,
                MatKhau: $('#newPass').val()
            }
            await postData(urlChange, dataChange);
            toastr.success('Đổi mật khẩu thành công!');
            setTimeout(() => {
                location.href =  'http://localhost/QuanLyTienLuong_PHP/views/pages/employee'
            }, 2000)
        }
    }

})

async function submitUL() {
    if ($.trim($('#sotien').val()) && $.trim($('#lydo').val())) {
        const max = $("#sotien").attr("max");
        if (parseInt($('#sotien').val()) < parseInt(max)) {
            const nguoigui = MANV;
            const nguoinhan = 'NV004';
            const noidung = `${nguoigui} ứng ${$('#sotien').val()} đ với lý do ${$('#lydo').val()}`;
            sendMessage('KT', nguoigui, nguoinhan, noidung);
            const url = "http://localhost/QuanLyTienLuong_PHP/api/api-send-notification.php";
            const data = {
                NguoiGui: nguoigui,
                NguoiNhan: nguoinhan,
                LoaiTKNguoiNhan: 'KT',
                NoiDung: noidung
            }
            const { message, status } = await postData(url, data);
            if (status) {
                return true;
            }
            else return false;

        } toastr.error(`Số tiền ứng tối đa là ${max} đ`); return false;
    } else {
        toastr.error('Vui lòng điền đầy đủ thông tin');
        return false;
    }
}