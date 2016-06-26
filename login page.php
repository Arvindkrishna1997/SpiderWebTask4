<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link  rel="stylesheet" type="text/css" href="styleform.css">
<title>Login page</title>
</head>
<body>
<?php
$name=$password1="";
if($_SERVER['REQUEST_METHOD']==="POST")
{$name=test_input($_POST["name"]);
 $password1=($_POST["password"]);


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
 $sql = "SELECT * FROM persons";
 $result = $conn->query($sql);
 $flag=0;
 if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
         if($row["name"]===$_POST["name"]&&($row["password"]===$password1))

         {   if(empty($_SESSION["logged_name"])) {
             $_SESSION["logged_name"] = $row["name"];
             $_SESSION["accesslevel"] = $row["accesslevel"];

             header("Location:BulletinBoard.php");
             exit;
           }
                else
                    echo "<script>alert('A user is already logged in.To login as another user please close the tabs and reopen again')</script>";
           	   $flag=1;
 			   break;
 	   }
     }
 }

 if($flag===0) {
     echo "<div class='error'>invalid credentials!!!</div>";
 }
 $conn->close();

}
function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
?>


<h2>Log In</h2>
<div class="login">
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" >
<input type="text" placeholder='Username'  autocomplete="off" name="name" value="<?php echo $name; ?>" >
    <br/>
<input type="password" placeholder='password' autocomplete="off" name="password"  >
    <br/><br/><br/><br/>
</div>
<input class="animated" type="submit" name="login" value="login" >
</form>
<br/>
<a class="signup" href="registration form.php">sign up?</a>
</body>
</html>
