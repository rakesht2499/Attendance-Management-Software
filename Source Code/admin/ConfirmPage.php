<?php session_start();
require_once '../CheckLogin.php';
if($_SESSION['Login'] == "Success"){
    $DBname = $_SESSION['Database'];
    if($_SESSION['adcode'] != 'done'){
       $_SESSION['ErrorMessage'] = "Illegal Access";
        header("Location:../Login.php"); 
    }
   require '../Connection.php';
}else{
$_SESSION['ErrorMessage'] = "Access Denied. Please Login";
header("Location:../Login.php");
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
                    background-image: url("../Images/whitebackground.jpg");
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
            <img src="../Images/VEC-LOGO.jpg" class="img-responsive" width="80%">
            </center>
        </div>
        <!--***************************    SIDE   *****    AREA   ******************************************-->
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <div class="row" style="position: fixed;">
            <ul id="SideArea" class="nav nav-pills nav-stacked">
                <br>
                <li><a href="WelcomeAdmin.php">
                    <span class="glyphicon glyphicon-calendar"></span>
                    &nbsp;ADMIN
                </a></li>
                <li><a href="subadm.php">
                    <span class="glyphicon glyphicon-tasks"></span>
                    &nbsp;UPDATE SUBJECTS
                </a></li>
                <li><a href="ConfirmPage2.php">
                    <span class="glyphicon glyphicon-list"></span>
                    &nbsp;CHANGE SEMESTER
                </a></li>
                <li class="active"><a href="ConfirmPage.php">
                    <span class="glyphicon glyphicon-tasks"></span>
                    &nbsp;CHANGE YEAR
                </a></li>
                <li ><a href="ChangeMentor.php">
                    <span class="glyphicon glyphicon-plus"></span>
                    &nbsp;UPDATE INFORMATION
                </a></li>
                <li ><a href="AttendanceUpdate.php">
                    <span class="glyphicon glyphicon-tasks"></span>
                    &nbsp;UPDATE ABSENCE
                </a></li>
                <li><a href="PassedOut.php" >
                    <span style="color:white;"><span class="glyphicon glyphicon-plus"></span>
                    &nbsp;PREVIOUS AT</span>TENDANCE
                </a></li>
                <li><a href="LogoutAdmin.php" style="color: white;">
                    <span class="glyphicon glyphicon-off"></span>
                    &nbsp;LOGOUT
                </a></li>
                </ul>
            </div>
        </div>
        <!--****************************    MAIN  ****   AREA   **********************-->
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
            <br>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><br><br><br>
                <h2 class="alert alert-danger">ARE YOU SURE- <br>GOING TO BEGIN A NEW YEAR?</h2>
                <br><br><br>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <a href="ChangeYear.php"><input type="button" class="btn btn-success btn-lg" value="CONFIRM"></a>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <a href="WelcomeAdmin.php"><input type="button" class="btn btn-danger btn-lg" value="BACK"></a>
                </div>
                </div>
            </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
        </div>
      </body>
</html>
<?php
/*
            DEVELEPOR NOTES(R*)
                _______________
1) This page is for Conforming the request for Changing the YEAR i.e., Moving from SEM 2 to SEM- 3;
2) We redirect to ChangeYear.php;
*/
?>