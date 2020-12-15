//討論終了画面
<?php
session_start();

$odai;
$result;


?>

<head>
<h1>討論結果</h1>
<style>
		body {
			text-align: center;
		}

		#domannaka {
			width: 70%;
			position: absolute;
			top: 50%;
			left: 50%;
			-webkit-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
			text-align: center;
			/*一応BOX内の文字も中央寄せ*/
		}
	</style>
</head>
<body>
<p id="odai">お題:    ここに討論DBからお題の値    </p>
<div id="domannaka">
		<canvas id="myPieChart"></canvas>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>

	<script>
		var ctx = document.getElementById("myPieChart");
		var myPieChart = new Chart(ctx, {
			type: 'doughnut',
			data: {
				labels: ["賛成", "反対"],
				datasets: [{
					backgroundColor: [
						"#13178E",
						"#888"
					],
					borderColor: [
						"#13178E",
						"#888"
					],
					data: [40, 60]
				}]
			},
			options: {
				title: {
					display: true,
					text: '討論結果'
				}
			}
		});
	</script>
    
    <a href="home.php">ホーム画面へ</a>

</body>