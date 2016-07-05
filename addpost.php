<?php
// Start the session
session_start();
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
$name=$_SESSION["logged_name"];
$posttext=$_POST['pos'];
if(!empty($posttext)) {
    $post = "By " . $name . ",<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $posttext;

    $sql = "SELECT * FROM posts";
    $result = $conn->query($sql);
    if ($result->num_rows === 0) {                           
        $sql = "INSERT INTO snippets (id,post)                     <!--to insert the post-->
           VALUES (0,'$post')";
    } else
        $sql = "INSERT INTO snippets (post) 
        VALUES ('$post');";

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        echo "lastid" . $last_id;
        echo "<div id=" . $last_id . ">" . $post . "</div>";
    }
}
header("Location:BulletinBoard.php");
?>