<?php

include ('header.php');
include ('checkRegistration.php');
include ('db_connect.php');
?>

<div class = "container mt-5" style ="max-width:400px;">
    <form action = "" method = "post">
        <h3 class = "mb-3">Request Pass</h3>

        <input type = "text" name = "full_name" class = "form-control mb-3" placeholder = "Full Name" value="<?= $name; ?>" required>
        <input type = "email" name = "work_email" class = "form-control mb-3" placeholder = "Work Email" value="<?= $email; ?>" required>
        <input type = "password" name = "secure_pin" class = "form-control mb-3" placeholder = "Secure Pin" value="<?= $password; ?>" required>
        <input type = "password" name = "confirm_pin" class = "form-control mb-3" placeholder = "Confirm Pin" value="<?= $confirm_password; ?>" required>
        <button type = "submit" class = "btn btn-primary">Request Pass</button>
    </form>
</div>







<br>
<?php
include ('footer.php');
?>
