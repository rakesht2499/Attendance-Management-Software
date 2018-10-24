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
if(isset($_POST['Submit'])){
    $Table = $_SESSION['temper'];
        $QueryForTable = "SELECT * FROM $Table";
        $NameForId = 1;
        $ExecuteForTable = mysqli_query($Connection, $QueryForTable);
        while($Data = mysqli_fetch_assoc($ExecuteForTable)){
                $Id = $Data['id'];
                $RegNo = $Data['regno'];
                if($RegNo == 0) continue;
                $Temp1 = "RollNo".$Id;
                $Temp2 = "Name".$Id;
                $Temp3 = "Mentor".$Id;
                $Temp4 = "RegNo".$Id;
                $RollNo[$Id] = $_POST[$Temp1];
                $Name[$Id] = $_POST[$Temp2];
                $Mentor[$Id] = $_POST[$Temp3];
                $RegNos[$Id] = $_POST[$Temp4];
                
                }
                $ExecuteForTable = mysqli_query($Connection, $QueryForTable);
                while($Data = mysqli_fetch_assoc($ExecuteForTable)){
                $Id = $Data['id'];
                $RegNo = $Data['regno'];
                if($RegNo == 0) continue;
                    $QueryForUpdate = "UPDATE $Table SET rollno='$RollNo[$Id]',name='$Name[$Id]',mentor='$Mentor[$Id]',regno='$RegNos[$Id]' WHERE id=$Id";
                    $Execute = mysqli_query($Connection, $QueryForUpdate);
                    
                }
}
?>
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
        <div class="col-lg-3 col-mg-3 col-sm-3 col-xs-3">
            <div class="row" style="position: fixed;" >
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
                    &nbsp;CHAGNE SEMESTER
                </a></li>
                <li><a href="ConfirmPage.php">
                    <span class="glyphicon glyphicon-tasks"></span>
                    &nbsp;CHANGE YEAR
                </a></li>
                <li class="active"><a href="ChangeMentor.php">
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
     <?php     if(isset($_POST['SubmitForYear']) && $_POST['Class'] == 'Year'){
         ?><div class='alert alert-danger col-lg-8 col-md-8 col-sm-8 col-xs-8' style='position:fixed;'><h3><center>Please Enter a Valid Year</center></h3></div>
         <?php }else{
             if(isset($_POST['SubmitForYear'])){
             $TableHeaders ='<center><div class="alert alert-success" style="font-size:0.7em;">';
            $TableHeaders.='<h3>Data\'s Sucessfully Fetched for ';
            $TableHeaders.= $_POST["Class"];
            $TableHeaders.='</h3></div></center>';
            echo $TableHeaders;
             }
         }
?> 
         <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div><div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
        <br><br>
        <form action="ChangeMentor.php" method="POST">
                <fieldset>
                    <br><br>
            <div class="form-group">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <center><label for='Class'><h2>Year & Sec:</h2></label></center>
                        <div class="input-group input-group-md ">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-education text-primary"></span>
                            </span>
                                <select class="form-control" id='Class' name="Class" style="background-color: rgba(255,255,255,0.5);">
                            <option>Year</option>
                                <?php
                                
                                if(substr($DBname,-12,-9) == "eee"){
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
                        </div><br>
                        <br><br>
                        <center><input class="btn btn-success btn-lg" type='submit' name='SubmitForYear' value="Submit"></center>
               </div>
            </div>
                </fieldset>
            </form>
</div>
         <?php
         if(isset($_POST['SubmitForYear']) && $_POST['Class'] != 'Year'){
         $Table = $_POST['Class'];
         require '../subjects.php';
         $_SESSION['temper'] = $Table;
            $TableHeaders = '<form action="ChangeMentor.php" method="POST"><div class="table-ressponsive" style="margin:10% 5% 15% 5%;">';
            $TableHeaders.='<table class="table">';
            $TableHeaders.= '<tr><th>Roll Number</th><th>Name</th><th>Mentor Name</th><th>Register Number </th>';
            $TableHeaders.= '</tr>';
                echo $TableHeaders;
        $QueryForTable = "SELECT * FROM $Table";
        echo '<input name="yearsec" value="'.$Table.'" style="display:none;">';
        $NameForId = 1;
        $ExecuteForTable = mysqli_query($Connection, $QueryForTable);
        while($Data = mysqli_fetch_assoc($ExecuteForTable)){
            $Id = $Data['id'];
                $RollNo = $Data['rollno'];
                $Name = $Data['name'];
                $RegNo = $Data['regno'];
                $Mentor = $Data['mentor'];
                if($RegNo == 0) continue;
                        $TableData ='<tr><td><input style = "color:Black;width:20ex;"  value="';
                        $TableData.=$RollNo;
                        $TableData.='" name = "';
                        $TableData.="RollNo".$Id;
                        $TableData.='"></td><td><input style = "color:Black;" value="';
                        $TableData.=$Name;
                        $TableData.='" name = "';
                        $TableData.="Name".$Id;
                        $TableData.='"></td><td><input style = "color:Black;" value="';
                        $TableData.=$Mentor;
                        $TableData.='" name = "';
                        $TableData.="Mentor".$Id;
                        $TableData.='"></td><td><input style = "color:Black;" value="';
                        $TableData.=$RegNo;
                        $TableData.='" name = "';
                        $TableData.="RegNo".$Id;
                        $TableData.='"></td>';
                        $TableData.="</tr>";
                        echo $TableData;
        }//For the given While Condition
                        echo '</table><center><input class="btn btn-lg btn-warning" type="submit" name="Submit" value="Submit"></center></div></form>';
         }
         ?>
</div>
    </body>
</html>