<?php
//menghubungkan dengan file koneksi.php
include('koneksi.php'); 
//mengambil data dari tabel tb_covid
$query = mysqli_query($koneksi,"select * from tb_covid"); 
while($row = mysqli_fetch_array($query)){
	$country[] = $row['country']; 
	$total_cases[] = $row['total_cases']; 
	$new_cases[] = $row['new_cases'];
	$total_death[] = $row['total_death'];
	$new_death[] = $row['new_death'];
	$total_recovered[] = $row['total_recovered'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bar Chart 10 Negara</title>
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
				labels: <?php echo json_encode($country); ?>, //label chart
				datasets: [{
					//total cases
					label: 'total cases',
					data: <?php echo json_encode($total_cases); ?>,
					backgroundColor: 'rgba(252, 99, 132, 0.2)', 
					borderColor: 'rgba(211,99,132,1)', 
					borderWidth: 1 
				
				},
					//new cases
					{ 
					label: 'new cases',
					data: <?php echo json_encode($new_cases); ?>, 
					backgroundColor: 'rgba(255, 99, 132, 0.7)', 
					borderColor: 'rgba(255,19,152,7)', 
					borderWidth: 1 
				},
					//total death
					{
					label: 'total death',
					data: <?php echo json_encode($total_death); ?>, 
					backgroundColor: 'rgba(275, 69, 192, 1)',
					borderColor: 'rgba(295,19,132,1)', 
					borderWidth: 1 
				
				},
					//new death
					{
					label: 'new death',
					data: <?php echo json_encode($new_death); ?>, 
					backgroundColor: 'rgba(255, 49, 14, 11)', 
					borderColor: 'rgba(255,99,132,1)', 
					borderWidth: 1 
				},
					//total recovered
					{
					label: 'total recovered',
					data: <?php echo json_encode($total_recovered); ?>, 
					backgroundColor: 'rgba(115, 91, 112, 2)', 
					borderColor: 'rgba(255,99,132,1)', 
					borderWidth: 1 
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