<?php session_start();
require_once 'CheckLogin.php';
$dayp = '';
if($_SESSION['Login'] == "Success"){
$DBname = $_SESSION['Database'];
if($_SESSION['adcode'] == 'done'){
header("Location:admin/WelcomeAdmin.php");
}
if($_SESSION['edit'] == 0){
$_SESSION['edit'] = 1;
}elseif($_SESSION['edit'] == 1){
$_SESSION['edit'] = 2;
}else{
header("Location:Logout.php");
}
require 'Connection.php';
$RollNumber = substr($_GET['roll'],4,2).substr($_GET['roll'],10,2).substr($_GET['roll'],16,2);
$RollNumbe = $_GET['roll'];
$DayOrdr = $_GET['dayorder'];
if($DayOrdr == 'MON')
$DayOrder = 1;
if($DayOrdr == 'TUE')
$DayOrder = 2;
if($DayOrdr == 'WED')
$DayOrder = 3;
if($DayOrdr == 'THU')
$DayOrder = 4;
if($DayOrdr == 'FRI')
$DayOrder = 5;
if($DayOrdr == 'CustomTT')
$DayOrder = 7;
$Table = $_GET['table'];
$SendTable = $Table;
$_SESSION['clas'] = $Table;
require 'subjects.php';
$TimeTable = substr($Table, 0,-4);
$TimeTable = $TimeTable."tt";
require 'UpdateNoOfHours.php';
if(isset($_POST['Submit'])){
for($i=1;$i<=$CountForSubjects;$i++){
$Element = "Core".$i;
if(isset($_POST[$Element])){
${$Element} = $_POST[$Element];
}else{
${$Element} = 0;
}
}
$QueryForSelect = "SELECT * FROM $Table WHERE rollno='$RollNumber'";
$ExecuteForSelect = mysqli_query($Connection, $QueryForSelect);
$Countt = 0;
while($Data= mysqli_fetch_assoc($ExecuteForSelect)){
if($Countt == 1)break;
$Countt=1;
$Name = $Data['name'];
$RegNo = $Data['regno'];
$Date = date("ymd");
$Tot =0;$OverallTotal=0;
for($i=1;$i<=$CountForSubjects;$i++){
$Element = "Core".$i;
$Element2 = "Count".$i;
$Tot +=${$Element};
$OverallTotal +=${$Element2};
}
$QueryString ="INSERT INTO ".$Table." (rollno,name,regno,";
for($i=1;$i<=$CountForSubjects;$i++){
$QueryString.= "core".$i."p,";
$QueryString.="core".$i."t,";
}
$QueryString.="overallp,overallt,lastupdated) VALUES ('".$RollNumber."','".$Name."','0',";
for($i=1;$i<=$CountForSubjects;$i++){
$Ele1 ="Core".$i;
$Ele2 ="Count".$i;
$QueryString.="'".${$Ele1}."',";
$QueryString.="'".${$Ele2}."',";
}
$QueryString.="'".$Tot."','".$OverallTotal."','".$Date."')";
$Execute = mysqli_query($Connection, $QueryString);
header("Location:Update.php?dayorder=$DayOrdr");
}
}
}else{
$_SESSION['ErrorMessage'] = "Access Denied. Please Login";
header("Location:Login.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            body{
                background-image: url("Images/whitebackground.jpg");
                background-attachment: fixed;
                background-size: cover;
                font-family: 'Slabo 27px', serif;
            }
            .panel-title{
                text-align: center;
                font-style: oblique;
            }
            .panel-body{
                background-image: url("Images/whitebackground.jpg");
                background-size: cover;
                color: black;
                font-size: 1.5em;    
                opacity: 0.9;
            }
            #SideArea{
                border-radius: 1%;
                opacity: 0.9;
            }
            #SideArea li a:hover{
                background-color: steelblue;
                color: white;
                animation-name: SideAreaFont;
                animation-duration: 0.3s;
                  animation-fill-mode: forwards;
            }
            tr:nth-child(even){
                background-color: lightblue;
              
            }
            tr:hover{
                animation-name: zoomtt;
                animation-duration: 0.4s;
                animation-fill-mode: forwards;
            }
            @keyframes SideAreaFont{
                100%{
                    transform: translate(15px);
                }
            }
            @keyframes zoomtt{
                100%{
                    background-color: steelblue;
                    color: white;
                    transform: scale(1.1,1.1);
                }
            }
        </style>
        <title>WELCOME</title>
    </head>
    <body>
        <div class="container">
            <center>
                <img src="Images/VEC-LOGO.jpg" class="img-responsive" width="80%">
            </center>
        </div>
