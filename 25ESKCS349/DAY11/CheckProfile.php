<?php 

// Check and start session exactly like the profile script pattern
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include ('db_connect.php');

$project_title = "";
$budget = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_title = $_POST["project_title"];
    $budget = $_POST["budget"];

    // Validate that at least one field or the file attachment has data
    if (empty($project_title) && empty($budget) && empty($_FILES["projectDoc"]["name"])) {
        echo "Please fill in at least one field.";
    } else {
        // Confirm active session verification layer
        if (empty($_SESSION['active_project_id'])) {
            echo "Project session not found.";
        } else {
            $project_id = intval($_SESSION['active_project_id']);

            // Fetch current records to establish fallback options
            $selectQuery = "SELECT * FROM projects WHERE id = $project_id";
            $result = mysqli_query($conn, $selectQuery);
            $project = mysqli_fetch_assoc($result);

            // Ternary operators: use new input if present, otherwise fall back to old DB data
            $title_safe = empty($project_title) ? $project['title'] : mysqli_real_escape_string($conn, $project_title);
            $budget_safe = empty($budget) ? $project['allocated_budget'] : mysqli_real_escape_string($conn, $budget);
            $doc_safe = $project['document_path'];

            // Handle the physical file upload process
            if (!empty($_FILES["projectDoc"]["name"])) {
                if (!is_dir('project_files')) {
                    mkdir('project_files', 0755, true);
                }
                $uploadPath = "project_files/" . basename($_FILES["projectDoc"]["name"]);
                if (move_uploaded_file($_FILES["projectDoc"]["tmp_name"], $uploadPath)) {
                    $doc_safe = mysqli_real_escape_string($conn, $uploadPath);
                } else {
                    echo "Failed to upload project document.";
                }
            }

            // Run the SQL UPDATE command with the safe variables
            $updateQuery = "UPDATE projects SET title = '$title_safe', allocated_budget = '$budget_safe', document_path = '$doc_safe' WHERE id = $project_id";
            mysqli_query($conn, $updateQuery);

            // Keep the active session memory accurately synchronized
            $_SESSION['project_title'] = $title_safe;
            $_SESSION['project_budget'] = $budget_safe;
            $_SESSION['project_doc'] = $doc_safe;

            header("Location: project_dashboard.php");
            exit();
        }
    }
}
?>
