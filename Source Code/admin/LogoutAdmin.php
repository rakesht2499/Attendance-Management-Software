<?php require_once '../CheckLogin.php'; ?>
<?php
session_start();
$_SESSION['adcode']='';
$_SESSION['SuccessMessage']="Logout Successful";
header("Location:../Login.php");
?>