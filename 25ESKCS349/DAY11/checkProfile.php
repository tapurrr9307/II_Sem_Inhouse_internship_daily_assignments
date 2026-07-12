<?php 

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include ('db_connect.php');

$title = "";
$description = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["course_title"];
    $description = $_POST["course_desc"];

    // Validation guard: checking if at least one parameter or asset upload is populated
    if (empty($title) && empty($description) && empty($_FILES["syllabus_doc"]["name"])) {
        echo "Please fill in at least one field.";
    } else {
        // Verification safety guard checking the system profile session ID
        if (empty($_SESSION['user_id'])) {
            echo "User session not found.";
        } else {
            $user_id = intval($_SESSION['user_id']);

            // Selecting the existing database row to prepare for potential fallbacks
            $selectQuery = "SELECT * FROM courses WHERE instructor_id = $user_id";
            $result = mysqli_query($conn, $selectQuery);
            $course = mysqli_fetch_assoc($result);

            // Ternary fallbacks matching your exact structural blueprint
            $title_safe = empty($title) ? $course['title'] : mysqli_real_escape_string($conn, $title);
            $desc_safe = empty($description) ? $course['description'] : mysqli_real_escape_string($conn, $description);
            $file_safe = $course['syllabus_path'];

            // File verification array mapping with automated location folder initialization
            if (!empty($_FILES["syllabus_doc"]["name"])) {
                if (!is_dir('course_materials')) {
                    mkdir('course_materials', 0755, true);
                }
                $uploadPath = "course_materials/" . basename($_FILES["syllabus_doc"]["name"]);
                if (move_uploaded_file($_FILES["syllabus_doc"]["tmp_name"], $uploadPath)) {
                    $file_safe = mysqli_real_escape_string($conn, $uploadPath);
                } else {
                    echo "Failed to upload profile image.";
                }
            }

            // Direct data string update targeting the structural mapping fields
            $updateQuery = "UPDATE courses SET title = '$title_safe', description = '$desc_safe', syllabus_path = '$file_safe' WHERE instructor_id = $user_id";
            mysqli_query($conn, $updateQuery);

            // Synchronizing state changes back up to the superglobal session tracker
            $_SESSION['active_title'] = $title_safe;
            $_SESSION['active_desc'] = $desc_safe;
            $_SESSION['active_file'] = $file_safe;

            header("Location: dashboard.php");
            exit();
        }
    }
}
?>
