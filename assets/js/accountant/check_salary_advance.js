const deletePUL = async (el, maphieu) => {
    const elRemove = $(el).closest("tr");
    const url = "http://localhost/QuanLyTienLuong_PHP/views/pages/accountant/check_salary_advance/api_check_salary_advance.php";
    const data = {
        type: 'delete',
        maphieu
    }
    const { message, status } = await postData(url, data);
    if (status) {
        elRemove.remove();
        toastr.success('Xóa thành công');
    }
}

const acceptPUL = async (el, maphieu, nguoinhan) => {
    const tdChange = $(el).closest("td");
    const pChange = $(el).closest("tr").find('.duyet-p');
    const url = "http://localhost/QuanLyTienLuong_PHP/views/pages/accountant/check_salary_advance/api_check_salary_advance.php";
    const data = {
        type: 'accept',
        maphieu
    }
    const resultUL = await postData(url, data);
    const urlTB = "http://localhost/QuanLyTienLuong_PHP/api/api-send-notification.php";
    const nguoigui = MANV;
    const noidung = `Phiếu ứng lương của bạn đã được duyệt`;
    const dataTB = {
        NguoiGui: nguoigui,
        NguoiNhan: nguoinhan,
        LoaiTKNguoiNhan: 'NV',
        NoiDung: noidung
    }
    const resultTB = await postData(urlTB, dataTB);
    if (resultTB.status && resultUL.status) {
        sendMessage('NV', nguoigui, nguoinhan, noidung);
        tdChange.html(`<i style="font-size:35px !important;color:green;" class='bi bi-check-circle-fill'></i>`);
        pChange.css({ "color": "green" });
        pChange.html("Đã duyệt");
        toastr.success('Duyệt thành công');
    }
}