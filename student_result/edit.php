<?php
    include "db_connection.php";
    date_default_timezone_set('Asia/Dhaka');

    $sid = $_GET['sid'];
    $name = "";
    $age = "";
    $address = "";
    $result = 0.0;
    $image = "";

    $rows = mysqli_query($connection, "select * from student where SID=$sid");
    while($row=mysqli_fetch_array($rows)){
        $sid = $_GET['sid'];
        $name = $row["Name"];
        $age = $row["Age"];
        $address = $row["Address"];
        $result = $row["Result"];
        $image = $row["Image"];
    }

    $nameErr = $ageErr = $addressErr = "";

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
    .error{
      color:#FF0001;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-lg-4">
  <h2>Add a student</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="edit-form" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="sid">Student ID:</label>
      <input type="text" class="form-control" id="sid" placeholder="Enter id" name="sid" value="<?php echo $sid; ?>" readonly>
    </div>
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="<?php echo $name; ?>">
      <span class="error">* <?php echo $nameErr; ?> </span>
    </div>
    <div class="form-group">
      <label for="age">Age:</label>
      <input type="number" class="form-control" id="age" placeholder="Enter age" name="age" value="<?php echo $age; ?>">
      <span class="error">* <?php echo $ageErr; ?> </span>
    </div>
    <div class="form-group">
      <label for="address">Address:</label>
      <input type="text" class="form-control" id="address" placeholder="Enter address" name="address" value="<?php echo $address; ?>">
      <span class="error">* <?php echo $addressErr; ?> </span>
    </div>
    <div class="form-group">
      <label for="image">Image:</label>
      <input type="file" class="form-control" id="file" name="file">
    </div>
    
    <button type="submit" name="update" class="btn btn-default">Update</button>
  </form>
  </div>
  <div class="col-lg-3"></div>
  <div class="col-lg-5">
    <div style="margin:50px 0px"><img src="<?php echo $image;?>" height="250" width="250" alt="profile picture"></div>
    
    <div><p style="font-size:18px">Result: </p><p style="font-size:25px;font-weight:bold;"><?php echo $result;?> </p></div>

  </div>
  </div>
</div>

<?php
    if(isset($_POST['update'])){
      if($nameErr=="" && $ageErr=="" && $addressErr==""){
        $unique_key = md5(time());
        $file_name = $_FILES["file"]["name"];
        $date_time = date('Y-m-d H:i:s');

        if($file_name==""){
          mysqli_query($connection, "update student set name='$_POST[name]', age='$_POST[age]', address='$_POST[address]', 
            `date created`='$date_time' where sid=$sid") or die(mysqli_error($connection));
        }
        else{
          $destination = './images/'.$unique_key.$file_name;
          $destination_for_table = 'images/'.$unique_key.$file_name;
          move_uploaded_file($_FILES["file"]["tmp_name"], $destination);

          mysqli_query($connection, "update student set name='$name', age='$age', address='$address',
            `date created`='$date_time', image='$destination_for_table' where sid=$sid") or die(mysqli_error($connection));
        }           
        
        ?>
          <script type=text/javascript>
            // window.location.href=window.location.href;
            // alert('updated successfully');
            window.location = "index.php";
        </script>
         <?php
      }
    }

?>

</body>
</html>
