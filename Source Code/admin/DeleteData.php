<?php
require_once 'calculate.php';
/*$arr1='';$arr2='';
    $arr1 = array("iva_stu","iiia_stu","iia_stu");
    $arr2 = array("ivb_stu","iiib_stu","iib_stu");
    $arr3 = array("ivc_stu","iiic_stu","iic_stu");
    if($_SESSION['user'] == "eee"){
    $arr4 = array("ivd_stu","iiid_stu","iid_stu"); 
}
    for($i=0;$i<=2;$i++){
        $Query = "DELETE FROM $arr1[$i] WHERE regno=0";
        $Execute = mysqli_query($Connection, $Query);
        $Query = "DELETE FROM $arr2[$i] WHERE regno=0";
        $Execute = mysqli_query($Connection, $Query);
        $Query = "DELETE FROM $arr3[$i] WHERE regno=0";
        $Execute = mysqli_query($Connection, $Query);
        if($_SESSION['user'] == "eee"){
        $Query = "DELETE FROM $arr4[$i] WHERE regno=0";
        $Execute = mysqli_query($Connection, $Query);
        }
    }*/
    header("Location:WelcomeAdmin.php");
?>