<?php
session_start();
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
        <link href="https://fonts.googleapis.com/css?family=Bangers" rel="stylesheet">
        <style>
            body{
                background-image: url("../Images/whitebackground.jpg");
                background-attachment: fixed;
                background-size: cover;
                font-family: 'Slabo 27px', serif;
            }
            .panel-title{
                text-align: center;
                font-style: oblique;
            }
            .panel-body{
                background-image: url("../Images/whitebackground.jpg");
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
                    transform: scale(1.35,1.35);
                }
            }
        </style>
        <title>WELCOME ADMIN</title>
    </head>
    <body>
        <h1 style="z-index: 100; position: fixed;font-family: 'Bangers', cursive;color: red; " >&nbsp;&nbsp;ADMIN</h1>
        <div style="z-index: 100;right:0;margin:2%;position:fixed;color: blue;"><a href="register.php"><span class='glyphicon glyphicon-user' style="font-size:20px"></span></a></div>
        <div class="container col-lg-12 col-md-12 col-sm-12 col-xs-12" style="top:0;z-index: 10; ">
            <center>
                <img src="../Images/VEC-LOGO.jpg" class="img-responsive" width="80%">
            </center>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
<!--**********************************************************************************************************************************
****************************************************    SIDE AREA     ****************************************************************
******************************************** ******************************************** ******************************************** -->
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <div class="row" style="position: fixed;" >
            <ul id="SideArea" class="nav nav-pills nav-stacked">
                <br>
                <li class="active"><a href="WelcomeAdmin.php">
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
                <li><a href="ConfirmPage.php">
                    <span class="glyphicon glyphicon-tasks"></span>
                    &nbsp;CHANGE YEAR
                </a></li>
                <li ><a href="ChangeMentor.php">
                    <span class="glyphicon glyphicon-plus"></span>
                    &nbsp;UPDATE INFORMATION
                </a></li>
                <li ><a href="AttendanceUpdate.php">
                    <span style="color:white;"><span class="glyphicon glyphicon-tasks"></span>
                    &nbsp;UPDATE</span> ABSENCE
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
<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
    <br><br>
    <center><div class="alert alert-success"><h3>WELCOME TO ADMIN SECTION</h3></div></center>
    
</div>
    </body>
</html>

