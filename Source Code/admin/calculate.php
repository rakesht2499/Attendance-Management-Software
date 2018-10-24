<?php
session_start();
date_default_timezone_set("Asia/Calcutta");
$DBname = $_SESSION['Database'];
require '../Connection.php';
$Table = '';$FileName = '';
if($_SESSION['user'] == "eee"){
                                $ar = array("II-A","II-B","II-C","III-A","III-B","III-C","IV-A","IV-B","IV-C");
                                $Section = 9;
                                }else{
                                $ar = array("II-A","II-B","II-C","II-D","III-A","III-B","III-C","III-D","IV-A","IV-B","IV-C","IV-D");
                                $Section = 12;    
                                }
for($k=0;$k<$Section;$k++){
    $Table = '';
    $Year = date("Y");
    if($k == 0){
        $Table = "II-A";
        $FileName = $Table.($Year-2)."-".($Year+2)."Sem3";
    }elseif($k == 1){
        $Table = "II-B";
        $FileName = $Table.($Year-2)."-".($Year+2)."Sem3";
    }elseif($k == 2){
        $Table = "II-C";
        $FileName = $Table.($Year-2)."-".($Year+2)."Sem3";
    }elseif($k == 3){
        if($_SESSION['user'] != "eee"){
        $Table = "II-D";
        $FileName = $Table.($Year-2)."-".($Year+2)."Sem3";
        }else{
            continue;
        }
    }elseif($k == 4){
        $Table = "III-A";
        $FileName = $Table.($Year-3)."-".($Year+1)."Sem5";
    }elseif($k == 5){
        $Table = "III-B";
        $FileName = $Table.($Year-3)."-".($Year+1)."Sem5";
    }elseif($k == 6){
        $Table = "III-C";
        $FileName = $Table.($Year-3)."-".($Year+1)."Sem5";
    }elseif($k == 7){
        if($_SESSION['user'] != "eee"){
        $Table = "III-D";
        $FileName = $Table.($Year-3)."-".($Year+1)."Sem5";
        }else{
            continue;
        }
    }elseif($k == 8){
        $Table = "IV-A";
        $FileName = $Table.($Year-4)."-".($Year)."Sem7";
    }elseif($k == 9){
        $Table = "IV-B";
        $FileName = $Table.($Year-4)."-".($Year)."Sem7";
    }elseif($k == 10){
        $Table = "IV-C";
        $FileName = $Table.($Year-4)."-".($Year)."Sem7";
    }elseif($k == 11){
        if($_SESSION['user'] != "eee"){
        $Table = "IV-D";
        $FileName = $Table.($Year-4)."-".($Year)."Sem7";
        }else{
            continue;
        }
    }

$Table= str_replace("-", "", $Table);
$Table =  strtolower($Table);
$SubjectTable = substr($Table, 0, -1);
$SubjectTable.="sub"; 
$Table = $Table."_stu";
$CountForSubjects=0;
    
    $FinalContent='';
    $FinalContent.='RollNo_Name_RegNumber_';
    $Query = "SELECT * FROM subs";
    $Execute = mysqli_query($Connection, $Query);
        while($data = mysqli_fetch_assoc($Execute)){
            if(!empty($data[$SubjectTable])){
                    $FinalContent.= '';
                 $FinalContent.= $data[$SubjectTable];
                 $FinalContent.= '_';
                 $CountForSubjects++;
            }
        }
                $FinalContent.= 'Overall_';
        $QueryForTable = "SELECT * FROM $Table";
        $ExecuteForTable = mysqli_query($Connection, $QueryForTable);
        $PrevRollNo=0;
        while($Data = mysqli_fetch_array($ExecuteForTable)){
                $RollNo = $Data['rollno'];
                $Name = $Data['name'];
                $RegNo = $Data['regno'];
                if($RegNo == 0)continue;
                $QueryForDate = "SELECT * FROM $Table WHERE rollno=$RollNo";
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
                        ${$Coresp} += $Datas[$corep];
                        ${$Corest} += $Datas[$coret];
                    }
                }
                $Overallp=0;$Overallt=0;
/////////////////////////////////////////////////CALC OVERALL P & T AND MAKING THE TOTAL HOURS TO 1 IF ITS 0//////////////////////////////////////////////////////////////////
                for($i=1;$i<=$CountForSubjects;$i++){
                  $Coresp = "Core".$i."p";
                  $Corest = "Core".$i."t";
                  $Overallp+=${$Coresp};
                  $Overallt+=${$Corest};
                  if(${$Corest} == 0){${$Corest} = 1;}
                }
                if($Overallt==0){$Overallt=1;}
/////////////////////////////////////////////////////CALC THE PERCENTAGE///////////////////////////////////////////////////////////////////////
                for($i=1;$i<=$CountForSubjects;$i++){
                  $Coresp = "Core".$i."p";
                  $Corest = "Core".$i."t";
                  $Coresperc = "Core".$i."TotalPerc";
                  ${$Coresperc} = (${$Coresp}/${$Corest})*100;
                }
                $TotalPerc = ($Overallp/$Overallt)*100;
                        $TableData =$RollNo;
                        $TableData.='_';
                        $TableData.=$Name;
                        $TableData.='_';
                        $TableData.=$RegNo;
                        $TableData.='_';
                        for($i=1;$i<=$CountForSubjects;$i++){
                            $Coresperc = "Core".$i."TotalPerc";
                            $TableData.=number_format((float) ${$Coresperc}, 2, '.', '').'_';
                        }
                        $TableData.=number_format((float) $TotalPerc, 2, '.', '')."_";
                        $FinalContent.= "\n".$TableData;
                        $PrevRollNo = $RollNo;
        }
$myfile = fopen(substr($DBname,0,3)."/".$FileName, "w") or die("Unable to open file!");
fwrite($myfile, $FinalContent);
}
?>
