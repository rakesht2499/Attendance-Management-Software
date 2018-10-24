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
                    transform: scale(1.1,1.1);
                }
            }
        </style>
        <title>WELCOME</title>
    </head>
    <body>
        <h1 style="z-index: 100; position: fixed;font-family: 'Bangers', cursive;color: red; " >&nbsp;&nbsp;ADMIN</h1>
        <div class="container col-lg-12 col-md-12 col-sm-12 col-xs-12" style="position: fixed;z-index: 10; ">
            <center>
                <img src="../Images/VEC-LOGO.jpg" class="img-responsive" width="80%">
            </center>
        </div>
        <div style="margin-top:10%; " class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
<!--**********************************************************************************************************************************
****************************************************    SIDE AREA     ****************************************************************
******************************************** ******************************************** ******************************************** -->
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <div class="row" style="position: fixed;" >
            <ul id="SideArea" class="nav nav-pills nav-stacked">
                <br>
                <li ><a href="WelcomeAdmin.php">
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
                    &nbsp;UPDATE INFORMATION&nbsp;
                </a></li>
                <li ><a href="AttendanceUpdate.php">
                    <span style="color:white;"><span class="glyphicon glyphicon-tasks"></span>
                    &nbsp;UPDATE</span> ABSENCE
                </a></li>
                <li class="active"><a href="PassedOut.php">
                    <span class="glyphicon glyphicon-plus"></span>
                    &nbsp;PREVIOUS ATTENDANCE
                </a></li>
                <li><a href="LogoutAdmin.php" style="color: white;">
                    <span class="glyphicon glyphicon-off"></span>
                    &nbsp;LOGOUT
                </a></li>
                </ul>
            </div>
        </div>
<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
   <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <form action="PassedOut.php" method="POST" >
                <fieldset>
                    <br><br>
                    <div class="form-group">
                        <center><label for='Sem'><h2>Semester:</h2></label></center>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
                        <div class="input-group input-group-md col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-education text-primary"></span>
                            </span>
                            <select class="form-control" onchange="validate()" id='Sem' name="Sem" style="background-color: rgba(255,255,255,0.5);">
                                    <option value="Semester">Semester</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
                        </div>
                    </div>
                    <script>
                        
