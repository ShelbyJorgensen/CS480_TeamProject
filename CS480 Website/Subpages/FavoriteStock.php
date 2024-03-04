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
	
	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_COOKIE['username'])) {
		$stock = $_POST['stocks'];
		
		$sql = "UPDATE user SET favorite_stock = '$stock' WHERE user_name = '$_COOKIE[username]';";
		$conn->query($sql);
		$_COOKIE['favoriteStock'] = $stock;
		header("Location: ./HomePage.php");
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
		<title>Change Favorite Stock Page</title>

        <!--Favicon-->
        <link id="favicon" rel="icon" href="../Images/penrose.png">

	</head>
	<body>

		<header class="pageTop">
			<a href="../Subpages/HomePage.php"><img src="../Images/penrose.png" alt="SAB Logo" id="Logo"></a>
			<h1>SAB Financial</h1>
		</header>

        <div class="loginInput">
            <form method="post" action="">
                <h2 id = "loginHeader">Change Favorite Stock</h2>
                <div class="loginText">
                    <label for="stocks">Choose a Stock:</label>

                    <select name="stocks" id="stocks">
                        <option value="2">Amazon</option>
                        <option value="5">AMD</option>
                        <option value="3">Apple</option>
                        <option value="7">Google</option>
                        <option value="4">Intel</option>
                        <option value="10">Meta</option>
                        <option value="1">Microsoft</option>
                        <option value="6">Nvidia</option>
                        <option value="9">Oracle</option>
                        <option value="8">Tesla</option>
                    </select>

                </div>
                
                <input type="submit" class="btn" value="Change">

            </form>
        </div>
	</body>
	<footer>
		<p id="footerText">Copyright All rights reserved.</p>
	</footer>
</html>