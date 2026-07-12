<?php 
session_start();

// Fallback session logic matching the profile format
$projectName = $_SESSION['project_title'] ?? $_SESSION['venture_name'] ?? $_SESSION['user_email'] ?? 'New Venture';
$projectScope = $_SESSION['project_scope'] ?? $_SESSION['scope_type'] ?? '';
$projectDoc = !empty($_SESSION['proposal_file']) ? $_SESSION['proposal_file'] : 'blueprint.pdf';

// Core auth guard verification routing check
if (empty($_SESSION['user_id']) && empty($_SESSION['user_name']) && empty($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include ('dashboardHeader.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Workspace</title>
    <style>
        /* Baseline spacing and layout styles matching the prototype template structure */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        .proposal-container {
            text-align: center;
        }

        .proposal-container h1 {
            color: #333;
            margin: 10px 0;
        }

        .proposal-container img {
            border-radius: 4px;
            width: 300px;
            height: 180px;
            object-fit: cover;
            border: 3px solid #ddd;
        }

        hr {
            margin: 20px 0;
            border: none;
            border-top: 1px solid #ddd;
        }

        a {
            color: #28a745;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        ul, ol {
            margin-left: 20px;
        }

        li {
            margin: 8px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="proposal-container">
            <h1><?php echo htmlspecialchars($projectName); ?></h1>
            <img src="<?php echo htmlspecialchars($projectDoc); ?>" alt="<?php echo htmlspecialchars($projectName); ?> Blueprint Showcase">
        </div>
        <hr>

        <?php if (!empty($projectScope)) { ?>
            <p><strong>Classification Scope:</strong> <?php echo htmlspecialchars($projectScope); ?></p>
        <?php } ?>

        <form method="post" class="mt-4">
            <h4>Milestone Execution Targets</h4>
            <div class="row">
                <div class="col-md-6 mb-2">
                    <input type="text" name="phase1" class="form-control" placeholder="Phase 1 Objective">
                </div>
                <div class="col-md-6 mb-2">
                    <input type="text" name="phase2" class="form-control" placeholder="Phase 2 Objective">
                </div>
                <div class="col-md-6 mb-2">
                    <input type="text" name="phase3" class="form-control" placeholder="Phase 3 Objective">
                </div>
                <div class="col-md-6 mb-2">
                    <input type="text" name="phase4" class="form-control" placeholder="Phase 4 Objective">
                </div>
                <div class="col-md-6 mb-2">
                    <input type="text" name="phase5" class="form-control" placeholder="Phase 5 Objective">
                </div>
                <div class="col-md-6 mb-2">
                    <input type="text" name="phase6" class="form-control" placeholder="Phase 6 Objective">
                </div>
                <div class="col-md-6 mb-2">
                    <input type="text" name="phase7" class="form-control" placeholder="Phase 7 Objective">
                </div>
                <div class="col-md-6 mb-2">
                    <input type="text" name="phase8" class="form-control" placeholder="Phase 8 Objective">
                </div>
                <div class="col-md-6 mb-2">
                    <input type="text" name="phase9" class="form-control" placeholder="Phase 9 Objective">
                </div>
                <div class="col-md-6 mb-2">
                    <input type="text" name="phase10" class="form-control" placeholder="Phase 10 Objective">
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-3">Save Phases</button>

            <h4 class="mt-3">Budget Allocations</h4>
            <div class="row">
                <div class="col-md-4 mb-2">
                    <input type="text" name="cost1" class="form-control" placeholder="Capital Expense">
                </div>
                <div class="col-md-4 mb-2">
                    <input type="text" name="cost2" class="form-control" placeholder="Operating Expense">
                </div>
                <div class="col-md-4 mb-2">
                    <input type="text" name="cost3" class="form-control" placeholder="Marketing Expense">
                </div>
            </div>

            <button type="submit" class="btn btn-success mt-3">Save Budget</button>
        </form>

        <div class="mt-3">
            <a href="editBudget.php" class="btn btn-secondary">Modify Financials</a>
            <a href="editMilestones.php" class="btn btn-secondary">Modify Deliverables</a>
        </div>
    </div>
</body>
</html>

<?php include ('dashboardVerticalcontent.php'); ?>

<?php
include('dashboardFooter.php');
?>
