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
    $Table = $_SESSION['tempo'];
    require '../subjects.php';
    $Dates = $_SESSION['Dates'];
        $QueryForTable = "SELECT * FROM $Table WHERE lastupdated='$Dates'";
        $NameForId = 1;
        $ExecuteForTable = mysqli_query($Connection, $QueryForTable);
        while($Data = mysqli_fetch_assoc($ExecuteForTable)){
                $Id = $Data['id'];
                $RegNo = $Data['regno'];
                        for($i=1;$i<=$CountForSubjects;$i++){
                        $Corep = "core".$i."p";
                        $Coret = "core".$i."t";
                        //if($_POST[$Corep."_".$Id] <= $_POST[$Coret."_".$Id]){
                           ${$Corep} = $_POST[$Corep."_".$Id];
                        //}else{
                        //${$Corep} = 0;
                        //}
                        ${$Coret} = $_POST[$Coret."_".$Id];
                        }
                    $QueryForUpdate = "UPDATE $Table SET ";
                    for($i=1;$i<=$CountForSubjects;$i++){
                        $Corep = "core".$i."p";
                        $Coret = "core".$i."t";
                        $QueryForUpdate.=$Corep."='";
                        $QueryForUpdate.=${$Corep};
                        $QueryForUpdate.="',";
                        $QueryForUpdate.=$Coret."='";
                        $QueryForUpdate.=${$Coret}."'";
                        if($i == $CountForSubjects)continue;
                        $QueryForUpdate.=",";
                    }
                    $QueryForUpdate.=" WHERE lastupdated=$Dates AND id=$Id";
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
                animation-duration: 0.3s;
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
                    transform: scale(1.06,1.06);
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
                    &nbsp;CHANGE SEMESTER
                </a></li>
                <li><a href="ConfirmPage.php">
                    <span class="glyphicon glyphicon-tasks"></span>
                    &nbsp;CHANGE YEAR
                </a></li>
                <li><a href="ChangeMentor.php">
                    <span class="glyphicon glyphicon-plus"></span>
                    &nbsp;UPDATE INFORMATION
                </a></li>
                <li class="active"><a href="AttendanceUpdate.php">
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
<div class="col-lg-9 col-md-9 col-sm-9 col-xs-3=9">
     <?php     if(isset($_POST['SubmitForYears']) && $_POST['Class'] == 'Year' || empty($_POST['Date']) || !preg_match("/^[0-9][0-9]\/[0-9][0-9]\/[0-9][0-9]$/", $_POST['Date'])){
         if(isset($_POST['Submit'])){}else{
         ?><div class='alert alert-danger col-lg-8 col-md-8 col-sm-8 col-xs-8' style='position:fixed;'><h3><center>Please Enter a Valid Year or Date</center></h3></div>
         <?php }}else{
        $Table = $_POST['Class'];
        $_SESSION['tempo'] = $Table;
        require '../subjects.php';
        $Date = $_POST['Date'];
        $String = explode("/", $Date);
        $Date = $String[2].$String[1].$String[0];
        $_SESSION['Dates'] = $Date;
        $QueryForTable = "SELECT * FROM $Table WHERE lastupdated='$Date'";
        $ExecuteForTable = mysqli_query($Connection, $QueryForTable);
         if(!mysqli_fetch_assoc($ExecuteForTable)){
            $TableHeaders ='<center><div class="alert alert-danger" style="font-size:0.7em;">';
            $TableHeaders.='<h3>No Data has been entered in the given DATE : ';
            $TableHeaders.= $_POST["Date"];
            $TableHeaders.='</h3></div></center>';
            echo $TableHeaders;
        }else{
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
        <form action="AttendanceUpdate.php" method="POST">
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
                        </div><br><br>
                        <center><label for='Date'><h2>Date :</h2></label></center>
                        <div class="input-group input-group-md ">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-education text-primary"></span>
                            </span>
                            <input class="form-control" id="Date" name="Date" placeholder="dd/mm/yy" style="background-color: rgba(255,255,255,0.5);">
                        </div>
                        <br><br>
                        <center><input class="btn btn-success btn-lg" type='submit' name='SubmitForYears' value="Submit"></center>
               </div>
            </div>
                </fieldset>
            </form>
</div>
         <?php
        if(isset($_POST['SubmitForYears']) && $_POST['Class'] != 'Year' && !empty($_POST['Date']) && preg_match("/^[0-9][0-9]\/[0-9][0-9]\/[0-9][0-9]$/", $_POST['Date'])){
        $NameForId = 1;
        $ExecuteForTable = mysqli_query($Connection, $QueryForTable);
        if(!mysqli_fetch_assoc($ExecuteForTable)){
        }else{
            $Table = $_POST['Class'];
            require '../subjects.php';
            $TableHeaders = '<form action="AttendanceUpdate.php" method="POST"><div class="table-ressponsive" style="margin:10% 4% 15% 0%;">';
            $TableHeaders.='<table class="table">';
            $TableHeaders.= '<tr><th>Roll Number</th><th>Name</th>';
                    for($i=0;$i<$CountForSubjects;$i++){
                        $TableHeaders.='<th>';
                        $TableHeaders.=$Name[$i]."-P";
                        $TableHeaders.='</th>';
                        $TableHeaders.='<th>';
                        $TableHeaders.=$Name[$i]."-T";
                        $TableHeaders.='</th>';
                    }
            $TableHeaders.= '</tr>';
                echo $TableHeaders;
                $ExecuteForTable = mysqli_query($Connection, $QueryForTable);
        while($Data = mysqli_fetch_assoc($ExecuteForTable)){
            $Id = $Data['id'];
                $RollNo = $Data['rollno'];
                $Name = $Data['name'];
                $RegNo = $Data['regno'];
                $Mentor = $Data['mentor'];
                for($i=1;$i<=$CountForSubjects;$i++){
                $Corep = "core".$i."p";
                $Coret = "core".$i."t";
                ${$Corep} = $Data[$Corep];
                ${$Coret} = $Data[$Coret];
                }
                        $TableData ='<tr><td>';
                        $TableData.=$RollNo;
                        $TableData.='</td><td>';
                        $TableData.=$Name;
                        $TableData.='</td>';
                        for($i=1;$i<=$CountForSubjects;$i++){
                        $Corep = "core".$i."p";
                        $Coret = "core".$i."t";
                        $TableData.='<td><input style="background-color:skyblue;width:29px;';
                        if(${$Coret} == 0)
                        $TableData.="display:none";
                        $TableData.='" name="';
                        $TableData.=$Corep."_".$Id;
                        $TableData.='" value="';
                        $TableData.=${$Corep};
                        $TableData.=' " ';
                        $TableData.='>';
                        $TableData.='</td>';
                        $TableData.='<td><input style="background-color:steelblue;color:white;width:29px;pointer-events:none;';
                         if(${$Coret} == 0)
                        $TableData.="display:none;";
                        $TableData.='" name="';
                        $TableData.=$Coret."_".$Id;
                        $TableData.='" value="';
                        $TableData.=${$Coret};
                        $TableData.='">';
                        $TableData.='</td>';
                        }
                        $TableData.="</tr>";
                        echo $TableData;
        }//For the given While Condition
        
                        echo '</table><center><input class="btn btn-lg btn-warning" type="submit" name="Submit" value="Submit"></center></div></form>';
        }
        
        }
        
         ?>
</div>
    </body>
</html>