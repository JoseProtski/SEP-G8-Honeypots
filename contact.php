<?php include 'header.php'; ?>
<?php include 'header.php'; ?>
<?php

session_start();

if (isset($_SESSION['username'])) {

 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Contact Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/form.css">

</head>
<body>
<center><h1>Bad Security Inc.</h1></center>
    <div class="content">
      <h3>Contact Us</h3>
    <form method="post" action="contact-form-process.php">

            <label for="Name" class="fcf-label">Name</label>
                <input type="text" id="Name" name="Name" required>

            <label for="Email">Email address</label>
                <input type="email" id="Email" name="Email" required>

            <label for="Message" >Your message</label><br>
                <textarea class="Message" name="Message" rows="6" maxlength="3000" required></textarea>

            <button type="submit">Send Message</button>
    </form>
  </div>

</body>
</html>
<?php

}else{
     header("Location: login.php");
     exit();
}

?>