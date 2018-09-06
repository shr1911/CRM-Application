<?php

$status = $_GET['status'];
$id = $_GET['id'];

echo 'status: ' + $status;
echo 'id: ' + $id;

$response = 'status: ' . $status . ' id: ' . $id;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hariomjyotish_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$active = 1;
if($status == 'true'){
    $active = 1;
}else{
    $active = 0;
}

$sql = "UPDATE contacts SET active = " . $active . " WHERE seq = " . $id ;
$result = mysqli_query($conn, $sql);
file_put_contents('C:\output1.json', $status . " " . $id . " " . $sql . " " . $result);
mysqli_close($conn);
?>