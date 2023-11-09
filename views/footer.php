<?php $this->section('footer'); ?>
<style>
    .left-footer {
        width: 17%;
        border-right: 1px solid #e7eaf0;
    }

    .footer {
        text-align: center;
        width: 83%;
        border-top: 2px solid #e7eaf0;
        padding-top: 5px;
    }

    .footer p {
        color: black !important;
        font-weight: var(--x-body-font-weight);
        font-size: var(--x-body-font-size);
        line-height: var(--x-body-line-height);
        height: auto !important;
    }

    .footer span {
        color: purple !important;
    }

    .member {
        width: 100%;
        margin: 5px 0;
        
    }

    .member table{
        width: 50% !important;
        text-align: center;
    }

    .member table td {
        padding: 0 !important;
        border-right: 1px solid black !important;
        color: purple !important;
        font-size: 14px !important;
    }
</style>
<div class="d-flex">
    <div class="left-footer">
    </div>
    <div class="footer bg-surface-secondary">
        <p>Developed by <span>Nhóm 1 Lớp 62.CNTT-3 Khoa Công nghệ Thông tin</span></p>
        <div class="member d-flex justify-content-center ">
            <table>
                <tr>
                    <td>Trần Ngọc Tiến</td>
                    <td>Trương Khánh Hòa</td>
                    <td>Nguyễn Duy Thiên</td>
                    <td>Phạm Ngọc Tuyển</td>
                    <td style="border-right: none !important; ">Lê Hoàng Thiện</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<?php $this->end(); ?>