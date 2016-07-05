<?php
// Start the session
session_start();
?>
<?php
$id=$_POST["postid"];
if($id==null)
    header("Location:login page.php");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "personDB";
$postErr="";
$accesslevel=$_SESSION["accesslevel"];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "DELETE FROM snippets WHERE id='$id'";
if ($conn->query($sql) === TRUE) {
    echo "Success";
}
else echo "failed";
    $conn->close();

?>

