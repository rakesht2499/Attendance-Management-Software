<?php
$TableTemp = $Table;
$Table= str_replace("-", "", $Table);
$Table =  strtolower($Table);
$SubjectTable = substr($Table, 0, -1);
$SubjectTable.="sub";
$Table = $Table."_stu";
$Flagii =FALSE;$Flagiii=FALSE;$Flagiv=FALSE;
    $CountForSubjects=0;
    $Count = 0;
    $Query = "SELECT * FROM subs";
    $Execute = mysqli_query($Connection, $Query);
        while($data = mysqli_fetch_assoc($Execute)){
            if(!empty($data[$SubjectTable])){
                $Name[$Count++] = $data[$SubjectTable];
                $CountForSubjects++;
            }else{
                $Name[$Count++] = " ";
            }
        }
        
        for($i=1;$i<=15;$i++){
            $Element = "Name".$i;
            ${$Element} = NULL;
        }
        for($i=1;$i<=$CountForSubjects;$i++){
            $Element = "Name".$i;
            ${$Element} = $Name[$i-1];
        }
?>