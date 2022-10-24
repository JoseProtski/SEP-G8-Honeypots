<?php include 'header.php'; ?>
<?php

session_start();

if (isset($_SESSION['username'])) {

 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<center><h1>Bad Security Inc.</h1></center>
    <div class="content">
      <h3>Home</h3>
      <p>Welcome <?php echo $_SESSION['username']; ?><p>
        <img src="img/hp.png" class="hp"/>
      <p>  A honeypot is a security mechanism that creates a virtual trap to lure attackers. An intentionally compromised computer system allows attackers to exploit vulnerabilities so you can study them to improve your security policies. You can apply a honeypot to any computing resource from software and networks to file servers and routers.

<p>Honeypots are a type of deception technology that allows you to understand attacker behavior patterns. Security teams can use honeypots to investigate cybersecurity breaches to collect intel on how cybercriminals operate. They also reduce the risk of false positives, when compared to traditional cybersecurity measures, because they are unlikely to attract legitimate activity.

<p>Honeypots vary based on design and deployment models, but they are all decoys intended to look like legitimate, vulnerable systems to attract cybercriminals.
    </div>

</body>
</html>
<?php

}else{
     header("Location: login.php");
     exit();
}

?>