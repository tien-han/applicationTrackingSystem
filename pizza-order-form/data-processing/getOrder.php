<?php
require '/home/cicadagr/pizzadb.php';
$sql = "SELECT * FROM Orders";
$result = @mysqli_query($cnxn, $sql);
while ($row = mysqli_fetch_assoc($result))
{
    $orderID = $row['orderID'];
    $Customers = $row['Customers'];
    $Prices = $row['Prices'];
    $promo = $row['promo'];
    $topping1 = $row['topping1'];
    $topping2 = $row['topping2'];
    $topping3 = $row['topping3'];
    $order_placed = $row['order_placed'];
    $delivery = $row['delivery'];
    echo "<p>$orderID - $customerID, $priceID, $promo, $topping1, $topping2, $topping3, $delivery, $order_placed</p>";
}
?>
