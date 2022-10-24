<!DOCTYPE html>
<!-- AUTHOR: JOSE PROTACIO -->
<!-- PURPOSE: LOG IN TO HONEYPOTS AND USE IPTABLES TO BAN IP ADDRESS -->
<!-- PURPOSE(0): PROCESS INPUT FROM remote_ban.php -->
<head>
  <title>Command Logs</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <a href="packetlogging.php">Packet logs </a>
  <a href="commandlogs.php">Command logs </a>
  <a href="remote_ban.php">Remote Ban </a>

  <div class="heading" style="display: inline;">
    <img src="media/menu.svg" class="avatar"/><center><h1 style="display: inline;">
  </div>
  <div class="content">
<h1>Bad Security Inc - Ban Hammer</h1>

<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['submit'])){
                if(!empty($_POST['honeypot'])){
                        $honeypot = $_POST['honeypot'];
                        echo $honeypot;
                } else {
                        echo 'honeypot not selected';
                }
                if(!empty($_POST['ip'])){
                        $ip = $_POST['ip'];
                            if($ip == '172.17.0.3'){
                                echo "invalid IP";
                            } else {
                                $ip = filter_var($ip, FILTER_VALIDATE_IP);
                                echo $ip;
                            }
                } else {
                        echo "ip not inputted";
                }

                //Select which honeypot to connect to and then ban
                if($honeypot == 'webserver') {
                        //172.17.0.5
                        $honeypot_ip = "172.17.0.2";
                                    $connection = ssh2_connect('172.17.0.2');
                                if (!$connection) {
                                        throw new Exception("fail: unable to establish connection\nPlease IP or if server is on and connected");
                                } else {
                                      echo "";
                                }
                            $pass_success = ssh2_auth_password($connection, 'root', 'password');
                                if (!$pass_success) {
                                        throw new Exception("fail: unable to establish connection\nPlease Check your password");
                                } else {
                                   echo "";
                                }
                            echo"<h3>Web Server Connections </h3>";
                            //display current connections?
                            $stream = ssh2_exec($connection, 'arp -a');
                            $errorStream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);
                            stream_set_blocking($errorStream, true);
                            stream_set_blocking($stream, true);
                            $output = stream_get_contents($stream);
                            $arr_output = explode("?", $output);

                                echo "<table border='1'>";
                                        foreach($arr_output as $i){
                                                echo"<tr>";
                                                echo"<td>" . $i . "</td>";
                                                echo"</tr>";
                                        }
                                echo "</table>";

                            //ban ip - produces no output
                            $stream = ssh2_exec($connection, "iptables -A INPUT -s " . $ip . " -j DROP");
                            echo"<h3>Banning IP ". $ip . "</h3>";

                            //display all connected ips
                            echo"<h3>Web Server ban table</h3>";
                            $stream = ssh2_exec($connection, "iptables -L");
                            $errorStream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);
                            stream_set_blocking($errorStream, true);
                            stream_set_blocking($stream, true);
                            $output = stream_get_contents($stream);
                            echo"<table>";
                            echo"<tr>";
                            echo "<pre>";
                            print_r($output);
                            echo"</pre>";
                            echo"</tr>";
                            echo"</table>";

                } elseif ($honeypot == 'systemserver') {
                        $honeypot_ip ="172.17.0.4";
                        $connection = ssh2_connect('172.17.0.4');
                                if (!$connection) {
                                        throw new Exception("fail: unable to establish connection\nPlease IP or if server is on and connected");
                                }
                            $pass_success = ssh2_auth_password($connection, 'root', 'password');
                                if (!$pass_success) {
                                        throw new Exception("fail: unable to establish connection\nPlease Check your password");
                                }

                            echo"<h3>System Server Connections </h3>";
                            //display current connections?
                            $stream = ssh2_exec($connection, 'arp -a');
                            $errorStream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);
                            stream_set_blocking($errorStream, true);
                            stream_set_blocking($stream, true);
                            $output = stream_get_contents($stream);
                            $arr_output = explode("?", $output);

                                echo "<table border='1'>";
                                        foreach($arr_output as $i){
                                                echo"<tr>";
                                                echo"<td>" . $i . "</td>";
                                                echo"</tr>";
                                        }
                                echo "</table>";

                            //ban ip - produces no output
                            $stream = ssh2_exec($connection, "iptables -A INPUT -s " . $ip . " -j DROP");
                            echo"<h3>Banning IP ". $ip . "</h3>";

                            //display all connected ips
                            echo"<h3>System Server ban table</h3>";
                            $stream = ssh2_exec($connection, "iptables -L");
                            $errorStream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);
                            stream_set_blocking($errorStream, true);
                            stream_set_blocking($stream, true);
                            $output = stream_get_contents($stream);
                            echo"<table>";
                            echo"<tr>";
                            echo "<pre>";
                            print_r($output);
                            echo"</pre>";
                            echo"</tr>";
                            echo"</table>";

                    } else {
                        echo "honeypot not selected";
                    }

        } else {
                echo "NOT WORKING";
        }

}

//phpinfo();


/*


*/
?>

</div>
</html>