<?php
    require '/home/cicadagr/db.php';
    $sql = "SELECT * FROM student";
    $result = @mysqli_query($cnxn, $sql);
    while ($row = mysqli_fetch_assoc($result))
    {
        $sid = $row['sid'];
        $first = $row['first'];
        $last = $row['last'];
        $birthdate = $row['birthdate'];
        echo "<p>$sid - $first $last, $birthdate</p>";
    }
?>