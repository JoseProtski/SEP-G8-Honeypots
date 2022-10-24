<!DOCTYPE html>

<!-- AUTHOR: JOSE PROTACIO -->
<!-- PURPOSE: LOG IN TO HONEYPOTS AND USE IPTABLES TO BAN IP ADDRESS -->

<head>
  <title>Banhammer</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

 <div class="heading" style="display: inline;">
    <img src="media/menu.svg" class="avatar"/><center><h1 style="display: inline;">
  </div>
  <div class="content">

<h1>Bad Security Inc - Ban Hammer</h1>
<a href="packetlogging.php">Packet logs </a>
  <a href="commandlogs.php">Command logs </a>


<form action="remote_ban_proc.php" method="POST">
    <section>
    <label> Webserver Honeypot </label>
    <input type="radio" name="honeypot" value="webserver">

    <label> System Server Honeypot</label>
    <input type="radio" name="honeypot" value="systemserver">
        </br>
    <label>IP ADDRESS </label>
    <input type="text" name="ip" value="ip">
    </section>
        <input type="submit" name="submit" value="Submit">
</form>
</div>
</body>
</html>