<?php 
session_start();
include("database.php");
$obj = new database();

//for checking emails
if(isset($_POST['email']))
{
    $emailcheck = $_POST['email'];
    $emaildata = $obj->selectemail($emailcheck);
}

if(isset($_POST['phone']))
{
    $phonecheck = $_POST['phone'];
    $emaildata = $obj->selectphone($phonecheck);
}

?>