<?php

include "../connection/dbcon.php";

$search = $_GET['search'];

$query = mysqli_query($conn, "SELECT * FROM user WHERE fname LIKE %$search%");

$data = array();

while($row = mysqli_fetch_assoc($query)){
    $data[] = $row['fname'];
}

echo json_encode($data);