<?php
    include "db_connection.php";
    include 'getResult.php';
    date_default_timezone_set('Asia/Dhaka');

    $nameErr = $sidErr = $ageErr = $addressErr = $ImageErr = "";
    $name = $sid = $age = $address = $image = "";

    function input_data($data) {  
      $data = trim($data);  
      $data = stripslashes($data);  
      $data = htmlspecialchars($data);  
      return $data;  
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {  
      //name validation
      if (empty($_POST["name"])) {  
        $nameErr = "Name is required";  
      } else {  
          $name = input_data($_POST["name"]);  
           // check if name only contains letters and whitespace  
           if (!preg_match("/^[a-zA-Z ]*$/",$name)) {  
               $nameErr = "Only alphabets and white space are allowed";  
           }  
      }
      
      //id validation
      if (empty($_POST["sid"])) {  
        $sidErr = "Student Id is required";  
      } else {  
        $sid = input_data($_POST["sid"]);  
        // check if mobile no is well-formed  
        if (!preg_match ("/^[0-9]*$/", $sid) ) {  
        $sidErr = "Only numeric value is allowed.";  
        }  
        //check mobile no length should not be less and greator than 10  
        if (strlen ($sid) != 4) {  
        $sidErr = "Student Id must contain 4 digits.";  
        }  
      }
      
      if (empty($_POST["age"])) {  
        $ageErr = "Age is required";  
      } else {  
        $age = input_data($_POST["age"]);  
        if ($age<"18" || $age>="30") {  
          $ageErr = "Age must be between 18 and 30.";  
        }
      }

      if (empty($_POST["address"])) {  
        $addressErr = "Address is required";  
      } else {  
        $address = input_data($_POST["address"]);  
      }
    
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
        button{
          width: 70px;
        }
        .error{
          color: #FF0001;
        } 
    </style>
</head>
<body>

<div class="container" >
    <div class="col-lg-4">
  <h2>Add a student</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="student-form" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="sid">Student ID:</label>
      <input type="text" class="form-control" id="sid" placeholder="Enter id" name="sid">
      <span class="error">*<?php echo $sidErr; ?> </span> 
    </div>
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
      <span class="error">*<?php echo $nameErr; ?> </span> 
    </div>
    <div class="form-group">
      <label for="age">Age:</label>
      <input type="number" class="form-control" id="age" placeholder="Enter age" name="age">
      <span class="error">*<?php echo $ageErr; ?> </span> 
    </div>
    <div class="form-group">
      <label for="address">Address:</label>
      <input type="text" class="form-control" id="address" placeholder="Enter address" name="address">
      <span class="error">* <?php echo $addressErr; ?> </span> 
    </div>
    <div class="form-group">
      <label for="image">Image:</label>
      <input type="file" class="form-control" id="file" name="file">
    </div>
    <!--<div class="form-group">
      <label for="result">Result:</label>
      <input type="number" step="any" class="form-control" id="result" placeholder="Enter result" name="result">
    </div>
     <div class="form-group">
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
            echo '<tr onclick="details(this)">';
                echo "<td>"; echo $row["SID"]; echo "</td>";
                echo "<td>"; echo $row["Name"]; echo "</td>";
                echo "<td>"; echo $row["Address"]; echo "</td>";
                echo "<td>"; echo getOverallResult($connection, $row["SID"]); echo "</td>";
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
    
    if(isset($_POST["save"])){

      if($sidErr=="" && $nameErr=="" && $ageErr=="" && $addressErr==""){

        $unique_key = md5(time());
        $file_name = $_FILES["file"]["name"];
        $destination = './images/'.$unique_key.$file_name;
        $destination_for_table = 'images/'.$unique_key.$file_name;
        move_uploaded_file($_FILES["file"]["tmp_name"], $destination);
        $res = getOverallResult($connection, $_POST["sid"]);

        $date_time = date('Y-m-d H:i:s');
        mysqli_query($connection, "insert into student values('$sid', '$name', '$age', '$address',
        '$res', '$date_time', '$destination_for_table')") or die(mysqli_error($connection)); //$_POST[datetime]
        ?>
        <script type="text/javascript">
            window.location.href = window.location.href;
        </script>
        <?php
      }
    }

    if (isset($_POST['Delete'])) {
        // If you receive the Delete post data, delete it from your table
        // $delete = 'DELETE FROM student WHERE SID = ?';
        // $stmt = $connection->prepare($delete);
        // $stmt->bind_param("i", $_POST['Delete']);
        // $stmt->execute();
        mysqli_query($connection, "delete from student where SID='$_POST[Delete]'") or die(mysqli_error($connection));
        mysqli_query($connection, "delete from result where SID='$_POST[Delete]'") or die(mysqli_error($connection));
        mysqli_query($connection, "delete from course where SID='$_POST[Delete]'") or die(mysqli_error($connection));
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
    window.location.href = 'details.php?sid='+sid;
  }
</script>

<!-- <div id="delete"></div>
<script>
    function func(){
        $('#delete').load('delete_record.php')
    }
</script> -->
</body>
</html>
