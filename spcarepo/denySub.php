<?php 
include_once("database/dbSubmissions.php");
include_once("domain/Submission.php");

?>
<!--  page generated by the BowdoinRMH software package -->
<html>
    <head>
        <title>Denied Submission</title>
        <!--  Choose a style sheet -->
        <link rel="stylesheet" href="styles.css" type="text/css"/>
        <!--<link rel="stylesheet" href="calendar.css" type="text/css"/> -->
        <!--    <link rel="stylesheet" href="calendar_newGUI.css" type="text/css"/> -->
    </head>
    <!--  Body portion starts here -->
    <body>
    <div id="container">
		<?php
			include('header2.php');
			echo "<div id='content'>";
			$email = $_POST['email'];
			$sub = retrieve_submission($email);
			remove_submission($email);
			unlink("pictures/".$sub->get_image());
			echo "<center><br><h2>This submission has been denied.</h2><br>";	
			echo "<form action='viewNewSubs.php' method='get'>
			<input type='submit' value='View Other Submissions'></form>";	
		?>
	</div></div>
    </body>
</html>

