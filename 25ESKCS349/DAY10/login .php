<?php
session_start();

// If already logged in, skip the login screen
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

include "db_connect.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $error = "Please enter Email and Password.";
    } else {
        // Updated query targeting the fleet operators/users table
        $stmt = mysqli_prepare($conn, "SELECT id, name, email, password FROM users WHERE email=?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {

            // Plain text password check matching your assignment logic
            if ($password == $row['password']) {

                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_email'] = $row['email'];

                header("Location: dashboard.php");
                exit();

            } else {
                $error = "Incorrect Password!";
            }

        } else {
            $error = "Operator email not registered.";
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
    <title>Fleet Control Terminal - Login</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #198754, #20c997); /* Match the green fleet theme */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .login-box {
            width: 420px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,.3);
            overflow: hidden;
        }

        .login-header {
            background: #198754;
            color: white;
            text-align: center;
            padding: 25px;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-login {
            border-radius: 10px;
            font-weight: bold;
            background-color: #198754;
            border-color: #198754;
        }

        .btn-login:hover {
            background-color: #146c43;
            border-color: #146c43;
        }

        .footer {
            text-align: center;
            padding: 15px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>

<body>

<div class="login-box">

    <div class="login-header">
        <h2>🚚 Operator Login</h2>
        <p class="mb-0">Fleet Management Control Center</p>
    </div>

    <div class="p-4">

        <?php if ($error != ""): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Operator Email Address</label>
                <input 
                    type="email" 
                    name="email" 
                    class="form-control" 
                    placeholder="name@company.com" 
                    required 
                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Terminal Password</label>
                <input 
                    type="password" 
                    name="password" 
                    class="form-control" 
                    placeholder="Enter Security Password" 
                    required>
            </div>

            <button type="submit" class="btn btn-success w-100 btn-login">
                Access Terminal
            </button>

        </form>

        <hr>

        <div class="text-center">
            New dispatcher? 
            <a href="register.php" class="text-success fw-bold">Register Terminal Account</a>
        </div>

    </div>

    <div class="footer">
        © 2026 Fleet Management System Ltd.
    </div>

</div>

</body>
</html>
