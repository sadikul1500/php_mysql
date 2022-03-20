<?php
    include "db_connection.php";
    date_default_timezone_set('Asia/Dhaka');

    $sid = $_GET['sid'];
    $name = "";
    $age = 0;
    $address = "";
    $result = 0.0;
    //$date_time = "";

    $rows = mysqli_query($connection, "select * from student where SID=$sid");
    while($row=mysqli_fetch_array($rows)){
        $sid = $_GET['sid'];
        $name = $row["Name"];
        $age = $row["Age"];
        $address = $row["Address"];
        $result = $row["Result"];
        //$date_time = $row["Date Created"];
    }
    
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
</head>
<body>

<div class="container">
    <div class="col-lg-4">
  <h2>Add a student</h2>
  <form action="" name="student-form" method="post">
    <div class="form-group">
      <label for="sid">Student ID:</label>
      <input type="text" class="form-control" id="sid" placeholder="Enter id" name="sid" value="<?php echo $sid; ?>" readonly>
    </div>
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="<?php echo $name; ?>">
    </div>
    <div class="form-group">
      <label for="age">Age:</label>
      <input type="number" class="form-control" id="age" placeholder="Enter age" name="age" value="<?php echo $age; ?>">
    </div>
    <div class="form-group">
      <label for="address">Address:</label>
      <input type="text" class="form-control" id="address" placeholder="Enter address" name="address" value="<?php echo $address; ?>">
    </div>
    <div class="form-group">
      <label for="result">Result:</label>
      <input type="number" step="any" class="form-control" id="result" placeholder="Enter result" name="result" value="<?php echo $result; ?>">
    </div>
    <!-- <div class="form-group">
      <label for="datetime">Date Created:</label>
      <input type="datetime-local" class="form-control" id="datetime" placeholder="Enter date-time" name="datetime">
    </div> -->
    
    <button type="submit" name="update" class="btn btn-default">Update</button>
  </form>
  </div>
</div>

<?php
    if(isset($_POST['update'])){
        $date_time = date('Y-m-d H:i:s');
        mysqli_query($connection, "update student set name='$_POST[name]', age='$_POST[age]', address='$_POST[address]', result='$_POST[result]',
        `date created`='$date_time' where sid=$sid") or mysqli_error($connection);
        
         ?>
          <script type=text/javascript>
            window.location = "index.php";
        </script>
         <?php
    }

?>

</body>
</html>
