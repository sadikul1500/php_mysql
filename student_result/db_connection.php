<?php
    $connection = mysqli_connect("localhost", "root", "") or die(mysqli_error($connection));
    mysqli_select_db($connection, "Student_result") or die(mysqli_error($connection));
?>