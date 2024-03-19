<?php
    ob_start();
    header('Content-Type: application/json');
    require '/home/cicadagr/atsdb.php';
    $sql = "SELECT * FROM applications WHERE admin_deleted = 0 ORDER BY application_date";
    $result = mysqli_query($cnxn, $sql);
    $recentApplications = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (isset($row['role_name'])) {
                $row['role_name'] = substr($row['role_name'], 0, 40); //limits the characters for role_name
            }
            $recentApplications[] = $row;
        }
    } else {
        $recentApplications = ["error" => "No recent applications found."];
    }
    ob_end_clean();
    echo json_encode($recentApplications);
?>
