<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">

        <!--CSS and JS file-->
		<link href="CSS/styles.css" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
		<script src="JavaScript/jScript.js" defer></script>
        

        <!--Webpage name-->
		<title>Login Page</title>

        <!--Favicon-->
        <link id="favicon" rel="icon" href="Images/penrose.png">

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
			
			// Create tables if first time using application
			$sql = "CREATE TABLE IF NOT EXISTS User (
						userID INT AUTO_INCREMENT,
						user_name VARCHAR(15) UNIQUE,
						password VARCHAR(60),
						email VARCHAR(30) UNIQUE,
						first_name VARCHAR(15),
						last_name VARCHAR(25),
						favorite_stock INT,
						admin_ID INT,
						PRIMARY KEY(userID)
					);";
			$conn->query($sql);		
					
			$sql = "CREATE TABLE IF NOT EXISTS Admin (
						admin_ID INT AUTO_INCREMENT,
						first_name VARCHAR(15),
						last_name VARCHAR(25),
						password VARCHAR(60),
						email VARCHAR(30)  UNIQUE,
						PRIMARY KEY(admin_ID)
					);";
			$conn->query($sql);


			$sql = "CREATE TABLE IF NOT EXISTS company (
						company_ID INT,
						company_name VARCHAR(25),
						location VARCHAR(40),
						industry VARCHAR(25),
						symbol VARCHAR(5),
						employees INT,
						dividend_yield DECIMAL(6,3),
						dividend_amount DECIMAL(6,3),
						revenue VARCHAR(7),
						market_cap VARCHAR(7),
						profit_margin DECIMAL(6,3),
						total_debit DECIMAL(6,3),
						eps DECIMAL(6,3),
						pe_ratio DECIMAL(6,3),
						description VARCHAR(1000),
						PRIMARY KEY(company_ID)
					);";
			$conn->query($sql);

			$sql = "CREATE TABLE IF NOT EXISTS Stock (
						company_ID INT,
						date DATE,
						time TIME,
						open DECIMAL(8,3),
						high DECIMAL(8,3),
						low DECIMAL(8,3),
						close DECIMAL(8,3),
						volume INT
					);";
			$conn->query($sql);
			
			// Only set company data if values are not set, otherwise, not new insertions are made
			$sql = "REPLACE INTO Company SET company_id = 1, company_name = 'Microsoft', location = 'Redmond, WA', industry = 'Technology-Software', symbol = 'MSFT', employees = 221000, dividend_yield = 0.74, dividend_amount = 3.00, revenue = '227.58B', market_cap = '3.00T', profit_margin = 35.26, total_debit = 31.62, eps = 11.06, pe_ratio = 36.77, description = 'Microsoft, a tech giant founded in 1975 by Bill Gates and Paul Allen, is renowned for its software products and services. Operating globally, it offers a vast array of products including the Windows operating system, Office productivity suite, Azure cloud platform, Xbox gaming consoles, and LinkedIn professional networking. Its focus on innovation extends to AI, IoT, and mixed reality. Microsofts mission centers on empowering individuals and organizations worldwide through technology.';";
			$conn->query($sql);
			
			$sql = "REPLACE INTO Company SET company_id = 2, company_name = 'Amazon', location = 'Seattle, WA', industry = 'Technology-Retail', symbol = 'AMZN', employees = 1525000, dividend_yield = NULL, dividend_amount = NULL, revenue = '574.79B', market_cap = '1.76T', profit_margin = 6.25, total_debit = 44.49, eps = 0.94, pe_ratio = 58.45, description = 'Amazon is the worlds largest online marketplace and cloud computing platform, founded by Jeff Bezos in 1994. It offers a vast array of products, from books to electronics, and services like Prime subscription for fast shipping and streaming. Its cloud arm, Amazon Web Services (AWS), dominates the cloud computing industry. Known for its relentless focus on customer satisfaction, innovation, and disruptive business practices, Amazon has transformed the retail landscape and expanded into various sectors like AI, entertainment, and healthcare.';";
			$conn->query($sql);
			
			$sql = "REPLACE INTO Company SET company_id = 3, company_name = 'Apple', location = 'Cupertino, CA', industry = 'Technology-Hardware', symbol = 'AAPL', employees = 161000, dividend_yield = 0.53, dividend_amount = 0.96, revenue = '385.71B', market_cap = '2.82T', profit_margin = 28.36, total_debit = 59.32, eps = 6.43, pe_ratio = 28.61, description = 'Apple Inc. is a pioneering American tech giant renowned for its innovative hardware, software, and services. Founded by Steve Jobs, Steve Wozniak, and Ronald Wayne in 1976, Apple has redefined consumer electronics with iconic products like the iPhone, iPad, Macintosh computers, and Apple Watch. Their sleek design ethos, user-friendly interfaces, and ecosystem integration have garnered a dedicated global following. Beyond hardware, Apples software ecosystem, including iOS, macOS, and iCloud, offers seamless user experiences. Notable for its commitment to privacy and security, Apple emphasizes environmental sustainability and ethical manufacturing practices. With a strong retail presence and a vast digital marketplace through the App Store, Apple continues to shape the future of technology and redefine the way we interact with digital devices.';";
			$conn->query($sql);
			
			$sql = "REPLACE INTO Company SET company_id = 4, company_name = 'Intel', location = 'Santa Clara, CA', industry = 'Technology-Semiconductors', symbol = 'INTC', employees = 124800, dividend_yield = 1.15, dividend_amount = 0.50, revenue = '54.23B', market_cap = '183.96B', profit_margin = 17.32, total_debit = 31.97, eps = 0.38, pe_ratio = 116.29, description = 'Intel Corporation, an American multinational, pioneers semiconductor innovation. Founded in 1968, it leads in CPU manufacturing for PCs, servers, and IoT devices. With a diverse product portfolio spanning processors, memory, and connectivity solutions, Intel drives technological advancement globally. Its research and development fuel breakthroughs in AI, 5G, and autonomous systems, shaping the future of computing. Intel remains a cornerstone of the tech industry, renowned for its reliability, performance, and relentless pursuit of innovation.';";
			$conn->query($sql);
			
			$sql = "REPLACE INTO Company SET company_id = 5, company_name = 'Advanced Micro Devices', location = 'Santa Clara, CA', industry = 'Technology-Semiconductors', symbol = 'AMD', employees = 26000, dividend_yield = NULL, dividend_amount = NULL, revenue = '22.68B', market_cap = '280.94B', profit_margin = 10.81, total_debit = 5.16, eps = 0.52, pe_ratio = 337.12, description = 'AMD, Advanced Micro Devices, is a leading semiconductor company renowned for its CPUs and GPUs. AMDs innovative products power computers, gaming consoles, and data centers. Known for its Ryzen CPUs and Radeon graphics cards, AMD is driving performance and efficiency advancements in computing technology.';";
			$conn->query($sql);
			
			$sql = "REPLACE INTO Company SET company_id = 6, company_name = 'NVIDIA', location = 'Santa Clara, CA', industry = 'Technology-Semiconductors', symbol = 'NVDA', employees = 26196, dividend_yield = 0.02, dividend_amount = 0.16, revenue = '44.87B', market_cap = '1.79T', profit_margin = 51.01, total_debit = 24.66, eps = 7.57, pe_ratio = 95.94, description = 'Nvidia, founded in 1993, is a global technology company renowned for its graphics processing units (GPUs) and semiconductor innovations. It dominates the market with high-performance GPUs used in gaming, data centers, artificial intelligence, and autonomous vehicles. Nvidias CUDA parallel computing platform and AI-focused products like Tesla GPUs and Jetson modules drive advancements in machine learning and deep learning. It also leads in the development of ray tracing technology, enhancing visual realism in gaming and professional graphics. With a focus on research and development, Nvidia continues to push the boundaries of computing power, efficiency, and AI integration.';";
			$conn->query($sql);
			
			$sql = "REPLACE INTO Company SET company_id = 7, company_name = 'Alphabet Class A', location = 'Mountain View, CA', industry = 'Technology-Interactive Media', symbol = 'GOOGL', employees = 156500, dividend_yield = NULL, dividend_amount = NULL, revenue = '307.39B', market_cap = '950.20B', profit_margin = 23.97, total_debit = 9.52, eps = 5.80, pe_ratio = 24.62, description = 'Alphabet Inc. is a multinational conglomerate founded by Larry Page and Sergey Brin, primarily known as the parent company of Google. Established in 2015, Alphabet oversees various businesses beyond Google, including subsidiaries like Waymo (self-driving cars), Verily (life sciences), and DeepMind (artificial intelligence). It aims to innovate in technology, from internet services to cutting-edge research, while maintaining a diverse portfolio of ventures under its umbrella. With a focus on forward-thinking projects and disruptive innovation, Alphabet continues to shape the digital landscape global';";
			$conn->query($sql);
			
			$sql = "REPLACE INTO Company SET company_id = 8, company_name = 'Tesla', location = 'Austin, TX', industry = 'Automobiles-Technology', symbol = 'TSLA', employees = 140473, dividend_yield = NULL, dividend_amount = NULL, revenue = '96.77B', market_cap = '636.80B', profit_margin = 31.50, total_debit = 13.20, eps = 4.30, pe_ratio = 46.62, description = 'Tesla, founded by Elon Musk in 2003, is a trailblazing American company leading the electric vehicle revolution. Known for its cutting-edge technology, Tesla produces sleek, high-performance electric cars like the Model S, Model 3, Model X, and Model Y, along with energy products like solar panels and batteries. Its pioneering self-driving technology and commitment to sustainability have reshaped the automotive industry, driving towards a greener, autonomous future.';";
			$conn->query($sql);
			
			$sql = "REPLACE INTO Company SET company_id = 9, company_name = 'Oracle', location = 'Austin, TX', industry = 'Technology-Software', symbol = 'ORCL', employees = 164000, dividend_yield = 1.44, dividend_amount = 1.60, revenue = '51.63B', market_cap = '305.98B', profit_margin = 19.34, total_debit = 90.69, eps = 3.62, pe_ratio = 31.18, description = 'Oracle Corporation is a multinational tech company renowned for its database software and cloud engineering services. Founded in 1977, Oracle offers a wide range of integrated hardware and software solutions, including enterprise software, cloud applications, and platform services. Its a key player in database management systems, data warehousing, and enterprise resource planning software, catering to various industries worldwide. Oracles technologies power critical systems for businesses, from small startups to large enterprises, driving efficiency, innovation, and digital transformation.';";
			$conn->query($sql);
			
			$sql = "REPLACE INTO Company SET company_id = 10, company_name = 'Meta Platforms Class A', location = 'Menlo Park, CA', industry = 'Technology-Interactive Media', symbol = 'META', employees = 67317, dividend_yield = NULL, dividend_amount = NULL, revenue = '134.90B', market_cap = '1.21T', profit_margin = 34.95, total_debit = 19.85, eps = 14.87, pe_ratio = 35.65, description = 'Meta is a tech conglomerate focusing on the development of virtual reality (VR), augmented reality (AR), and other emerging technologies. Founded by Mark Zuckerberg, it aims to connect people in new ways, emphasizing communication, collaboration, and immersive experiences. Metas flagship platform, the Metaverse, envisions a digital universe where users interact, work, play, and create. With subsidiaries like Facebook, Instagram, and WhatsApp, Meta seeks to redefine social networking and reshape the future of human connectivity and digital presence.';";
			$conn->query($sql);
			
			if($_SERVER["REQUEST_METHOD"] == "POST") {
				
				$username = test_input($_POST['username']);
				$password = test_input($_POST['password']);
				
				$select = "SELECT user_name, password FROM user";
				$result = $conn->query($select);
				
				while($row = $result->fetch_assoc()) {
					if($row['user_name'] === $username && password_verify($password, $row['password'])) {
						// Allows the user to stay logged in for 50 minutes
						setcookie("username", $username, time() + 3000000);
						$_COOKIE["username"] = $username;
						header("Location: ./Subpages/HomePage.php");
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
			<a href="Index.php"><img src="Images/penrose.png" alt="SAB Logo" id="Logo"></a>
			<h1>SAB Financial</h1>
		</header>

        <section class="loginInput">
            <form method="post" action="#">
                <h2 id = "loginHeader">Login</h2>
                <div class="loginText">
                    <input type="text" name="username" placeholder="Username" required>
                    <i class='bx bx-user'></i>
                </div>
                <div class="loginText">
                    <input id="password" type="password" name="password" placeholder="Password" required>
                    <i class='bx bx-lock-alt' ></i>
                    <i class='bx bx-show' id="inside"></i>                
                </div>
                <div class="remember">
                    <label><input type="checkbox" class="btn">Remember me</label>
                </div>

                <input type="submit" class="btn" value="Login">

                <nav>
                    <div class="loginLinks">
                        <a href="Subpages/RecoverPassword.html">Forgot Password</a>
                    </div>
                    <div class="loginLinks">
                        <a href="Subpages/CreateAccount.php">Create Account</a>
                    </div>
                </nav>
                
            </form>
        </section>
	</body>
	<footer>
		<p id="footerText">Copyright All rights reserved.</p>
	</footer>
</html>