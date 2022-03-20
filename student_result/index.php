<?php
    include "db_connection.php";
    date_default_timezone_set('Asia/Dhaka');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Result</title>
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
    </style>
</head>
<body>

<div class="container" >
    <div class="col-lg-4">
  <h2>Add a student</h2>
  <form action="" name="student-form" method="post">
    <div class="form-group">
      <label for="sid">Student ID:</label>
      <input type="text" class="form-control" id="sid" placeholder="Enter id" name="sid">
    </div>
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
    </div>
    <div class="form-group">
      <label for="age">Age:</label>
      <input type="number" class="form-control" id="age" placeholder="Enter age" name="age">
    </div>
    <div class="form-group">
      <label for="address">Address:</label>
      <input type="text" class="form-control" id="address" placeholder="Enter address" name="address">
    </div>
    <div class="form-group">
      <label for="result">Result:</label>
      <input type="number" step="any" class="form-control" id="result" placeholder="Enter result" name="result">
    </div>
    <!-- <div class="form-group">
      <label for="datetime">Date Created:</label>
      <input type="datetime-local" class="form-control" id="datetime" placeholder="Enter date-time" name="datetime">
    </div> -->
    
    <button type="submit" name="save" class="btn btn-primary">Save</button>
  </form>
  </div>
</div>

<div class="container" style="margin:20px"></div>
<div class="container">
<div class="col-lg-12">

              
  <table class="table table-hover">
    
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Address</th>
        <th>Result</th>
        <th></th>
        <th></th>
    </tr>
    
    <tbody>
      <?php 
        $rows = mysqli_query($connection, "select * from student");
        $sid = "";
        while($row=mysqli_fetch_array($rows)){
            //$sid = $row["SID"];
            echo "<tr>";
                echo "<td>"; echo $row["SID"]; echo "</td>";
                echo "<td>"; echo $row["Name"]; echo "</td>";
                echo "<td>"; echo $row["Address"]; echo "</td>";
                echo "<td>"; echo $row["Result"]; echo "</td>";
                echo '<td style="text-align:center">'; ?> <a href="edit.php?sid=<?php echo $row["SID"]; ?>">
                <button type="button" class="btn btn-success">Edit</button></a> <?php echo "</td>";

                // echo "<td>"; echo '<form method="post">
                //     <button type="submit" name="Delete" class="btn btn-danger" value="'.$row['SID'].'">Delete</button>
                //     </form></td>';
                
                echo '<td style="text-align:center">'; ?> <a href="delete_record.php?sid=<?php echo $row["SID"]; ?>">
                <button type="button" class="btn btn-danger">Delete</button></a> <?php echo "</td>";
            echo "</tr>";
            // if(isset($_POST['$sid'])){
            //     mysqli_query($connection, "delete from student where SID=$sid") or die(mysqli_error($connection));
            //     //echo $row["SID"];
                
            // }
            // else{
            //     echo 'did not work';
            // }
        }
      
      ?>

    </tbody>
  </table>
    
</div>
</div>

<?php
    //echo DateTime();
    if(isset($_POST["save"])){
        //echo "Sadii";
        $date_time = date('Y-m-d H:i:s');
        mysqli_query($connection, "insert into student values('$_POST[sid]', '$_POST[name]', '$_POST[age]', '$_POST[address]',
        '$_POST[result]', '$date_time')") or die(mysqli_error($connection)); //$_POST[datetime]
        ?>
        <script type="text/javascript">
            window.location.href = window.location.href;
        </script>
        <?php
    }
    if (isset($_POST['Delete'])) {
        // If you receive the Delete post data, delete it from your table
        // $delete = 'DELETE FROM student WHERE SID = ?';
        // $stmt = $connection->prepare($delete);
        // $stmt->bind_param("i", $_POST['Delete']);
        // $stmt->execute();
        mysqli_query($connection, "delete from student where SID='$_POST[Delete]'") or die(mysqli_error($connection));
        ?>
        <script type="text/javascript">
            window.location.href = window.location.href;
        </script>
        <?php
    }
    
?>

<!-- <div id="delete"></div>
<script>
    function func(){
        $('#delete').load('delete_record.php')
    }
</script> -->
</body>
</html>