function validate()
{
 var ddl = document.getElementById("Sem");
 var selectedValue = ddl.options[ddl.selectedIndex].value;
 if(selectedValue != "Semester"){
      document.getElementById("Secti").innerHTML='<div class="form-group"><center><label for="Sec"><h2>Section:</h2></label></center><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div><div class="input-group input-group-md col-lg-6 col-md-6 col-sm-6 col-xs-6"><span class="input-group-addon"><span class="glyphicon glyphicon-education text-primary"></span></span><select class="form-control" onchange="Calculate()" id="Sec" name="Sec" style="background-color: rgba(255,255,255,0.5);"><option value="Section">Section</option><option value="A">A</option><option value="B">B</option><option value="C">C</option><option value="D">D</option></select></div><div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div></div></div>';
  }else{
      document.getElementById("Secti").innerHTML='';
  }
}
function Calculate(){
 var ddl = document.getElementById("Sec");
 var selectedValue = ddl.options[ddl.selectedIndex].value;
 if(selectedValue != "Section"){
  document.getElementById("Secti2").innerHTML='<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6"><center><label for="From"><h4>From :</h4></label></center><div class="input-group input-group-md"><span class="input-group-addon"><span class="text-primary">From:</span></span><input class="form-control" id="From" name="From" placeholder="YYYY" style="background-color: rgba(255,255,255,0.5);"></div></div><div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6"><center><label for="To"><h4>To :</h4></label></center><div class="input-group input-group-md"><span class="input-group-addon"><span class="text-primary">To:</span></span><input class="form-control" id="To" name="To" placeholder="YYYY" style="background-color: rgba(255,255,255,0.5);"></div></div><center><input class="btn btn-info btn-md" type="Submit" name="Submit" value="Submit"></center>';
 }else{
 document.getElementById("Secti2").innerHTML='';
 }
}
                        </script>
                        <div id='Secti'></div>
                        <div id='Secti2'></div>
                </fieldset>
            </form>
                <br><br>
            </div>
   <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="z-index: 1000;">
   <?php
   if(isset($_POST['Submit'])){
           if($_POST['Sem']=="Semester"){
               echo '<div class="alert alert-danger" style="font-size:0.7em;">
                   <center><h4>Enter The Year</h4></center>
                    </div>';
               }elseif(isset($_POST['Submit']) && $_POST['Sec'] == "Section"){
                   echo '<div class="alert alert-danger" style="font-size:0.7em;">
                   <center><h4>Enter The Section</h4></center>
                    </div>';
               }elseif(isset($_POST['Submit']) && empty($_POST['From']) && empty($_POST['To'])){
               echo '<div class="alert alert-danger" style="font-size:0.7em;">
                   <center><h4>Enter Both Year\'s Please</h4></center>
                    </div>';
               }elseif(!preg_match("/^[2-9][0-9]{3}$/", $_POST['From']) || !preg_match("/^[2-9][0-9]{3}$/", $_POST['To'])){
               echo '<div class="alert alert-danger" style="font-size:0.7em;">
                   <center><h4>Please Enter Both Year\'s In Correct Format</h4></center>
                    </div>';
               }else{
                   $Sem = $_POST['Sem'];
                   $From = $_POST['From'];
                   $To = $_POST['To'];
                   $Sec = $_POST['Sec'];
                   $Table='';
                   if($Sem == 3 || $Sem == 4){
                       $Table = "II-";
                   }
                   if($Sem == 5 || $Sem == 6){
                       $Table = "III-";
                   }
                   if($Sem == 7 || $Sem == 8){
                       $Table = "IV-";
                   }
                   $Table.=$Sec;
                   $FullName = $Table.$From."-".$To."Sem".$Sem;
                   if(file_exists(substr($DBname,-12,-9)."/".$FullName)){
                   echo '<div class="alert alert-success" style="font-size:0.7em;">
                   <center><h4>Data For Class: '.$Table.'   Batch:'.$From."-".$To.'   Semester-'.$Sem.'   is Successfully Fetched</h4></center>
                    </div>';
                   require '../subjects.php';
            $DisplayContent=file(substr($DBname,-12,-9)."/".$FullName);
            
            $TableHeaders = '<div class="table-ressponsive" style="margin:0% 5% 5% 5%;">';
            $TableHeaders.='<br>';
            $TableHeaders.='</div><table class="table">';
            if(!empty($DisplayContent[1])){
            $TableHeaders.= '<tr><th>Roll Number</th><th>Name</th><th>Register Number </th>';
                for($i=1;$i<=$CountForSubjects;$i++){
                    $Names = "Name".$i;
                    $TableHeaders.= '<th>';
                    $TableHeaders.= ${$Names};
                    $TableHeaders.= '</th>';
                }
                $TableHeaders.= '<th>Overall</th></tr>';
                echo $TableHeaders;
                $C=TRUE;
                
foreach ($DisplayContent as $Line){
if(!$C){
    $Lines = explode("_", $Line);
    echo '<tr>';
    for($i=0;$i<$CountForSubjects+4;$i++)
      echo "<td>".$Lines[$i]."</td>";
    echo '</tr>';
}
$C=FALSE;
}
                }else{
                    echo '<div class="alert alert-danger" style="font-size:0.7em;">
                   <center><h4>No Data Was Entered Before Saving The File</h4></center>
                    </div>'; 
                }
echo '</table></div>';
               }else{
                   echo '<div class="alert alert-danger" style="font-size:0.7em;">
                   <center><h4>File Does Not Exist</h4></center>
                    </div>';
               }
               }
   }
               ?>
   </div>
    </div>
    </body>
</html>