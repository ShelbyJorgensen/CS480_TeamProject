# About the Project

This project, created as part of our CS480 Software Development course, had use design, document, and implement a platform where users could view financial stock data about 10 different companies. As a team, we decided to use a web based approach, building out a website using HTML, CSS, JavaScript, PHP and MySQL.

# Installation
This section explains how to access and start using the financial application, which will be hosted on a local Apache server. The application is designed to provide users with real-time information on 10 U.S.-based stocks using the Alpha Vantage API, all within an easy-to-use web interface.
Before accessing the application, ensure you have:

-	A modern web browser (e.g., Google Chrome, Mozilla Firefox, Safari).
  
Step 1: Install XAMPP
1)	Download XAMPP: Go to the official website for XAMPP (https://www.apachefriends.org/index.html) and download the latest version based on your system.
2)	Run the Installer: Once downloaded, located the downloaded file and run the newly downloaded installer.
3)	Choose Components: Before installation begins, there will be an option to choose which option you will download, for this program, Apache, MySQL, and PHP are all required.
4)	Select Directory for Installation: During installation setup, you will be asked where to save the program, often the default is acceptable (C:\xampp), but you can choose another directory if desired.
5)	Start Installation: All other installation options presented do not need to be changed from their default values, when prompted select “Install” to start the installation process.
6)	Completed Installation: Once completely installed, you will be asked if you want to start the XAMPP Control Panel, which how we can interact with the program.
7)	Start Apache and MySQL Servers: With an opened XAMPP Control Panel, start both the Apache and MySQL servers, which can be started with the “Start” button next to each respective server on the control panel.
8)	Test Installation: Open your web browser and navigate to "http://localhost". If you see the XAMPP dashboard, it means XAMPP has been successfully installed.
   
Step 2: Create Database
1)	Start XAMPP Control Panel: If not currently running the XAMPP control panel, start the program.
2)	Start MySQL and Apache: With the control panel open, click the “Start” button next to the MySQL server and Apache server, which will start both servers.
3)	Access phpMyAdmin: Open your web browser and navigate to "http://localhost/phpmyadmin/". This will open the phpMyAdmin interface, which is a web-based tool for managing MySQL databases. This screen can also be accessed by selecting “Admin” on the XAMPP control panel under the MySQL section.
4)	(Optional) Log in to phpMyAdmin: You may be prompted to log into phpMyAdmin upon opening it. If prompted, the default log in credentials will be a username of “root” and no password.
5)	Navigate to the “Database” Tab: On the phpMyAdmin page, there will be a menu bar of different options at the top part of the screen, select the “Databases” tab, which should be the first on the list of options.
6)	Create the Database: Under the “Create database” section, enter the name “sab” into the “Database name” field. Once entered, click “Create” button to create the necessary database, if successful, you will see a confirmation message that the database has been created.
   
Step 3: Place Webpages onto XAMPP
1)	Download Webpage Files: Retrieve the necessary files for the webpage from the SAB team GitHub page (https://github.com/ShelbyJorgensen/CS480_TeamProject). On this page, download the zip file titled “CS480_Website.zip”, which when extracted will hold all the files needed to run the webpage.
2)	Locate XAMPP Directory: Navigate to the location on your system where XAMPP was downloaded to, the default option presented during installation is “C:\xampp”.
3)	Navigate to the “htdocs” folder: Once in the XAMPP folder, navigate to the fold labeled “htdocs” and open this folder. Once opened, place the folder downloaded from the SAB team GitHub page.
4)	Access Web Page: With all necessary files now in the “htdocs” folder, the webpage should now be accessible. Any page can now be accessed by placing “http://localhost/” name of file you want to access. In order to access the web page home page, you can also enter 
“http://localhost/CS480%20Website/Index.php” directly into your web browser of choice.
5)	View Web Page: If all steps above where followed correctly, the SAB home page should now be functional and viewable for your use.

On the first time running the application, stock prices and graphs on the home page will show up with error messages as there is no pricing data stored in the database. In order to fix this error, as each stock page is entered, an API call is made to get the most relevant stock prices for that company. Once each stock page has been visited, all prices and graphs displayed on the home page should be fully functional.

