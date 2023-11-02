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