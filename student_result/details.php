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

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Result Details</title>
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
    </style>
</head>
<body>

<div class="container" >
    <div class="row">
    <div class="col-lg-4">
    <a href="index.php"> <button style="margin-top:10px" name="back" class="btn btn-default">Back</button> </a>
    <h2>Add to Result</h2>
  <form action="" name="result-form" method="post">
  
    <!-- <div class="form-group">
      <label for="sid">Student ID:</label>
      <input type="text" class="form-control" id="sid" placeholder="Enter id" name="sid" value="<?php echo $sid; ?>" readonly>
    </div> -->
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter naame" name="name" value="<?php echo $name; ?>" readonly>
    </div>
    <div class="form-group">
      <label for="semester">Semester:</label>
      <input type="number" class="form-control" id="semester" placeholder="Enter nth semester(1)" name="semester">
    </div>
    <!-- <div class="form-group">
      <label for="age">Age:</label>
      <input type="number" class="form-control" id="age" placeholder="Enter age" name="age">
    </div>
    <div class="form-group">
      <label for="address">Address:</label>
      <input type="text" class="form-control" id="address" placeholder="Enter address" name="address">
    </div> -->
    <div class="form-group">
      <label for="result">Result:</label>
      <input type="number" step="any" class="form-control" id="result" placeholder="Enter result" name="result">
    </div>
    <!-- <div class="form-group">
      <label for="datetime">Date Created:</label>
      <input type="datetime-local" class="form-control" id="datetime" placeholder="Enter date-time" name="datetime">
    </div> -->
    
    <button type="submit" name="save" class="btn btn-primary">Add result</button>
  </form>
  </div>
  <div class="col-lg-3"></div>
  <div class="col-lg-5">
      <div style="margin:50px 0px"><img src="<?php echo $image; ?>" alt="profile picture" width="222" height="222"></div>
      <div style="margin:0px 80px">Result: <p style="font-size:25px;font-weight:bold;"><?php echo $result;?> </p></div>
  </div>
  </div>
</div>


<div class="container" style="margin:20px"></div>

<div class="container">
    <div class="col-lg-12">          
        <table class="table table-hover">
            
            <tr>
                <th>SID</th>                
                <th>Semester</th>
                <th>Result</th>
                <th></th>
            </tr>
            
            <tbody>
            <?php 
                $rows = mysqli_query($connection, "select * from result where sid=$sid") or die(mysqli_error($connection));
                while($row=mysqli_fetch_array($rows)){
                    echo '<tr>';
                        echo "<td>"; echo $row["SID"]; echo "</td>";
                        echo "<td>"; echo $row["Semester"]; echo "</td>";
                        echo "<td>"; echo $row["Result"]; echo "</td>";
                        echo '<td style="text-align:center">'; echo '<form method="post">
                    <button type="submit" name="Delete" class="btn btn-danger" value="'.$row['SID'].'">Delete</button>
                     </form></td>';
                        
                }
            
            ?>

            </tbody>
        </table>
    
    </div>
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
        $delete = 'DELETE FROM result WHERE SID = ?';
        $stmt = $connection->prepare($delete);
        $stmt->bind_param("i", $_POST['Delete']);
        $stmt->execute();
        //the following method is prone to sql injection attack
        //mysqli_query($connection, "delete from student where SID='$_POST[Delete]'") or die(mysqli_error($connection));
        ?>
        <script type="text/javascript">
            window.location.href = window.location.href;
        </script>
        <?php
    }

?>




</body>
</html>