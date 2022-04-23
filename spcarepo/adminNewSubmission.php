<?php


session_start();
session_cache_expire(30);
include_once('database/dbSubmissions.php');
include_once('domain/Submission.php');
include_once('database/dbAdopters.php');
include_once('doman/Adopter.php');
include_once('database/dbLog.php');

$submission = new Submission(null, null, null, null, null, null, null, null, null, null);
$adopter = new Adopter(null, null, null, null);
?>
<html>
    <link rel="stylesheet" href="styles.css" type="text/css" />
    <head><title>Make New Submission</title></head>
    <body>
	<div id="container">
	    <?PHP
	    include('header.php');
			echo '
            <div class="topnav">
            <a href="' . $path . 'index.php">Home</a>
            <a class = "active" href="' . $path . 'adminNewSubmission.php">Make New Submission</a>
            <a href="' . $path . 'adminViewSubs.php">View Accepted Submissions</a>
            <a href="' . $path . 'viewNewSubs.php">View New Submissions</a>
            <a href="' . $path . 'emailList.php">Generate Emailing List</a>
            <a href="' . $path . 'createAdminAccount.php">Create Admin Account</a>
            <div class="topnav-right">
            <a href="' . $path . 'logout.php">Logout</a><br>
            </div>
            </div>';
	    echo "<div id='content'>";
	    echo "<center><h1>Make New Submission</h1></center><br>";
	    include('submissionValidate.inc');
	    if ($_POST['_form_submit'] != 1) {
		    include('submissionForm2.inc');
	    }
	    else {
    		$errors = validate_submission($submission);
		if ($errors) {
		    show_errors($errors);
		    $submission = new Submission($_POST['email'], $_POST['first_name'], $_POST['last_name'], $_POST['pet_type'], $_POST['description'], $_POST['pet_name'], 0, $_POST['image'], $_POST['opt_in'], null);
		    include('submissionForm2.inc');
		}
    		else {
    		    process_submission($submission);
		    echo "</div>";
		//include('footer2.php');
		echo('</div></body></html>');
		die();
		}
	    }


	    function process_submission($submission) {
		$email = trim(str_replace('\\\'', '\'', htmlentities($_POST['email'])));
		$first_name = trim(str_replace('\\\'', '\'', htmlentities($_POST['first_name'])));
		$last_name = trim(str_replace('\\\'', '\'', htmlentities($_POST['last_name'])));
		if ($_POST['pet_type'] !== 'Other') {
		    $pet_type = trim(str_replace('\\\'', '\'', htmlentities($_POST['pet_type'])));
		}
	        else {
		    $pet_type = trim(str_replace('\\\'', '\'', htmlentities($_POST['pet_type_other'])));
		}	
		$description = trim(str_replace('\\\'', '\'', htmlentities($_POST['description'])));
		$pet_name = trim(str_replace('\\\'', '\'', htmlentities($_POST['pet_name'])));
		$approved = 0;

		
		$name = $_FILES['image']['name'];
		$image = "picture".uniqid();
		
		if ($_POST['opt_in']) {
			$opt_in = 1;
		}	
		else {
			$opt_in = 0;
		}
		 
		$submission = new Submission($email, $first_name, $last_name, $pet_type, $description, $pet_name, $approved, $image, $opt_in, null);
		
		$result = add_submission($submission);
		if ($result) {
		    $target_dir = "pictures/";
		    $target_file = $target_dir.basename($_FILES["image"]["name"]);

		    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		    $extensions_arr = array("jpg", "jpeg", "png", "gif");

		    if (in_array($imageFileType, $extensions_arr)) {
			if (move_uploaded_file($_FILES['image']['tmp_name'],$target_dir.$image)) {}
		    }

		    $adopter = retrieve_adopter($email);
		
		    if (!$adopter) {
		        $newadopter = new Adopter($first_name, $last_name, $email, $opt_in);
 		        $result2 = add_adopter($newadopter);
		    }
		    else if ($opt_in == 1) {
		        opt_in($email);
		    }
		}
		
		echo "<center>"; 
		if (!$result) {
		    echo('<strong><font color="red">Error: Unable to add</font></strong>');
		    include('submissionForm2.inc');
		}
		else {
		    header('Location: formSubmit.php');
			//echo("Your form has been successfully submitted!<br><br><br>");			
		} 
		echo "</div>";
		include('footer2.inc');
		//}
	    }
	    ?>
	</div>   
                    <?PHP include('footer2.inc'); ?>
    </body>
</html> 
