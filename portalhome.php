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
  <title>Command Logs</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

  <div class="heading" style="display: inline;">
    <img src="media/menu.svg" class="avatar"/><center><h1 style="display: inline;">Bad Security Inc.</h1></center>
  </div>
  <div class="content">
    <h3>Portal Home Page</h3>
        <ul>
                <li><a href="portalhome.php">Home</a></li>
                <li><a href="portal_ip.php">Network Config</a></li>
                <li><a href="portaldownload.php">Download</a></li>
        </ul>
        <h5>Welcome to the menu for all portal changes. The above tabs will allow for you to make netowrk changes to the honeypots as well as link you to a location where they can all be downloaded.</h5>
  </div>
        <div class="links">
                <a href="portallogout.php">Log out</a>
        </div>
</body>
</html>