<?php include 'header.php'; ?>
<?php

session_start();

if (isset($_SESSION['username'])) {

 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Resources - BSI</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/resources.css">
<script type="text/javascript" src="script/image.js"></script>
<!--note for developers: ssh access - uname - admin | pw - password -->
</head>
<body>
<center><h1>Bad Security Inc.</h1></center>
    <div class="content">
      <h3>Resources</h3>
        <div class="row">
          <div class="column">
            <p>Video Conferencing Manual<p>
            <img src="img/video.jpg" alt="<h2>Collaborate Ultra Online Training</h2><iframe src='https://cdnapisec.kaltura.com/p/691292/sp/69129200/embedIframeJs/uiconf_id/24456822/partner_id/691292?iframeembed=true&playerId=kaltura_player_1420508608&entry_id=0_t38yoiuz&flashvars[streamerType]=auto' width='auto' height='auto' allowfullscreen webkitallowfullscreen mozAllowFullScreen frameborder='0'><span itemprop='name' content='Collaborate Ultra Online Training Session Recording, 19 March 2020'><span></iframe> <p> Collaborate Ultra Online Training Session Recording, 19 March 2020Collaborate Ultra is an online, synchronous web-conferencing tool that runs in your web browser. This hands-on workshop will take you through the set-up and functionality of the tool when used to manage an online classroom. Topics covered include: Session settings and creation, Interface overview, Hardware set-up, Managing and sharing content, Communicating with and managing students, Live chat, Polling and Breakout rooms. Presented on Thursday 19th March 2020.<p>Created by Learning Transformations Unit" onclick="myFunction(this);">
          </div>
          <div class="column">
            <p>Available Tools<p>
            <img src="img/tools.jpg" alt="<h2>Available Tools</h2><ul><li>Citrix</li><li>Matlab</li><li>Ansys</li><li>Altium Designer</li><li>Office 365</li></ul>" onclick="myFunction(this);">
          </div>
          <div class="column">
            <p>Remote Access<p>
            <img src="img/remote.jpg" alt="<h2>Remote Access</h2><img src='img/vpn.svg' class='hp' style='padding-bottom:20px;'/><p>Bad Security Inc. has set up a Virtual Private Network for employees to remotely access BSI's network from home when required. <p>To set up credentials and retrieve instructions on the VPN installation please contact I.T. via the form on the <a href='contact.php'>Support</a> page. <p>If there are any issues with remotely accessing the network please phone BSI or for non urgent matters refer to the aforementioned support page." onclick="myFunction(this);">
          </div>
        </div>

        <!-- The expanding image container -->
        <div class="container">
          <!-- Close the image -->
          <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>

          <!-- Expanded image -->

          <!-- Image text -->
          <div id="imgtext"></div>

          <img id="expandedImg" style="width:0%">


        </div>
    </div>

</body>
</html>
<?php

}else{
     header("Location: login.php");
     exit();
}

?>