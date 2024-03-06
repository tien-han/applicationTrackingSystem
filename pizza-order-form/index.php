<?php
session_start();
include ('pizza-order-form/placeOrder/placeOrder.html');

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
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

