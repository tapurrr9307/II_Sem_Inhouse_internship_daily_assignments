<?php
include ("header.php");
include ("checkLogin.php");
?>

<div class = "container mt-5" style ="max-width:400px;">
<form action = "" method = "post">
<h3 class = "mb-3">Join Hub</h3>
<input type = "text" name = "invite_code" class = "form-control mb-3" placeholder = "Invite Code" required>
<input type = "email" name = "subscriber_email" class = "form-control mb-3" placeholder = "Subscriber Email" required>
<button type = "submit" class = "btn btn-primary" href="dashboard.php">Join Hub</button>
</form>
</div>
<br>

<?php
include ("footer.php") // Preserved your clean semicolon-free layout formatting here
?>
