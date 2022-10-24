<!DOCTYPE html>
<script>
function show() {
 document.getElementById('nav').style.display = "block";
}
function hide() {
  document.getElementById('nav').style.display = "none";
}
</script>
<div class="menu" onclick="show()"></div>
<nav style="display:none;" id ="nav">
<p id="close" onclick="hide()"/>&times;</p><br><br><br>
<a href="action_page.php">Home</a>
<a href="resources.php">Resources</a>
<a href="contact.php">Contact Support</a><br><br>

<b><a href="logout.php">Logout</a></b>
</nav>