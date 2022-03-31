<?php
    include "db_connection.php";
    include 'getResult.php'; 
    date_default_timezone_set('Asia/Dhaka');

    $sid = $_GET['sid'];
    $semester = $_GET['semester'];
    $name = "";
    $image = "";
    $course= 0;
    $result = getOverallResult($connection, $sid); // 0.0
    
    $names = mysqli_query($connection, "select * from student where SID=$sid") or die(mysqli_error($connection));
    while($row=mysqli_fetch_array($names)){
        $name=$row["Name"];
        //$result = $row["Result"];
        $image = $row["Image"];
    }

    // $resultErr = "";

    // function input_data($data) {  
    //     $data = trim($data);  
    //     $data = stripslashes($data);  
    //     $data = htmlspecialchars($data);  
    //     return $data;  
    // }
  
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     if (empty($_POST["result"])) {  
    //         $resultErr = "result is required";  
    //       } else {  
    //         $result = input_data($_POST["result"]); 
    //         $result = getOverallResult($connection, $sid); 
    //         if ($result<"0.00" || $result>"4.00") {  
    //           $resultErr = "result must be between 0.00 and 4.00";  
    //         }
    //       }
    // }  

    


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Course Wise Result Details</title>
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

        select{
            width: 360px;
            height: 33px;
        }

        option{
            width: 360px;
            height: 33px;
        }
        .error{
            color: #FF0001;
        }
        

    </style>
</head>
<body>

<div class="container" >
    <div class="row">
    <div class="col-lg-4">
    <a href="details.php?sid=<?php echo $sid; ?>"> <button style="margin-top:10px" name="back" class="btn btn-default">Back</button> </a>
    <h3>Add a course Result</h3>
  <form action="" name="result-form" method="post">
  
    
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter naame" name="name" value="<?php echo $name; ?>" readonly>
    </div>
    <div class="form-group">
      <label for="semester">Semester:</label><br>
      <!--<input type="number" class="form-control" id="semester" placeholder="Enter nth semester(1)" name="semester"> -->
      <select name="semester" id="semester" onchange="select()">
          <option value=1 >1</option>
          <option value=2 >2</option>
          <option value=3 >3</option>
      </select>
    </div>

    <div class="form-group">
      <label for="course">Course No:</label><br>
      <select name="course" id="course"></select>   
    </div>
    
    <div class="form-group">
      <label for="result">Result:</label>
      <input type="number" step="any" class="form-control" id="result" placeholder="Enter result" name="result">
      <!--<span class="error">* <?php echo $resultErr;?></span> -->
    </div>
    
    
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
                <th>ID</th>                
                <th>Semester</th>
                <th>Course</th>
                <th>Result</th>
                <th></th>
            </tr>
            
            <tbody>
            <?php
                      

                $rows = mysqli_query($connection, "select * from course where sid=$sid and semester=$semester") or die(mysqli_error($connection));
                while($row=mysqli_fetch_array($rows)){
                    $arr = Array($row["SID"], $row["Semester"], $row["Course_Name"]);
                    $values = join(' ', $arr);
                    echo '<tr>';
                        echo "<td>"; echo $row["SID"]; echo "</td>";
                        echo "<td>"; echo $row["Semester"]; echo "</td>";
                        echo "<td>"; echo $row["Course_Name"]; echo "</td>";
                        echo "<td>"; echo $row["Result"]; echo "</td>";
                        echo '<td style="text-align:center">'; echo '<form method="post">
                    <button type="submit" name="Delete" class="btn btn-danger" value="'.$values.'">Delete</button>
                     </form></td>';
                        
                }
            
            ?>

            </tbody>
        </table>
    
    </div>
</div>



<?php

    if(isset($_POST["save"])){
        //if($resultErr==""){
            $query = mysqli_query($connection, "SELECT * FROM course WHERE sid=$sid and semester='$_POST[semester]' and
            Course_Name='$_POST[course]'");

            if (!$query)
            {
                die('Error: ' . mysqli_error($connection));
            }

            if(mysqli_num_rows($query) > 0){
                ?>
                <script>
                    //console.log($_POST['course']);
                    alert("record already exists");
                </script>
                <?php             

            }else{

                mysqli_query($connection, "insert into course values(NULL, '$sid', '$_POST[semester]', '$_POST[course]', '$_POST[result]')") or die(mysqli_error($connection));
            
                $query2 = mysqli_query($connection, "SELECT * FROM result WHERE sid=$sid and semester='$_POST[semester]'");
                if(!$query2) die(mysqli_error($connection));
                if(mysqli_num_rows($query2) == 0){
                mysqli_query($connection, "insert into result values(NULL, '$sid', '$_POST[semester]', '$_POST[result]')") or die(mysqli_error($connection));
                }
            }
            ?>
            <script type="text/javascript">
                window.location.href = window.location.href;
            </script>
            <?php
        //}
    }

    if (isset($_POST['Delete'])) {
        //If you receive the Delete post data, delete it from your table
        ?><script>//console.log("$_POST['Delete']");</script><?php
        //echo $_POST['Delete'];
        $str = explode(' ', $_POST['Delete']);
        // $delete = 'DELETE FROM result WHERE SID = ?';
        // $stmt = $connection->prepare($delete);
        // $stmt->bind_param("i", $_POST['Delete']);
        // $stmt->execute();
        //the following method is prone to sql injection attack
        mysqli_query($connection, "delete from course where SID='$str[0]' and Semester='$str[1]' and Course_Name='$str[2]'") or die(mysqli_error($connection));
        ?>
        <script type="text/javascript">
           window.location.href = window.location.href;
        </script>
        <?php
    }

?>

<script>
    function select() { // don't leak
            var elm = document.getElementById('course'); // get the select
            elm.innerHTML = "";
            
            df = document.createDocumentFragment(); // create a document fragment to hold the options while we create them
            var semester = document.getElementById('semester').value;
            //var test = document.getElementById('name').value;
            //alert(semester);
            for (var i = 1; i <= 3; i++) { // loop, i like 42.
                var option = document.createElement('option'); // create the option element
                option.value = semester*100+i; // set the value property
                option.appendChild(document.createTextNode(semester*100+i)); // set the textContent in a safe way.
                df.appendChild(option); // append the option to the document fragment
            }
            elm.appendChild(df); // append the document fragment to the DOM. this is the better way rather than setting innerHTML a bunch of times (or even once with a long string)
            }
    
    window.onload = function() {
    select();
    };

</script>




</body>
</html>
