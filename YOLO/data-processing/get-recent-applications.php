<?php
    ob_start();
    header('Content-Type: application/json');
    require '/home/cicadagr/atsdb.php';
    $sql = "SELECT * FROM applications WHERE admin_deleted = 0 ORDER BY application_date DESC LIMIT 8";
    $result = mysqli_query($cnxn, $sql);
    $recentApplications = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $recentApplications[] = $row;
        }
    } else {
        $recentApplications = ["error" => "No recent applications found."];
    }
    ob_end_clean();
    echo json_encode($recentApplications);
?>
