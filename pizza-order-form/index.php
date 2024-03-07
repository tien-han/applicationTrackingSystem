<?php
session_start();
include ('pizza-order-form/placeOrder/placeOrder.html');

if (isset($_GET['logged_out'])) {
    echo "<script>alert('You have been logged out.');</script>";
}


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if username and password match
    if ($username == "admin" && $password == "admin") {
        // Set the logged-in status in the session
        $_SESSION["logged_in"] = true;
        header("Location: placeOrder/placeOrder.html");
        exit();
    } else {
        $error_message = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
<!-- Navbar -->
<nav class="navbar navbar-expand navbar-dark" role="navigation">
    <!-- Navbar Brand & Toggler -->
    <div class="navbar-header" id="navbar-header">
        <a class="navbar-brand navbar-left px-3"><img
                    alt="Pizza Logo from Pexels.com" src="/pictures/pexels-christopher-farrugia-3581878.jpg" width="100"></a>
    </div>
    <div class="navbar-expand-sm me-auto">
        <ul class="navbar-nav align-items-center">
            <li class="nav-item">
                <a class="nav-link active" href="placeOrder/placeOrder.html">Place Your Order</a>
            </li>
        </ul>
    </div>
</nav>
<h2>Login</h2>
<?php
if (isset($error_message)) {
    echo "<p style='color: red;'>$error_message</p>";
}
?>
<form action="index.php" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>
    <input type="submit" value="Login">
</form>
</body>
</html>

