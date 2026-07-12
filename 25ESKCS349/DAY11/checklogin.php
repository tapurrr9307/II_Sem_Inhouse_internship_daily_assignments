<?php 
include ('db_connect.php');
$error = "";
$ticketCode = "";
$guestEmail = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizing inputs just like the login script
    $ticketCode = mysqli_real_escape_string($conn, $_POST["ticket_code"] ?? "");
    $guestEmail = mysqli_real_escape_string($conn, $_POST["email"] ?? "");

    if (empty($ticketCode) || empty($guestEmail)) {
        $error = "Please enter both your ticket code and email address.";
        echo $error;
    } else {
        // Fetching registration details based on a unique identifier
        $selectQuery = "SELECT * FROM registrations WHERE ticket_code = '$ticketCode' AND email = '$guestEmail'";
        $result = mysqli_query($conn, $selectQuery);
        $registration = mysqli_fetch_assoc($result);

        if ($registration) {
            // Initializing session and binding user/event variables
            session_start();
            $_SESSION['reg_id'] = $registration['id'];
            $_SESSION['guest_email'] = $registration['email'];
            $_SESSION['guest_name'] = $registration['fullname'] ?? '';
            $_SESSION['seat_no'] = $registration['seat_number'] ?? 'General Admission';
            
            // Role-based/Access-level routing sequence
            if ($registration['access_level'] == 'VIP') {
                header("Location: vip_lounge.php");
            } else {
                header("Location: general_admission.php");
            }
            exit();
        } else {
            echo "Invalid ticket code or email match.";
            echo "Error details: " . mysqli_error($conn);
        }
    }
}
?>
