<?php $this->layout('layout') ?>
<?php $this->section('content'); ?>
<div class="card shadow border-0 mb-7 mt-5">
	<div class="card-header d-flex justify-content-center">
		<h5 class="mb-0">BẢNG BÁO CÁO THỐNG KÊ LƯƠNG CÔNG TY THÁNG 12</h5>
	</div>
	<div class="table-responsive">
			<tbody>
				<table>
					<div class="d-flex justify-content-center">
					<canvas id="myChart" style="width:100%;max-width:1150px"></canvas>
				</div>
				</table>
			</tbody>
	</div>
</div>

<script>
	var xValues = ["Tháng 1","Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6","Tháng 7","Tháng 8","Tháng 9","Tháng 10","Tháng 11","Tháng 12"];
	var yValues = [ 250, 225, 210, 275, 300, 245, 220,225, 260, 230, 215, 300 , 0 , 350];
	var barColors = ["red", "green","blue","orange","brown","silver", "lime","cyan","Fuchsia","Navy", "Teal","Olive"];
	new Chart("myChart", {
		type: "bar",
		data: {
			labels: xValues,
			datasets: [{
				backgroundColor: barColors,
				data: yValues
			}]
	},
	options: {
		legend: {display: false},
		title: {
		display: true
		},
		axisY:{
			minimum: 150,
		},
	}
	});
	chart.render();
</script>
<?php $this->end(); ?>