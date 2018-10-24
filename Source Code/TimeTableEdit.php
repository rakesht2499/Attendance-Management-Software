<?php require_once 'CheckLogin.php';
session_start();
if($_SESSION['Login'] == "Success"){
    $DBname = $_SESSION['Database'];
    if($_SESSION['adcode'] == 'done'){
       header("Location:admin/WelcomeAdmin.php");   
      }
   $SendDayOrder = $_GET['dayorder'];
   if($_SESSION['dayorders'] == $SendDayOrder){} else {
    header("Location:Logout.php");
}
   $Class = $_GET['year'];
   $UpdateDayOrder = $_GET['updatedayorder'];
                    if($UpdateDayOrder == 'MON')
                        $UpdateDayOrder = 1;
                    if($UpdateDayOrder == 'TUE')
                        $UpdateDayOrder = 2;
                    if($UpdateDayOrder == 'WED')
                        $UpdateDayOrder = 3;
                    if($UpdateDayOrder == 'THU')
                        $UpdateDayOrder = 4;
                    if($UpdateDayOrder == 'FRI')
                        $UpdateDayOrder = 5;
                    require 'Connection.php';
}else{
$_SESSION['ErrorMessage'] = "Access Denied. Please Login";
header("Location:Login.php");
}
if(isset($_POST['Submit'])){
    $First = $_POST['1stHr'];
    $Second = $_POST['2ndHr'];
    $Third =$_POST['3rdHr'];
    $Fourth = $_POST['4thHr'];
    $Fifth = $_POST['5thHr'];
    $Sixth = $_POST['6thHr'];
    $Seventh = $_POST['7thHr'];
    $Eighthth = $_POST['8thHr'];
    if($First=='' || $Second == '' || $Third == '' || $Fourth == '' || $Fifth == '' || $Sixth == '' || $Seventh == '' || $Eighthth == ''){
    $_SESSION['ErrorMessage']='All Fields are compulsory';
    }else{
        if($_SESSION['Installed'] != NULL){
            $arr = array("iiatt"=>"II-A","iibtt"=>"II-B","iictt"=>"II-C","iidtt"=>"II-D",
                "iiiatt"=>"III-A","iiibtt"=>"III-B","iiictt"=>"III-C","iiidtt"=>"III-D",
                "ivatt"=>"IV-A","ivbtt"=>"IV-B","ivctt"=>"IV-C","ivdtt"=>"IV-D");

            for($i=1;$i<=7;$i++){
                foreach ($arr as $key => $value) {
                   if($_SESSION['Classhere'] == $key) 
                $Query = "INSERT INTO $Class(dayorder,class,one,two,three,four,five,six,seven,eight) VALUES ('$i','$value','','','','','','','','')" ;
                }
/*                if($_SESSION['Classhere'] == "iiatt")
            $Query = "INSERT INTO $Class(dayorder,class,one,two,three,four,five,six,seven,eight) VALUES ('$i','II-A','','','','','','','','')" ;
                if($_SESSION['Classhere'] == "iiiatt")
            $Query = "INSERT INTO $Class(dayorder,class,one,two,three,four,five,six,seven,eight) VALUES ('$i','III-A','','','','','','','','')" ;
                if($_SESSION['Classhere'] == "ivatt" )
            $Query = "INSERT INTO $Class(dayorder,class,one,two,three,four,five,six,seven,eight) VALUES ('$i','IV-A','','','','','','','','')" ;
                if($_SESSION['Classhere'] == "iibtt")
            $Query = "INSERT INTO $Class(dayorder,class,one,two,three,four,five,six,seven,eight) VALUES ('$i','II-B','','','','','','','','')" ;
                if($_SESSION['Classhere'] == "iiibtt")
            $Query = "INSERT INTO $Class(dayorder,class,one,two,three,four,five,six,seven,eight) VALUES ('$i','III-B','','','','','','','','')" ;
                if($_SESSION['Classhere'] == "ivbtt")
            $Query = "INSERT INTO $Class(dayorder,class,one,two,three,four,five,six,seven,eight) VALUES ('$i','IV-B','','','','','','','','')" ;
                if($_SESSION['Classhere'] == "iictt")
           $Query = "INSERT INTO $Class(dayorder,class,one,two,three,four,five,six,seven,eight) VALUES ('$i','II-C','','','','','','','','')" ;
                if($_SESSION['Classhere'] == "iiictt")
           $Query = "INSERT INTO $Class(dayorder,class,one,two,three,four,five,six,seven,eight) VALUES ('$i','III-C','','','','','','','','')" ;
                if($_SESSION['Classhere'] == "ivctt" )
           $Query = "INSERT INTO $Class(dayorder,class,one,two,three,four,five,six,seven,eight) VALUES ('$i','IV-C,'','','','','','','','')" ;
                if($_SESSION['Classhere'] == "iidtt")
           $Query = "INSERT INTO $Class(dayorder,class,one,two,three,four,five,six,seven,eight) VALUES ('$i','II-D','','','','','','','','')" ;
                if($_SESSION['Classhere'] == "iiidtt")
           $Query = "INSERT INTO $Class(dayorder,class,one,two,three,four,five,six,seven,eight) VALUES ('$i','III-D','','','','','','','','')" ;
                if($_SESSION['Classhere'] == "ivdtt")
           $Query = "INSERT INTO $Class(dayorder,class,one,two,three,four,five,six,seven,eight) VALUES ('$i','IV-D','','','','','','','','')" ;
*/
            $Execute = mysqli_query($Connection, $Query);
            }
        }
        $QueryForUpdate = "UPDATE $Class SET one='$First',two='$Second',three='$Third',four='$Fourth',five='$Fifth',six='$Sixth',seven='$Seventh',eight='$Eighthth' WHERE dayorder=$UpdateDayOrder";
        $ExecuteForUpdate = mysqli_query($Connection, $QueryForUpdate);
        header("Location:EditTimeTable.php?dayorder=$SendDayOrder");
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
                <li><a href="EditTimeTable.php?dayorder=<?php echo $SendDayOrder;?>">
                    <span class="glyphicon glyphicon-tasks"></span>
                    &nbsp;UPDATE TT
                </a></li>
                <li><a href="AddNewStudent.php?dayorder=<?php echo $SendDayOrder;?>">
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
        
        <!--********************************* MAIN  ******   AREA *************************************-->
        
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
            <div style="position: fixed;right:0;top:0;color: #269abc;padding-right: 1%"><h3><?php echo date("l");?></h3></div>
            <div style="position: fixed;left:0;top:0;color: #269abc;padding-left: 1%;"><h3><?php echo date("d F Y");?></h3></div>
            <br><br>
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php 
                 $QueryFor = "SELECT * FROM $Class WHERE dayorder=$UpdateDayOrder";
        $ExecuteFor = mysqli_query($Connection, $QueryFor);
        if(!mysqli_fetch_array($ExecuteFor)){
            $One = NULL;
            $Two = null;
            $Three = null;
            $Four  = null;
            $Fifth = null;
            $Sixth = null;
            $Seventh = null;
            $Eighthth = null;
            $_SESSION['Installed'] = 'Yes';
            $_SESSION['Classhere'] = $Class;
        }
        $ExecuteFor = mysqli_query($Connection, $QueryFor);
        while($Data = mysqli_fetch_array($ExecuteFor)){
            $One = $Data['one'];
            $Two = $Data['two'];
            $Three = $Data['three'];
            $Four  = $Data['four'];
            $Fifth = $Data['five'];
            $Sixth = $Data['six'];
            $Seventh = $Data['seven'];
            $Eighthth = $Data['eight'];
        }
        
        ?>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
            <div class="col-lg-5 col-offset-lg-4 col-md-5 col-offset-md-4 col-sm-5 col-offset-sm-4 col-xs-5 col-offset-xs-4">
                        <?php 
                        if(isset($_POST['Submit']))
                        {echo Message();}
                        ?>
  <!--********************************************************FOR EDITING THE TIME TABLE  *****************************************-->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!--div id="txtt" class="alert alert-info" onmouseout="Display()" onmouseover="Mention()">
                    <center><input type="button" class="btn btn-warning" value="Format"></center>
                </div-->
                    <form action="TimeTableEdit.php?dayorder=<?php echo $SendDayOrder;?>&updatedayorder=<?php echo $UpdateDayOrder;?>&year=<?php echo $Class;?>" method="POST" style="margin:0 5% 0 5%">
                <fieldset>
<div class="form-group"><center><label for='1stHr'><h2>1st Hour:</h2></label></center><div class="input-group input-group-md"><span class="input-group-addon"><span class="glyphicon glyphicon-time text-primary"></span></span><input class="form-control" type="text" id='1stHr' name="1stHr" value="<?php echo $One;?>"></div></div>
<div class="form-group"><center><label for='2ndHr'><h2>2nd Hour:</h2></label></center><div class="input-group input-group-md"><span class="input-group-addon"><span class="glyphicon glyphicon-time text-primary"></span></span><input class="form-control" type="text" id='2ndHr' name="2ndHr" value="<?php echo $Two;?>"></div></div>
<div class="form-group"><center><label for='3rdHr'><h2>3rd Hour:</h2></label></center><div class="input-group input-group-md"><span class="input-group-addon"><span class="glyphicon glyphicon-time text-primary"></span></span><input class="form-control" type="text" id='3rdHr' name="3rdHr" value="<?php echo $Three;?>"></div></div>
<div class="form-group"><center><label for='4thHr'><h2>4th Hour:</h2></label></center><div class="input-group input-group-md"><span class="input-group-addon"><span class="glyphicon glyphicon-time text-primary"></span></span><input class="form-control" type="text" id='4thHr' name="4thHr" value="<?php echo $Four;?>"></div></div>
<div class="form-group"><center><label for='5thHr'><h2>5th Hour:</h2></label></center><div class="input-group input-group-md"><span class="input-group-addon"><span class="glyphicon glyphicon-time text-primary"></span></span><input class="form-control" type="text" id='5thHr' name="5thHr" value="<?php echo $Fifth;?>"></div></div>
<div class="form-group"><center><label for='6thHr'><h2>6th Hour:</h2></label></center><div class="input-group input-group-md"><span class="input-group-addon"><span class="glyphicon glyphicon-time text-primary"></span></span><input class="form-control" type="text" id='6thHr' name="6thHr" value="<?php echo $Sixth;?>"></div></div>
<div class="form-group"><center><label for='7thHr'><h2>7th Hour:</h2></label></center><div class="input-group input-group-md"><span class="input-group-addon"><span class="glyphicon glyphicon-time text-primary"></span></span><input class="form-control" type="text" id='7thHr' name="7thHr" value="<?php echo $Seventh;?>"></div></div>
<div class="form-group"><center><label for='8thHr'><h2>8th Hour:</h2></label></center><div class="input-group input-group-md"><span class="input-group-addon"><span class="glyphicon glyphicon-time text-primary"></span></span><input class="form-control" type="text" id='8thHr' name="8thHr" value="<?php echo $Eighthth;?>"></div></div>
                    <center>
                        <input class="btn btn-info btn-lg" type="Submit" name="Submit" value="Submit">
                    </center> 
                    <br><br><br>
                </fieldset>
            </form>
        </div>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
                </div>
             </div><br><br><br>
        </div>
    </body>
</html>
<!-- DEVELOPED BY RAKESH KUMAR T -->