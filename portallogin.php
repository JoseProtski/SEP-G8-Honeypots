<?php
        session_start();
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
    <h3>Portal Log in Page</h3>
        <div class="login">
                <form action="portallogin.php" method="POST">
                        <label>Username</label>
                        <input type="text" name="userName"><br>
                        <label>Password</label>
                        <input type="password" name="Password" /><br>
                        <input type="submit" name="login" value="Log In"/>
                        <input type="reset" value="Clear"/>
                </form>
        </div>
        </div>
  </div>
</body>
</html>


<?php

        // Check if username input is not empty
        function validateUsername ($username, $fieldname){
                global $errorCount;
                if (empty($username)) {
                        echo"<p>Please enter a $fieldname to log in.</p>\n";
                        ++$errorCount;
                } else{
                        return $username;
                }
        }
        //check password is not empty
        function validatePassword ($password, $fieldname){
                global $errorCount;
                if (empty($password)){
                        echo"<p>Please enter a $fieldname to log in.</p>\n";
                        ++$errorCount;
                } else {
                        return $password;
                }
        }

        $errorCount = 0;

        if(isset($_POST["login"])){
                $userName = validateUsername($_POST["userName"], "Username");
                $Password = validatePassword($_POST["Password"], "Password");

                if ($errorCount == 0) {
                        $servername = "localhost";
                        $username = "admin";
                        $password = "badsecurityinc";
                        $db = "logs";

                        $conn = new mysqli($servername, $username, $password, $db);
                        if(!$conn){
                                echo "CONNECTION FAILED" . $conn -> connect_error;
                        } else {
                                echo "CONNECTED";
                                $checkQuery = "SELECT * FROM portal WHERE username='$userName' AND password='$Password'";
                                $result = mysqli_query($conn, $checkQuery);
                                if (mysqli_num_rows($result) == 1){
                                        $_SESSION["logIN"] = true;
                                        header('location: portalhome.php');
                                } else {
                                        echo"<p>Incorrect username/password</p>";
                                }
                        }
                }
        }
                                        
                                        
?>