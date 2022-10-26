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
<head>
  <title>IP Change</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

 <div class="heading" style="display: inline;">
    <img src="media/menu.svg" class="avatar"/><center><h1 style="display: inline;">Bad Security Inc.</h1></centre>
  </div>
  <div class="content">

<h3>Bad Security Inc - IP change</h3>
<ul>
<li><a href="portalhome.php">Home</a></li>
<li><a href="portal_ip.php">Network Config</a></li>
<li><a href="portaldownload.php">Download</a></li>
</ul>
<form action="portalipchange.php" method="POST">
    <label>CURRENT IP ADDRESS </label>
    <input type="text" name="currentip" value="">
    <label>NEW IP ADDRESS </label>
    <input type="text" name="ip" value="">
   <br/>
         </section>
        <input type="submit" name="submit" value="Submit">
    <label>NEW DEFAULT GATEWAY (OPTIONAL)</label>
    <input type="text" name="gateway" value="">
</form>
</div>
<div>
        <div class="links">
                <a href="portallogout.php">Log out</a>
        </div
</div>
</body>
</html>