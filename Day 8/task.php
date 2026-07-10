<!DOCTYPE html>
<html>
<head>
    <title>Student Registration Confirmation System</title>

    <style>

        body{
            font-family: Arial, sans-serif;
            background:#e8f0fe;
            margin:0;
            padding:0;
        }

        h1{
            background:#0d6efd;
            color:white;
            padding:20px;
            text-align:center;
            margin:0;
        }

        form{
            width:450px;
            margin:30px auto;
            background:white;
            padding:20px;
            border-radius:10px;
            box-shadow:0 0 10px gray;
        }

        table{
            width:100%;
        }

        td{
            padding:10px;
        }

        input,select{
            width:100%;
            padding:8px;
            border-radius:5px;
            border:1px solid gray;
        }

        input[type=submit]{
            background:#0d6efd;
            color:white;
            border:none;
            cursor:pointer;
            font-size:16px;
        }

        input[type=submit]:hover{
            background:#084298;
        }

        .card{
            width:500px;
            margin:30px auto;
            background:white;
            padding:20px;
            border-radius:10px;
            box-shadow:0 0 10px gray;
        }

        .card h2{
            text-align:center;
            color:#0d6efd;
        }

        .card table{
            border-collapse:collapse;
        }

        .card td{
            border:1px solid #ccc;
        }

        .error{
            text-align:center;
            color:red;
            font-weight:bold;
        }

        footer{
            background:#0d6efd;
            color:white;
            text-align:center;
            padding:15px;
            margin-top:30px;
        }

    </style>
</head>

<body>

<h1>Student Registration Confirmation System</h1>

<?php

$name="";
$email="";
$branch="";
$college="";
$cgpa="";
$grade="";
$message="";

if(isset($_POST["submit"]))
{

    $name=$_POST["name"];
    $email=$_POST["email"];
    $branch=$_POST["branch"];
    $college=$_POST["college"];
    $cgpa=$_POST["cgpa"];

    if($name=="" || $email=="" || $branch=="" || $college=="" || $cgpa=="")
    {
        $message="Please fill all fields.";
    }
    else
    {

        if($cgpa>=9)
            $grade="A+";
        elseif($cgpa>=8)
            $grade="A";
        elseif($cgpa>=7)
            $grade="B";
        elseif($cgpa>=6)
            $grade="C";
        else
            $grade="D";

    }

}

?>

<form method="POST">

<table>

<tr>
<td>Name</td>
<td><input type="text" name="name" value="<?php echo $name; ?>"></td>
</tr>

<tr>
<td>Email</td>
<td><input type="email" name="email" value="<?php echo $email; ?>"></td>
</tr>

<tr>
<td>Branch</td>
<td>
<select name="branch">

<option value="">Select</option>

<option value="CSE"
<?php if($branch=="CSE") echo "selected"; ?>>
CSE
</option>

<option value="IT"
<?php if($branch=="IT") echo "selected"; ?>>
IT
</option>

<option value="ECE"
<?php if($branch=="ECE") echo "selected"; ?>>
ECE
</option>

<option value="ME"
<?php if($branch=="ME") echo "selected"; ?>>
ME
</option>

<option value="CE"
<?php if($branch=="CE") echo "selected"; ?>>
CE
</option>

</select>

</td>
</tr>

<tr>
<td>College</td>
<td><input type="text" name="college" value="<?php echo $college; ?>"></td>
</tr>

<tr>
<td>CGPA</td>
<td><input type="number" step="0.1" name="cgpa" value="<?php echo $cgpa; ?>"></td>
</tr>

<tr>
<td colspan="2" align="center">
<input type="submit" name="submit" value="Register">
</td>
</tr>

</table>

</form>

<?php

if($message!="")
{
    echo "<p class='error'>$message</p>";
}

if($grade!="")
{

echo "<div class='card'>";

echo "<h2>Welcome $name</h2>";

echo "<table>";

echo "<tr><td><b>Name</b></td><td>$name</td></tr>";

echo "<tr><td><b>Email</b></td><td>$email</td></tr>";

echo "<tr><td><b>Branch</b></td><td>$branch</td></tr>";

echo "<tr><td><b>College</b></td><td>$college</td></tr>";

echo "<tr><td><b>CGPA</b></td><td>$cgpa</td></tr>";

echo "<tr><td><b>Grade</b></td><td>$grade</td></tr>";

echo "<tr><td><b>Date</b></td><td>".date("d-m-Y")."</td></tr>";

echo "</table>";

echo "</div>";

}

?>

<footer>

Student Registration Confirmation System © <?php echo date("Y"); ?>

</footer>

</body>
</html>