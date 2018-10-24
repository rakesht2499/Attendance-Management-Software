<?php
require_once 'CheckLogin.php';
session_start();
$DayOrder = 0;
if($_SESSION['Login'] == "Success"){
$DBname = $_SESSION['Database'];
if($_SESSION['adcode'] == 'done'){
header("Location:admin/WelcomeAdmin.php");   
}
require 'Connection.php';
}else{
$_SESSION['ErrorMessage'] = "Access Denied. Please Login";
header("Location:Login.php");
}
if(isset($_POST['Submit'])){
    $DayOrder = $_POST['DayOrder'];
    if($DayOrder=='Custom TT'){
        $DayOrder = 7;
    }
        if($DayOrder=="Day"){
    $_SESSION['ErrorMessage']='Please select a valid Day';
    unset($DayOrder);
    }else{
    $_SESSION['dayorders'] = $DayOrder;
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
                <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/2/29/Valliammai_Logo.png">
                <meta name="viewport" content="width=device-width, initial-scale=1">
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
            .float-right{
                float: right;
            }
            .float-right:hover{
                transform: scale(2,2);
            }
            .float-left{
                float: left;
            }
        </style>
        <title>WELCOME</title>
    </head>
    <body>
        <div class="container-fluid">
            <center>
                <img src="Images/VEC-LOGO.jpg" class="img-responsive" width="80%">
            </center>
        </div>
        <!--********************************* SIDE  ******   AREA *************************************-->
        <?php 
        //ob_start();
        ?>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
            <div class="row" style="position: fixed;" >
            <ul id="SideArea" class="nav nav-pills nav-stacked">
                <br>
                <li class="active" ><a href="WelcomePage.php">
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
        <?php  
        //$output = ob_get_clean();
        //echo $output;
        ?>
        <!--********************************* MAIN  ******   AREA *************************************-->
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
            <div style="position: fixed;right:0;top:0;color: #269abc;padding-right: 1%"><h3><?php echo date("l");?></h3></div>
            <div style="position: fixed;left:0;top:0;color: #269abc;padding-left: 1%;"><h3><?php echo date("d F Y");?></h3></div>
            <br><br>
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
                 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                     <?php
                    if(isset($_POST['Submit']) && isset($DayOrder)){
                 echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><center><h2 class="alert alert-info">Day :'.$_POST['DayOrder'].'</h2></center></div>';
                 }
                 ?>
                 <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
                 </div>
                <div class="table-ressponsive" style="margin:0 20% 0 20%;">
                   <br>
                <?php 
                if(isset($_POST['Submit']) && isset($DayOrder)){
                    
                    if($DayOrder=='CustomTT')
                        $DayOrdr = 7;
                    if($DayOrder == 'MON')
                        $DayOrdr = 1;
                    if($DayOrder == 'TUE')
                        $DayOrdr = 2;
                    if($DayOrder == 'WED')
                        $DayOrdr = 3;
                    if($DayOrder == 'THU')
                        $DayOrdr = 4;
                    if($DayOrder == 'FRI')
                        $DayOrdr = 5;
                    if($_SESSION['user'] == "eee"){
                        $temparr = array('','','',"iiatt","iibtt","iictt","iiiatt","iiibtt","iiictt","ivatt","ivbtt","ivctt");
                        $Section = 11;
                    }else{
                        $temparr = array('','','',"iiatt","iibtt","iictt","iidtt","iiiatt","iiibtt","iiictt","iiidtt","ivatt","ivbtt","ivctt","ivdtt");
                        $Section = 14;
                    }
                    
                    
                    for($u=3;$u<=$Section;$u++){
        $QueryFor[$u] = "SELECT * FROM $temparr[$u] WHERE dayorder = {$DayOrdr}";
                    }
        for($i=3;$i<=$Section;$i++){
            $Executing[$i]= mysqli_query($Connection, $QueryFor[$i]);
        } ?>
                <table class="table">
                    <tr>
                        <th>CLASS</th>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th>8</th>
                    </tr>
                   <?php
                for($i=3;$i<=$Section;$i++){
                $Data= mysqli_fetch_row($Executing[$i]);
                $Class = $Data[1];
                $FirstHr = $Data[2];
                $SecondHr = $Data[3];
                $ThirdHr = $Data[4];
                $FourthHr = $Data[5];
                $FifthHr = $Data[6];
                $SixthHr = $Data[7];
                $SeventhHr = $Data[8];
                $EightthHr = $Data[9];
            ?>
                    <tr>
                        <th><?php echo $Class;?></th>
                        <td><?php echo $FirstHr;?></td>
                        <td><?php echo $SecondHr;?></td>
                        <td><?php echo $ThirdHr;?></td>
                        <td><?php echo $FourthHr;?></td>
                        <td><?php echo $FifthHr;?></td>
                        <td><?php echo $SixthHr;?></td>
                        <td><?php echo $SeventhHr;?></td>
                        <td><?php echo $EightthHr;?></td>
                    </tr>
            <?php
                }   
        }//for isset(Submit)
?>
                </table>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
            <div class="col-lg-5 col-offset-lg-4 col-md-5 col-offset-md-4 col-sm-5 col-offset-sm-4 col-xs-5 col-offset-xs-4">
                <form action="WelcomePage.php" method="POST" style="margin:0 5% 0 5%">
                <fieldset>
                    <div class="form-group">
                        <h3>
                        <?php 
                        if(isset($_POST['Submit']) && !isset($DayOrder))
                        {echo Message();}else{echo MessagForSem();}
                        ?>
                            </h3>
                        <center><label for='DayOrder'><h2>Day : </h2></label></center>
                        <div class="input-group input-group-md">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-education text-primary"></span>
                            </span>
                            <!--<input class="form-control" type="text" id='DayOrder' name="DayOrder" placeholder="DayOrder">-->
                            <select class="form-control"id='DayOrder' name="DayOrder" style="background-color: rgba(255,255,255,0.5);">
                                <option>Day</option>
                                <option style="background-color: rgb(70,130,180);color: white;">MON</option>
                                <option style="background-color: skyblue;color: black;">TUE</option>
                                <option style="background-color: rgb(70,130,180);color: white;">WED</option>
                                <option style="background-color: skyblue;color: black;">THU</option>
                                <option style="background-color: rgb(70,130,180);color: white;">FRI</option>
                                <option style="background-color: skyblue;color: black;">CustomTT</option>
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
<?php /*            DEVELEPOR NOTES(R*)
                _______________
1) Just to View the time table & Pass the Dayorder for Updating the Students Attendance;
2) We have used SESSION['sem'] to mention weather the sem is evem or odd;
3) The Clock symbol tells us that we haven't set the semester 
4) Ther Trash Symbol is for making all the records to begin from first (SEM 1 to SEM 2);
5) The Reset or Refresh Symbol is to move from one year to another ( SEM 2- SEM -3 )
6) For more details on refresh Symbol, kindly refer the DEVELOPER NOTES(R*) of DeleteData.php
*/?>
