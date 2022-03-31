<?php
    include "db_connection.php";

    function round_up ( $value, $precision ) { 
        $pow = pow ( 10, $precision ); 
        return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow; 
    }
    
    function getOverallResult($connection, $sid){
        $score = 0.0;
        $count = 0;
        $calculatedResult = 0.0;
        $dbResult = 0.0;
        $results = mysqli_query($connection, "select * from result where SID=$sid") or die(mysqli_error($connection));
        while($result=mysqli_fetch_array($results)){
          $score += $result["Result"];
          $count += 1;
        }
        if ($count<=0) $calculatedResult = 0.0;
        else $calculatedResult = round_up($score/$count,2);
        $dbResults = mysqli_query($connection, "select * from student where SID=$sid") or die(mysqli_error($connection));  
        while($result=mysqli_fetch_array($dbResults)){
          $dbResult = $result["Result"];
        }
  
        if($dbResult == $calculatedResult) return $calculatedResult;
        else editResult($connection, $sid, $calculatedResult);
        return $calculatedResult;  
    }

    function editResult($connection, $sid, $result){
        ?><script>console.log('called');</script><?php
        mysqli_query($connection, "update student set result='$result' where sid=$sid") or die(mysqli_error($connection));
  
    }

?>
