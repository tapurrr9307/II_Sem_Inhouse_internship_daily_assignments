<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Registration Form</title>
</head>
<body>
    <h1>College Registration Form</h1>
    
    <!-- Registration Form -->
    <form action="submision.php" method="post">
        <label for="name">Student Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="college">College Name:</label><br>
        <input type="text" id="college" name="college" required><br><br>

        <label for="branch">Branch:</label><br>
        <input type="text" id="branch" name="branch" required><br><br>

        <input type="submit" value="Register">
    </form>

    <?php
    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars($_POST['name']);
        $college = htmlspecialchars($_POST['college']);
        $branch = htmlspecialchars($_POST['branch']);

        echo "<h2>Registration Details:</h2>";
        echo "<p><strong>Name:</strong> $name</p>";
        echo "<p><strong>College:</strong> $college</p>";
        echo "<p><strong>Branch:</strong> $branch</p>";
    }
    ?>
</body>
</html>
