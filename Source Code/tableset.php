<?php
session_start();
$DBname = $_SESSION['Database'];
require 'Connection.php';
if($_SESSION['user'] == "eee"){
    $ar = array("iiatt","iibtt","iictt","iiiatt","iiibtt","iiictt","ivatt","ivbtt","ivctt");
    $Section = 9;
}else{
    $ar = array("iiatt","iibtt","iictt","iidtt","iiiatt","iiibtt","iiictt","iiidtt","ivatt","ivbtt","ivctt","ivdtt");
    $Section = 12;
}
$da = date("w");
$day = (int)$da;
for($i=0;$i<$Section;$i++){
    $Queryp = "SELECT * FROM $ar[$i] WHERE dayorder=$day";
    $Executep = mysqli_query($Connection, $Queryp);
    while($data = mysqli_fetch_array($Executep)){
        $QueryUpdate = "UPDATE $ar[$i] SET one='$data[2]',two='$data[3]',three='$data[4]',four='$data[5]',five='$data[6]',six='$data[7]',seven='$data[8]',eight='$data[9]' WHERE dayorder=7";
        $ExecuteUpdate = mysqli_query($Connection, $QueryUpdate);
    }
}
header("Location:WelcomePage.php");
?>
