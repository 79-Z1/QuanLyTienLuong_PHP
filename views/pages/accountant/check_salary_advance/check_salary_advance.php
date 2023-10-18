<?php $this->layout('layout_accountant') ?>
<?php $this->section('content'); ?>
<div class="card shadow border-0 mb-7 mt-5">
	<div class="card-header">
		<h5 class="mb-0">BẢNG ỨNG LƯƠNG</h5>
	</div>
	<div class="table-responsive">
		<table class="table table-hover table-nowrap">
			<thead class="thead-light">
				<tr>
					<th scope="col">mã phiếu</th>
					<th scope="col">mã nhân viên</th>
					<th scope="col">ngày ứng</th>
					<th scope="col">lý do</th>
					<th scope="col">số tiền</th>
					<th scope="col">xét duyệt</th>
					<th></th>
				</tr>
			</thead>
			<tbody> 
				{{#each phieuUngLuong}}
				<tr>
					<td>{{this.MaPhieu}}</td>
					<td>{{this.MaNV}}</td>
					<td>{{this.NgayUng}}</td>
					<td>{{this.LyDo}}</td>
					<td>{{#toVND this.SoTien}}{{/toVND}}</td>
					<td><button class="btn btn-sm btn-neutral js-btn-duyet" data-bs-toggle="modal" data-ma-phieu="{{this.MaPhieu}}" data-bs-target="#staticBackdrop">Duyệt</button></td>
					<td class="text-end">
                        <button type="button" class="btn btn-sm btn-xoa btn-square btn-neutral2 text-danger-hover" data-ma-phieu="{{this.MaPhieu}}" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
							<i class="bi bi-trash"></i>
						</button>
					</td>
				</tr>
				{{/each}}
                <!-- Modal1 -->
					<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="staticBackdropLabel">Xác nhận</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<h3>Bạn có chắc chắn muốn duyệt không</h3>
							</div>
							<div class="modal-footer">
								<button type="button" class="btnn " data-bs-dismiss="modal">Close</button>
								<button type="button" class="btnn duyet-yes-btn" data-bs-dismiss="modal">Yes</button>
							</div>
							</div>
						</div>
					</div>
                <!-- Modal2 -->
					<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
						<div class="modal-dialog test-modal">
							<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="staticBackdropLabel">Xác nhận</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<h3>Bạn có chắc chắn muốn xóa phiếu ứng lương này không</h3>
							</div>
							<div class="modal-footer">
								<button type="button" class="btnn " data-bs-dismiss="modal">Close</button>
								<button type="button" class="btnn xoa-yes-btn" data-bs-dismiss="modal">Yes</button>
							</div>
							</div>
						</div>
					</div>
			</tbody>
		</table>
	</div>
</div>

<script>
	let maPhieu = '';

	$('.js-btn-duyet').on('click',async function() {
		maPhieu = $(this).data("ma-phieu");
	})

	$('.duyet-yes-btn').on('click',async function(e) {
		await checkUngLuong(maPhieu, 1);
		window.location.reload();
	})


	$('.btn-xoa').on('click',async function() {
		maPhieu = $(this).data("ma-phieu");
		console.log(maPhieu)
	})

	$('.xoa-yes-btn').on('click',async function() {
		await checkUngLuong(maPhieu, 0);
		window.location.reload();
	})


	async function checkUngLuong(maphieu, isduyet) {
		const payload = {
			maphieu: maphieu,
			duyet: isduyet
		}
		return (await instance.put('/admin/ung-luong/check', payload)).data
	}
</script>
<?php $this->end(); ?>