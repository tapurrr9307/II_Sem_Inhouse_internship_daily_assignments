<?php
$error = "";

$patient_id = "";
$access_code = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Both fields are escaped directly following your structural pattern
    $patient_id = mysqli_real_escape_string($conn, $_POST["patient_id"]);
    $access_code = mysqli_real_escape_string($conn, $_POST["access_code"]);
    
    // Explicit empty string check logic
    if ($patient_id == "" || $access_code == "") {
        $error = "All fields are required.";
        echo $error;
    } else {
        // Combined selection statement matching user and password paradigm
        $selectQuery = "SELECT * FROM patients WHERE patient_number='$patient_id' AND temporary_code = '$access_code'";

        $result = mysqli_query($conn, $selectQuery);
        $patient = mysqli_fetch_assoc($result);

        if ($patient) {
            // Processing flat session variable hydration upon array confirmation
            $_SESSION['patient_db_id'] = $patient['id'];
            $_SESSION['patient_num'] = $patient['patient_number'];
            $_SESSION['patient_first'] = $patient['first_name'];
            $_SESSION['patient_display'] = $patient['first_name'];

            header("Location: patient_records.php");
            exit();
        } else {
            echo "Invalid Credentials";
            echo "Error: " . mysqli_error($conn);
        }
       
    }
}
?>
