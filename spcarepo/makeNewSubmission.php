<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
	$mail->SMTPDebug = 2;									
	$mail->isSMTP();											
	$mail->Host	 = 'smtp.gmail.com;';					
	$mail->SMTPAuth = true;							
	$mail->Username = 'fredspca430@gmail.com';				
	$mail->Password = 'kittens123!';						
	$mail->SMTPSecure = 'tls';							
	$mail->Port	 = 587;
	$mail->setFrom('from@gmail.com', 'FXBG_SPCA');		
	$mail->addAddress('spca430@gmail.com');
	$mail->addAddress('brian2wolf2@gmail.com', 'Name');
	$mail->isHTML(true);								
	$mail->Subject = 'Email Verification';
	$mail->Body = 'Please enter the access code to verify your email address with the <b>Fredericksburg SPCA</b>: ';
	$mail->AltBody = 'Body in plain text for non-HTML mail clients';
	$mail->send();
	echo "Mail has been sent successfully!";
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>

<?php

session_start();
session_cache_expire(30);

include_once('database/dbSubmissions.php');
include_once('domain/Submission.php');
include_once('database/dbAdopters.php');
include_once('domain/Adopter.php');
include_once('database/dbLog.php');

$submission = new Submission($_POST['email'], null, null, null, null, null, null, null, null);
$adopter = new Adopter(null, null, null, null);

?>
<html>
    <link rel="stylesheet" href="styles.css" type="text/css" />
    <head></head>
    <body>
	<div id="container">
	    <?PHP
	    include('header.php');
	    echo "<div id='content'>";
	    include('submissionValidate.inc');
	    echo "<center><h1>Submit Your Adoption Story</h1></center><br>";

	    if ($_POST['_form_submit'] != 1) {
		    include('submissionForm.inc');
		    //include('footer2.php');
	    }
	    else {
		$errors = validate_submission($submission);
		
		if ($errors) {
		    show_errors($errors);
		    $submission = new Submission($_POST['email'], $_POST['first_name'], $_POST['last_name'], $_POST['pet_type'], $_POST['description'], $_POST['pet_name'], 0, $_POST['image'], $_POST['opt_in']);
		    $adopter = new Adopter($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['opt_in']);
		    include('submissionForm.inc');
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
		
		if ($dup)
			echo('<p class="error"Unable to add your submission to the database. <br> Email is already in the database.');
		else {   
		    $newsubmission = new Submission($email, $first_name, $last_name, $pet_type, $description, $pet_name, $approved, $image, $opt_in);
		    $result = add_submission($newsubmission);
		    $new_adopter = new Adopter($first_name, $last_name, $email, $opt_in);
		    add_adopter($new_adopter);
		    
		    if (!$result)
			    echo('<center>Unable to add');
		    else {
			    echo("<center>Your form has been successfully submitted!</div>");
			    include('footer2.inc');	    
		    } 
		}
	    }
	    ?>
	</div>  
	<?php include('footer2.inc'); ?>
    </body>
</html> 
