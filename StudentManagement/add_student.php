<?php
session_start();

    if(!isset($_SESSION['username'])){
        header("location:login.php");
    }elseif($_SESSION['usertype']=='student'){
        header("location:login.php");
    }

    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "studentmanagement";

    $data = mysqli_connect($host, $user, $password, $db);

    if(isset($_POST['add_student'])){
        $username=$_POST['name'];
        $user_email=$_POST['email'];
        $phone=$_POST['phone'];
        $password=$_POST['password'];
        $usertype="student";

        $check = "SELECT * FROM user WHERE username='$username' ";
        $check_user = mysqli_query($data, $check);

        $row_count = mysqli_num_rows($check_user);

        if($row_count==1){
            echo "<script>
                alert('Username Already Exist. Try Another One')
            </script>";
        }else{

            $sql = "INSERT INTO user(username, phone, email, usertype, password) VALUES ('$username','$phone', '$user_email', '$usertype', '$password')" ;

            $result = mysqli_query($data, $sql);

            if($result){
                echo "<script>
                    alert('Data Uploaded Successfully')
                </script>";
            }else{
                echo "<script>
                    alert('Upload Failed')
                </script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="adminhome.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="add_student.css"> -->
    <style>
        label{
            display: inline-block;
            text-align: right;
            width: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .div_deg{
            background-color: skyblue;
            width: 400px;
            padding: 70px 0;
        }
    </style>
</head>
<body>
    <?php
        include 'admin_sidebar.php';
    ?>

    <div class="content">
        <center>
            <h1>Add Student</h1>
            <div class="div_deg">
                <form action="#" method="POST">
                    <div>
                        <label class="label">Username</label>
                        <input type="text" name="name">
                    </div>
                    <div>
                        <label class="label">Email</label>
                        <input type="email" name="email">
                    </div>
                    <div>
                        <label class="label">Phone</label>
                        <input type="number" name="phone">
                    </div>
                    <div>
                        <label class="label">Password</label>
                        <input type="text" name="password">
                    </div>
                    <div>
                        <input type="submit" value="Add Student" name="add_student" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </center>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></>
</body>
</html>