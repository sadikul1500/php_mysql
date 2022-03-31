<?php
    include "db_connection.php";
    date_default_timezone_set('Asia/Dhaka');

    $sid = $_GET['sid'];
    $name = "";
    $image = "";
    $result = 0.0;

    $names = mysqli_query($connection, "select * from student where SID=$sid") or die(mysqli_error($connection));
    while($row=mysqli_fetch_array($names)){
        $name=$row["Name"];
        $result = $row["Result"];
        $image = $row["Image"];
    }

    function editResult($connection, $sid, $semester, $result){
      mysqli_query($connection, "update result set result='$result' where sid=$sid and semester=$semester") or die(mysqli_error($connection));

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Semester Wise Result Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
        img{
            border-radius: 50%;
        }
        button{
          width: 70px;
        }
    </style>
</head>
<body>

<div class="container" >
    
    <div class="row">
    <div class="col-lg-6" >
    
    <!-- <div class="col-lg-12"> -->  
     <h2>Semester Result Details</h2>        
        <table class="table table-hover" style="margin:50px 0px">
            
            <tr>
                <th>ID</th>                
                <th>Semester</th>
                <th>Result</th>
                
            </tr>
            
            <tbody>
            <?php
                function round_up ( $value, $precision ) { 
                  $pow = pow ( 10, $precision ); 
                  return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow; 
                }
                function getResult($connection, $sid, $semester){
                  $score = 0.0;
                  $count = 0;
                  $calculatedResult = 0.0;
                  $dbResult = 0.0;
                  $results = mysqli_query($connection, "select * from course where SID=$sid and semester=$semester") or die(mysqli_error($connection));
                  while($result=mysqli_fetch_array($results)){
                      $score += $result["Result"];
                      $count += 1;
                  }
                  if ($count<=0) return $calculatedResult;

                  $calculatedResult  = round_up($score/$count,2);
                  $dbResults = mysqli_query($connection, "select * from result where SID=$sid and semester=$semester") or die(mysqli_error($connection));  
                  while($result=mysqli_fetch_array($dbResults)){
                    $dbResult = $result["Result"];
                  }

                  if($dbResult == $calculatedResult) return $calculatedResult;
                  else editResult($connection, $sid, $semester, $calculatedResult);
                  return $calculatedResult;
                }
              
              
                $rows = mysqli_query($connection, "select * from result where sid=$sid") or die(mysqli_error($connection));
                if(mysqli_num_rows($rows) == 0 ){
                  ?>
                  <script type="text/javascript">
                    var php_var = "<?php echo $sid; ?>";
                    window.location.href = "course.php?sid="+php_var+"&semester=1";
                  </script>
                  <?php
                }
                else{
                  while($row=mysqli_fetch_array($rows)){
                      $arr = Array($row["SID"], $row["Semester"]);
                      $values = join(' ', $arr);
                      echo '<tr onclick="details(this)">';
                          echo "<td>"; echo $row["SID"]; echo "</td>";
                          echo "<td>"; echo $row["Semester"]; echo "</td>";
                          echo "<td>"; echo getResult($connection, $sid, $row["Semester"]); echo "</td>";
                      //     echo '<td style="text-align:center">'; echo '<form method="post">
                      // <button type="submit" name="Delete" class="btn btn-danger" value="'.$values.'">Delete</button>
                      // </form></td>';
                          
                  }
              }
            
            ?>

            </tbody>
        </table>
        <div class="row" style="margin:0px 2px"><a href="index.php"> <button style="margin-top:10px;float:left" name="back" class="btn btn-primary">Back</button> </a>
        
        <button name="more" class="btn btn-primary" id="showit" style="margin-top:10px; float:right">Details</button></div>

    <!--</div> -->
  </div>
  <div class="col-lg-1"></div>
  <div class="col-lg-5">
      <div style="margin:50px 0px"><img src="<?php echo $image; ?>" alt="profile picture" width="222" height="222"></div>
      <div style="margin:0px 80px"><p style="font-size:18px">Result: </p><p style="font-size:25px;font-weight:bold;"><?php echo $result;?> </p></div>
  </div>
  </div>
</div>



<div id="mytable" style="display:none;margin:5px 35px">
<h3>Course Details</h3>
      <table class="table table-hover" style="margin:50px 0px">
            
            <tr>
                <th>ID</th>                
                <th>Semester</th>
                <th>Course</th>
                <th>Result</th>
                
            </tr>
            
            <tbody>
            <?php             
              
                $rows = mysqli_query($connection, "select * from course where sid=$sid") or die(mysqli_error($connection));
                if(mysqli_num_rows($rows) == 0 ){
                  ?>
                  <script type="text/javascript">
                    var php_var = "<?php echo $sid; ?>";
                    window.location.href = "course.php?sid="+php_var+"&semester=1";
                  </script>
                  <?php
                }
                else{
                  while($row=mysqli_fetch_array($rows)){
                      $arr = Array($row["SID"], $row["Semester"]);
                      $values = join(' ', $arr);
                      echo '<tr onclick="details(this)">';
                          echo "<td>"; echo $row["SID"]; echo "</td>";
                          echo "<td>"; echo $row["Semester"]; echo "</td>";
                          echo "<td>"; echo $row["Course_Name"]; echo "</td>";
                          echo "<td>"; echo $row["Result"]; echo "</td>";
                      //     echo '<td style="text-align:center">'; echo '<form method="post">
                      // <button type="submit" name="Delete" class="btn btn-danger" value="'.$values.'">Delete</button>
                      // </form></td>';
                          
                  }
              }
            
            ?>

            </tbody>
        </table>
    

</div>


<div class="container" style="margin:20px"></div>

<div class="container">
    
</div>



<?php

    if(isset($_POST["save"])){
        mysqli_query($connection, "insert into result values(NULL,'$_POST[sid]', '$_POST[semester]', '$_POST[result]')") or die(mysqli_error($connection)); //$_POST[datetime]
        ?>
        <script type="text/javascript">
            window.location.href = window.location.href;
        </script>
        <?php
    }

    if (isset($_POST['Delete'])) {
        //If you receive the Delete post data, delete it from your table
        $str = explode(' ', $_POST['Delete']);
        // $delete = 'DELETE FROM result WHERE SID = ?';
        // $stmt = $connection->prepare($delete);
        // $stmt->bind_param("i", $_POST['Delete']);
        // $stmt->execute();
        //the following method is prone to sql injection attack
        mysqli_query($connection, "delete from result where SID='$str[0]' and semester='$str[1]'") or die(mysqli_error($connection));
        ?>
        <script type="text/javascript">
            window.location.href = window.location.href;
        </script>
        <?php
    }

?>

<script>
    function details(x){
    //alert(x.cells[0].innerHTML);
    sid = x.cells[0].innerHTML;
    semester = x.cells[1].innerHTML;
    console.log(typeof(semester));
    window.location.href = 'course.php?sid='+sid+'&semester='+semester;
  }

  $(document).ready(function(){
   $("#showit").click(function(){
       $("#mytable").css("display","block");
   });
  });
</script>



</body>
</html>
