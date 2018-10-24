<?php session_start();
require_once 'CheckLogin.php';
if(isset($_POST['Submit'])){
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    $Password2 = $_POST['Password2'];
    if(empty($Username) || empty($Password) || empty($Password2))
    {
     $_SESSION['ErrorMessage'] = "Both the fields are compulsory";
    }else{
        if($Password == $Password2){
        $Connection = mysqli_connect("faith", "rjapvirg", "intrigueengineering","rjapvirg_eeedepttrial" );
        $store = "rjapvirg_eeedepttrial";
        $query = "INSERT INTO check_login VALUES('".$Username."','".$Password."','".$store."')";
        $Execute = mysqli_query($Connection,$query);
        }else{
            echo "<div class='alert alert-danger' style='width:100%'>PASSWORD MISMATCH</div>";
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
        <title>REGISTER</title>
        
    </head>
    <body>
        <div class="container-fluid">
            <center>
                <img src="Images/VEC-LOGO.jpg" class="img-responsive" width="80%">
            </center>
        </div>
        <br><br><br>
        <div class="col-lg-4 col-md-3 col-sm-3 col-xs-1"><!--FOR SPACING--></div>
        <div class="container col-md-6 col-lg-4 col-sm-6 col-xs-10">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h2 class="panel-title"><strong><span class="glyphicon glyphicon-hand-right"></span>&nbsp;&nbsp;&nbsp; REGISTER HERE &nbsp;&nbsp;&nbsp;<span class="	glyphicon glyphicon-hand-left"></span></strong></h2>
                    </div><!--CLOSING PANEL HEADING-->
                    <div class="panel-body">
                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF'])?>" method="post">
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
                                <div class="form-group">
                                    <label for="Password"><span class="FieldInfo">Password:</span></label>
                                        <div class="input-group input-group-md">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-lock text-primary"></span>
                                            </span>
                                            <input class="form-control" type="Password" name="Password" id="Password" placeholder="Password">
                                        </div>	
                                </div>
                                <span id="DisplayError" class='alert alert-danger' style="display:none">Password Mismatch</span>
                                 <div class="form-group">
                                    <label for="Password"><span class="FieldInfo">Confirm Password:</span></label>
                                        <div class="input-group input-group-md">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-lock text-primary"></span>
                                            </span>
                                            <input class="form-control" type="Password" name="Password2" id="Password2" onchange="DisplayButton()" placeholder="Password">
                                        </span></div>
                                </div>
                              <br>
                              <script>
                              function DisplayButton(){
                                  var pass1 = document.getElementById("Password").value;
                                  var pass2 = document.getElementById("Password2").value;
                                  if(pass1 != pass2){
                                      document.getElementById("registerbtn").disabled = true;
                                      document.getElementById("DisplayError").style.display = "block";
                                  }else{
                                      document.getElementById("registerbtn").disabled = false;
                                      document.getElementById("DisplayError").style.display = "none";
                                  }
                              }
                              </script>
                                <center>
                                    <div id="divforsubmit"><input class="btn btn-info btn-lg" type="Submit" name="Submit" id="registerbtn" value=" Login "></div>
                                </center>              
                            </fieldset>
                        </form>
                    </div>
                    <div class="panel-footer">                    
                    </div>
                </div><!-- CLOSING PANEL CLASS -->
            </div><!--CLOSING CONTAINER CLASS-->
        <div class="col-lg-4 col-md-3 col-sm-3 col-xs-1"><!--FOR SPACING--></div>
    </body>
</html>
<!-- DEVELOPED BY RAKESH KUMAR T -->