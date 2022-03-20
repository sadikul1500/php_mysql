<?php
    include "db_connection.php";
    //include "index.php";
    //echo $del;
    //mysqli_query($connection, "delete ")
    $sid = $_GET['sid'];
    mysqli_query($connection, "delete from student where SID=$sid") or die(mysqli_error($connection));
?>

<script type=text/javascript>
    window.location = "index.php";
</script>