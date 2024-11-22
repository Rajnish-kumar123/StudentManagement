<?php
    error_reporting(0);
    
    $host = "localhost";
    $user="root";
    $password = "";
    $db = "studentmanagement";
    $data = mysqli_connect($host, $user, $password, $db);

    echo "<script>connected</script>";
    if($data === false){
        die("connection error");
    }
    
?>