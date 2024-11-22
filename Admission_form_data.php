<?php
    include("db_connection.php");
    session_start();

    if(isset($_POST['apply'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];
        

        $sql = "INSERT INTO admissionform(name,email,phone,message) VALUES('$name', '$email', '$phone', '$message')";

        $result = mysqli_query($data, $sql);
        if($result){
            $_SESSION['message'] = "Your Application Submited Successfully";
            header("location:index.php");
        }else{
            echo "Apply Failed";
        }

    }

?>