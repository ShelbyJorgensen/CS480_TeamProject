<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">

        <!--CSS and JS file-->
		<link href="../CSS/styles.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
		<script src="../JavaScript/jScript.js" defer></script>
        

        <!--Webpage name-->
		<title>Create Account Page</title>

        <!--Favicon-->
        <link id="favicon" rel="icon" href="../Images/penrose.png">

	</head>
	<body>
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
			
			if($_SERVER["REQUEST_METHOD"] == "POST") {
				$firstName = test_input($_POST['first_name']);
				$lastName = test_input($_POST['last_name']);
				$email = test_input($_POST['email']);
				$userName = test_input($_POST['username']);
				$password = test_input($_POST['password']);
				// Encrypt the password with a hash before processing further
				$hashed = password_hash($password, PASSWORD_BCRYPT);
				
				// Only insert data when all fields have a value in them
				if(strlen($username) > 0 && strlen($password) > 0 && strlen($firstName) > 0 && strlen($lastName) > 0 && strlen($email) > 0) {
					$select = "SELECT * FROM user";
					$insert = "INSERT INTO user (user_name, password, email, first_name, last_name, favorite_stock, admin_ID) VALUES ('$userName', '$hashed', '$email', '$firstName', '$lastName', 1, 1);";
					$result = $conn->query($select);
					$canStore = True;
					
					// Allow insertion if the DB is empty`
					if ($result->num_rows === 0 ) {
						mysqli_query($conn, $insert);
					}
					// Otherwise check the DB for dubplicate values before posting 
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							if($row["email"] === $email) {
								$canStore = False;
							}
						}
						if ($canStore) {
							mysqli_query($conn, $insert);
							header("Location: ../Index.php");
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
		<header class="pageTop">
			<a href="../Index.php"><img src="../Images/penrose.png" alt="SAB Logo" id="Logo"></a>
			<h1>SAB Financial</h1>
		</header>

        <section class="loginInput">
            <form method="post" action="">
                <h2 id = "loginHeader">Create Acount</h2>
                <div class="loginText">
                    <input type="text" name ="first_name" placeholder="First Name" required>
                </div>
                <div class="loginText">
                    <input type="text" name="last_name" placeholder="Last Name" required>
                </div>
                <div class="loginText">
                    <input type="text" name="email" placeholder="Email" required>
                    <box-icon name='envelope'></box-icon>
                </div>
                <div class="loginText">
                    <input type="text" name="username" placeholder="Username" required>
                    <i class='bx bx-user'></i>
                </div>
                <div class="loginText">
                    <input id="password" type="password" name="password" placeholder="Password" required>
                    <i class='bx bx-lock-alt' ></i>
                    <i class='bx bx-show' id="inside"></i>
                    <!-- <i class='bx bx-hide' id="inside"></i> -->
                    
                </div>
                <!-- <div class="remember">
                    <label><input type="checkbox" class="btn">Remember me</label>
                </div> -->

                <!-- <div class="errorMessage">
                    <h3>Password must contain:</h3>
                    <p id="lLetter" class="invalid"><i class='bx bx-check' id="passValCheck"></i><i class='bx bx-x' id="passValHide"></i>A Lower Case Letter</p>
                    <p id="uLetter" class="invalid">A Upper Case Letter</p>
                    <p id="number" class="invalid">A Number</p>
                    <p id="minChars" class="invalid">Minimum of 8 Characters</p>
                </div> -->

                <button type="submit" class="btn">Create</button>

                <!-- <div class="forgot">
                    <a href="Subpages/RecoverPassword.html">Forgot Password</a>
                </div>
                <div class="register">
                    <a href="Subpages/CreateAccount.html">Create Account</a>
                </div> -->

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