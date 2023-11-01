(async function () {
    const thongBaoContainer = $('#thongbao-container');
    const url = "http://localhost/QuanLyTienLuong_PHP/api/api-getall-notification.php";
    const data = {
        NguoiNhan: MANV
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
            <div class="card notification-card notification-invitation p-2">
                <div class="card-body">
                    <table>
                        <tr>
                            <td style="width:90%" class="${noti['TinhTrang'] == '0' ? '' : 'readed'}">
                                <div class="card-title">${noti['NoiDung']}</div>
                            </td>
                            <td style="width:10%">
                                <a href="#" class="btn btn-danger dismiss-notification">Xóa</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            `)
        }
    }
})()