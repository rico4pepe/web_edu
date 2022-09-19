<?php
require_once("./MyPhpConnections/connection.php");

Class schoolTimetable{

    //private $all_user = [];

    private $Day;
    private $Hour;
    
    private $Subjects; 

    function insertTimeTable($newDay, $newSubjects, $Facilitator_ID, $newStarDate, $newEndDate){
        $Days = trim($newDay);
        $Subjects  = trim( $newSubjects);
        $facilitator = trim($Facilitator_ID);
        $Start_Time     = trim($newEndDate);
        $End_Time    = trim($newStarDate);

        $conn = connect();

       6


        $user_query  = $conn->prepare("INSERT INTO SchoolTimetable (`Days`,`Subjects`,`facilitator`,`Start_Time`,`End_Time`,`Create_At`,`Modified_At`,`Is_Deleted`) 
        VALUES ('$Days','$Subjects','$facilitator','$Start_Time','$End_Time','$created_At','$modified_At','$Is_Deleted')");

                //   $user_query->bindParam("Days", $Days);
                //  $user_query->bindParam("Subjects", $Subjects);
                //  $user_query->bindParam("facilitator", $facilitator);
                //  $user_query->bindParam("Start_Time", $Start_Time);
                //  $user_query->bindParam("End_Time", $End_Time);
                $user_query->execute();

    }


    function SelectTimeTable($newDay , $newSubjects , $Facilitator_ID , $newStarDate , $newEndDate ){
        echo "Hello first apperance....... $newDay , $newSubjects , $Facilitator_ID , $newStarDate , $newEndDate";
        $Days = trim($newDay);
        $Subjects  =  trim($newSubjects);
        $facilitator = $Facilitator_ID;
        $Start_Time    = $newEndDate;
        $End_Time    = $newStarDate;

        $conn = connect();


        echo "<br />Hello 2....... $newDay <br />";
        
        echo "SELECT   Days_DB.Name as Day, Facilitator_BD.First_Name, Facilitator_BD.Sur_Name,Subjects.Name, SchoolTimetable.Start_Time, SchoolTimetable.End_Time from SchoolTimetable
        JOIN Days_DB ON  SchoolTimetable.Days  = Days_DB.ID
        JOIN Facilitator_BD ON SchoolTimetable.facilitator = Facilitator_BD.Faciltator_ID
        JOIN Subjects ON SchoolTimetable.Subjects = Subjects.ID
       where Days_DB.Name = '   $Days'  and Subjects.Name = '$Subjects'
        ORDER BY Days_DB.Name,SchoolTimetable.Start_Time ";


echo "<br />Hello 3....... $newDay <br />";

        $sql_stmt = "SELECT   Days_DB.Name as Day, Facilitator_BD.First_Name, Facilitator_BD.Sur_Name,Subjects.Name, SchoolTimetable.Start_Time, SchoolTimetable.End_Time from SchoolTimetable
        JOIN Days_DB ON  SchoolTimetable.Days  = Days_DB.ID
        JOIN Facilitator_BD ON SchoolTimetable.facilitator = Facilitator_BD.Faciltator_ID
        JOIN Subjects ON SchoolTimetable.Subjects = Subjects.ID
       where Days_DB.Name = $Days  and Subjects.Name = $Subjects
        ORDER BY Days_DB.Name,SchoolTimetable.Start_Time; ";

        $user_query  = $conn->prepare($sql_stmt); 
       

            $user_query->execute();
    }

}
?>