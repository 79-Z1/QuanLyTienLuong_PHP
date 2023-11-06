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
            if (status) return true;
            else return false;

        } toastr.error(`Số tiền ứng tối đa là ${max} đ`); return false;
    } else {
        toastr.error('Vui lòng điền đầy đủ thông tin');
        return false;
    }
}