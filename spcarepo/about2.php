
<html>
<head>
        <title>
        SPCA Adoption Stories
        </title>
        <link rel="stylesheet" href="styles.css" type="text/css" />
</head>
<body>
<div id="container">
<?php
include('header.php');
?>
<div class="topnav">
<a href="index.php">Home</a>
<a href="makeNewSubmission.php">Make A Submission</a>
<a href="viewAccSubs.php">View Stories</a>
<a href="login_form.php">Admin Login</a>
<a class = "active" href="about2.php">About</a>
<div class="topnav-right">
<label for="type" style="font-size:14px; color:white; padding-top: 16px;">Pet Type:</label>
<select name="type" id="type">
<option value="">---Choose Type---</option>
<option value="Dog">Dog</option>
<option value="Cat">Cat</option>
<option value="Other">Other</option>
</select>
</div>
</div>
<div id="content">
<center/>
<h1 style="color:blue;">ABOUT US</h1>
<p style="font-size: 18px;">
Find your new best friend!<br/><br/>
This site was created for the Fredericksburg SPCA to highlight adoption stories that will warm your heart and spread awareness.<br/> 
Created by Jennifer Werme, Ariana Tran, Brian Wolf, and Saraid Satterfield.<br/>
To learn more about the SPCA: 
<a href="https://fredspca.org/?msclkid=454e614cc4e511ec99c5ed56c67ec71d">Fredericksburg SPCA</a>
</p>
<img src="spcalogo.jpg" alt="SPCA Logo">
</div>
</div>
<?php  
include("footer2.inc");
?>
</body>
</html>
<style>
.topnav-right {
    float: right;
    font-size: 16px;
    margin-right: 10px;
    padding-top: 25px;
}
</style>
