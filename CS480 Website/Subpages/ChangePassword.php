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
		$oldPassword = test_input($_POST['oldPassword']);
		$newPassword = test_input($_POST['newPassword']);
		$confirmPassword = test_input($_POST['confirmPassword']);
		
		// Only insert data when all fields have a value in them
		if(strlen($oldPassword) > 0 && strlen($newPassword) > 0 && strlen($confirmPassword) > 0 && $newPassword === $confirmPassword) {
			$select = "SELECT * FROM user";
			$result = $conn->query($select);
			
			$hashed = password_hash($newPassword, PASSWORD_BCRYPT);
			
			while($row = $result->fetch_assoc()) {
				if($row['user_name'] === $_COOKIE['username'] && password_verify($oldPassword, $row['password'])) {
					$sql = "UPDATE user SET password = '$hashed' WHERE user_name = '$_COOKIE[username]';";
					$conn->query($sql);
					header("Location: ./HomePage.php");
				}
			}
		}
	}
	function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
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
		<title>Change Password Page</title>

        <!--Favicon-->
        <link id="favicon" rel="icon" href="../Images/penrose.png">

	</head>
	<body>

		<header class="pageTop">
			<a href="../Subpages/HomePage.php"><img src="../Images/penrose.png" alt="SAB Logo" id="Logo"></a>
			<h1>SAB Financial</h1>
		</header>

        <section class="loginInput">
            <form method="post" action="">
                <h2 id = "loginHeader">Change Password</h2>
                <div class="loginText">
                    <input type="password" name="oldPassword" placeholder="Old Password" required>
                </div>
                <div class="loginText">
                    <input type="password" name="newPassword" placeholder="New Password" required>
                </div>
                <div class="loginText">
                    <input type="password" name="confirmPassword" placeholder="Confirm New Password" required>
                    <box-icon name='envelope'></box-icon>
                </div>

                <input type="submit" class="btn" value="Change">

                <nav class="loginLinks">
                    <a href="../Index.php">Login</a>
                </nav>
            </form>
        </section>
	</body>
	<footer>
		<p id="footerText">Copyright All rights reserved.</p>
	</footer>
</html>