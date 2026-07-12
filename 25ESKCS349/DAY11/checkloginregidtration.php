<?php
include ('db_connect.php');
session_start();
$error = "";
$itemName = $skuCode = $quantity = $confirmSku = "";

if ( $_SERVER["REQUEST_METHOD"] == "POST"){

    // Sanitizing all inputs exactly like your script does
    $itemName = mysqli_real_escape_string($conn, $_POST["item_name"]);
    $skuCode = mysqli_real_escape_string($conn, $_POST["sku_code"]);
    $quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);
    $confirmSku = mysqli_real_escape_string($conn, $_POST["confirm_sku"]);

    // Checking if any field is empty using individual string comparisons
    if ($itemName == "" || $skuCode == "" || $quantity == "" || $confirmSku == ""){
        $error = "All fields are required.";
        echo $error;
    } else {
        // Checking if confirmed tracking identifiers match (like your password verification)
        if ($skuCode !== $confirmSku) {
            $error = "SKU codes do not match.";
            echo $error;
        } else {
            $safe_quantity = mysqli_real_escape_string($conn, $quantity);
            
            // Inserting a new record using NULL for auto-increment and current_timestamp() for tracking
            $sql = "INSERT INTO `products` (`id`, `item_name`, `sku`, `stock_qty`, `date_added`) VALUES (NULL, '$itemName', '$skuCode', '$safe_quantity', current_timestamp())";

            if (mysqli_query($conn, $sql)) {
                // Tracking the newly inserted item row inside the session using mysqli_insert_id
                $_SESSION['last_added_id'] = mysqli_insert_id($conn);
                $_SESSION['last_added_sku'] = $skuCode;
                $_SESSION['last_added_name'] = $itemName;
                $_SESSION['manager_username'] = $_SESSION['username'] ?? 'System';

                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            
            // Post-insertion clean redirect to an item-added landing view
            header("Location: inventory_success.php");
            exit();
        }
    }
}
?>
