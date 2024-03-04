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
		$oldUsername = test_input($_POST['oldUsername']);
		$newUsername = test_input($_POST['newUsername']);
		$confirmUsername = test_input($_POST['confirmUsername']);
		
		// Only insert data when all fields have a value in them
		if(strlen($oldUsername) > 0 && strlen($newUsername) > 0 && strlen($confirmUsername) > 0 && $newUsername === $confirmUsername) {
			$select = "SELECT * FROM user";
			$result = $conn->query($select);
			
			while($row = $result->fetch_assoc()) {
				if($row['user_name'] === $_COOKIE['username']) {
					$sql = "UPDATE user SET user_name = '$newUsername' WHERE user_name = '$_COOKIE[username]';";
					$conn->query($sql);
					$_COOKIE['username'] = $newUsername;
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
		<title>Change Username Page</title>

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
                <h2 id = "loginHeader">Change Username</h2>
                <div class="loginText">
                    <input type="text" name="oldUsername" placeholder="Old Username" required>
                </div>
                <div class="loginText">
                    <input type="text" name="newUsername" placeholder="New Username" required>
                </div>
                <div class="loginText">
                    <input type="text" name="confirmUsername" placeholder="Confirm New Username" required>
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