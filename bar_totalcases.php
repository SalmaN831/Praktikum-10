<?php
//mengubungkan dengan file koneksi.php
include('koneksi.php'); 
//mengambil data dari tabel tb_covid
$query = mysqli_query($koneksi,"select * from tb_covid");
while($row = mysqli_fetch_array($query)){
	$country[] = $row['country'];
	$total_cases[] = $row['total_cases'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bar Chart Total Cases</title>
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
			type: 'bar', //tipe chart bar
			data: {
				labels: <?php echo json_encode($country); ?>, //label chart country
				datasets: [{
					label: 'Total Cases COVID-19',
					data: <?php echo json_encode($total_cases); ?>, //data bar
					backgroundColor: 'rgba(255, 99, 132, 0.2)', //warna background
					borderColor: 'rgba(255,99,132,1)', //warna border
					borderWidth: 1 //tebal border
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>