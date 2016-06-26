<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sign up</title>
    <link rel="stylesheet" type="text/css" href="styleregister.css">
</head>

<body>
<?php
       $name= $password =$pic= $email =$physical_address =$phoneno=$password1="";
        $nameErr =$passwordErr =$emailErr =$physical_addressErr=$picErr=$phonenoErr=$passwordErr1="";


  if($_SERVER['REQUEST_METHOD']=="POST"){
 if (empty($_POST["name"])) {
   $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  if(empty($_POST["password"])){
	  $passwordErr="password is required";
  }
  else
  {$password=$_POST["password"];
  }
  $password1=$_POST["password1"];
  if($password!=$password1)
    $passwordErr1="passwords dont match";

  if(empty($_POST["pic"]))
       $picErr="select an image";
       $pic=$_POST["pic"];
$phoneno=$_POST["phoneno"];

if (empty($_POST["email"])) {
$emailErr = "Email is required";
} else {
$email = test_input($_POST["email"]);
// check if e-mail address is well-formed
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
$emailErr = "Invalid email format";
}
}
if(empty($_POST["physicaladdress"]))
$physical_addressErr="physical address is reqiured";
else
$physical_address=test_input($_POST["physicaladdress"]);
if($nameErr===""&&$passwordErr===""&&$emailErr===""&&$physical_addressErr===""&&$passwordErr1=="")
{
$servername = "localhost";
$username = "root";
$passwo = "";
$dbname = "personDB";

// Create connection
$conn = new mysqli($servername, $username, $passwo, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
//$password=md5($password,2155);
$sql = "INSERT INTO persons (name,password,accesslevel,pic,email,phoneno,physicaladdress)
VALUES ('$name', '$password','viewer','$pic','$email','$phoneno','$physical_address')";

if ($conn->query($sql) === TRUE) {
echo "\nSigned up  successfully.";
header("Location:login page.php");
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


}

}
function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
?>
<script>
    function validateclientside()
    {   <?php  ?>
         if( document.form.name.value == "" )
                 {  alert("name is required");
                    return false;
                 }
         if(document.form.password.value=="")
                {
                    alert("password is required");
                }
         if(document.form.pic.value=="")
                {
                   alert("select an image");
                   return false;
                }
         var emailID = document.form.email.value;
         var atpos = emailID.indexOf("@");
         var dotpos = emailID.lastIndexOf(".");
         if (1> atpos  || ( 2>dotpos - atpos ))
                {
                  alert("invalid email");
                  return false;
                  }
         if(document.form.phoneno.value=="")
                {
                  alert("enter a phone number");
                  return false;
                  }
         if(document.form.physical_address.value=="")
                  {
                     alert("address is required");
                     return false;
                  }

    }
</script>
<h2>Student Adding form</h2>
<div class="login" >
    <form name="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" onsubmit="return validateclientside();" >
    <input type="text"  name="name" autocomplete="off" placeholder='Username' value="<?php echo $name;?>">
    <span class="error">* <?php echo $nameErr;?></span>
    <br/>
    <input type="password" autocomplete="off" placeholder='password' name="password" value="<?php echo $password;?>" >
    <span class="error">* <?php echo $passwordErr;?></span>
   <br/>
   <input type="password" autocomplete="off" placeholder='retype-password' name="password1" value="<?php echo $password1;?>" >
       <span class="error">* <?php echo $passwordErr1;?></span>
      <br/><br/>
    <div id="text" style="display: inline">Profile pic</div>
    <input type="file" style="display:inline" autocomplete="off" placeholder='profile pic' name="pic" accept="image/*">
    <span class="error">* <?php echo $picErr;?></span>
    <br/>
    <input type="text" placeholder='email' autocomplete="off" name="email" value="<?php echo $email;?>">
    <span class="error">* <?php echo $emailErr;?></span>
    <br/>
    <input type="number" autocomplete="off" placeholder='phone no' name="phoneno" value="<?php echo $phoneno;?>">
        <span class="error">* <?php echo $phonenoErr;?></span>
        <br/>
    <textarea placeholder='address' autocomplete="off" name="physicaladdress" rows="3" cols="40" value="<?php echo $physical_address;?>"><?php echo $physical_address;?></textarea>
    <span class="error">* <?php echo $physical_addressErr;?></span>
    <br/><br/>
    <input class="animated" type="submit" name="submit" value="Register">
    <br/>
</form>
    </div>

</body>
</html>