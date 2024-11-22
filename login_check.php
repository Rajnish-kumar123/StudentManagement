<?php
    
    session_start();


    include("db_connection.php");

    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        $name = $_POST['username'];
        $password = $_POST['password'];

        $sql = "select * from user where username='".$name."' AND password='".$password."' ";

        $result = mysqli_query($data, $sql);

        $row = mysqli_fetch_array($result);

        if($row["usertype"]=="student"){
            $_SESSION['username']=$name;
            $_SESSION['usertype']="student";
            header("location:studenthome.php");
        }
        elseif($row["usertype"]=="admin"){
            $_SESSION['username']=$name;
            $_SESSION['usertype']="admin";
            header("location:adminhome.php");
        }else{
            $message= "Username or Password do not match";
            $_SESSION['loginMessage'] = $message;
            header("location:login.php");
        }
    }
?>