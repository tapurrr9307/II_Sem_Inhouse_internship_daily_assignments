<?php 
session_start();

// Multi-tier structural session fallbacks matching your profile properties
$assetName = $_SESSION['vehicle_nickname'] ?? $_SESSION['model_name'] ?? $_SESSION['vin_number'] ?? 'Fleet Asset';
$assetLocation = $_SESSION['assigned_hub'] ?? $_SESSION['last_known_city'] ?? '';
$assetImage = !empty($_SESSION['vehicle_photo']) ? $_SESSION['vehicle_photo'] : 'default_truck.jpg';

// Enforces a strict multi-variable auth check wall to protect the system data
if (empty($_SESSION['driver_id']) && empty($_SESSION['model_name']) && empty($_SESSION['vehicle_nickname'])) {
    header("Location: portal_login.php");
    exit();
}
include ('fleetHeader.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleet Operations Log</title>
    <style>
        /* Sets the overall page font, outer spacing, and background color */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #eceff1;
        }

        /* Centers the asset section content */
        .asset-header {
            text-align: center;
        }

        /* Styles the vehicle reference heading */
        .asset-header h1 {
            color: #2c3e50;
            margin: 10px 0;
        }

        /* Makes the asset item image circular and properly sized */
        .asset-header img {
            border-radius: 50%;
            width: 250px;
            height: 250px;
            object-fit: cover;
            border: 3px solid #b0bec5;
        }

        /* Adds a horizontal divider line with spacing */
        hr {
            margin: 20px 0;
            border: none;
            border-top: 1px solid #cfd8dc;
        }

        /* Styles normal navigation elements */
        a {
            color: #1e88e5;
            text-decoration: none;
        }

        /* Underlines links when the mouse hovers over them */
        a:hover {
            text-decoration: underline;
        }

        /* Adds left indentation for unordered and ordered lists */
        ul, ol {
            margin-left: 20px;
        }

        /* Adds vertical spacing between list items */
        li {
            margin: 8px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="asset-header">
            <h1><?php echo htmlspecialchars($assetName); ?></h1>
            <img src="<?php echo htmlspecialchars($assetImage); ?>" alt="<?php echo htmlspecialchars($assetName); ?> System Image">
        </div>
        <hr>

        <?php if (!empty($assetLocation)) { ?>
            <p><strong>Current Hub:</strong> <?php echo htmlspecialchars($assetLocation); ?></p>
        <?php } ?>

        <!-- Form architecture using matching Bootstrap grid mechanics -->
        <form method="post" class="mt-4">
            <h4>Mechanical Checklists / Safety Points</h4>
            <div class="row">
                <div class="col-md-6 mb-2">
                    <input type="text" name="check1" class="form-control" placeholder="Check 1: Brake System">
                </div>
                <div class="col-md-6 mb-2">
                    <input type="text" name="check2" class="form-control" placeholder="Check 2: Tire Pressure">
                </div>
                <div class="col-md-6 mb-2">
                    <input type="text" name="check3" class="form-control" placeholder="Check 3: Fluid Levels">
                </div>
                <div class="col-md-6 mb-2">
                    <input type="text" name="check4" class="form-control" placeholder="Check 4: Indicators">
                </div>
                <div class="col-md-6 mb-2">
                    <input type="text" name="check5" class="form-control" placeholder="Check 5: Battery Health">
                </div>
                <div class="col-md-6 mb-2">
                    <input type="text" name="check6" class="form-control" placeholder="Check 6: Belt Condition">
                </div>
                <div class="col-md-6 mb-2">
                    <input type="text" name="check7" class="form-control" placeholder="Check 7: Exhaust System">
                </div>
                <div class="col-md-6 mb-2">
                    <input type="text" name="check8" class="form-control" placeholder="Check 8: Headlights">
                </div>
                <div class="col-md-6 mb-2">
                    <input type="text" name="check9" class="form-control" placeholder="Check 9: Wiper Blades">
                </div>
                <div class="col-md-6 mb-2">
                    <input type="text" name="check10" class="form-control" placeholder="Check 10: Cargo Locks">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit Log</button>

            <h4 class="mt-3">Cargo Destination Points</h4>
            <div class="row">
                <div class="col-md-4 mb-2">
                    <input type="text" name="dest1" class="form-control" placeholder="Primary Dropoff">
                </div>
                <div class="col-md-4 mb-2">
                    <input type="text" name="dest2" class="form-control" placeholder="Secondary Delivery">
                </div>
                <div class="col-md-4 mb-2">
                    <input type="text" name="dest3" class="form-control" placeholder="Return Hub">
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit Route</button>
        </form>

        <div class="mt-3">
            <a href="modifyAlerts.php" class="btn btn-primary">Update Emergency Contacts</a>
            <a href="modifyAsset.php" class="btn btn-primary">Update Log Metadata</a>
        </div>
    </div>
</body>
</html>

<?php include ('fleetVerticalNavigation.php'); ?>

<?php
include('fleetFooter.php');
?>
