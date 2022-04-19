<?php


session_start();
session_cache_expire(30);
include_once('database/dbSubmissions.php');
include_once('domain/Submission.php');
include_once('database/dbLog.php');

$submission = new Submission(null, null, null, null, null, null, null, null, null, null);

?>
<html>
    <link rel="stylesheet" href="styles.css" type="text/css" />
    <head></head>
    <body>
	<div id="container">
	    <?PHP
	    include('header.php');
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
		$target_dir = "pictures/";
		$target_file = $target_dir.basename($_FILES["image"]["name"]);

		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$extensions_arr = array("jpg","jpeg","png","gif");

		if (in_array($imageFileType, $extensions_arr)) {
			if (move_uploaded_file($_FILES['image']['tmp_name'],$target_dir.$image)) {}
		}
		if ($_POST['opt_in']) {
			$opt_in = 1;
		}	
		else {
			$opt_in = 0;
		}
		
		$dup = retrieve_submission($email);
		
		//if ($dup)
		//	echo('<p class="error"Unable to add your submission to the database. <br> Email is already in the database.');
		//else {
		    
		    $newsubmission = new Submission($email, $first_name, $last_name, $pet_type, $description, $pet_name, $approved, $image, $opt_in, null);
		    $result = add_submission($newsubmission);
		    echo "<center>"; 
		    if (!$result)
			echo('Unable to add');
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
