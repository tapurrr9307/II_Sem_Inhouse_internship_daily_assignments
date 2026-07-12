<?php
session_start();
include('db_connect.php');

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizes incoming string inputs against standard SQL Injection strategies
    $new_password = mysqli_real_escape_string($conn, trim($_POST["new_secret"] ?? ""));
    $old_password = mysqli_real_escape_string($conn, trim($_POST["current_token"] ?? ""));
    $confirm_password = mysqli_real_escape_string($conn, trim($_POST["confirm_secret"] ?? ""));

    // Validation Guard 1: Enforces completeness across all properties
    if ($new_password === "" || $old_password === "" || $confirm_password === "") {
        $error = "Please fill in all fields.";
        echo $error;
    // Validation Guard 2: Cross-references structural token matching rules
    } elseif ($new_password !== $confirm_password) {
        $error = "New password and confirm password do not match.";
        echo $error;
    // Validation Guard 3: Validates the state of the parent operational session identity
    } elseif (!isset($_SESSION["admin_id"])) {
        echo "Please login first.";
    } else {
        $user_id = (int)$_SESSION["admin_id"];
        $selectQuery = "SELECT secret_key FROM administrators WHERE id = $user_id";
        $result = mysqli_query($conn, $selectQuery);

        if ($result && $user = mysqli_fetch_assoc($result)) {
            $stored_password = $user["secret_key"];

            // Flexible authentication structure accepting fallback string matches or hashed records
            if ($stored_password === $old_password || password_verify($old_password, $stored_password)) {
                $safe_new_password = mysqli_real_escape_string($conn, $new_password);
                $updateQuery = "UPDATE administrators SET secret_key = '$safe_new_password' WHERE id = $user_id";

                if (mysqli_query($conn, $updateQuery)) {
                    header("Location: portal_dashboard.php");
                    exit();
                } else {
                    echo "Failed to update password.";
                }
            } else {
                $error = "Old password is incorrect.";
                echo "Old password is incorrect.";
            }
        } else {
            echo "User not found.";
        }
    }
}
