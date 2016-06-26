<?php
// Start the session
session_start();
?>
<?php
if(empty($_SESSION["logged_name"]))
{
    

}
else
{
    echo "<script>alert('A user is already logged in.To login as another user please close the tabs and reopen again')</script>";

}

?>