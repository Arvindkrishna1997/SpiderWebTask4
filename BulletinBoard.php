<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="bulletinboard.css">
<title>Bulletin Board</title>
</head>
<body id="bod" >
<script>

    function validatepos(){
        if(document.form.pos.value=="") {
            alert("enter a post");
            return false;
        }
        else
            return true;

    }
    function deletePost(id) {                      //a functionto delete a post
        // alert("going to delete :"+id);
        if (confirm("Are you sure")) {
            var xhttp = new XMLHttpRequest();
            var formdata = new FormData();
            formdata.append("postid", id);
            //alert("going to delete :"+id);
            xhttp.onreadystatechange = function () {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    if (xhttp.responseText.search("Success") == 0) {
                        var element = document.getElementById(id);
                        element.parentNode.removeChild(element);

                    }

                }
            };
            xhttp.open("POST", "deletePost.php", true);
            xhttp.send(formdata);
        }
    }
</script>


<?php

$servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "personDB";
 $postErr="";
  $accesslevel=$_SESSION["accesslevel"];
$loggedname= $_SESSION["logged_name"];
if(empty($loggedname))
    header("Location:login page.php");

  if($accesslevel==="admin")
   echo "<a href='admin_panel.php'> <button id='adminpanel'>Admin panel</button></a><br/>";
echo "<h2>Bulletin Board</h2>";
 // Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);
 // Check connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
 $sql = "SELECT * FROM snippets";
 $result = $conn->query($sql);


   if(!$result->num_rows)
       echo "sorry no posts published";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //echo $row["id"]."  ".$row["post"]."<br/>";
        if($accesslevel=="admin")
        {
            echo "<div class='posts'  id=".$row["id"].">".$row["post"]."<button  onclick=\"deletePost(".$row["id"].")\">Delete</button></div>";
        }
        else
        echo "<div class='posts'  id=".$row["id"].">".$row["post"]."</div>";
    }
}
$conn->close();
    if($accesslevel==="admin"||$accesslevel==="editor")
        {
            echo "<form name='form' method=\"post\" action='addpost.php' onsubmit='return validatepos()'>
                    <br/>
                     <textarea name=\"pos\" placeholder=\"What's on your mind?\" rows=\"5\" cols=\"40\" ></textarea>
                        <br/><br/>
                        <input type=\"submit\" name=\"submit\" value=\"Add post\">
                         <br> </form>";


        }



 ?>


</body>
</html>