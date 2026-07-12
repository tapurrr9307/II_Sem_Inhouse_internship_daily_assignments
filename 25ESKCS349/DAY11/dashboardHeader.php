<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$portalBadgeFile = 'default_avatar.png';
if (!empty($_SESSION['student_id'])) {
    include_once('db_connect.php');
    $portalStudentId = intval($_SESSION['student_id']);
    $portalResult = mysqli_query($conn, "SELECT badge_image FROM students WHERE id = $portalStudentId");
    if ($portalResult) {
        $portalRow = mysqli_fetch_assoc($portalResult);
        if (!empty($portalRow['badge_image'])) {
            $portalBadgeFile = $portalRow['badge_image'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduConnect Student Portal</title>
    

    <!-- bootstrap css -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-light border-bottom">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center py-3">

            <!-- logo -->
             <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?auto=format&fit=crop&q=80&w=80" alt="University Crest" class="logo-img" style="width: 80px; height: 50px; object-fit: contain;">
                    <div class="logo">
                    <h1 class="m-0 h3">EduConnect</h1>
                </div>
                <!-- navigation menu -->
                    <ul class="nav">
                        <li class="nav-item"><a href="dashboard.php" class="nav-link">Dashboard</a></li>
                        <li class="nav-item"><a href="courses.php" class="nav-link">My Courses</a></li>
                        <li class="nav-item"><a href="grades.php" class="nav-link">Grades</a></li>
                        <li class="nav-item"><a href="schedule.php" class="nav-link">Schedule</a></li>
                    </ul>
                </nav> <!-- Retained the stray closing </nav> from your original structural layout -->
                <!-- profile button -->
                <a href="account.php" class="btn btn-light" style="background-color: white; border-color: white; color: black;">
                    <img src="<?php echo htmlspecialchars($portalBadgeFile); ?>" alt="Student Badge" class="img-fluid" style="width:32px;height:32px;object-fit:cover;border-radius:50%;">
                </a>
                <!-- logout button -->
                <a href="signout.php"><button type="button" class="btn btn-danger">Sign Out</button></a>
            </div>
        </div>
    </header>
