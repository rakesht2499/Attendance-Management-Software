<?php session_start();
require_once 'CheckLogin.php';
if($_SESSION['Login'] == "Success"){
$DBname = $_SESSION['Database'];
if($_SESSION['adcode'] == 'done'){
header("Location:admin/WelcomeAdmin.php"); 
}
require 'Connection.php';
$DayOrder = $_GET['dayorder'];
if($_SESSION['dayorders'] == $DayOrder){} else {
header("Location:WelcomePage.php");
}
}else{
$_SESSION['ErrorMessage'] = "Access Denied. Please Login";
header("Location:Login.php");
}
$General = null;
$_SESSION['ErrorMessage'] = null;
if(isset($_POST['Submit'])){
    $Name = $_POST['Name'];
    $RollNo = $_POST['RollNumber'];
    $RegNo = $_POST['RegNumber'];
    $Mentor = $_POST['Mentor'];
    $YearAndSec = $_POST['YearAndSec'];
    if(empty($Name) || empty($RollNo) || empty($RegNo) || empty($Mentor) || $YearAndSec == "Year-Sec"){
        $_SESSION['ErrorMessage'] = "All Fields are Compulsory"; 
    }elseif (!preg_match("/^[A-Za-z .]*$/", $Name)){
        $_SESSION['ErrorMessage'] = "Kindly Fill The Name in Correct Format"; 
    }elseif (!preg_match("/^[1-9][0-9]{5}$/", $RollNo)){
     $_SESSION['ErrorMessage'] = "Kindly Enter a valid 6 digit RollNumber";
     }elseif (!preg_match("/^[1-9][0-9]{7}$/", $RegNo)){
     $_SESSION['ErrorMessage'] = "Kindly Enter a valid 8 digit RegisterNumber";
    }elseif(!preg_match("/^[A-Za-z .]*$/", $Mentor)){
        $_SESSION['ErrorMessage'] = "Kindly Fill The Mentor Name in Correct Format"; 
    }else{
    $YearAndSec= str_replace("-", "", $YearAndSec);
    $YearAndSec = strtolower($YearAndSec);
    $YearAndSec = $YearAndSec."_stu";
    $Date  = date("ymd");$Date-=1;
    $Query = "INSERT INTO $YearAndSec (rollno,name,mentor,regno,lastupdated) VALUES ('$RollNo','$Name','$Mentor','$RegNo','$Date')";
    $Execute = mysqli_query($Connection, $Query);
    if($Execute){
        $_SESSION['ErrorMessage'] = null;
        $General = 'Data Successfully Added';
    }else{
        $_SESSION['ErrorMessage'] = "There was some error while Uploading the data. Kindly Re-enter the data";
    }
    }
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
            @keyframes SideAreaFont{
                100%{
                    transform: translate(15px);
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
        <!--***************************    SIDE   *****    AREA   ******************************************-->
        <div class="col-lg-3 col-mg-3 col-sm-3 col-xs-3">
            <div class="row" style="position: fixed;" >
            <ul id="SideArea" class="nav nav-pills nav-stacked">
                <br>
                <li><a href="WelcomePage.php">
                    <span class="glyphicon glyphicon-calendar"></span>
                    &nbsp;TIME-TABLE
                </a></li>
                <li><a href="Update.php?dayorder=<?php echo $DayOrder;?>">
                    <span class="glyphicon glyphicon-tasks"></span>
                    &nbsp;UPDATE ATTENDANCE
                </a></li>
                <li><a href="ViewAttendance.php?dayorder=<?php echo $DayOrder;?>">
                    <span class="glyphicon glyphicon-list"></span>
                    &nbsp;VIEW-ATTENDANCE
                </a></li>
                <li><a href="EditTimeTable.php?dayorder=<?php echo $DayOrder;?>">
                    <span class="glyphicon glyphicon-tasks"></span>
                    &nbsp;UPDATE TT
                </a></li>
                <li class="active"><a href="AddNewStudent.php?dayorder=<?php echo $DayOrder;?>">
                    <span class="glyphicon glyphicon-plus"></span>
                    &nbsp;ADD-STUDENT
                </a></li>
                <li><a href="Predictions.php?dayorder=<?php echo $DayOrder;?>">
                    <span class="glyphicon glyphicon-tasks"></span>
                    &nbsp;PREDICTIONS
                </a></li>
                <li><a href="Logout.php">
                    <span class="glyphicon glyphicon-off"></span>
                    &nbsp;LOGOUT
                </a></li>
                </ul>
            </div>
        </div>
        <!--****************************    MAIN  ****   AREA   **********************-->
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
            <div style="position: fixed;right:0;top:0;color: #269abc;padding-right: 1%"><h3><?php echo date("l");?></h3></div>
            <div style="position: fixed;left:0;top:0;color: #269abc;padding-left: 1%;"><h3><?php echo date("d F Y");?></h3></div>
            <br>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <form action="AddNewStudent.php?dayorder=<?php echo $DayOrder;?>" method="POST">
                <fieldset><h2>
                    <?php 
                        if(isset($_POST['Submit']) && $_SESSION['ErrorMessage']!=null )
                        {echo Message();}
                        echo $General;
                        ?></h2>
                    <div class="form-group">
                        <label for="Name"><span class="FieldInfo">Name:</span></label>
                        <div class="input-group input-group-md">
                            <span class="input-group-addon">
                            <span class="glyphicon glyphicon-user text-primary"></span>
                            </span>
                            <input class="form-control" type="text" name="Name" id="Name" placeholder="Student Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="RollNumber"><span class="FieldInfo">Roll Number:</span></label>
                        <div class="input-group input-group-md">
                            <span class="input-group-addon">
                            <span class="glyphicon glyphicon-paste text-primary"></span>
                            </span>
                            <input class="form-control" type="text" name="RollNumber" id="RollNumber" placeholder="RollNumber">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="RegNumber"><span class="FieldInfo">Register Number:</span></label>
                        <div class="input-group input-group-md">
                            <span class="input-group-addon">
                            <span class="glyphicon glyphicon-copy text-primary"></span>
                            </span>
                            <input class="form-control" type="text" name="RegNumber" id="RegNumber" placeholder="Registration Number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Mentor"><span class="FieldInfo">Mentor:</span></label>
                        <div class="input-group input-group-md">
                            <span class="input-group-addon">
                            <span class="glyphicon glyphicon-copy text-primary"></span>
                            </span>
                            <input class="form-control" type="text" name="Mentor" id="Mentor" placeholder="Mentor Name">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="YearAndSec"><span class="FieldInfo">Year & Section:</span></label>
                        <div class="input-group input-group-md">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-education text-primary"></span>
                            </span>
                                <select class="form-control"id='YearAndSec' name="YearAndSec" >
                                <option>Year-Sec</option>
                                <?php 
                                if($_SESSION['user'] == "eee"){
                                $ar = array("II-A","II-B","II-C","III-A","III-B","III-C","IV-A","IV-B","IV-C");
                                $Section = 9;
                                }else{
                                $ar = array("II-A","II-B","II-C","II-D","III-A","III-B","III-C","III-D","IV-A","IV-B","IV-C","IV-D");
                                $Section = 12;    
                                }
                                for($i=0;$i<$Section;$i++){
                                    echo "<option>".$ar[$i]."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <center>
                        <input class="btn btn-success btn-lg" type="Submit" name="Submit" value="CONFIRM">
                    </center>
                </fieldset>
            </form></div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
        </div>
      </body>
</html>
<!-- DEVELOPED BY RAKESH KUMAR T -->