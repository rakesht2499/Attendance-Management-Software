<?php session_start();
require_once 'CheckLogin.php';
$_SESSION['UserName']=" ";
$_SESSION['pass']=" ";
$Message = "";
if(isset($_POST['Submit'])){
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    if(empty($Username) || empty($Password))
    {
     $_SESSION['ErrorMessage'] = "Both the fields are compulsory";
    }else{
        $Database = GetDatabase($Username,$Password);
        $Username_check_admin = substr($Username, 3);
        if($Username_check_admin == "admin"){
        $AdCode = substr($Database, -16,-12);
        $Database = substr($Database, 0,-16). substr($Database, -12);
        $_SESSION['adcode'] = $AdCode;
        }else{
            $_SESSION['adcode']='';
        }
        $_SESSION['Database'] = $Database;
        if($Database == null){
            $_SESSION['ErrorMessage'] = "No Such Account Found. Please Enter the Correct Username & Password";
        }else{
            if($_SESSION['adcode'] == "done"){
             $_SESSION['user'] = $Username;
            header("Location:admin/WelcomeAdmin.php");
            }else{
            $_SESSION['user'] = $Username;
            header("Location:tableset.php");
            }
            }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="STYLESHEET/LoginPageStyle.css" >
        <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
         <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LOGIN</title>
        
    </head>
    <body>
        <div class="container-fluid">
            <center>
                <img src="Images/VEC-LOGO.jpg" class="img-responsive" width="80%">
            </center>
        </div>
        <br><br><br>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-1"><!--FOR SPACING--></div>
        <div class="container col-md-4 col-lg-4 col-sm-4 col-xs-10">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h2 class="panel-title"><strong>WELCOME BACK!!!</strong></h2>
                    </div><!--CLOSING PANEL HEADING-->
                    <div class="panel-body">
                        <form action="Login.php" method="post">
                            <fieldset>
                              <br>
                                <div class="form-group">
                                    <?php 
                                          echo Message();
                                          echo SuccessMessage();
                                    ?>
                                    <label for="Username"><span class="FieldInfo">UserName:</span></label>
                                        <div class="input-group input-group-md">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-envelope text-primary"></span>
                                            </span>
                                            <input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
                                        </div>	
                                </div>
                              <br>              
                                <div class="form-group">
                                    <label for="Password"><span class="FieldInfo">Password:</span></label>
                                        <div class="input-group input-group-md">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-lock text-primary"></span>
                                            </span>
                                            <input class="form-control" type="Password" name="Password" id="Password" placeholder="Password">
                                        </div>	
                                </div>
                              <br>
                                <center>
                                    <input class="btn btn-info btn-lg" type="Submit" name="Submit" value=" Login ">
                                </center>              
                            </fieldset>
                        </form>
                    </div>
                    <div class="panel-footer">                    
                    </div>
                </div><!-- CLOSING PANEL CLASS -->
            </div><!--CLOSING CONTAINER CLASS-->
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-1"><!--FOR SPACING--></div>
    </body>
</html>
<!-- DEVELOPED BY RAKESH KUMAR T -->