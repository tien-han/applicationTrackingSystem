<?php
ob_start();
header('Content-Type: application/json');
require '/home/cicadagr/atsdb.php';
$sql = "SELECT * FROM announcements ORDER BY date DESC LIMIT 5";
$result = mysqli_query($cnxn, $sql);
$recentAnnouncements = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $recentAnnouncements[] = $row;
    }
} else {
    $recentAnnouncements = ["error" => "No recent applications found."];
}
ob_end_clean();
echo json_encode($recentAnnouncements);

?>
