<?php
$name = $email = $phone = $gender = $course = $address = $date_registered = "";
$errors = [];
$photoPath = "";

if(isset($_POST['submit']))
{
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $gender = isset($_POST['gender']) ? $_POST['gender'] : "";
    $course = $_POST['course'];
    $address = trim($_POST['address']);
    $date_registered = $_POST['date_registered'];

    // Name Validation
    if($name=="")
        $errors[]="Name is required.";
    else if(!preg_match("/^[a-zA-Z ]+$/",$name))
        $errors[]="Name should contain only alphabets.";

    // Email Validation
    if($email=="")
        $errors[]="Email is required.";
    else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        $errors[]="Enter a valid Email.";

    // Phone Validation
    if($phone=="")
        $errors[]="Phone Number is required.";
    else if(!preg_match("/^[0-9]{10}$/",$phone))
        $errors[]="Phone Number must be exactly 10 digits.";

    // Gender Validation
    if($gender=="")
        $errors[]="Please select Gender.";

    // Course Validation
    if($course=="")
        $errors[]="Please select Course.";

    // Address Validation
    if($address=="")
        $errors[]="Address is required.";

    // Date Validation
    if($date_registered=="")
        $errors[]="Please select Date Registered.";

    // Photo Upload
    if($_FILES['photo']['name']=="")
    {
        $errors[]="Please upload a Photo.";
    }
    else
    {
        if(!file_exists("uploads"))
        {
            mkdir("uploads");
        }

        $photoPath="uploads/".time()."_".$_FILES['photo']['name'];

        $ext=strtolower(pathinfo($photoPath,PATHINFO_EXTENSION));

        if($ext!="jpg" && $ext!="jpeg" && $ext!="png")
        {
            $errors[]="Only JPG, JPEG and PNG files are allowed.";
        }

        if(count($errors)==0)
        {
            move_uploaded_file($_FILES["photo"]["tmp_name"],$photoPath);
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Student Registration Form</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f2f5f9;
font-family:Arial;
}

.container-box{
width:720px;
margin:40px auto;
background:white;
padding:30px;
border-radius:15px;
box-shadow:0px 0px 12px gray;
}

h2{
text-align:center;
margin-bottom:25px;
color:#0d6efd;
}

.error-box{
background:#ffe5e5;
padding:15px;
border-radius:8px;
color:red;
margin-bottom:20px;
}

.success-box{
background:#e8ffe8;
padding:25px;
border-radius:10px;
}

img{
border-radius:10px;
border:2px solid gray;
}

</style>

</head>

<body>

<div class="container-box">

<?php

if(isset($_POST['submit']) && count($errors)==0)
{

?>

<div class="success-box">

<h2>Registration Successful</h2>

<table class="table table-bordered">

<tr>
<th>Photo</th>
<td><img src="<?php echo $photoPath; ?>" width="180"></td>
</tr>

<tr>
<th>Name</th>
<td><?php echo $name; ?></td>
</tr>

<tr>
<th>Email</th>
<td><?php echo $email; ?></td>
</tr>

<tr>
<th>Phone</th>
<td><?php echo $phone; ?></td>
</tr>

<tr>
<th>Date Registered</th>
<td><?php echo $date_registered; ?></td>
</tr>

<tr>
<th>Gender</th>
<td><?php echo $gender; ?></td>
</tr>

<tr>
<th>Course</th>
<td><?php echo $course; ?></td>
</tr>

<tr>
<th>Address</th>
<td><?php echo nl2br($address); ?></td>
</tr>

</table>

<a href="" class="btn btn-primary">Register Another Student</a>

</div>

<?php
}
else
{
?>

<h2>Student Registration Form</h2>

<?php
if(count($errors)>0)
{
?>

<div class="error-box">

<b>Please fix the following errors:</b>

<ul>

<?php

foreach($errors as $e)
echo "<li>$e</li>";

?>

</ul>

</div>

<?php
}
?>
<form method="POST" enctype="multipart/form-data">

<div class="mb-3">
<label class="form-label">Full Name</label>
<input
type="text"
class="form-control"
name="name"
value="<?php echo $name; ?>">
</div>

<div class="mb-3">
<label class="form-label">Email</label>
<input
type="email"
class="form-control"
name="email"
value="<?php echo $email; ?>">
</div>

<div class="mb-3">
<label class="form-label">Phone Number</label>
<input
type="text"
class="form-control"
name="phone"
maxlength="10"
value="<?php echo $phone; ?>">
</div>

<!-- NEW PHOTO FIELD -->

<div class="mb-3">
<label class="form-label">Photo</label>
<input
type="file"
class="form-control"
name="photo"
accept=".jpg,.jpeg,.png">
</div>

<!-- NEW DATE REGISTERED FIELD -->

<div class="mb-3">
<label class="form-label">Date Registered</label>
<input
type="date"
class="form-control"
name="date_registered"
value="<?php echo $date_registered; ?>">
</div>

<div class="mb-3">

<label class="form-label">Gender</label>

<br>

<input
type="radio"
name="gender"
value="Male"
<?php if($gender=="Male") echo "checked"; ?>>
Male

&nbsp;&nbsp;&nbsp;

<input
type="radio"
name="gender"
value="Female"
<?php if($gender=="Female") echo "checked"; ?>>
Female

&nbsp;&nbsp;&nbsp;

<input
type="radio"
name="gender"
value="Other"
<?php if($gender=="Other") echo "checked"; ?>>
Other

</div>

<div class="mb-3">

<label class="form-label">Course</label>

<select
class="form-select"
name="course">

<option value="">Select Course</option>

<option value="B.Tech" <?php if($course=="B.Tech") echo "selected"; ?>>B.Tech</option>

<option value="BCA" <?php if($course=="BCA") echo "selected"; ?>>BCA</option>

<option value="BBA" <?php if($course=="BBA") echo "selected"; ?>>BBA</option>

<option value="MBA" <?php if($course=="MBA") echo "selected"; ?>>MBA</option>

<option value="MCA" <?php if($course=="MCA") echo "selected"; ?>>MCA</option>

</select>

</div>

<div class="mb-3">

<label class="form-label">Address</label>

<textarea
class="form-control"
name="address"
rows="4"><?php echo $address; ?></textarea>

</div>

<div class="text-center">

<button
type="submit"
name="submit"
class="btn btn-success px-5">
Register
</button>

<button
type="reset"
class="btn btn-secondary px-5">
Reset
</button>

</div>

</form>

<?php
}
?>

</div>

</body>
</html>