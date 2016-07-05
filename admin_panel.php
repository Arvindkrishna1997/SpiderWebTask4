<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin panel</title>
    <link rel="stylesheet" type="text/css" href="adminpanel.css">
</head>
<body>
<script>
    function changeAccessLevel(selectId)               //to change the accesslevel
    {  var xhtt=new XMLHttpRequest();
        var formdata=new FormData();
        formdata.append("id",selectId);
        var element=document.getElementById(selectId);
        var newaccesslevel=element.value;
        formdata.append("newaccesslevel",newaccesslevel);
        xhtt.open("POST","changeaccesslevel.php",true);
        xhtt.onreadystatechange = function(){
            if(xhtt.readyState==4&& xhtt.status==200)
            {
                if (xhtt.responseText.search("Success") == 0)
                {
                     alert("changed successfully");
                    location.reload();
                }
            }
        };
        xhtt.send(formdata);
    }
</script>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "personDB";
$postErr="";
$accesslevel=$_SESSION["accesslevel"];
if($accesslevel!='admin')
header("Location:login page.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM  persons";
$result = $conn->query($sql);
echo "<h2>Admin Panel</h2>";
if($result->num_rows===0)
echo "no other user registered";
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
    if ($row["accesslevel"] == "admin")                  //echos to display the details of users and their access level
        echo "<div class='users'>".$row["name"] ."<div class='access'>admin</div></div><br/>";
    else if ($row["accesslevel"] == "editor")
      echo "<div class='users'>".$row["name"].""."<div class='access'>
<select id=".$row["id"].">
  <option value=\"admin\">admin</option>
  <option value=\"editor\" selected>editor</option>
</select  id=".$row["id"]." ></div><button id='button'onclick=\"changeAccessLevel(".$row["id"].")\">change</button></div><br/> ";
    else
        echo "<div class='users'>".$row["name"].""."<div class='access'>
<select id=".$row["id"].">
  <option value=\"admin\">admin</option>
  <option value=\"editor\" >editor</option>
  <option value=\"viewer\" selected >viewer </option>
</select></div><button id='button' onclick=\"changeAccessLevel(".$row["id"].")\">change</button></div><br/> ";

      }
}
?>
</body>
</html>