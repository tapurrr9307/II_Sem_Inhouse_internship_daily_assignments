<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$headerBadgeFile = 'default-badge.png';
if (!empty($_SESSION['user_id'])) {
    include_once('db_connect.php');
    $headerStudentId = intval($_SESSION['user_id']);
    $headerResult = mysqli_query($conn, "SELECT dynamic_badge FROM students WHERE id = $headerStudentId");
    if ($headerResult) {
        $headerRow = mysqli_fetch_assoc($headerResult);
        if (!empty($headerRow['dynamic_badge'])) {
            $headerBadgeFile = $headerRow['dynamic_badge'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduPortal Learning</title>
    

    <!-- bootstrap css -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-border-bottom">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center py-3">

            <!-- logo -->
             <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?auto=format&fit=crop&w=80&h=50&q=80" alt="EduLogo" class="logo-img" style="width: 80px; height: 50px;">
                    <div class="logo">
                    <h1 class="m-0">EduPortal</h1>
                </div>
                <!-- navigation menu -->
                    <ul class="nav">
                        <li class="nav-item"><a href="dashboard.php" class="nav-link">Classroom</a></li>
                        <li class="nav-item"><a href="grades.php" class="nav-link">Grades</a></li>
                        <li class="nav-item"><a href="schedule.php" class="nav-link">Schedules</a></li>
                        <li class="nav-item"><a href="library.php" class="nav-link">Library</a></li>
                    </ul>
                </nav>
                <!-- profile button -->
                <a href="achievements.php" class="btn btn-primary" style="background-color: white; border-color: white; color: black;">
                    <img src="<?php echo htmlspecialchars($headerBadgeFile); ?>" alt="Rank Badge" class="img-fluid" style="width:32px;height:32px;object-fit:cover;border-radius:50%;">
                </a>
                <!-- logout button -->
                <a href="signout.php"><button type="button" class="btn btn-danger">Leave Class</button></a>
            </div>
        </div>
    </header>
