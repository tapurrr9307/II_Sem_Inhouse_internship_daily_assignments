<?php 
include ('event_db_connect.php');
$error = "";
$ticket_ref = "";
$access_pin = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs to prevent basic SQL injection
    $ticket_ref = mysqli_real_escape_string($conn, $_POST["ticket_ref"] ?? "");
    $access_pin = $_POST["access_pin"] ?? "";

    if (empty($ticket_ref) || empty($access_pin)) {
        $error = "Please provide both your ticket reference and access PIN.";
        echo $error;
    } else {
        // Query the registrations table instead of a standard user table
        $selectQuery = "SELECT * FROM registrations WHERE ticket_reference = '$ticket_ref'";
        $result = mysqli_query($conn, $selectQuery);
        $attendee = mysqli_fetch_assoc($result);

        // Plaintext check matching your template (Note: for true production, password_verify() is used)
        if ($attendee && $attendee['pin'] === $access_pin) {
            session_start();
            $_SESSION['attendee_id'] = $attendee['id'];
            $_SESSION['ticket_code'] = $attendee['ticket_reference'];
            $_SESSION['guest_name'] = $attendee['full_name'] ?? 'Valued Guest';
            $_SESSION['vip_status'] = $attendee['is_vip'] ?? '0';

            // Role-based routing concept maintained
            if ($attendee['access_level'] == 'organizer') {
                header("Location: organizerDashboard.php");
            } else {
                header("Location: welcomeKiosk.php");
            }
            exit();
        } else {
            echo "Invalid ticket reference or access PIN.";
            echo "Database Diagnostics: " . mysqli_error($conn);
        }
    }
}
?>
