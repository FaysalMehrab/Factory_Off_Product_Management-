<?php

$connect = mysqli_connect('localhost', 'root', '', 'brothers');


// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

?>