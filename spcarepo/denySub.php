<?php 
session_start();
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
			include('header.php');
			echo "<div id='content'>";
			$id= $_POST['id'];
			$sub = retrieve_submission($id);
			
			remove_submission($id);
			unlink("pictures/".$sub->get_image());
			echo "<center><br><h2>This submission has been denied.</h2><br>";	
			echo "<form action='viewNewSubs.php' method='get'>
			<input type='submit' value='View Other Submissions'></form><br><br><br>";	
		?>
	</div></div>
        <?php include('footer2.inc'); ?>
    </body>
</html>

