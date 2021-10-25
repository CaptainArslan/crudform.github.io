<?php 
session_start();
include("database.php");
$obj = new database();

//for checking emails
if(isset($_POST['email']))
{
    $emailcheck = $_POST['email'];
    $emaildata = $obj->duplication($emailcheck);
    if($emaildata)
    {
        echo "true";
    }
    else
    {
        echo "false";
    }
}
?>