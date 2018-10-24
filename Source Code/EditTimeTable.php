<?php require_once 'CheckLogin.php';
session_start();
if($_SESSION['Login'] == "Success"){
    $DBname = $_SESSION['Database'];
    if($_SESSION['adcode'] == 'done'){
       header("Location:admin/WelcomeAdmin.php");
      }
   $SendDayOrder = $_GET['dayorder'];
   if($_SESSION['dayorders'] == $SendDayOrder){} else {
    header("Location:WelcomePage.php");
}
   require 'Connection.php';
}else{
$_SESSION['ErrorMessage'] = "Access Denied. Please Login";
header("Location:Login.php");
}
if(isset($_POST['Submit'])){
    $DayOrder = $_POST['DayOrder'];
    $YearAndSec = $_POST['YearAndSec'];
    if($DayOrder=="Day"){
    $_SESSION['ErrorMessage']='Please select a valid DayOrder';
    }
    else if($YearAndSec=="Year-Sec"){
    $_SESSION['ErrorMessage']='Please select a valid Year-Sec';
    }
    else if($YearAndSec=="Year-Sec" && $DayOrder=="Day"){
     $_SESSION['ErrorMessage']='Please select a valid Day Order & Year-Sec';   
    }else{
        $YearAndSec= str_replace("-", "", $YearAndSec);
           $YearAndSec = strtolower($YearAndSec);
           $YearAndSec = $YearAndSec."tt";
           if($DayOrder=='TempTT'){
               $DayOrder = 7;
           }
    header("Location:TimeTableEdit.php?dayorder=$SendDayOrder&updatedayorder=$DayOrder&year=$YearAndSec");
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
            .panel-title{
                text-align: center;
                font-style: oblique;
            }
            .panel-body{
                background-image: url("Images/LoginBackground.jpg");
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
        <!--********************************* SIDE  ******   AREA *************************************-->
        <div class="col-lg-3 col-mg-3 col-sm-3 col-xs-3">
            <div class="row" style="position: fixed;" >
            <ul id="SideArea" class="nav nav-pills nav-stacked">
                <br>
                <li ><a href="WelcomePage.php">
                    <span class="glyphicon glyphicon-calendar"></span>
                    &nbsp;TIME-TABLE
                </a></li>
                <li><a href="Update.php?dayorder=<?php echo $SendDayOrder;?>">
                    <span class="glyphicon glyphicon-tasks"></span>
                    &nbsp;UPDATE ATTENDANCE
                </a></li>
                <li><a href="ViewAttendance.php?dayorder=<?php echo $SendDayOrder;?>">
                    <span class="glyphicon glyphicon-list"></span>
                    &nbsp;VIEW-ATTENDANCE
                </a></li>
                <li class="active"><a href="EditTimeTable.php?dayorder=<?php echo $SendDayOrder;?>">
                    <span class="glyphicon glyphicon-tasks"></span>
                    &nbsp;UPDATE TT
                </a></li>
                <li><a href="AddNewStudent.php?dayorder=<?php echo $SendDayOrder;?>">
                    <span class="glyphicon glyphicon-plus"></span>
                    &nbsp;ADD-STUDENT
                </a></li>
                <li><a href="Predictions.php?dayorder=<?php echo $SendDayOrder;?>">
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
        <!--********************************* MAIN  ******   AREA *************************************-->
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
            <div style="position: fixed;right:0;top:0;color: #269abc;padding-right: 1%"><h3><?php echo date("l");?></h3></div>
            <div style="position: fixed;left:0;top:0;color: #269abc;padding-left: 1%;"><h3><?php echo date("d F Y");?></h3></div>
            <br><br>
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
            <div class="col-lg-5 col-offset-lg-4 col-md-5 col-offset-md-4 col-sm-5 col-offset-sm-4 col-xs-5 col-offset-xs-4">
                <form action="EditTimeTable.php?dayorder=<?php echo $SendDayOrder;?>" method="POST" style="margin:0 5% 0 5%">
                <fieldset>
                    <h3>
                        <?php 
                        if(isset($_POST['Submit']) && ($DayOrder=='Day'|| $YearAndSec == 'Year-Sec'))
                        {echo Message();}
                        ?>
                            </h3>
                    <div class="form-group">
                        <center><label for='YearAndSec'><h2>Year And Section:</h2></label></center>
                        <div class="input-group input-group-md">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-education text-primary"></span>
                            </span>
                            <!--<input class="form-control" type="text" id='DayOrder' name="DayOrder" placeholder="DayOrder">-->
                            <select class="form-control"id='YearAndSec' name="YearAndSec" style="background-color: rgba(255,255,255,0.5);">
                                <option >Year-Sec</option>
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
                    <div class="form-group">
                        <center><label for='DayOrder'><h2>Day Order:</h2></label></center>
                        <div class="input-group input-group-md">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time text-primary"></span>
                            </span>
                            <!--<input class="form-control" type="text" id='DayOrder' name="DayOrder" placeholder="DayOrder">-->
                            <select class="form-control"id='DayOrder' name="DayOrder" style="background-color: rgba(255,255,255,0.5);">
                                <option >Day</option>
                                <option >MON</option>
                                <option >TUE</option>
                                <option >WED</option>
                                <option >THU</option>
                                <option >FRI</option>
                                <option >TempTT</option>
                            </select>
                        </div>
                    </div>
                    
                    <center>
                        <input class="btn btn-info btn-md" type="Submit" name="Submit" value="Submit">
                    </center> 
                </fieldset>
            </form>
                <br>
               </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
             </div>
        </div>
    </body>
</html>
<!-- DEVELOPED BY RAKESH KUMAR T -->