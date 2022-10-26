<?php
        session_start();
        if(!$_SESSION["logIN"]){
                $_SESSION["message"] = "Please login before proceeding";
                header("location:portallogin.php");
        } else {
                $_SESSION["logIN"] = true;
        }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Honeypot Download</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

  <div class="heading" style="display: inline;">
    <img src="media/menu.svg" class="avatar"/><center><h1 style="display: inline;">Bad Security Inc.</h1></center>
  </div>
  <div class="content">
    <h3>Download Honeypot System</h3>
        <ul>
                <li><a href="portalhome.php">Home</a></li>
                <li><a href="portal_ip.php">Network Config</a></li>
                <li><a href="portaldownload.php">Download</a></li>
        </ul>
        <h5>Please use the following link to download the Honeypot Containers --> <a href="https://hub.docker.com/r/josephleong/sepa_prototype">Click here</a></h5>
  </div>
        <div class="links">
                <a href="portallogout.php">Log out</a>
        </div>
</body>
</html>

