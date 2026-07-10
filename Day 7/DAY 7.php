<?php
$name = $email = $phone = $gender = $course = $address = "";
$errors = [];

if(isset($_POST['submit']))
{
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $gender = isset($_POST['gender']) ? $_POST['gender'] : "";
    $course = $_POST['course'];
    $address = trim($_POST['address']);

    if($name=="")
        $errors[]="Name is required.";
    else if(preg_match('/[0-9]/',$name))
        $errors[]="Name should not contain numbers.";

    if($email=="")
        $errors[]="Email is required.";
    else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        $errors[]="Enter a valid Email.";

    if($phone=="")
        $errors[]="Phone Number is required.";
    else if(!preg_match('/^[0-9]{10}$/',$phone))
        $errors[]="Phone Number must be 10 digits.";

    if($gender=="")
        $errors[]="Please select Gender.";

    if($course=="")
        $errors[]="Please select Course.";

    if($address=="")
        $errors[]="Address is required.";
    else if(strlen($address)<10)
        $errors[]="Address must be at least 10 characters.";
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Student Registration</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f2f5f9;
font-family:Arial;
}

.container-box{
width:700px;
margin:40px auto;
background:white;
padding:30px;
border-radius:12px;
box-shadow:0px 0px 10px gray;
}

h2{
text-align:center;
margin-bottom:25px;
}

.error-box{
background:#ffe5e5;
color:red;
padding:15px;
border-radius:8px;
margin-bottom:20px;
}

.success-box{
background:#e7ffe7;
padding:20px;
border-radius:10px;
}

img{
margin-top:10px;
border-radius:10px;
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

<p><b>Name :</b> <?php echo $name; ?></p>

<p><b>Email :</b> <?php echo $email; ?></p>

<p><b>Phone :</b> <?php echo $phone; ?></p>

<p><b>Gender :</b> <?php echo $gender; ?></p>

<p><b>Course :</b> <?php echo $course; ?></p>

<p><b>Address :</b><br><?php echo nl2br($address); ?></p>

<?php

if($_FILES['photo']['name']!="")
{
?>

<p><b>Selected Photo :</b></p>

<img src="<?php echo $_FILES['photo']['tmp_name']; ?>" width="180">

<?php
}
?>

<br><br>

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
{
echo "<li>$e</li>";
}

?>

</ul>

</div>

<?php
}
?>

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">

<label class="form-label">Full Name</label>

<input type="text"
class="form-control"
name="name"
value="<?php echo $name;?>">

</div>

<div class="mb-3">

<label class="form-label">Email</label>

<input type="email"
class="form-control"
name="email"
value="<?php echo $email;?>">

</div>

<div class="mb-3">

<label class="form-label">Phone Number</label>

<input type="text"
class="form-control"
name="phone"
value="<?php echo $phone;?>">

</div>

<div class="mb-3">

<label class="form-label">Upload Photo</label>

<input
type="file"
class="form-control"
name="photo">

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

&nbsp;&nbsp;

<input
type="radio"
name="gender"
value="Female"
<?php if($gender=="Female") echo "checked"; ?>>
Female

&nbsp;&nbsp;

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

<option value="B.Tech"
<?php if($course=="B.Tech") echo "selected"; ?>>
B.Tech
</option>

<option value="BCA"
<?php if($course=="BCA") echo "selected"; ?>>
BCA
</option>

<option value="BBA"
<?php if($course=="BBA") echo "selected"; ?>>
BBA
</option>

<option value="MBA"
<?php if($course=="MBA") echo "selected"; ?>>
MBA
</option>

<option value="MCA"
<?php if($course=="MCA") echo "selected"; ?>>
MCA
</option>

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