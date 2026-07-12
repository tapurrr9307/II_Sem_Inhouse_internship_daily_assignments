<?php include('dashboardHeader.php'); 
    include ('checkProfile.php');
?>

<div class = "container mt-5" style ="max-width:400px;">
<form action = "" method = "post" enctype="multipart/form-data">
<h3 class = "mb-3">Update Asset</h3>
<p>Current Name: <?php echo $_SESSION['asset_name']; ?></p>
<p>Current Email: <?php echo $_SESSION['asset_serial']; ?></p>
<input type = "text" name = "name" class = "form-control mb-3" placeholder = "New Asset Name">
<input type = "email" name = "email" class = "form-control mb-3" placeholder = "New Notification Email">
<label for="fileChoice">Asset Photo:</label>
<input class="form-control mb-3" type="file" name="myFile" id="fileChoice" accept="image/*">
<button type = "submit" class = "btn btn-primary">Update Asset</button>
</form>
</div>

<?php include('footer.php'); ?>