<!--**********************************************************************************************************************************
****************************************************    SIDE AREA     ****************************************************************
******************************************** ******************************************** ******************************************** -->
        <div class="col-lg-3 col-mg-3 col-sm-3 col-xs-3">
            <div class="row" style="position: fixed;" >
            <ul id="SideArea" class="nav nav-pills nav-stacked">
                <br>
                <li ><a href="">
                    <span class="glyphicon glyphicon-calendar"></span>
                    &nbsp;TIME-TABLE
                </a></li>
                <li><a href="">
                    <span class="glyphicon glyphicon-tasks"></span>
                    &nbsp;UPDATE ATTENDANCE
                </a></li>
                <li><a href="">
                    <span class="glyphicon glyphicon-list"></span>
                    &nbsp;VIEW-ATTENDANCE
                </a></li>
                <li><a href="">
                    <span class="glyphicon glyphicon-tasks"></span>
                    &nbsp;UPDATE TT
                </a></li>
                <li><a href="">
                    <span class="glyphicon glyphicon-plus"></span>
                    &nbsp;ADD-STUDENT
                </a></li>
                <li><a href="" style="color: white;">
                    <span class="glyphicon glyphicon-off"></span>
                    &nbsp;LOGOUT
                </a></li>
                </ul>
            </div>
        </div>
<!--**********************************************************************************************************************************
****************************************************    MAIN  AREA     ****************************************************************
******************************************** ******************************************** ******************************************** -->     
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
        <div style="position: fixed;right:0;top:0;color: #269abc;padding-right: 1%"><h3><?php echo date("l");?></h3></div>
            <div style="position: fixed;left:0;top:0;color: #269abc;padding-left: 1%;"><h3><?php echo date("d F Y");?></h3></div>
            <br><br>
            <?php   
            $QueryForSelect = "SELECT * FROM $Table WHERE rollno=$RollNumber";
            $ExecuteForSelect = mysqli_query($Connection, $QueryForSelect);
            $Countt=0;
            while($Data= mysqli_fetch_assoc($ExecuteForSelect)){
                if($Countt > 0)break;
                $Countt = 1;
                $Name = $Data['name'];
                $RegNo = $Data['regno'];
                $LastUpdated = $Data['lastupdated'];
 $Query = "SELECT lastupdated FROM $Table WHERE rollno=$RollNumber";
 $Execute = mysqli_query($Connection, $Query);
 $PrevDate = '000000';
 while($Datas = mysqli_fetch_array($Execute)){
     $LastUpdated = $Datas['lastupdated'];
     if($PrevDate < $LastUpdated){
     $Month = $LastUpdated[2].$LastUpdated[3];
     switch ($Month){
         case '01': $Month = "January";break;
         case '02': $Month = "Febuary";break;
         case '03': $Month = "March";break;
         case '04': $Month = "April";break;
         case '05': $Month = "May";break;
         case '06': $Month = "June";break;
         case '07': $Month = "July";break;
         case '08': $Month = "August";break;
         case '09': $Month = "September";break;
         case '10': $Month = "October";break;
         case '11': $Month = "November";break;
         case '12': $Month = "December";break;
     }
     $LastUpdatd = $LastUpdated[4].$LastUpdated[5]." ".$Month." ".$LastUpdated[0].$LastUpdated[1];   
     }
     $PrevDate = $Datas['lastupdated'];
 }   
            $Formeg = '<div style="margin:0 35% 0 35%">';
            $Formeg.='<form action="NewUserTry.php?roll='.$RollNumbe.'&dayorder='.$DayOrdr.'&table='.$SendTable.'" method="POST" >';
            $Formeg.='<fieldset><div class="form-group"><center>';
            $Formeg.='<h2>Name: '.$Name.'</h2>';
            $Formeg.='<h2>Roll Number: '.$RollNumber.'</h2>';
            $Formeg.='<h4>Last Updated: '.$LastUpdatd;
            $Formeg.= '</h4></center>';
                echo $Formeg;
                            for($i=1;$i<=$CountForSubjects;$i++){
                                $Element = "Name".$i;
                                $CountElement = "Count".$i;
                            if(${$CountElement} == 0){
                                continue;
                            }
                                $SubCont = '<label>';
                                $SubCont.= ${$Element};
                                $SubCont.=':</label><div class="input-group input-group-md">';
                                $SubCont.='<span class="input-group-addon"><span class="glyphicon glyphicon-education text-primary"></span></span>';
                                $SubCont.='<select class="form-control" id="';
                                $SubCont.= 'Core'.$i.'" name = "Core'.$i.'" ';
                                $SubCont.=' style="background-color: rgba(255,255,255,0.5);" >';
                                        for($j=0;$j<=${$CountElement};$j++){
                                            $SubCont.='<option>'.$j.'</option>';
                                            }
                                $SubCont.='</select></div><br><br>';
                                echo $SubCont;
                            }
                            $FormEnding ='</div><center>';
                            $FormEnding.='<input class="btn btn-success btn-lg" type="Submit" name="Submit" value="Submit">';
                            $FormEnding.='</center>';
                            $FormEnding.='<br><br><br></fieldset></form></div>';
                            echo $FormEnding;
            }
            ?>
        </div>
    </body>
</html>
<!-- DEVELOPED BY RAKESH KUMAR T -->
<?php
/*            DEVELEPOR NOTES (-RAKESH KUMAR T)
                ________________         
1) This page is is completely for updating the attendace for particular student;
2) Here wee have used $DBname for getting database name;
3) $Rollnumber for picking up the specific data;
4) $Core3 & $Core4 are used for dealing with third years;
5) $Maths is used for dealing with 1st & 2nd years;
6) $Flag is set for third year;
*/
?>