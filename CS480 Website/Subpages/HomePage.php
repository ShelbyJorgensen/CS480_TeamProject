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
	
	if(isset($_COOKIE['username'])) {
		$sql = "SELECT favorite_stock FROM user WHERE user_name = '$_COOKIE[username]';";
		$favorite = $conn->query($sql);
		$favorite = $favorite->fetch_assoc();
		$sql = "SELECT * FROM stock WHERE company_ID = '$favorite[favorite_stock]' ORDER BY date ASC;";
		$prices = $conn->query($sql);
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">

        <!--CSS and JS file-->
		<link href="../CSS/styles.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
		<script src="../JavaScript/jScript.js" defer></script>
        

        <!--Webpage name-->
		<title>Home Page</title>

        <!--Favicon-->
        <link id="favicon" rel="icon" href="../Images/penrose.png">
        
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
        <!-- Account Sidebar -->
        <div id="sideBarNav" class="sidenav"> <!--<div id="mySidenav" class="sidenav"></div> -->
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="../Subpages/About.html">About</a>
            <a href="../Subpages/UserAccount.php">Account</a>
            <a href="../Subpages/Help.html">Help</a>
        </div>

        <span onclick="openNav()" class="navIcons"><i class='bx bx-menu' id = "menuIcon"></i></span>

        <div id="main">
            <header class="pageTop">
                <a href="../Index.php"><img src="../Images/penrose.png" alt="SAB Logo" id="Logo"></a>
                <h1>SAB Financial</h1>
            </header>

            <!-- <nav class="navIcons">
                <a href="Account.html"><i class='bx bxs-user' id = "accountIcon"></i></a>
            </nav> -->
			
			<div class="stockGraph">
                <div id="chart_div" style="width: 1300px; height: 500px; margin-left: 5%;"></div>
            </div>
			
			<br><br><br><br><br>

            <div class="homeGrid">
                <div class="homeGridDivs"><a href="../Subpages/Stocks/MicrosoftStock.php"><img src="../Images/Microsoft.png" alt="Microsoft Logo" id="CompanyLogo"></a></div>
                <div class="homeGridDivs"><a href="../Subpages/Stocks/AmazonStock.php"><img src="../Images/Amazon.png" alt="Amazon Logo" id="CompanyLogo"></a></div>
                <div class="homeGridDivs"><a href="../Subpages/Stocks/AppleStock.php"><img src="../Images/Apple.png" alt="Apple Logo" id="CompanyLogo"></a></div>
                <div class="homeGridDivs"><a href="../Subpages/Stocks/TeslaStock.php"><img src="../Images/Tesla.png" alt="Tesla Logo" id="CompanyLogo"></a></div>
                <div class="homeGridDivs"><a href="../Subpages/Stocks/GoogleStock.php"><img src="../Images/Google.png" alt="Google Logo" id="CompanyLogo"></a></div>
                <div class="gridPrice"><p>$<?php
						// Get the stock price data for Microsoft, order by most recent dates first
						$sql = "SELECT * FROM stock WHERE company_ID = 1 ORDER BY date DESC LIMIT 2";
						$curr_price = $conn->query($sql);
						$new_price = $curr_price->fetch_assoc();
						
						echo $new_price['close']; ?></p></div>
                <div class="gridPrice"><p>$<?php
						// Get the stock price data for Amazon, order by most recent dates first
						$sql = "SELECT * FROM stock WHERE company_ID = 2 ORDER BY date DESC LIMIT 2";
						$curr_price = $conn->query($sql);
						$new_price = $curr_price->fetch_assoc();
						
						echo $new_price['close']; ?></p></div>
                <div class="gridPrice"><p>$<?php
						// Get the stock price data for Apple, order by most recent dates first
						$sql = "SELECT * FROM stock WHERE company_ID = 3 ORDER BY date DESC LIMIT 2";
						$curr_price = $conn->query($sql);
						$new_price = $curr_price->fetch_assoc();
						
						echo $new_price['close']; ?></p></div>
                <div class="gridPrice"><p>$<?php
						// Get the stock price data for Tesla, order by most recent dates first
						$sql = "SELECT * FROM stock WHERE company_ID = 8 ORDER BY date DESC LIMIT 2";
						$curr_price = $conn->query($sql);
						$new_price = $curr_price->fetch_assoc();
						
						echo $new_price['close']; ?></p></div>
                <div class="gridPrice"><p>$<?php
						// Get the stock price data for Google, order by most recent dates first
						$sql = "SELECT * FROM stock WHERE company_ID = 7 ORDER BY date DESC LIMIT 2";
						$curr_price = $conn->query($sql);
						$new_price = $curr_price->fetch_assoc();
						
						echo $new_price['close']; ?></p></div>
                <div class="homeGridDivs"><a href="../Subpages/Stocks/MetaStock.php"><img src="../Images/Meta.png" alt="Meta Logo" id="CompanyLogo"></a></div>
                <div class="homeGridDivs"><a href="../Subpages/Stocks/IntelStock.php"><img src="../Images/Intel.png" alt="Intel Logo" id="CompanyLogo"></a></div>
                <div class="homeGridDivs"><a href="../Subpages/Stocks/AMDStock.php"><img src="../Images/AMD.png" alt="AMD Logo" id="CompanyLogo"></a></div>
                <div class="homeGridDivs"><a href="../Subpages/Stocks/OracleStock.php"><img src="../Images/Oracle.png" alt="Oracle Logo" id="CompanyLogo"></a></div>
                <div class="homeGridDivs"><a href="../Subpages/Stocks/NvidiaStock.php"><img src="../Images/Nvidia.png" alt="Nvidia Logo" id="CompanyLogo"></a></div>
                <div class="gridPrice"><p>$<?php
						// Get the stock price data for Meta, order by most recent dates first
						$sql = "SELECT * FROM stock WHERE company_ID = 10 ORDER BY date DESC LIMIT 2";
						$curr_price = $conn->query($sql);
						$new_price = $curr_price->fetch_assoc();
						
						echo $new_price['close']; ?></p></div>
                <div class="gridPrice"><p>$<?php
						// Get the stock price data for Intel, order by most recent dates first
						$sql = "SELECT * FROM stock WHERE company_ID = 4 ORDER BY date DESC LIMIT 2";
						$curr_price = $conn->query($sql);
						$new_price = $curr_price->fetch_assoc();
						
						echo $new_price['close']; ?></p></div>
                <div class="gridPrice"><p>$<?php
						// Get the stock price data for AMD, order by most recent dates first
						$sql = "SELECT * FROM stock WHERE company_ID = 5 ORDER BY date DESC LIMIT 2";
						$curr_price = $conn->query($sql);
						$new_price = $curr_price->fetch_assoc();
						
						echo $new_price['close']; ?></p></div>
                <div class="gridPrice"><p>$<?php
						// Get the stock price data for Oracle, order by most recent dates first
						$sql = "SELECT * FROM stock WHERE company_ID = 9 ORDER BY date DESC LIMIT 2";
						$curr_price = $conn->query($sql);
						$new_price = $curr_price->fetch_assoc();
						
						echo $new_price['close']; ?></p></div>
                <div class="gridPrice"><p>$<?php
						// Get the stock price data for Nvidia, order by most recent dates first
						$sql = "SELECT * FROM stock WHERE company_ID = 6 ORDER BY date DESC LIMIT 2";
						$curr_price = $conn->query($sql);
						$new_price = $curr_price->fetch_assoc();
						
						echo $new_price['close']; ?></p></div>
            </div>
        </div>
		


        
	</body>
	<footer>
		<p id="footerText">Copyright All rights reserved.</p>
	</footer>
</html>