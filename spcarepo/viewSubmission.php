
<?php 
session_start();
include_once("database/dbSubmissions.php");
include_once("domain/Submission.php");

?>
<!--  page generated by the BowdoinRMH software package -->
<html>
    <head>
	<script>
	function clicked(e)
	{
	    if (!confirm('Are you sure you want to unapprove this submission?')) {
		e.preventDefault();
	    }
	}
	</script>
        <title>Submission</title>
        <!--  Choose a style sheet -->
        <link rel="stylesheet" href="styles.css" type="text/css"/>
        <!-- <link rel="stylesheet" href="calendar.css" type="text/css"/>-->
        <!--    <link rel="stylesheet" href="calendar_newGUI.css" type="text/css"/> -->
    </head>
    <!--  Body portion starts here -->
    <body>
    <div id="container">
	<?php
		include('header.php');
			echo '
            <div class="topnav">
            <a href="' . $path . 'index.php">Home</a>
            <a href="' . $path . 'adminNewSubmission.php">Make New Submission</a>
            <a class = "active" href="' . $path . 'adminViewSubs.php">View Accepted Submissions</a>
            <a href="' . $path . 'viewNewSubs.php">View New Submissions</a>
            <a href="' . $path . 'emailList.php">Generate Emailing List</a>
            <a href="' . $path . 'createAdminAccount.php">Create Admin Account</a>
            <div class="topnav-right">
            <a href="' . $path . 'logout.php">Logout</a><br>
            </div>
            </div>';
		echo "<div id='content'><center>";
		$id = $_POST['id'];
		$sub = retrieve_submission($id);
		if ($_POST['_form_submit'] != 1) {
		    echo "<h1>Adoption Story</h1>";	
		
		    $adopter = $sub->get_first_name()." ".$sub->get_last_name();
		    $pet_name = $sub->get_pet_name();
		    $pet_type = $sub->get_pet_type();
		    $story = $sub->get_description();
		    $image = $sub->get_image();
		    $image_src = "pictures/".$image;
		    echo "<table style width='500'><tr><td><img src=".$image_src." width='500' height='350'></td></tr>";
		    echo "<tr><td><br><b>Pet Name:</b> ".$pet_name."</td></tr>";
		    echo "<tr><td><b>Adopter:</b> ".$adopter."</td></tr>";
		    echo "<tr><td><b>Pet Type:</b> ".$pet_type."</td></tr>";
		    echo "<tr><td><b>Description:</b></td></tr>";
		    echo "<tr><td>".nl2br($story)."</td></tr></table><br><br>";
		
		    echo "<form action='' method='post'>
		    <input type='hidden' name='_form_submit' value='1'>
		    <input type='hidden' name='id' value='".$id."'>
		    <input type='submit' value='Remove Post' onclick='clicked(event)'></form><br>";
		    echo "<form action='adminViewSubs.php' method='get'>
		    <input type='submit' value='     Return      '></form><br><br>";
		}
		else {
		    unapprove_submission($id);
		    echo "<br><br><h2>This submission has been unapproved.</h2><br><br>";
		    echo "<form action='adminViewSubs.php' method='get'>
		    <input type='submit' value='View Other Submissions'></form><br><br>";
		}

	?>
    </div></div>
    <?php include('footer2.inc'); ?>
    </body>
</html>

