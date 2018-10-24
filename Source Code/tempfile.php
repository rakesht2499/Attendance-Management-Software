<?php session_start();
if($_SESSION['Login'] == "Success"){
    $DBname = $_SESSION['Database'];
   $Connection = mysqli_connect("localhost", "root", "", $DBname);
//   $DayOrder = $_GET['dayorder'];
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
                    font-size: 1.3em;
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
                    transform: scale(1.25,1.25);
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
        <div class="col-lg-3 col-mg-3 col-sm-3">
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
                    &nbsp;PREDICTIONS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </a></li>
                <li><a href="Logout.php">
                    <span class="glyphicon glyphicon-off"></span>
                    &nbsp;LOGOUT
                </a></li>
                </ul>
            </div>
        </div>
        <!--********************************************MAIN AREA ************************************************ -->
        <div class="col-lg-9">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <form action="tempfile.php" method="POST" >
                <fieldset>
                    <br><br>
                    <div class="form-group">
                        <center><label for='Class'><h2>Year & Sec:</h2></label></center>
                        <div class="col-lg-12">
                            <div class="col-lg-3"></div>
                        <div class="input-group input-group-md col-lg-6">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-education text-primary"></span>
                            </span>
                                <select class="form-control"id='Class' name="Class" style="background-color: rgba(255,255,255,0.5);">
                                <option>Year-Sec</option>
                                <option>II-A</option>
                                <option>II-B</option>
                                <option>III-A</option>
                                <option>III-B</option>
                                <option>IV-A</option>
                                <option>IV-B</option>
                            </select>
                        </div>
                            <div class="col-lg-3"></div>
                        </div>
                    </div><div class="col-lg-12"><br><br>
                        <center><input class="btn btn-danger btn-lg" type='submit' name='Predict' value="Predict!"></center></div>
                </fieldset>
                </form>
                </div>
            <div class="col-lg-2"></div>
            <div class="col-lg-12">
                <?php
                $Table = $_POST['Class'];
                if($Table == "II-A"){
                  $temp = "iiatt";  
                }if($Table == "II-B"){
                  $temp = "iibtt";  
                }if($Table == "III-A"){
                  $temp = "iiiatt";  
                }if($Table == "III-B"){
                  $temp = "iiibtt";  
                }if($Table == "IV-A"){
                  $temp = "iiatt";  
                }if($Table == "II-A"){
                  $temp = "iiatt";  
                }
                require 'subjects.php';
        $temparr = array(1,2,3,4,5);
            for($u=0;$u<5;$u++){
        $QueryFor[$u] = "SELECT * FROM $temp WHERE dayorder = $temparr[$u]";
                    }
                    for($t=1;$t<=$CountForSubjects;$t++){
                $SubCount = "Sub".$t;
                ${$SubCount} = 0;
            }
        for($i=0;$i<5;$i++){
            $Executing[$i]= mysqli_query($Connection, $QueryFor[$i]);
        while($dats = mysqli_fetch_array($Executing[$i])){
            $Counti=0;
            
            for($index = 3;$index<=9;$index++){
                for($t=1;$t<=$CountForSubjects;$t++){
                $Sub = "Name".$t;
                $SubCount = "Sub".$t;
                    if($dats[$index] == ${$Sub}){
                        ${$SubCount}++;
                    }
                }
            }
        }
        }
        for($t=1;$t<=$CountForSubjects;$t++){
                $SubCount = "Sub".$t;
                ${$SubCount}*=20;
            }
            for($t=1;$t<=$CountForSubjects;$t++){
            ${"SubPerc".$t} = 0;
            }
        for($t=1;$t<=$CountForSubjects;$t++){
            $SubCount = "Sub".$t;
            ${"SubPerc".$t} = ${$SubCount} * (0.75);
            echo ${"SubPerc".$t}." ";
        }
                ?>
 </div>
        </div>
</html>
<?php
  /*    $my_file = 'subjects_1.php';
$modified = '$Name1 = "DOMER";
$Name2 = "DOKDF";
$Name3 = "ECHDF";
$Name4 = "PORDF";
$Name5 = "PARDF";
$Name6 = "MODFO";
$Name7 = "PICDF";
$Name8 = "PADFI";
$Name9 = "MENDF";
$Name10 = "ERDFA";
$Name11 = "MADU";
';
        $CountSubjects=0;$html='';$FullContent='';
        $fileDirectory = "subjects_1.php";
        $fileContents = file($fileDirectory);
		if(!(is_readable($fileDirectory)&&is_writable($fileDirectory)))
		{
			echo alertStatus('Error!! File access not granted');
			exit;
		}
                $needle='IIIeven';
                $SubjectNo = 'Name3';
                $html;$Count = 0;$CountForCopy=0;
                foreach ($fileContents as $haystack){
                    
                    if (strpos($haystack, $needle) !== false){ $FullContent.=$haystack;$Count++;$CountForCopy++; continue;}
                    if($Count == 1){
                        if($CountForCopy == 1){
                        $FullContent.=$modified;
                        $CountForCopy++;
                        } 
                        }else{
                        $FullContent.=$haystack;
                    }
                    }
                $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
                fwrite($handle, $FullContent);
                fclose($handle);
      */?>