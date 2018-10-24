<?php
    $QueryForDayOrder = "SELECT * FROM $TimeTable WHERE dayorder='$DayOrder'";
    $ExecuteForDayOrder = mysqli_query($Connection, $QueryForDayOrder);
    $Flagii = FALSE;$Flagiii = FALSE;$Flagiv = FALSE;
  if($TimeTable == "ivatt" || $TimeTable == "ivbtt" || $TimeTable == "ivctt" || $TimeTable == "ivdtt")$Flagiv = TRUE;
  if($TimeTable == "iiiatt" || $TimeTable == "iiibtt" || $TimeTable == "iiictt" || $TimeTable == "iiidtt")$Flagiii = TRUE;
  if($TimeTable == "iiatt" || $TimeTable == "iibtt" || $TimeTable == "iictt" || $TimeTable == "iidtt")$Flagii = TRUE;
    for($i=1;$i<=$CountForSubjects;$i++){
    $Element2 = "Count".$i;
    ${$Element2} = 0;
    }
    while($tt = mysqli_fetch_array($ExecuteForDayOrder)){
        for($j=2;$j<=9;$j++){
            for($i=1;$i<=$CountForSubjects;$i++){
                $Element = "Name".$i;
                $Element2 = "Count".$i;
                if($tt[$j] == ${$Element}){${$Element2}++;}
            }
        }
    }
?>