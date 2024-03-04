<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "sab";
					
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
			
	$json = file_get_contents('https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol=AAPL&apikey=I19RPNEJSJH056FK');

	$data = json_decode($json, true);
						
	// check if the array key exists
	if (!empty($data['Time Series (Daily)']) && !isset($_COOKIE['Apple'])) {
				
		// Remove all old stock data
		$sql = "DELETE FROM stock WHERE company_ID = 3;";
		$conn->query($sql);
				
		// loop over the contents of Time Series
		foreach( $data['Time Series (Daily)'] AS $date => $results ) { 
			// loop over the results for each date in Time Series
			$open = $results['1. open'];
			$high = $results['2. high'];
			$low = $results['3. low'];
			$close = $results['4. close'];
			$volume = $results['5. volume'];
					
			// Insert new stock data into database
			$sql = "REPLACE INTO stock SET company_ID = 3, date = '$date', time = NULL, open = '$open', high = '$high', low = '$low', close = '$close', volume = '$volume';";
			$conn->query($sql);
					
			// Use a cookie to prevent stock price updates for 5 minutes to limit API calls
			setcookie("Apple", 'updated', time() + 300000);
			$_COOKIE['Apple'] = 'updated';
		}
	}
			
	$sql = "SELECT * FROM stock WHERE company_ID = 3 ORDER BY date ASC;";
	$prices = $conn->query($sql);
			
	// Select all relevant company information to fill out page
	$sql = "SELECT * FROM company WHERE company_ID = 3;";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">

        <!--CSS and JS file-->
		<link href="../../CSS/styles.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
		<script src="../../JavaScript/jScript.js" defer></script>
        

        <!--Webpage name-->
		<title>Apple Stock</title>

        <!--Favicon-->
        <link id="favicon" rel="icon" href="../../Images/penrose.png">
        
		<!-- All script below is used to import a Google Chart to display stock prices -->
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">
			google.charts.load('current', {'packages':['corechart']});
			google.charts.setOnLoadCallback(drawChart);

			function drawChart() {
				var data = google.visualization.arrayToDataTable([
					<?php while($price = $prices->fetch_assoc()) { ?>
						['<?php echo $price['date']; ?>', <?php echo $price['low']; ?>, <?php echo $price['open']; ?>, <?php echo $price['close']; ?>, <?php echo $price['high']; ?>],
					<?php } ?>
				// Treat first row as data as well.
				], true);

				var options = {
					legend:'none',
					backgroundColor: 'white',
					candlestick: {
						fallingColor: { strokeWidth: 0, fill: '#a52714' }, // red
						risingColor: { strokeWidth: 0, fill: '#0f9d58' }   // green
					}
				};

				var chart = new google.visualization.CandlestickChart(document.getElementById('chart_div'));

				chart.draw(data, options);
			}
		</script>
		
	</head>

	<body>
		<header class="pageTop">
			<a href="../HomePage.php"><img src="../../Images/penrose.png" alt="SAB Logo" id="Logo"></a>
			<h1>SAB Financial</h1>
        </header>
        <div class="stockGrid">

            <div class="stockGraph" id="chart_div" style="width: 1500px; height: 500px;">
            </div>
            <div class="generalStockInfo">
                <div class="companyLogo">
                    <img src="../../Images/Apple.png" alt="Apple Logo">
                </div>
                <div class="companyName">
                    <?php
						echo "<p>" . $row['company_name'] . "</p>";
						echo "<p>" . $row['symbol'] . "</p>";
					?>
                </div>
                <div class="stockPrice">
                    <?php
						// Get the stock price data for Apple, order by most recent dates first
						$sql = "SELECT * FROM stock WHERE company_ID = 3 ORDER BY date DESC LIMIT 2";
						$curr_price = $conn->query($sql);
						$new_price = $curr_price->fetch_assoc();
						
						echo "<p>" . $new_price['close'] . "</p>";
					?>
                </div>
            </div>
            <div class="Description">
                <?php 
					echo "<p>Location: " . $row['location'] . "</p>";
					echo "<p>Industry: " . $row['industry'] . "</p>";
					echo "<p>Employees: " . $row['employees'] . "</p>";
					echo "<p>Description: " . $row['description'] . "</p>";
				?>
            </div>
            <div class="Dividend">
                <?php 
					if(is_null($row['dividend_yield']) || is_null($row['dividend_amount'])) {
						echo "<p>Company does not offer a dividend currently.</p>";
					} else {
						echo "<p>Dividend: " . $row['dividend_amount'] . "</p>";
						echo "<p>Dividend Yield: " . $row['dividend_yield'] . "</p>";
					}
				?>
            </div>
            <div class="moreInfo">
                <?php
					echo "<p>Market Cap: " . $row['market_cap'] . "</p>";
					echo "<p>Earning Per Share: " . $row['eps'] . "</p>";
					echo "<p>P/E Ratio: " . $row['pe_ratio'] . "</p>";
					echo "<p>Revenue: " . $row['revenue'] . "</p>";
					echo "<p>Profit Margin: " . $row['profit_margin'] . "</p>";
					echo "<p>Total Debit: " . $row['total_debit'] . "</p>";
				?>
            </div>

        </div>

        <iframe src="" title="Apple News"></iframe>
        
	</body>
	<footer>
		<p id="footerText">Copyright All rights reserved.</p>
	</footer>
</html>