<?php
session_start();
include("DashboardHeader.php");
?>
<div class = "container mt-5" style ="max-width:400px;">
<form action = "rotatecheck.php" method = "post">
<h3 class = "mb-3">Rotate API Key</h3>

<input type = "password" name = "current_token" class = "form-control mb-3" placeholder = "Current Token" required>

<input type = "password" name = "new_secret" class = "form-control mb-3" placeholder = "New Secret Key" required>

<input type = "password" name = "confirm_secret" class = "form-control mb-3" placeholder = "Confirm New Secret" required>

<button type = "submit" class = "btn btn-primary">Rotate API Key</button>
</form>
</div>
<br>

<?php
include ("Dashboardfooter.php");
?>
