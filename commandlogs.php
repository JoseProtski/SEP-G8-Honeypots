
<!DOCTYPE html>
<html>
<head>
  <title>Command Logs</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<a href="packetlogging.php">Packet logs </a>
  <a href="remote_ban.php">Remote Ban </a>

  <div class="heading" style="display: inline;">
    <img src="media/menu.svg" class="avatar"/><center><h1 style="display: inline;">Bad Security Inc.</h1></center>
  </div>
  <div class="content">
  <h3>Command Logs</h3>
        <h1>Command Logs</h1>
        <form action="commandlogs.php" method="POST">
         <label>Search Logs by Date</label><br>
         <input type="date" name="date"/><br>
         <label>Search Logs by User</label><br>
         <input type="text" name="user"/><br>
         <label>Search Logs by Hostname</label><br>
         <input type="text" name="hostname"/><br>
         <label>Search Logs by Command</label><br>
         <input type="text" name="command"/><br>
         <input type="submit" name="submit" value="Search"/>
         <input type="reset" name="reset"/>
       </form>
</body>
</html>


<?php

//AUTHOR: JOSE PROTACIO
//PURPOSE: Display logs in table via website

$servername = "localhost";
$username = "admin";
$password = "badsecurityinc";
$db = "logs";

$conn = new mysqli($servername, $username, $password, $db);

if(!$conn){
        echo "CONNECTION FAILED" . $conn -> connect_error;
} else {
        echo "CONNECTED";
}



//DISPLAYS THE QUERY RESULT IN A TABLE
function displayTable($result) {
        echo"<table border='1'";
        print"<tr>".
                "<td>LogID</td>" .
                "<td>Date</td>" .
                "<td>Time</td>" .
                "<td>Hostname</td>" .
                "<td>User</td>" .
                "<td>Command</td>" .
                "</tr>";
                while($row = $result -> fetch_assoc()){
                        print"<tr>" .
                                "<td>" .$row["logID"]. "</td>" .
                                "<td>" .$row["date"]. "</td>" .
                                  "<td>" .$row["time"]. "</td>" .
                                "<td>" .$row["hostname"]. "</td>" .
                                "<td>" .$row["user"]. "</td>" .
                                "<td>" .$row["command"]. "</td>" .
                                "</tr>";

                                }

        echo"</table>";
}

if (isset($_POST["submit"])) {
        $fields = array('date', 'user', 'hostname', 'command');
        $conditions = array();
        foreach($fields as $field){
                if(isset($_POST[$field]) && !empty($_POST[$field])) {
                        $conditions[] = "$field LIKE '%" . mysqli_real_escape_string($conn,$_POST[$field]) . "%'";
                }
        }
        $query = "SELECT * FROM command_logs ";
        if(count($conditions) > 0) {
                $query .= "WHERE " . implode (' AND ', $conditions);
        }
        $result = mysqli_query($conn, $query);
        if ($result -> num_rows > 0) {
                displayTable($result);
        } else {
                echo"No match";
        }

} else {
        if(isset($_GET["page"])){
                $page=$_GET["page"];
        } else {
                $page =1;
        }
        $returnAll = "SELECT * FROM command_logs";
        $result = mysqli_query($conn,$returnAll);
        $row = mysqli_num_rows($result);

        $per_page=20;
        $total_pages = ceil($row/$per_page);
        echo"You are on $page of $total_pages<br>";
        $x= ($page-1) * $per_page;

        $query = "SELECT * FROM command_logs LIMIT $x, $per_page";
        $Result = mysqli_query($conn, $query);
        if ($Result -> num_rows > 0) {
                displayTable($Result);
        } else {
                echo"no match";
        }
        if($page!=1){
                echo"<a href='commandlogs.php?page=1'>First</a> "." ";
                $previous = $page-1;
                echo"<a href='commandlogs.php?page=$previous'>Previous</a>";
        }

        if(($page != 1) && ($page != $total_pages)){
                echo"  |  ";
        }
        if ($page != $total_pages){
                $next = $page+1;
                echo"<a href='commandlogs.php?page=$next'>Next</a> "." ";
                echo"<a href='commandlogs.php?page=$total_pages'>Last</a>";
        }
}

?>


</div>
</body>
</html>