<?php
$error = "";

$appointmentId = "";
$contactNumber = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitizing both inputs using mysqli_real_escape_string just like the original script
    $appointmentId = mysqli_real_escape_string($conn, $_POST["appointment_id"]);
    $contactNumber = mysqli_real_escape_string($conn, $_POST["contact_number"]);
    
    // Checking for empty inputs using string comparison and the logical OR (||) operator
    if ($appointmentId == "" || $contactNumber == "") {
        $error = "All fields are required.";
        echo $error;
    } else {
        // Query searching for an exact record matching both criteria at once
        $selectQuery = "Select * from appointments where booking_id='$appointmentId' and phone = '$contactNumber'";

        $result = mysqli_query($conn, $selectQuery);
        $booking = mysqli_fetch_assoc($result);

        if ($booking) {
            // Initializing specific session key-value stores upon a successful match
            $_SESSION['booking_id'] = $booking['id'];
            $_SESSION['client_phone'] = $booking['phone'];
            $_SESSION['client_name'] = $booking['patient_name'];
            $_SESSION['appointment_date'] = $booking['schedule_date'];

            // Clean redirection to the target review page
            header("Location: view_appointment.php");
            exit();
        } else {
            echo "Invalid Credentials";
            echo "Error: " . mysqli_error($conn);
        }
       
    }
}
?>
