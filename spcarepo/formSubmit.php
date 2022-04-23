<style>
input[type=submit] {
    background: #3ABBAD;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
}
</style>

<?php

session_start();
include_once("database/dbSubmissions.php");
include_once("domain/Submission.php");

?>
<!--  page generated by the BowdoinRMH software package -->
<html>
    <head>
        <title>Form Submission</title>
        <!--  Choose a style sheet -->
        <link rel="stylesheet" href="styles.css" type="text/css"/>
        <!--<link rel="stylesheet" href="calendar.css" type="text/css"/> -->
        <!--    <link rel="stylesheet" href="calendar_newGUI.css" type="text/css"/> -->
    </head>
    <!--  Body portion starts here -->
    <body>
    <div id="container">
		<?php
			include('header.php');
			if($_SESSION['access_level'] == 0) {

            echo '<div class="topnav">
            <a href="index.php">Home</a>
            <a class = "active" href="makeNewSubmission.php">Make A Submission</a>
            <a href="login_form.php">Admin Login</a>
            <a>About</a>
            <div class="topnav-right">
            <input type="text" placeholder="Search..">
            </div>
            </div>';
            }
            echo "<div id='content'>";
			echo "<center><br><br>";
			echo "<h2>Thank you for your submission!</h2><br><br>";
			if ($_SESSION['access_level'] != 2) {	
				echo "<form action='viewerHomepage.php' method='get'>
				<input type='submit' value='Back to Homepage'></form>";
			}
			else {
				echo "<form action='adminNewSubmission.php' method='get'>
				<input type='submit' value='Return'></form>";
			}
			echo "<br><br><br>";	
		?>
    </div></div>
    <?php include('footer2.inc'); ?>
    </body>
</html>

