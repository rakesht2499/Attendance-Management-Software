<?php
session_start();
ini_set('display_errors', 'off');
require_once '../CheckLogin.php';
date_default_timezone_set("Asia/Calcutta");
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
$_SESSION['ErrorMessage']=null;
if(isset($_POST['submit'])){
        $Table = $_POST['classname'];
    require '../subjects.php';
    for($i=1;$i<=$CountForSubjects;$i++){
        $Element = "Name".$i;
        if(empty($_POST[$Element])){
            $_SESSION['ErrorMessage']='Kindly Enter All the Subjects';
        }
    }
    if(!isset($_SESSION['ErrorMessage'])){
    if(!empty($_POST['numsub'])){
        $CountForSubjects = $_POST['numsub'];
    }
    if($_SESSION['InstalledInSubadm'] != NULL){
            for($i=1;$i<=15;$i++){
           $Query = "INSERT INTO subs(id,iisub,iiisub,ivsub) VALUES ('$i','','','')" ;
           $Execute = mysqli_query($Connection, $Query);
            }
        }
    for($i=1;$i<=$CountForSubjects;$i++){
        $Element = "Name".$i;
        $Query = "UPDATE subs SET $SubjectTable='$_POST[$Element]' WHERE id=$i";
        $Execute = mysqli_query($Connection, $Query);
    }
    for($i=$CountForSubjects+1;$i<=15;$i++){
        $Query = "UPDATE subs SET $SubjectTable='' WHERE id=$i";
        $Execute = mysqli_query($Connection, $Query);
    }     
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
        <title>WELCOME</title>
    </head>
    <body>
        <h1 style="z-index: 100; position: fixed;font-family: 'Bangers', cursive;color: red; " >&nbsp;&nbsp;ADMIN</h1>
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
                <li><a href="WelcomeAdmin.php">
                    <span class="glyphicon glyphicon-calendar"></span>
                    &nbsp;ADMIN
                </a></li>
                <li class="active"><a href="subadm.php">
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
     <?php  
     if(isset($_POST['SubmitForYear']) && $_POST['Class'] == 'Year'){
         ?><div class='alert alert-danger col-lg-8 col-md-8 col-sm-8 col-xs-8' style='position:fixed;'><h3><center>Please Enter a Valid Year</center></h3></div>
         <?php }?> 
    <?php
    if(isset($_POST['SubmitForYear']) && $_POST['Class'] != 'Year'){
    echo '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="position: fixed;">';
    }else{
      echo '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div><div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">'; 
    }
     echo '<h3>'.Message().'</h3>';
            ?>
        <br><br>
        <form action="subadm.php" method="POST">
                <fieldset>
                    <br><br>           
            <div class="form-group">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">        
                <center><label for='Class'><h2>Year & Sec:</h2></label></center>
                        <div class="input-group input-group-md ">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-education text-primary"></span>
                            </span>
                                <select class="form-control"id='Class' name="Class" style="background-color: rgba(255,255,255,0.5);">
                            <?php    
                                $Options = '<option>Year</option><option';
                                if((isset($_POST['SubmitForYear']) || isset($_POST['submit'])) && $_POST['Class'] == 'II-YEAR'){
                                $Options.=' selected ';    
                                }
                                $Options.='>II-YEAR</option><option';
                                if(isset($_POST['SubmitForYear']) && $_POST['Class'] == 'III-YEAR'){
                                $Options.=' selected ';    
                                }
                                $Options.='>III-YEAR</option><option';
                                if(isset($_POST['SubmitForYear']) && $_POST['Class'] == 'IV-YEAR'){
                                $Options.=' selected ';    
                                }
                                $Options.='>IV-YEAR</option>';
                                echo $Options;
                            ?>
                            </select>
                        </div><br>
                        <center><label for='NoOfSub'><h2>Number Of Subjects:</h2></label></center>
                        <div class="input-group input-group-md ">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-dashboard text-primary"></span>
                            </span>
                            <input class="form-control" id='NoOfsub' placeholder="No Of Subjects" name="NoOfSub" style="background-color: rgba(255,255,255,0.5);">
                        </div><br><br>
                        <center><input class="btn btn-success btn-lg" type='submit' name='SubmitForYear' value="Submit"></center>    
   
                </div>
                          
            </div> 
                </fieldset>
            </form>
</div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"></div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <?php
                if(isset($_POST['SubmitForYear']) && $_POST['Class'] == 'Year'){
        
                }else{
                    if(isset($_POST['SubmitForYear'])){
                        $Table = $_POST['Class'];
                        $FormStart = ' <form action="subadm.php" method="POST" ><fieldset><div class="form-group">';
                        echo $FormStart;
                        $echoClassName = '<center><h2>Class & Sec:';
                        $echoClassName.= $Table;
                        $echoClassName.= '</h2></center>';
                        $Table = substr($Table, 0,-4);
                        $Table.="A";
                        $echoClassName.='<input type="text" id="classname" name="classname" style="display:none;" value="';
                        $echoClassName.=$Table.'" >';
                        require '../subjects.php';
                        $SampleQuery = "SELECT $SubjectTable FROM subs";
                        $ExecuteSample = mysqli_query($Connection, $SampleQuery);
                        if(!mysqli_fetch_assoc($ExecuteSample)){
                          $_SESSION['InstalledInSubadm']="set";  
                        }
                        $ExecuteSample = mysqli_query($Connection, $SampleQuery);
                        if(!mysqli_fetch_assoc($ExecuteSample) && empty($_POST['NoOfSub'])){
                            echo '<br><br><br><br><br><br><div class="alert alert-warning"><center><h3>Kindly Enter the No. of Sub As This Is A Freshly Installed Software</h3></center></div>';
                        }else{
                        if(!empty($_POST['NoOfSub']) && $_POST['NoOfSub'] >0){
                            $CountForSubjects = $_POST['NoOfSub'];
                        }
///////////////STRORING THE YEAR-SEC IN AN INVISIBLE INPUT FIELD FOR ROCESSING THE NEXT REQUEST FOR UPDATE/////////////////////////////////
                        $echoClassName.='<input type="text" id="numsub" name="numsub" style="display:none;" value="';
                        $echoClassName.=$CountForSubjects.'" >';
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                        echo $echoClassName;
                        for($i=1;$i<=$CountForSubjects;$i++){
                            $Name = "Name".$i;
                        $htmltodisplay = '<label>';
                        $htmltodisplay.="Subject".$i;
                        $htmltodisplay.=':</label><div class="input-group input-group-md">';
                        $htmltodisplay.= '<span class="input-group-addon"><span class="glyphicon glyphicon-education text-primary"></span></span>';
                        $htmltodisplay.= '<input class="form-control" id="';
                        $htmltodisplay .="Name".$i;
                        $htmltodisplay.= '" name="';
                        $htmltodisplay.= 'Name'.$i.'" ';
                        $htmltodisplay.= 'value="';
                        $htmltodisplay.= ${$Name};
                        $htmltodisplay.= '" style="background-color: rgba(255,255,255,0.5);"></div><br>';
                        echo $htmltodisplay;
                        }
                        $FormEnd = '<center><button type="submit" class="btn btn-danger btn-lg" name="submit">Submit</button></center></div></fieldset></form>';
                        echo $FormEnd;
                    }
                    }
                }
                ?>
        </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
</div>

    </body>
</html>