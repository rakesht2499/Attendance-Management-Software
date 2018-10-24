<!--            DEVELEPOR NOTES(R*)
                _______________
1) We drop the table for Third years;
2) Then we rename the First year table names to be second years;
3) Which implies that we dont have the table for first and third year;
4) Hence we create the tables for first years and third years;
5) We need to re-enter the database for third years & Fresh data for fisrt years;
-->
<?php
require 'calculateyear.php';
/*$arr1 = array("iva_stu","iiia_stu","iia_stu");
$arr2 = array("ivb_stu","iiib_stu","iib_stu");
$arr3 = array("ivc_stu","iiic_stu","iic_stu");
if($_SESSION['user'] == "eee"){
$arr4 = array("ivd_stu","iiid_stu","iid_stu"); 
}
for($i=0;$i<=2;$i++){
    $Query = "DELETE FROM $arr1[$i]";
    $Execute = mysqli_query($Connection, $Query);
    $Query = "DELETE FROM $arr2[$i]";
    $Execute = mysqli_query($Connection, $Query);
    $Query = "DELETE FROM $arr3[$i]";
    $Execute = mysqli_query($Connection, $Query);
    if($_SESSION['user'] == "eee"){
        $Query = "DELETE FROM $arr4[$i]";
        $Execute = mysqli_query($Connection, $Query);
    }
    if($i==2){
        continue;
    }
    $j=$i+1;
    $Query = "SELECT * FROM $arr1[$j] WHERE regno!=0";
    $Execute = mysqli_query($Connection, $Query);
    while($dat = mysqli_fetch_array($Execute)){
        $QueryString ="INSERT INTO $arr1[$i](id,rollno,mentor,name,regno) VALUES ('".$dat[0]."','".$dat[1]."','".$dat[2]."','".$dat[3]."','".$dat[4]."')";
        $Executess = mysqli_query($Connection, $QueryString);
    }
    $Query = "SELECT * FROM $arr2[$j] WHERE regno!=0";
    $Execute = mysqli_query($Connection, $Query);
    while($dat = mysqli_fetch_array($Execute)){
        $QueryString ="INSERT INTO $arr2[$i](id,rollno,mentor,name,regno) VALUES ('".$dat[0]."','".$dat[1]."','".$dat[2]."','".$dat[3]."','".$dat[5]."')";
        $Executess = mysqli_query($Connection, $QueryString);
    }
    $Query = "SELECT * FROM $arr3[$j] WHERE regno!=0";
    $Execute = mysqli_query($Connection, $Query);
    while($dat = mysqli_fetch_array($Execute)){
        $QueryString ="INSERT INTO $arr3[$i](id,rollno,mentor,name,regno) VALUES ('".$dat[0]."','".$dat[1]."','".$dat[2]."','".$dat[3]."','".$dat[5]."')";
        $Executess = mysqli_query($Connection, $QueryString);
    }
    if($_SESSION['user'] == "eee"){
       $Query = "SELECT * FROM $arr4[$j] WHERE regno!=0";
    $Execute = mysqli_query($Connection, $Query);
    while($dat = mysqli_fetch_array($Execute)){
        $QueryString ="INSERT INTO $arr4[$i](id,rollno,mentor,name,regno) VALUES ('".$dat[0]."','".$dat[1]."','".$dat[2]."','".$dat[3]."','".$dat[5]."')";
        $Executess = mysqli_query($Connection, $QueryString);
    } 
    }
}*/
header("Location:WelcomeAdmin.php");
?>