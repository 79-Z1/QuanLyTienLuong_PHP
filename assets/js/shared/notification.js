(async function () {
    const thongBaoContainer = $('#thongbao-container');
    const url = "http://localhost/QuanLyTienLuong_PHP/api/api-getall-notification.php";
    const data = {
        NguoiNhan: MANV,
        LoaiTKNguoiNhan: LOAITK
    }
    const { message, status, notiList } = await postData(url, data);
    if (status) {
        const urlUpdate = "http://localhost/QuanLyTienLuong_PHP/api/api-update-to-readed-notification.php";
        for (let noti of notiList) {
            const dataUpdate = {
                MaTB: noti['MaTB']
            }
            await postData(urlUpdate, dataUpdate);
            thongBaoContainer.append(`
            <div class="card notification-card notification-invitation">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="${noti['TinhTrang'] == '0' ? '' : 'readed'}">
                        <div class="card-title">${noti['NoiDung']}</div>
                    </div>
                    <div >
                        <a href="#" class="btn btn-danger dismiss-notification">Xóa</a>
                    </div>
                </div>
            </div>
            `)
        }
    }
})()