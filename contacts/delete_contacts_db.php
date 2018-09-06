<?php

function delete_prev_contacts() {
    require '../db_connect.php';
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $sql = "TRUNCATE TABLE contacts";
    $result = mysqli_query($conn, $sql);
    return $result;
}
    