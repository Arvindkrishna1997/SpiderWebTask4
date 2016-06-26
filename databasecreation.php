<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create database and table</title>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE personDB";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();
?>
<?php
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

// sql to create table
$sql= "CREATE TABLE persons (
id INT(30) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100) UNIQUE,
password VARCHAR(100) ,
accesslevel VARCHAR(100),
pic VARCHAR(100) ,
email VARCHAR(40) UNIQUE,
phoneno INT(10) UNIQUE,
physicaladdress VARCHAR(300)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table persons created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
$sql = "INSERT INTO persons (name,password,accesslevel,email,phoneno,physicaladdress)
VALUES ('Arvind', 'krishna','admin','arvindborn2win@gmail.com','2030168','srirangam')";

if ($conn->query($sql) === TRUE) {
echo "\nSigned up  successfully.";

} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
$sql= "CREATE TABLE snippets (
id INT(30) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
post VARCHAR(300)
)";

if ($conn->query($sql) === TRUE) {
echo "\nsnippets created  successfully.";

} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
</body>
</html>