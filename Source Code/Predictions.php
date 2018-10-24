<?php
session_start();
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
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/2/29/Valliammai_Logo.png">
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
            tr:nth-child(even){
                background-color: rgb(173,216,230);
              
            }
            tr:hover{
                animation-name: zoomtt;
                animation-duration: 0.4s;
                animation-fill-mode: forwards;
            }
            @keyframes zoomtt{
                100%{
                    background-color: rgba(70,130,180,1);
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
        <!--SIDE AREA-->
        <div class="col-lg-3 col-mg-3 col-sm-3 col-xs-3">
           <div class="row" style="position: fixed;">
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
                <li><a href="AddNewStudent.php?dayorder=<?php echo $DayOrder;?>">
                    <span class="glyphicon glyphicon-plus"></span>
                    &nbsp;ADD-STUDENT
                </a></li>
                <li class="active"><a href="Predictions.php?dayorder=<?php echo $DayOrder;?>">
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
        <!--********************************************MAIN AREA ************************************************ -->
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
            <div style="position: fixed;right:0;top:0;color: #269abc;padding-right: 1%"><h3><?php echo date("l");?></h3></div>
            <div style="position: fixed;left:0;top:0;color: #269abc;padding-left: 1%;"><h3><?php echo date("d F Y");?></h3></div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                <form action="Predictions.php?dayorder=<?php echo $DayOrder;?>" method="POST" >
                <fieldset>
                    <br><br>
                    <div class="form-group">
                        <center><label for='Class'><h2>Year & Sec:</h2></label></center>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
                        <div class="input-group input-group-md col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-education text-primary"></span>
                            </span>
                                <select class="form-control"id='Class' name="Class" style="background-color: rgba(255,255,255,0.5);">
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
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
                        </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <center><label for='NumberOfDays'><h2>Number Of Days:</h2></label></center>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
                        <div class="input-group input-group-md col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-education text-primary"></span>
                            </span>
                            <input class="form-control" id='NumberOfDays' name="NumberOfDays" placeholder="Number Of Days" style="background-color: rgba(255,255,255,0.5);">
                        </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><br><br>
                        <center><input class="btn btn-danger btn-lg" type='submit' name='Predict' value="Predict!"></center></div>
                </fieldset>
                </form>
                </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php
            if(isset($_POST['Predict'])){
               if($_POST['Class']=="Year-Sec"){
               echo '<br><br><br><div class="alert alert-danger" style="font-size:0.7em;">
                   <center><h4>Enter a Valid Year & Section</h4></center>
                    </div>';
               }else{
            $Table = $_POST['Class'];
            $General = $Table;
            require 'subjects.php';
            $QueryCheck = "SELECT * FROM $Table";
            $ExecuteCheck = mysqli_query($Connection, $QueryCheck);
            if(mysqli_fetch_assoc($ExecuteCheck)){
                if($_POST['NumberOfDays'] > 0 || empty($_POST['NumberOfDays'])){
            $TableHeaders = '<div class="table-ressponsive" style="margin:10% 5% 15% 5%;">';
            
            $TableHeaders.='<br><div class="alert alert-success" style="font-size:0.7em;"><center>';           
            $TableHeaders.='<h4>Data\'s Sucessfully Fetched for ';
            $TableHeaders.= $_POST["Class"];
            $TableHeaders.='</h4></center>';
            
            $TableHeaders.='</div><table class="table">';
            $TableHeaders.= '<tr><th>Roll Number</th><th>Name</th><th>Mentor</th><th>Register Number </th>';
                for($i=1;$i<=$CountForSubjects;$i++){
                    $Names = "Name".$i;
                    $TableHeaders.= '<th>';
                    $TableHeaders.= ${$Names};
                    $TableHeaders.= '</th>';
                }
                $TableHeaders.= '<th>Overall</th></tr>';
                echo $TableHeaders;
                }
                
                $General;
                if($General == "II-A"){
                  $temp = "iiatt";  
                }if($General == "II-B"){
                  $temp = "iibtt";  
                }if($General == "II-C"){
                  $temp = "iictt";  
                }if($General== "III-A"){
                  $temp = "iiiatt";  
                }if($General == "III-B"){
                  $temp = "iiibtt";  
                }if($General == "III-C"){
                  $temp = "iiictt";  
                }if($General == "IV-A"){
                  $temp = "ivatt";  
                }if($General == "IV-B"){
                  $temp = "ivbtt";
                }if($General == "IV-C"){
                  $temp = "ivctt";  
                }
                if($_SESSION['user'] != "eee"){
                    if($General == "II-D"){
                  $temp = "iidtt";  
                }if($General == "III-D"){
                  $temp = "iiidtt";
                }if($General == "IV-D"){
                  $temp = "ivdtt";  
                }
                }
                if(isset($_POST['NumberOfDays']))
                    $Days = $_POST['NumberOfDays'];
                else
                    $Days = 0;
            for($t=1;$t<=$CountForSubjects;$t++){
                $SubCount = "Sub".$t;
                $SubCountForPresent = "SubPres".$t;
                ${$SubCountForPresent} = 0;
                ${$SubCount} = 0;
            }
            $day = date("w");
            $da=$day+1;
            for($t=0;$t<$Days;$t++){
                if($da == 6 || $da==7 || $da==8)$da = 1;
                $QueryFor = "SELECT * FROM $temp WHERE dayorder = $da";
                $Executing = mysqli_query($Connection, $QueryFor);
                while($dats = mysqli_fetch_array($Executing)){
            for($index = 2;$index<=9;$index++){
                for($x=1;$x<=$CountForSubjects;$x++){
                $Sub = "Name".$x;
                $SubCount = "Sub".$x;
                    if($dats[$index] == ${$Sub}){
                        ${$SubCount}++;
                    }
                }
            }
             
        }
                $da++;
                }
                for($x=1;$x<=$CountForSubjects;$x++){
                $SubCount = "Sub".$x;
                $SubCountForPresent = "SubPres".$x;
                ${$SubCountForPresent} = ${$SubCount}*0.75;  
                }
              $QueryForTable = "SELECT * FROM $Table";
        $ExecuteForTable = mysqli_query($Connection, $QueryForTable);
        $PrevRollNo=0;
        while($Data = mysqli_fetch_array($ExecuteForTable)){
                $RollNo = $Data['rollno'];
                $Name = $Data['name'];
                $RegNo = $Data['regno'];
                $Mentor = $Data['mentor'];
                if($RegNo == 0)continue;
///////////////////////////////////////////////////////ASSIGNING CORE1P & CORE1T AS 0//////////////////////////////////////////
                for($i=1;$i<=$CountForSubjects;$i++){
                    $Corep = "Core".$i."p";
                    $Coret = "Core".$i."t";
                    ${$Corep} = 0;
                    ${$Coret} = 0;
                }
                $QueryForDate = "SELECT * FROM $Table WHERE rollno=$RollNo";
                $Execute = mysqli_query($Connection, $QueryForDate);
                while($Datas = mysqli_fetch_assoc($Execute)){
                    $Overallp=0;$Overallt=0;
/////////////////////////////////////////////////////ADDING THE NUMBER OF HOURS PRESENT IN CORE1T & CORE1P///////////////////////
                    for($i=1;$i<=$CountForSubjects;$i++){
                        $Coresp = "Core".$i."p";
                        $Corest = "Core".$i."t";
                        $corep = "core".$i."p";
                        $coret = "core".$i."t";
                        ${$Coresp} += $Datas[$corep];
                        ${$Corest} += $Datas[$coret];
                    }                
/////////////////////////////////////////////////////CALC THE PERCENTAGE///////////////////////////////////////////////////////////////////////
                }
                if(!empty($_POST['NumberOfDays'])){
                    if($_POST['NumberOfDays'] > 0){
                for($x=1;$x<=$CountForSubjects;$x++){
                $Corest = "Core".$x."t";  
                $SubCount = "Sub".$x;
                $TotalHrPerc = "TotPerc".$x;
                ${$Corest} +=${$SubCount};
                $Overallt+=${$SubCount};
                ${$TotalHrPerc} = ${$Corest} * 0.75;
                //echo ${$TotalHrPerc}." ";
                }
           
   
                for($x=1;$x<=$CountForSubjects;$x++){
                $SubCountForPresent = "SubPres".$x;
                $TotalHrPerc = "TotPerc".$x;
                $SubCount = "Sub".$x;
                $Coresp = "Core".$x."p";
                $Display = "Display".$x;
                $CheckForGreater = "Check".$x;
                ${$CheckForGreater} = 0;
                //echo "TotalHrPerc: ".${$TotalHrPerc}." ";
                //echo "SubCountForPresent: ".${$SubCountForPresent}." ";
                //echo "Coresp: ".${$Coresp}."<br>";
                ${$Display} = ${$TotalHrPerc} - ${$Coresp};
                if(${$Display} > ${$SubCount}){
                    ${$CheckForGreater} = 1;
                }
                if(${$Display} <= 0){
                    ${$Display} = 0;
                }
                
                $Overallp+=ceil(${$Display});
                }
                        $TableData ='<tr><th>';
                        $TableData.=$RollNo;
                        $TableData.='</th><td ';
                        if($Overallt < $Overallp){
                           $TableData.="style='background-color:rgb(255,0,0,0.6);'";
                        }
                        $TableData.='>';
                        $TableData.=$Name;
                        $TableData.='</td><td>';
                        $TableData.=$Mentor;
                        $TableData.='</td><td>';
                        $TableData.=$RegNo;
                        $TableData.='</td>';
                        for($i=1;$i<=$CountForSubjects;$i++){
                            $Coresp = "Core".$i."p";
                            $Corest = "Core".$i."t";
                            $CheckForGreater = "Check".$i;
                            $Display = "Display".$i;
                            $SubCount = "Sub".$i;
                            if(${$CheckForGreater} == 1){
                                $TableData.='<td>N/A</td>';
                            }else{
                            $TableData.='<td>'.ceil(${$Display})."/".${$SubCount}.'</td>';
                            }
                        }
                        if($Overallt > $Overallp){
                        $TableData.="<td>".$Overallp."/".$Overallt."</td></tr>";
                        }else{
                            $TableData.="<td style='background-color:rgb(255,0,0,0.6);'>N/A</td></tr>";
                        }
                        echo $TableData;
                    }else{
                        echo '<br><br><br><div class="alert alert-danger" style="font-size:0.7em;">
                    <center><h4>Kindly Enter A Valid Number Of Days</h4></center>
                    </div>';break;
                    }
                }else{
                    for($i=1;$i<=$CountForSubjects;$i++){
                        $Coresp = "Core".$i."p";
                        $Corest = "Core".$i."t";
                        $Overallp+=${$Coresp};
                        $Overallt+=${$Corest};
                    }
                    $TableData ='<tr><th>';
                        $TableData.=$RollNo;
                        $TableData.='</th><td>';
                        $TableData.=$Name;
                        $TableData.='</td><td>';
                        $TableData.=$Mentor;
                        $TableData.='</td><td>';
                        $TableData.=$RegNo;
                        $TableData.='</td>';
                        for($i=1;$i<=$CountForSubjects;$i++){
                            $Coresp = "Core".$i."p";
                            $Corest = "Core".$i."t";
                            $TableData.='<td>'.${$Coresp}."/".${$Corest}.'</td>';
                        }
                        $TableData.="<td>".$Overallp."/".$Overallt."</td></tr>";
                        echo $TableData;
                }
        }
               }else{
                   echo '<br><br><br><div class="alert alert-danger" style="font-size:0.7em;">
                    <center><h4>No Data Has Been Entered For The Specific Class</h4></center>
                    </div>';
               }
               }
               }
            ?>
            </div>
        </div>
</html>
<!-- DEVELOPED BY RAKESH KUMAR T -->