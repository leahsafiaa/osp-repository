<?php
$conn = mysqli_connect("localhost", "root", "", "produce_website");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>