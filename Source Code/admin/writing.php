  <?php 
  $Connection = mysqli_connect("localhost", "root", "", "eeedepts");
  for($k=0;$k<6;$k++){
    $Year = date("Y");
    if($k == 0){
        $Table = "II-A";
        $FileName = $Table.($Year-2)."-".($Year+2)."Sem4";
    }elseif($k == 1){
        $Table = "II-B";
        $FileName = $Table.($Year-2)."-".($Year+2)."Sem4";
    }elseif($k == 2){
        $Table = "III-A";
        $FileName = $Table.($Year-3)."-".($Year+1)."Sem6";
    }elseif($k == 3){
        $Table = "III-B";
        $FileName = $Table.($Year-3)."-".($Year+1)."Sem6";
    }elseif($k == 4){
        $Table = "IV-A";
        $FileName = $Table.($Year-4)."-".($Year)."Sem8";
    }elseif($k == 5){
        $Table = "IV-B";
        $FileName = $Table.($Year-4)."-".($Year)."Sem8";
    }
    require '../subjects.php';
    $FinalContent='';$TableData='';
                $FinalContent.='RollNo_Name_RegNumber_';
                for($i=1;$i<=$CountForSubjects;$i++){
                    $Names = "Name".$i;
                    $FinalContent.= '';
                    $FinalContent.= ${$Names};
                    $FinalContent.= '_';
                }
                $FinalContent.= 'Overall_';
        $QueryForTable = "SELECT * FROM $Table";
        $ExecuteForTable = mysqli_query($Connection, $QueryForTable);
        $PrevRollNo=0;
        while($Data = mysqli_fetch_array($ExecuteForTable)){
                $RollNo = $Data['rollno'];
                if($RollNo < $PrevRollNo)break;
                $QueryForDate = "SELECT * FROM $Table";
                $Execute = mysqli_query($Connection, $QueryForDate);
                $Name = $Data['name'];
                $RegNo = $Data['regno'];
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
                        $TableData.=$RollNo;
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
$myfile = fopen($FileName, "w") or die("Unable to open file!");
fwrite($myfile, $FinalContent);
}
?>