<!--check if user is logged in, if not redirect to login page -->
<?php
session_start();

// Validates the compound, multi-variable authentication protection wall
if (empty($_SESSION['admin_id']) && empty($_SESSION['admin_name']) && empty($_SESSION['sys_username']) && empty($_SESSION['admin_email'])) {
    header("Location: secure_gateway.php");
    exit();
}
?>

<!-- page content Header-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloud Terminal</title>
    

    <!-- bootstrap css -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"">
</head>
<body>
    <header class="bg-border-bottom">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center py-3">

            <!-- logo -->
             <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&q=80&w=80" alt="Terminal Logo" class="logo-img" style="width: 80px; height: 50px; object-fit: contain;">
                    <div class="logo">
                    <h1 class="m-0">NetOps Portal</h1>
                </div>
                <!-- navigation menu -->
                <nav>
                    <ul class="nav">
                        <li class="nav-item"><a href="nodes.php" class="nav-link">Compute Nodes</a></li>
                        <li class="nav-item"><a href="storage.php" class="nav-link">Storage Volumes</a></li>
                        <li class="nav-item"><a href="networks.php" class="nav-link">VPC Networks</a></li>
                        <li class="nav-item"><a href="security.php" class="nav-link">IAM Policies</a></li>
                    </ul>
                </nav>
              <!--  <a href="login.php"><button type="button" class="btn btn-primary">Log in </button></a> -->
            </div>
        </div>
    </header>

<!--  Middle page -->
<!DOCTYPE html>
<html lang="en">
<head>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
<h2 class="text-center mb-4">Infrastructure Nodes</h2>
<input type="text" id="search" class="form-control mb-4" placeholder="Search Infrastructure Nodes...">
<div id="container" class="row g-4"></div>
</div>
<script>
let items = []; // Holds data records arrays

function renderItems(filter = "") {
const searchTerm = filter.toLowerCase().trim();
const filteredItems = items.filter(item => {
return (
item.title.toLowerCase().includes(searchTerm) ||
item.status.toLowerCase().includes(searchTerm) ||
String(item.id).includes(searchTerm)
);
});
let html = "";
filteredItems.forEach(item => {
html += `
<div class="col-md-4 card-item">
<div class="card shadow">
<div class="card-body">
<h4>Node-${item.id}</h4>
<button class="btn btn-primary btn-sm mt-2 show-btn">
Show Metrics
</button>
<div class="details mt-3" style="display:none;">
<img src="https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&q=80&w=300" alt="${item.title}" class="img-fluid rounded mb-3">
<p><strong>Ref Code:</strong> ${item.id}</p>
<p><strong>Config Type:</strong> ${item.title.substring(0, 15)}...</p>
<p><strong>Node Status:</strong> <span class="badge bg-success">${item.status}</span></p>
</div>
</div>
</div>
</div>
`;
});
$("#container").html(html);
}

// Handles live interactive slide animations via jQuery DOM selectors
$(document).on("click", ".show-btn", function () {
$(this).next(".details").slideToggle();
});

// Event listener catches realtime keyword filtering
$("#search").on("input", function () {
renderItems($(this).val());
});

// Fetches operational JSON array sets directly from a test endpoint architecture
fetch("https://jsonplaceholder.typicode.com/todos")
.then(response => response.json())
.then(data => {
    // Maps the incoming variables dynamically to mock system node profiles
    items = data.map(todo => ({
        id: todo.id,
        title: todo.title,
        status: todo.completed ? "Active Operational" : "Maintenance Queue"
    }));
    renderItems();
})
.catch(error => console.error("API Fetch Error Event: ", error));
</script>
</body>
</html>

<?php include('footer.php'); ?>
