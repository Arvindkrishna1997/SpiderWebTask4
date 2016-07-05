<?php

$id=$_POST["id"];
$newaccesslevel=$_POST["newaccesslevel"];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "personDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "UPDATE persons SET accesslevel='$newaccesslevel' WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    echo "Success";
}
else echo "failed";
$conn->close();
?>