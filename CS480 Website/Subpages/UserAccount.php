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
	
	$sql = "SELECT * FROM user WHERE user_name = '$_COOKIE[username]';";
	$result = $conn->query($sql);
	$info = $result->fetch_assoc();
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
		<title>Settings Page</title>

        <!--Favicon-->
        <link id="favicon" rel="icon" href="../Images/penrose.png">
        
        
        
	</head>
	<body>

		<header class="pageTop">
			<a href="../Subpages/HomePage.php"><img src="../Images/penrose.png" alt="SAB Logo" id="Logo"></a>
			<h1>SAB Financial</h1>
        </header>

        <nav class="navIcons">
            <a href="../Index.php"><i class='bx bx-log-out' id = "logoutIcon"></i></a>
            <a href="../Subpages/HomePage.php"><i class='bx bx-home-alt-2' id = "homeIcon"></i></a>
        </nav>

        <div class="homeGrid">
			<div> <?php
				echo "<p>Username: " . $info['user_name'] . "</p>";
				echo "<p>First Name: " . $info['first_name'] . "</p>";
				echo "<p>Last Name: " . $info['last_name'] . "</p>";
				$stock = "SELECT company_name FROM company WHERE company_ID = 
			?>
			</div>
            <!-- <div class="homeGridDivs">Color Scheme</div> -->
            <div class="homeGridDivs"><a href="../Subpages/FavoriteStock.php">Favorite Stock</a></div>
        </div>
	</body>
	<footer>
		<p id="footerText">Copyright All rights reserved.</p>
	</footer>
</html>