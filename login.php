<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/form.css">
<!--note for developers - uname - allan | pw - badsec -->
</head>
<body>
  <div class="heading" style="display: inline;"><img src="img/menu.svg" class="avatar"/>
<center><h1 style="display: inline;">Bad Security Inc.</h1>
<p>Welcome, please enter your credentials.</p></center>
<?php if (isset($_GET['error'])) { ?>
  <p class="error"><?php echo $_GET['error']; ?></p>
<?php } ?>
</div>
  <form class="log" action="post.php" method="post">
      <div class="login">
      <label for="username">Username</label>
      <input type="text" placeholder="Enter Username" name="username" required>

      <label for="password">Password</label>
      <input type="password" placeholder="Enter Password" name="password" required>

      <label style="float: right;">
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
      <button type="submit">Login</button>

    </div>
  </form>

</body>
</html>