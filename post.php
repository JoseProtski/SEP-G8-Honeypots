<?php

session_start();

//include 'config.php';

/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$DB_SERVER = 'localhost';
$DB_USERNAME = 'root';
$DB_PASSWORD = 'password';
$DB_NAME = 'bad_sec';

/* Attempt to connect to MySQL database */
$link = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// Check connection
if($link === false){
    echo "ERROR: Could not connect. " . mysqli_connect_error();
} else {
 echo"success";
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    /*
    function validate($data){

       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);

       return $data;

    }
    */
    $uname = $_POST['username'];
    $pass = $_POST['password'];
        echo $uname;
        echo $pass;
    if (empty($_POST['username'])) {
        header("Location: login.php?error=User Name is required");
        //exit();

    }else if(empty($_POST['password'])){
        header("Location: login.php?error=Password is required");
        //exit();

    }else{
        $sql = "SELECT * FROM bad_sec_intranet WHERE username='$uname' AND password='$pass'";
        echo $sql;
        $result = $link -> query($sql);
        //$result = $link -> query("SELECT * FROM bad_sec_intranet WHERE username= '.$uname.' AND password= '.$pass.'");
        //$result = $link -> query("SELECT * FROM bad_sec_intranet;");
        var_dump($result);
        if ($result -> num_rows == 1) {
            $row = $result -> fetch_assoc();
                print_r($result);
            if ($row['username'] === $uname && $row['password'] === $pass) {
                echo "Logged in!";

                $_SESSION['username'] = $row['username'];
                //$_SESSION['id'] = $row['id'];
                header("Location: action_page.php");
                //exit();
            }else{
                header("Location: login.php?error=Incorect User name or password");
                //exit();
                //echo "test1";
            }
        }else{
            header("Location: login.php?error=Incorect User name or password");
            //exit();
            //echo "test2";
        }
    }
}else{
    header("Location: login.php");
    //exit();
        //echo"test3";
}
~                          