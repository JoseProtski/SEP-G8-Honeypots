$<!DOCTYPE html>
<!-- AUTHOR: RYAN MUDFORD -->
<!-- PURPOSE: ADJUST THE IP ADDRESS OF VARIOUS CONTAINERS -->
<head>
  <title>Command Logs</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="heading" style="display: inline;">
    <img src="media/menu.svg" class="avatar"/><center><h1 style="display: inline;">
  </div>
  <div class="content">
<h1>Bad Security Inc - IP Change</h1>

<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if(!empty($_POST['ip'])){
                        $ip = $_POST['ip'];
                        $current_ip = $_POST['currentip'];
}
                                    $connection = ssh2_connect($current_ip);
                                if (!$connection) {
                                        throw new Exception("fail: unable to establish connection\nPlease IP or if server is on and connected");
                                } else {
                                      echo "";
                                }
                            $pass_success = ssh2_auth_password($connection, 'root', 'password');
                                if (!$pass_success) {
                                  throw new Exception("fail: unable to establish connection\nPlease Check your password");
                                }



                            $stream = ssh2_exec($connection, "ifconfig eth0 " . $ip . "/24 &&  exit");
                            echo "Command Worked. Ignore the Warnings below - These are due to the IP Address Changing";

                            $connection = ssh2_connect($ip);
                            $pass_success = ssh2_auth_password($connection, 'root', 'password');



                            $errorStream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);
                            stream_set_blocking($errorStream, true);
                            stream_set_blocking($stream, true);
                            $output = stream_get_contents($stream);
                            echo"<table>";
                            echo"<tr>";
                            echo"<pre>";
                            print_r($output);
                            echo"</pro>";
                            echo"</tr>";
                            echo"</table>";
                                echo"<h3>IP CHANGED </h3";
                                if(!empty($_POST['gateway'])){
                                        $gateway = $_POST['gateway'];
                                        $stream = ssh2_exec($connection, "ip route add default via " . $gateway . " dev eth0");
                                        echo"<h3>Gateway Changed</h3>";
                                }
                            echo"<h3>Changing IP to: ". $ip . "</h3>";
                    }

?>
</div>
</html>