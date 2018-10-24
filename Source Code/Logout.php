<?php require_once 'CheckLogin.php';
session_start();
$_SESSION['Login']='Fail';
$_SESSION['Database']='';
$_SESSION['SuccessMessage']="Logout Successful";
header("Location:Login.php");
?>
<!-- DEVELOPED BY RAKESH KUMAR T -->