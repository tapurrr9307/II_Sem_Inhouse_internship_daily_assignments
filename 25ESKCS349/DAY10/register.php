

<?php
session_start();

include "db_connect.php";

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);
    $region   = trim($_POST['region']); // Replaced 'college' with operating 'region'
    $hub_id   = trim($_POST['hub_id']); // Replaced 'branch' with 'hub_id'

    if (empty($name) || empty($email) || empty($password) || empty($region) || empty($hub_id)) {
        
        $error = "Please fill all fields.";
        
    } elseif (strlen($password) < 6) {
        
        $error = "Password must be at least 6 characters.";
        
    } else {

        // Check if operator email is already in the database
        $stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE email=?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            
            $error = "Email already registered to an operator account.";
            
        } else {

            // Insert new operator into users table
            $stmt = mysqli_prepare($conn, 
            "INSERT INTO users(name, email, password, region, hub_id) 
            VALUES(?, ?, ?, ?, ?)");

            mysqli_stmt_bind_param(
                $stmt,
                "sssss",
                $name,
                $email,
                $password,
                $region,
                $hub_id
            );

            if (mysqli_stmt_execute($stmt)) {
                $success = "Registration Successful! Terminal access granted.";
            } else {
                $error = "Registration Failed. Systems error.";
            }
        }

        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator Registration - Fleet System</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #198754, #20c997); /* Unified Fleet Green theme */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .register-box {
            width: 500px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,.3);
            overflow: hidden;
        }

        .header {
            background: #198754;
            color: white;
            text-align: center;
            padding: 25px;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-register {
            border-radius: 10px;
            font-weight: bold;
            background-color: #198754;
            border-color: #198754;
        }

        .btn-register:hover {
            background-color: #146c43;
            border-color: #146c43;
        }

        .footer {
            text-align: center;
            color: #777;
            padding: 15px;
        }
    </style>
</head>

<body>

<div class="register-box">

    <div class="header">
        <h2>🚚 Operator Sign-Up</h2>
        <p class="mb-0">Fleet Management Control Center</p>
    </div>

    <div class="p-4">

        <?php if ($error != ""): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <?php if ($success != ""): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($success); ?>
                <br><br>
                <a href="login.php" class="btn btn-success btn-sm">Go to Login Terminal</a>
            </div>
        <?php endif; ?>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input 
                    type="text" 
                    name="name" 
                    class="form-control" 
                    required 
                    value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Company Email Address</label>
                <input 
                    type="email" 
                    name="email" 
                    class="form-control" 
                    required 
                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Terminal Password</label>
                <input 
                    type="password" 
                    name="password" 
                    class="form-control" 
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Assigned Region</label>
                <input 
                    type="text" 
                    name="region" 
                    class="form-control" 
                    placeholder="e.g. Midwest, Pacific North"
                    required 
                    value="<?= htmlspecialchars($_POST['region'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Distribution Hub ID</label>
                <input 
                    type="text" 
                    name="hub_id" 
                    class="form-control" 
                    placeholder="e.g. HUB-404"
                    required 
                    value="<?= htmlspecialchars($_POST['hub_id'] ?? '') ?>">
            </div>

            <button type="submit" class="btn btn-success w-100 btn-register">
                Register Operator Profile
            </button>

        </form>

        <hr>

        <div class="text-center">
            Already have an account? 
            <a href="login.php" class="text-success fw-bold">Login Here</a>
        </div>

    </div>

    <div class="footer">
        © 2026 Fleet Management System Ltd.
    </div>

</div>

</body>
</html>
