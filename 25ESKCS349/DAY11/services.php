<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevSprint Workspace</title>
    

    <!-- bootstrap css -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-border-bottom">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center py-3">

            <!-- logo -->
             <img src="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&q=80&w=80" alt="Logo" class="logo-img" style="width: 80px; height: 50px; object-fit: contain;">
                    <div class="logo">
                    <h1 class="m-0">DevSprint</h1>
                </div>
                <!-- navigation menu -->
                <nav>
                    <ul class="nav">
                        <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                        <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
                        <li class="nav-item"><a href="services.php" class="nav-link">Services</a></li>
                        <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
                    </ul>
                </nav>
              <!--  <a href="login.php"><button type="button" class="btn btn-primary">Log in </button></a>-->
            </div>
        </div>
    </header>
</body>
</html>

<!-- page content -->
<div class="container mt-5" style="max-width: 700px;">
    <div class="card shadow-sm p-4">
        <h3 class="mb-4 text-center">Platform Core Features</h3>

        <div class="mb-3">
            <h5>Sprint Planning</h5>
            <p class="text-muted mb-0">Map out your milestones, assign development tickets, and track project velocities smoothly.</p>
        </div>

        <div class="mb-3">
            <h5>Task Boards</h5>
            <p class="text-muted mb-0">Organize task iterations visually using dynamic drag-and-drop workflow status boards.</p>
        </div>

        <div class="mb-3">
            <h5>Code Integration</h5>
            <p class="text-muted mb-0">Link repository commits and branch requests directly to operational issue tickets.</p>
        </div>

        <div class="mb-3">
            <h5>Burndown Analytics</h5>
            <p class="text-muted mb-0">Monitor sprint progress lines relative to timeline deadlines with built-in telemetry reports.</p>
        </div>

        <div class="mb-3">
            <h5>Automated Releases</h5>
            <p class="text-muted mb-0">Build, test, and deploy stable builds automatically across staging and deployment targets.</p>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
