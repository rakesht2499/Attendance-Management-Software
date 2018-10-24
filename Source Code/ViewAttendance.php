<?php
session_start();
$PageName = "ViewAttendance";
if($_SESSION['Login'] == "Success"){
$DBname = $_SESSION['Database'];
if($_SESSION['adcode'] == 'done'){
header("Location:admin/WelcomeAdmin.php");
}
require 'Connection.php';
$DayOrder = $_GET['dayorder'];
if($DayOrder == "0"){
header("Location:WelcomePage.php");
}
if($_SESSION['dayorders'] == $DayOrder){}else{
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
            .threebuttons input{
                padding: 2%;
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
            
                        /* Customize the label (the container) */
.containers {
  display: inline-block;
  position: relative;
  padding-left: 25px;
  margin-bottom: 10px;
  cursor: pointer;
  font-size: 18px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.containers input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.containers:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.containers input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.containers input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.containers .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
            

        </style>
        <title>WELCOME</title>
    </head>
    <body>
        <div class="container" >
            <center>
            <img src="Images/VEC-LOGO.jpg" class="img-responsive" width="80%">
            </center>
        </div>
        <!--SIDE AREA-->
        <div class="col-lg-3 col-mg-3 col-sm-3 col-xs-3">
           <div class="row" style="position: fixed;">
            <ul id="SideArea" class="nav nav-pills nav-stacked">
                <br>
                <li <?php if($PageName=="TimeTable"){echo 'class="active"';}?>><a href="WelcomePage.php">
                    <span class="glyphicon glyphicon-calendar"></span>
                    &nbsp;TIME-TABLE
                </a></li>
                <li <?php if($PageName=="UpdateAttendance"){echo 'class="active"';}?>><a href="Update.php?dayorder=<?php echo $DayOrder;?>">
                    <span class="glyphicon glyphicon-tasks"></span>
                    &nbsp;UPDATE ATTENDANCE
                </a></li>
                <li <?php if($PageName=="ViewAttendance"){echo 'class="active"';}?>><a href="ViewAttendance.php?dayorder=<?php echo $DayOrder;?>">
                    <span class="glyphicon glyphicon-list"></span>
                    &nbsp;VIEW-ATTENDANCE
                </a></li>
                <li <?php if($PageName=="UpdateTT"){echo 'class="active"';}?>><a href="EditTimeTable.php?dayorder=<?php echo $DayOrder;?>">
                    <span class="glyphicon glyphicon-tasks"></span>
                    &nbsp;UPDATE TT
                </a></li>
                <li <?php if($PageName=="UpdateAttendance"){echo 'class="active"';}?>><a href="AddNewStudent.php?dayorder=<?php echo $DayOrder;?>">
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
        <!--********************************************MAIN AREA ************************************************ -->
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
            <div style="position: fixed;right:0;top:0;color: #269abc;padding-right: 1%"><h3><?php echo date("l");?></h3></div>
            <div style="position: fixed;left:0;top:0;color: #269abc;padding-left: 1%;"><h3><?php echo date("d F Y");?></h3></div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <form action="ViewAttendance.php?dayorder=<?php echo $DayOrder;?>" method="POST" >
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
                                <select class="form-control" id='Class' onchange="validate()" name="Class" style="background-color: rgba(255,255,255,0.5);">
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
                                        <div class="Secti col-lg-12" style="margin-top:5%;" id="Secti"></div>
                    <script>

function validate()
{
 var ddl = document.getElementById("Class");
 var selectedValue = ddl.options[ddl.selectedIndex].value;
 if(selectedValue == "IV-A" || selectedValue == "IV-B" || selectedValue == "IV-C"){
     <?php 
     $Table = "IV-A";
     require 'subjects.php';
     $dat='';
     for($i=1;$i<=$CountForSubjects;$i++){
         $Namep = "Name".$i;
         $dat.="<label class='checkbox-inline containers'><input type='checkbox' name='Nam".$i."'>".${$Namep}."<span class='checkmark'></span></label>";
     }
     ?>
     document.getElementById("Secti").innerHTML="<?php echo $dat;?>";
     }else if(selectedValue == "II-A" || selectedValue == "II-B" || selectedValue == "II-C"){
              <?php 
     $Table = "II-A";
     require 'subjects.php';
     $dat='';
     for($i=1;$i<=$CountForSubjects;$i++){
         $Namep = "Name".$i;
         $dat.="<label class='checkbox-inline containers'><input type='checkbox' name='Nam".$i."'>".${$Namep}."<span class='checkmark'></span></label>";
     }
     ?>
     document.getElementById("Secti").innerHTML="<?php echo $dat;?>";
}else if(selectedValue == "III-A" || selectedValue == "III-B" || selectedValue == "III-C"){
         <?php 
     $Table = "III-A";
     require 'subjects.php';
     $dat='';
     for($i=1;$i<=$CountForSubjects;$i++){
         $Namep = "Name".$i;
         $dat.="<label class='checkbox-inline containers'><input type='checkbox' name='Nam".$i."'>".${$Namep}."<span class='checkmark'></span></label>";
     }
     ?>
     document.getElementById("Secti").innerHTML="<?php echo $dat;?>";
}else{
      document.getElementById("Secti").innerHTML='';
  }
  }</script>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 threebuttons">
                        <br><br>
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
                    <input class="btn btn-primary col-lg-2 col-md-2 col-sm-2 col-xs-2" onclick="showrollno()" value="Roll Number">    
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
                    <input class="btn btn-success col-lg-2 col-md-2 col-sm-2 col-xs-2" onclick="showspecific()" value="Specific Date">
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
                    <input class="btn btn-danger col-lg-2 col-md-2 col-sm-2 col-xs-2" type='submit' name='SubTillDate' value="Till Date">
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
                    <input class="btn btn-warning col-lg-2 col-md-2 col-sm-2 col-xs-2" onclick="showfromto()" value="From-To">
                    
                    </div>
                    <script type="text/javascript" >
                    function showfromto(){
                    document.getElementById("demo").innerHTML ='<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6"><center><label for="From"><h4>From :</h4></label></center><div class="input-group input-group-md"><span class="input-group-addon"><span class="text-primary">From:</span></span><input class="form-control" id="From" name="From" placeholder="dd/mm/yy" style="background-color: rgba(255,255,255,0.5);"></div></div><div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6"><center><label for="To"><h4>To :</h4></label></center><div class="input-group input-group-md"><span class="input-group-addon"><span class="text-primary">To:</span></span><input class="form-control" id="To" name="To" placeholder="dd/mm/yy" style="background-color: rgba(255,255,255,0.5);"></div></div><center><input class="btn btn-info btn-md" type="Submit" name="Submit1" value="Submit"></center>';
                    }
                    function showspecific(){
                    document.getElementById("demo").innerHTML ='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div><div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6"><center><label for="Specific"><h4>Specific Date :</h4></label></center><div class="input-group input-group-md"><span class="input-group-addon"><span class="text-primary">Date:</span></span><input class="form-control" id="Specific" name="Specific" placeholder="dd/mm/yy" style="background-color: rgba(255,255,255,0.5);"></div></div><div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div></div><center><input class="btn btn-info btn-md" type="Submit" name="Submit2" value="Submit"></center>';
                    }
                    function showrollno(){
                    document.getElementById("demo").innerHTML ='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div><div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6"><center><label for="RollNo"><h4>Roll Number :</h4></label></center><div class="input-group input-group-md"><span class="input-group-addon"><span class="text-primary">RollNo:</span></span><input class="form-control" id="RollNo" name="RollNo" placeholder="Roll Number" style="background-color: rgba(255,255,255,0.5);"></div></div><div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div></div><center><input class="btn btn-info btn-md" type="Submit" name="Submit3" value="Submit"></center>';
                    }
                    </script>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="demo"></div> 
                </fieldset>
            </form>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php
            if(isset($_POST['Submit1']) || isset($_POST['Submit2']) || isset($_POST['SubTillDate']) || isset($_POST['RollNo'])){
                if(isset($_POST['Submit1'])){
                $From = $_POST['From'];
                $To = $_POST['To'];
             }if(isset($_POST['Submit2'])){
                 $Specific = $_POST['Specific'];
             }if(isset($_POST['Submit3'])){
                 $RollNoInput = $_POST['RollNo'];
             }
               if($_POST['Class']=="Year-Sec"){
               echo '<br><br><br><div class="alert alert-danger" style="font-size:0.7em;">
                   <center><h4>Enter a Valid Year & Section</h4></center>
                    </div>';
               }elseif(isset($_POST['Submit1']) && (!preg_match("/^[0-9][0-9]\/[0-9][0-9]\/[0-9][0-9]$/", $_POST['From']) || !preg_match("/^[0-9][0-9]\/[0-9][0-9]\/[0-9][0-9]$/", $_POST['To']))){
               echo '<br><br><br><div class="alert alert-danger" style="font-size:0.7em;">
                   <center><h4>Enter Both Dates In The Given Format</h4></center>
                    </div>';
               }elseif(isset($_POST['Submit2']) && (empty($Specific) || !preg_match("/[0-9][0-9]\/[0-9][0-9]\/[0-9][0-9]/", $Specific))){
               echo '<br><br><br><div class="alert alert-danger" style="font-size:0.7em;">
                    <center><h4>Kindly Enter the Date In The Given Format</h4></center>
                    </div>';
               }elseif(isset($_POST['Submit3']) && (empty($RollNoInput) || !preg_match("/[1-9][0-9][0-9][0-9][0-9][0-9]/", $RollNoInput))){
               echo '<br><br><br><div class="alert alert-danger" style="font-size:0.7em;">
                    <center><h4>Kindly Enter the Correct RollNumber</h4></center>
                    </div>';
               }else{
              $Table = $_POST['Class'];
               require 'subjects.php';
             if(isset($_POST['Submit1'])){
                $From = $_POST['From'];
                $To = $_POST['To'];
                $String1 = explode("/", $From);
                $String2 = explode("/", $To);
                $From = $String1[2].$String1[1].$String1[0];
                $To = $String2[2].$String2[1].$String2[0];
             }if(isset($_POST['Submit2'])){
                 $Specific = $_POST['Specific'];
                 $String = explode("/", $Specific);
                 $Specific = $String[2].$String[1].$String[0];
             }if(isset($_POST['Submit3'])){
                 $RollNoInput = $_POST['RollNo'];
             }
            $Table = $_POST['Class'];
            require 'subjects.php';
            if(isset($_POST['Submit1']) || isset($_POST['Submit2']) || isset($_POST['SubTillDate'])){
            if(isset($_POST['Submit1'])){
                    $QueryForDate = "SELECT * FROM $Table WHERE (lastupdated BETWEEN '$From' AND '$To')";
                }if(isset($_POST['Submit2'])){
                    $QueryForDate = "SELECT * FROM $Table WHERE lastupdated='$Specific'";
                }if(isset($_POST['SubTillDate'])){
                    $QueryForDate = "SELECT * FROM $Table";
                }
                $Execute = mysqli_query($Connection, $QueryForDate);
                if(mysqli_fetch_assoc($Execute)){
            $TableHeaders = '<div class="table-ressponsive" style="margin:10% 5% 15% 5%;">';
            $TableHeaders.='<br><div class="alert alert-success" style="font-size:0.7em;"><center>';           
            $TableHeaders.='<h4>Data\'s Sucessfully Fetched for ';
            $TableHeaders.= $_POST["Class"];
            $TableHeaders.='</h4></center></div><table class="table">';
            $TableHeaders.= '<tr><th>Roll Number</th><th>Name</th><th>Mentor Name</th><th>Register Number </th>';
                for($i=1;$i<=$CountForSubjects;$i++){
                    $Names = "Name".$i;
                    if(isset($_POST['Nam'.$i]))
                        continue;
                    $TableHeaders.= '<th>';
                    $TableHeaders.= ${$Names};
                    $TableHeaders.= '</th>';
                }
                $TableHeaders.= '<th>Overall</th></tr>';
                echo $TableHeaders;
                
        $QueryForTable = "SELECT * FROM $Table";
        $ExecuteForTable = mysqli_query($Connection, $QueryForTable);
        while($Data = mysqli_fetch_array($ExecuteForTable)){
                $RollNo = $Data['rollno'];
                $Name = $Data['name'];
                $RegNo = $Data['regno'];
                $Mentor = $Data['mentor'];
                if($RegNo == 0) continue;
                if(isset($_POST['Submit1'])){
                    $QueryForDate = "SELECT * FROM $Table WHERE (lastupdated BETWEEN '$From' AND '$To') AND rollno=$RollNo";
                }if(isset($_POST['Submit2'])){
                    $QueryForDate = "SELECT * FROM $Table WHERE lastupdated='$Specific' AND rollno=$RollNo";
                }if(isset($_POST['SubTillDate'])){
                    $QueryForDate = "SELECT * FROM $Table WHERE rollno=$RollNo";
                }
                $Execute = mysqli_query($Connection, $QueryForDate);
///////////////////////////////////////////////////////ASSIGNING CORE1P & CORE1T AS 0//////////////////////////////////////////
                for($i=1;$i<=$CountForSubjects;$i++){
                    $Corep = "Core".$i."p";
                    $Coret = "Core".$i."t";
                    ${$Corep} = 0;
                    ${$Coret} = 0;
                }
                while($Datas = mysqli_fetch_assoc($Execute)){
/////////////////////////////////////////////////////ADDING THE NUMBER OF HOURS PRESENT IN CORE1T & CORE1P///////////////////////
                    for($i=1;$i<=$CountForSubjects;$i++){
                        $Coresp = "Core".$i."p";
                        $Corest = "Core".$i."t";
                        $corep = "core".$i."p";
                        $coret = "core".$i."t";
                        if(isset($_POST['Nam'.$i]))
                        continue;
                        ${$Coresp} += $Datas[$corep];
                        ${$Corest} += $Datas[$coret];
                    }
                    
                }
                $Overallp=0;$Overallt=0;
/////////////////////////////////////////////////CALC OVERALL P & T AND MAKING THE TOTAL HOURS TO 1 IF ITS 0//////////////////////////////////////////////////////////////////
                for($i=1;$i<=$CountForSubjects;$i++){
                  $Coresp = "Core".$i."p";
                  $Corest = "Core".$i."t";
                  if(isset($_POST['Nam'.$i]))
                        continue;
                  $Overallp+=${$Coresp};
                  $Overallt+=${$Corest};
                  if(${$Corest} == 0){${$Corest} = 1;}
                }
                if($Overallt==0){$Overallt=1;}
/////////////////////////////////////////////////////CALC THE PERCENTAGE///////////////////////////////////////////////////////////////////////
                for($i=1;$i<=$CountForSubjects;$i++){
                  $Coresp = "Core".$i."p";
                  $Corest = "Core".$i."t";
                  if(isset($_POST['Nam'.$i]))
                        continue;
                  $Coresperc = "Core".$i."TotalPerc";
                  ${$Coresperc} = (${$Coresp}/${$Corest})*100;
                }
                $TotalPerc = ($Overallp/$Overallt)*100;
                        $TableData ='<tr ';
                        if($TotalPerc <75)
                        $TableData.='style="background-color:rgb(255,0,0,0.6);" ';
                        $TableData.='><th>';
                        $TableData.=$RollNo;
                        $TableData.='</th><td>';
                        $TableData.=$Name;
                        $TableData.='</td><td>';
                        $TableData.=$Mentor;
                        $TableData.='</td><td>';
                        $TableData.=$RegNo;
                        $TableData.='</td>';
                        for($i=1;$i<=$CountForSubjects;$i++){
                            if(isset($_POST['Nam'.$i]))
                        continue;
                            $Coresperc = "Core".$i."TotalPerc";
                            $TableData.='<td>'.number_format((float) ${$Coresperc}, 2, '.', '').'</td>';
                        }
                        $TableData.="<td>".number_format((float) $TotalPerc, 2, '.', '')."</td></tr>";
                        echo $TableData;
                        $PrevRollNo = $RollNo;
        }//For the given While Condition
                        echo '</table></div>';
                }else{
                    echo '<br><br><br><div class="alert alert-danger" style="font-size:0.7em;">
                    <center><h4>No Data Has Been Entered In the Mentioned Date/Period</h4></center>
                    </div>';
                }
               }if(isset($_POST['Submit3'])){
                   $QueryForDate = "SELECT * FROM $Table WHERE rollno=$RollNoInput";
                   $ExecuteForTable = mysqli_query($Connection, $QueryForDate);
                   if(mysqli_fetch_array($ExecuteForTable)){
                   $TableHeaders = '<div class="table-ressponsive" style="margin:10% 5% 15% 5%;">';
            $TableHeaders.='<br><div class="alert alert-success" style="font-size:0.7em;"><center>';           
            $TableHeaders.='<h4>Data\'s Sucessfully Fetched for ';
            $TableHeaders.= $_POST["Class"]."<br>";
            $ExecuteForTable = mysqli_query($Connection, $QueryForDate);
            while($Data = mysqli_fetch_array($ExecuteForTable)){
                $RollNo = $Data['rollno'];
                $Name = $Data['name'];
                $RegNo = $Data['regno'];
                $Mentor = $Data['mentor'];
                $TableHeaders.="Roll Number: ".$RollNo."<br>Name: ".$Name."<br>Register Number: ".$RegNo."<br>Mentor: ".$Mentor." ";
                break;
            }
            $TableHeaders.='</h4></center></div><table class="table">';
            $TableHeaders.= '<tr><th>&nbsp;&nbsp;Date&nbsp;&nbsp;</th>';
                for($i=1;$i<=$CountForSubjects;$i++){
                    $Names = "Name".$i;
                    $TableHeaders.= '<th>';
                    $TableHeaders.= ${$Names}."-P";
                    $TableHeaders.= '</th>';
                    $TableHeaders.= '<th>';
                    $TableHeaders.= ${$Names}."-T";
                    $TableHeaders.= '</th>';
                }
                $TableHeaders.= '<th>Overall-P</th><th>Overall-T</th></tr>';
                echo $TableHeaders; 
                $QueryForDate = "SELECT * FROM $Table WHERE rollno=$RollNoInput";
                $ExecuteForTable = mysqli_query($Connection, $QueryForDate);
                $Gen=0;
            while($Data = mysqli_fetch_array($ExecuteForTable)){ 
                $Gen++;
                $RegNo = $Data['regno'];
                $Overallp = $Data['overallp'];
                $Overallt = $Data['overallt'];
                $LastUpdated = $Data['lastupdated'];
     $LastUpdated = $LastUpdated[4].$LastUpdated[5]."/".$LastUpdated[2].$LastUpdated[3];
                if($RegNo != 0)continue;
                $TableData = '<tr><td style="background-color:rgba(1, 38, 96,0.8);color:white">'.$LastUpdated.'</td>';
            for($i=1;$i<=$CountForSubjects;$i++){
                        $corep = "core".$i."p";
                        $coret = "core".$i."t";
                echo $TableHeader;
                        $TableData.='<td style="background-color:rgba(';
                        if($Gen%2 == 0)
                        $TableData.='66, 185, 244,0.5';
                        else
                        $TableData.='0,0,0,0.01';
                        $TableData.=');">'.$Data[$corep].'</td><td style="background-color:rgba(';
                        if($Gen%2 == 1)
                        $TableData.='0, 121, 181,0.5';
                        else
                        $TableData.='0,0,0,0.01';
                        $TableData.=');">'.$Data[$coret].'</td>';
                        }
                        $TableData.='<td style="background-color:rgba(';
                        if($Gen%2 == 0)
                        $TableData.='66, 185, 244,0.5';
                        else
                        $TableData.='0,0,0,0.01';
                        $TableData.=')">'.$Overallp.'</td><td style="background-color:rgba(';
                        if($Gen%2 == 1)
                        $TableData.='0, 121, 181,0.5';
                        else
                        $TableData.='0,0,0,0.01';
                        $TableData.=')">'.$Overallt.'</td></tr>';
                        echo $TableData;
                        $TableHeader='';
            }
            echo "</table></div>";
                   }else{
                    echo '<br><br><br><div class="alert alert-danger" style="font-size:0.7em;">
                    <center><h4>No Data Has Been Entered For The Specific Roll Number</h4></center>
                    </div>';
                }
               }
            }//FOR ELSE CONDITION UNDER if(YEAR-SEC)
            }//For the given if (SUBMIT) condition
            ?>
               </div>
        </div>
    </body>
</html>
<!-- DEVELOPED BY RAKESH KUMAR T -->