<?php session_start();
$_SESSION['edit'] = 0;
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
$DayOrder = $_GET['dayorder'];
if($_SESSION['dayorders'] == $DayOrder){}else{
header("Location:WelcomePage.php");
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
                0%{
                    transform: translate(0px);
                }
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
                
                0%{
                    background-color: rgba(70,130,180,0.8);
                    color: white;
                    transform: scale(1,1);
                }
                100%{
                    background-color: rgba(70,130,180,0.8);
                    color: white;
                    transform: scale(1.15,1.15);
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
            <div class="row" style="position: fixed;" >
            <ul id="SideArea" class="nav nav-pills nav-stacked">
                <br>
                <li><a href="WelcomePage.php">
                    <span class="glyphicon glyphicon-calendar"></span>
                    &nbsp;TIME-TABLE
                </a></li>
                <li class="active"><a href="Update.php?dayorder=<?php echo $DayOrder;?>">
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
        <!--********************************************MAIN AREA ************************************************ -->
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
            <div style="position: fixed;right:0;top:0;color: #269abc;padding-right: 1%"><h3><?php echo date("l");?></h3></div>
            <div style="position: fixed;left:0;top:0;color: #269abc;padding-left: 1%;"><h3><?php echo date("d F Y");?></h3></div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">  
                <form action="Update.php?dayorder=<?php echo $DayOrder;?>" method="POST" >
                <fieldset>
                    <br><br>
                    <div class="form-group">
                        <center><label for='Class'><h2>Year & Sec:</h2></label></center>
                        <div class="input-group input-group-md">
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
                    </div>
                    <center>
                        <input class="btn btn-info btn-md" type="Submit" name="Submit" value="Submit">
                    </center> 
                </fieldset>
            </form>
        </div>
                            
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <?php 
          
//Here we will get into the display part of the table If the Session is already set(Started updating any class) or if we submit from the options 
            if(isset($_POST['Submit']) || isset($_SESSION['clas'])){
//Using a Temperory variable for checking the condition only when we get the value in the <select> field and when we Press Submit/////////////////////
                if(isset($_POST['Class']))
                    $TempVar = $_POST['Class'];
                else
                    $TempVar = '';
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
               if($TempVar =="Year-Sec" && isset($_POST['Submit'])){
               echo '<br><br><div class="alert alert-danger" style="font-size:0.7em;"><center><h4>Enter a Valid Year & Section</h4></center></div>';
                }else{
//////////////Fetching the table by Checking weather we came after updating a specific class or we are using Submit to fetch the data//////////////////////
                   if(!isset($_POST['Submit']) && isset($_SESSION['clas'])){
                       $Table = $_SESSION['clas'];
                   }
                   if(isset($_POST['Submit']) && $_POST['Class']!="Year-Sec"){
             $Table = $_POST['Class'];
               }
               
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
             $SendTable = $Table;
            $Table= str_replace("-", "", $Table);
           $Table = strtolower($Table);
           $Table = $Table."_stu";
            $QueryForTable = "SELECT * FROM $Table";
 $ExecuteForTable = mysqli_query($Connection, $QueryForTable);
     if(mysqli_fetch_assoc($ExecuteForTable)){
 /////////As we have the table name in the format classsec_stu in database////////////////////
                ?>
            <div class="table-respondive" style="margin:10% 5% 20% 5%;">
                    <div class="alert alert-success" style="font-size:0.7em;"><center>            
                            <h3>Data's Sucessfully Fetched for <?php 
                            
//////////////////////////////////////////For displaying the success message////////////////////////
                            //We should display this only when we submit & its not equal to Year-Sec
                            if(isset($_POST['Submit']) && $_POST['Class']!="Year-Sec"){
                            echo $_POST['Class'];
                            }
                            //Here We should print the session only when the Submit is not done and the session is set
                            if(!isset($_POST['Submit']) && isset($_SESSION['clas'])){
                                echo $_SESSION['clas'];
                            }
////////////////////////////////////////////////////////////////////////////////////////////////////////
                            ?>
                </h3>
                </center>
                    </div>
                <table class="table">
                    <tr>
                        <th>ROLL NUMBER</th>
                        <th>NAME</th>
                        <th>REGISTER NUMBER </th>
                        <th>LAST UPDATED</th>
                        <th>UPDATE</th>
                    </tr>
                     <?php
 $QueryForTable = "SELECT * FROM $Table";
 $ExecuteForTable = mysqli_query($Connection, $QueryForTable);
 $PrevRollNo = 0;
 while($Data = mysqli_fetch_array($ExecuteForTable)){
     $RollNo = $Data['rollno'];
     $Name = $Data['name'];
     $RegNo = $Data['regno'];
     $LastUpdated = $Data['lastupdated'];
     if($RegNo == 0){
         continue;
     }
      $Query = "SELECT * FROM $Table WHERE rollno=$RollNo";
 $Execute = mysqli_query($Connection, $Query);
 $PrevDate='0';
 while($Datas = mysqli_fetch_array($Execute)){
     if($PrevDate < $Datas['lastupdated']){
        $LastUpdated = $Datas['lastupdated'];
     }else{
        continue;
     }
     $PrevDate = $Datas['lastupdated'];
     $Month = $LastUpdated[2].$LastUpdated[3];
     switch ($Month){
         case '01': $Month = "January";break;
         case '02': $Month = "Febuary";break;
         case '03': $Month = "March";break;
         case '04': $Month = "April";break;
         case '05': $Month = "May";break;
         case '06': $Month = "June";break;
         case '07': $Month = "July";break;
         case '08': $Month = "August";break;
         case '09': $Month = "September";break;
         case '10': $Month = "October";break;
         case '11': $Month = "November";break;
         case '12': $Month = "December";break;
     }
     $LastUpdated = $LastUpdated[4].$LastUpdated[5]." ".$Month." ".$LastUpdated[0].$LastUpdated[1];
     $Date = $LastUpdated[0].$LastUpdated[1];
 }
                    $Display = '<tr><th>'.$RollNo.'</th><td>'.$Name.'</td><td>'.$RegNo.'</td><td>'.$LastUpdated.'</td><td>';
                     $RollNo = "9wp2".substr($RollNo,0,2)."9ywa".substr($RollNo,2,2)."35ui".substr($RollNo,4,2)."08ww";
                    $Display.='<a href="NewUserTry.php?roll='.$RollNo.'&table='.$SendTable.'&dayorder='.$DayOrder.'" ><input ';
                    if($Date == date("d"))
                        $Display.="disabled";
                    $Display.=' type="Submit" name="Update" id="Update" value="UPDATE" class="btn ';
                    if($Date == date("d"))$Display.='btn-success';else $Display.='btn-info';
                    $Display.='"></a></td></tr>';
                    echo $Display;
 }
 echo '</table></div>';
 }else{
                    echo '<br><br><br><div class="alert alert-danger" style="font-size:0.7em;">
                    <center><h4>No Data Entered For the Above Mentioned Class</h4></center>
                    </div>';
                }
//***********************************End of TABLE RESPONSIVE DIV TAG***************************************-->
                   }//else part for YEAR-SEC
                   }//end of submit
                   ?>
   </div>
        </div>
        </div>
    </body>
</html>
<!-- DEVELOPED BY RAKESH KUMAR T -->
<?php
/*            DEVELEPOR NOTES(R*)
                _______________
1) To update the  Attendance based on the dayorder We Got;
2) We passed dayorder to all pages as we may go to update.php page from any page and may to update;
3) As we already got the dayorder from WelcomePage.php, we should not re-enter the dayorder;
4) Rest of the details are given below in independant comments for each complex step;
*/
?>