<?php
include ('pizza-order-form/index.php');
// Start the session
session_start();

// Get DB Connection credentials
require '/home/cicadagr/pizzadb.php';


// Check if the user is logged in
if (!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]) {
    // Redirect to login.php if not logged in
    header("Location: index.php");
    exit();
}

// Display orders or any relevant content for logged-in users

// Fetch all orders from the Orders table
$ordersSQL = "SELECT * FROM Orders";
$result = mysqli_query($cnxn, $ordersSQL);

// Check if there are any orders
if (mysqli_num_rows($result) > 0) {
    echo "<h2>All Orders</h2>";
    echo "<table border='1'>";
    echo "<tr>
                <th>Order ID</th>
                <th>Customer ID</th>
                <th>Topping 1</th>
                <th>Topping 2</th>
                <th>Topping 3</th>
                <th>Delivery</th>
                <th>Price ID</th>
                <th>Promo ID</th>
                <th>Order Placed</th>
            </tr>";

    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                    <td>{$row['orderID']}</td>
                    <td>{$row['customerId']}</td>
                    <td>{$row['topping1']}</td>
                    <td>{$row['topping2']}</td>
                    <td>{$row['topping3']}</td>
                    <td>{$row['delivery']}</td>
                    <td>{$row['priceID']}</td>
                    <td>{$row['promoID']}</td>
                    <td>{$row['order_placed']}</td>
                </tr>";
    }

    echo "</table>";
} else {
    echo "<p>No orders found.</p>";
}

// Close the database connection
mysqli_close($cnxn);
?>

