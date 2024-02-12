<?php
require '/home/cicadagr/db.php';
$sql = "SELECT * FROM Orders";
$result = @mysqli_query($cnxn, $sql);
while ($row = mysqli_fetch_assoc($result))
{
    $orderID = $row['orderID'];
    $customerID = $row['customerID'];
    $priceID = $row['priceID'];
    $promoID = $row['promoID'];
    $topping1 = $row['topping1'];
    $topping2 = $row['topping2'];
    $topping3 = $row['topping3'];
    $order_placed = $row['order_placed'];
    $delivery = $row['delivery'];
    echo "<p>$orderID - $customerID, $priceID, $promoID, $topping1, $topping2, $topping3, $delivery, $order_placed</p>";
}
?>
