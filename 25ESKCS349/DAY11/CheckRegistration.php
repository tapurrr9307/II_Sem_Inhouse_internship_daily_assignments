<?php
include ('db_connect.php');
session_start();
$error = "";
$device_tag = $hardware_type = $serial_num = $confirm_serial_num = "";
if ( $_SERVER["REQUEST_METHOD"] == "POST"){

// Every field is explicitly sanitized via mysqli_real_escape_string straight away
$device_tag = mysqli_real_escape_string($conn, $_POST["device_tag"]);
$hardware_type = mysqli_real_escape_string($conn, $_POST["hardware_type"]);
$serial_num = mysqli_real_escape_string($conn, $_POST["serial_num"]);
$confirm_serial_num = mysqli_real_escape_string($conn, $_POST["confirm_serial_num"]);


if ($device_tag == "" || $hardware_type == "" || $serial_num == "" || $confirm_serial_num == ""){
$error = "All fields are required.";
echo $error;
} else {
if ($serial_num !== $confirm_serial_num) {
$error = "Serial numbers do not match.";
echo $error;
} else {
$safe_serial = mysqli_real_escape_string($conn, $serial_num);
$sql = "INSERT INTO `assets` (`id`, `device_tag`, `hardware_type`, `serial_number`, `date_registered`) VALUES (NULL, '$device_tag', '$hardware_type', '$safe_serial', current_timestamp())";


if (mysqli_query($conn, $sql)) {
    // Catches the auto-incremented primary key of the new asset
    $_SESSION['asset_id'] = mysqli_insert_id($conn);
    $_SESSION['asset_type'] = $hardware_type;
    $_SESSION['asset_tag'] = $device_tag;
    $_SESSION['device_tag'] = $device_tag; // Exact match to your session double-assignment layout

    echo "New record created successfully";
} else {

echo "Error: " . $sql . "<br>" . mysqli_error($conn);

}
header("Location: success.php");
exit();
}
}
}
?>
