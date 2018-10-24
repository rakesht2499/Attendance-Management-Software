<?php
function Message(){
    if(isset($_SESSION["ErrorMessage"])){
       $Output="<div class=\"alert alert-danger\" style=\"font-size:0.7em; \"><center>" ;
       $Output.=htmlentities($_SESSION["ErrorMessage"]);
       $Output.="</center></div>";
       $_SESSION["ErrorMessage"]=null;
       return $Output;  
    }
}
function MessagForSem(){
    if(isset($_SESSION["SemMessage"])){
       $Output="<div class=\"alert alert-warning\" style=\"font-size:0.7em; \"><center>" ;
       $Output.=htmlentities($_SESSION["SemMessage"]);
       $Output.="</center></div>";
       $_SESSION["SemMessage"]=null;
       return $Output;  
    }
}
function SuccessMessage(){
    if(isset($_SESSION["SuccessMessage"])){
       $Output="<div class=\"alert alert-success\" style=\"font-size:0.7em; \"><center><strong>" ;
       $Output.=htmlentities($_SESSION["SuccessMessage"]);
       $Output.="</strong></center></div>";
       $_SESSION["SuccessMessage"]=null;
       return $Output;  
    }
}
function GetDatabase($Username,$Password){
    $DB = null;
    //$Connection = mysqli_connect("localhost", "root", "", "login");
    $Connection = mysqli_connect("faith", "rjapvirg", "intrigueengineering", "rjapvirg_eeedepttrial");
    $QueryForDataBase = "SELECT * FROM check_login";
    $ExecuteForDataBaseQuery = mysqli_query($Connection, $QueryForDataBase);
    while($DataForDB = mysqli_fetch_array($ExecuteForDataBaseQuery)){
        if($DataForDB['username']==$Username && $DataForDB['password']==$Password)
        $DB = $DataForDB['database'];
    }
    if(is_null($DB)){
        $_SESSION['Login'] = "Fail";
        return null;
    } else {
        $_SESSION['Login']="Success";
        return $DB;
     }
}
?>