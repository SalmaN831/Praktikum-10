<?php
//menghubungkan dengan file koneksi.php
include('koneksi.php'); 
//mengambil data dari tabel tb_covid
$query = mysqli_query($koneksi,"select * from tb_covid"); 
while($row = mysqli_fetch_array($query)){ 
	$country[] = $row['country'];  
	$total_cases = $row['total_cases'];  
	$new_cases[] = $row['new_cases'];  
	$total_death[] = $row['total_death'];  
	$new_death[] = $row['new_death'];  
	$total_recovered[] = $row['total_recovered']; 
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Line Chart 10 Negara</title>
	<!--memanggil file chart.js -->
	<script type="text/javascript" src="Chart.js"></script> 
</head>
<body>
	<div style="width: 800px;height: 800px">
		<canvas id="myChart"></canvas>
	</div>

	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line', //tipe chart line
			data: {
				labels: <?php echo json_encode($country); ?>,
				datasets: [
				{
					//total cases
					label: 'total cases',
					fill: false, 
					data: <?php echo json_encode($total_cases); ?>,
					backgroundColor: 'rgba(171, 54, 35, 1)', 
					borderColor: 'rgba(255,99,132,1)', 
					borderWidth: 1
				},
				{
					//new cases
					label: 'new cases',
					fill: false, 
					data: <?php echo json_encode($new_cases); ?>,
					backgroundColor: 'rgba(235, 99, 132, 1)', 
					borderColor: 'rgba(255,91,132,1)', 
					borderWidth: 1
				},
				{
					//total death
					label: 'total death',
					fill: false,
					data: <?php echo json_encode($total_death); ?>,
					backgroundColor: 'rgba(65, 135, 245, 1)',
					borderColor: 'rgba(66, 155, 245,1)',
					borderWidth: 1
				},
				{
					//new death
					label: 'new death',
					fill: false,
					data: <?php echo json_encode($new_death); ?>,
					backgroundColor: 'rgba(249, 152, 35, 1)',
					borderColor: 'rgba(247, 132, 35,1)',
					borderWidth: 1
				},
				{
					//total recovered
					label: 'total recovered',
					fill: false,
					data: <?php echo json_encode($total_recovered); ?>,
					backgroundColor: 'rgba(133, 295, 29, 1)',
					borderColor: 'rgba(133, 245, 89,1)',
					borderWidth: 1
				},
				]
			},
			options: {
				elements: {
			        line: {
			            tension: 0
			        }
			    },
				legend: {
					display: true
				},
				barValueSpacing: 20,
				scales: {
					yAxes: [{
						ticks: {
							min: 0,
						}
					}],
					xAxes: [{
						gridLines: {	
							color: "rgba(0, 0, 0, 0)",
						}
					}]
				}
			}
		});
	</script>
</body>
</html>