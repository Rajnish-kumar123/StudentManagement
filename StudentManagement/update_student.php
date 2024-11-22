<?php
session_start();

    if(!isset($_SESSION['username'])){
        header("location:login.php");
    }elseif($_SESSION['usertype']=='student'){
        header("location:login.php");
    }

    include('db_connection.php');

    $id = $_GET['student_id'];
    $sql = "SELECT * FROM user WHERE id='$id' ";
    $result = mysqli_query($data, $sql);

    $info = $result -> fetch_assoc();

    //updating data
    if(isset($_POST['update'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];

        $query = "UPDATE user SET username='$name', email='$email', phone='$phone', password='$password' WHERE id='$id' ";

        $result2 = mysqli_query($data, $query);
        if($result2){
            header("location:view_student.php");
            echo "<script>alert('Course updated successfully');</script>";
        } else {
            echo "<script>alert('Failed to update course');</script>";
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
        <h1>Update Student Data</h1>
        <br>
        <div class="div_deg">
            <form action="#" method="POST">
                <div>
                    <label for="">Username</label>
                    <input type="text" name="name" value="<?php echo "{$info['username']}"; ?> ">
                </div>
                <div>
                    <label for="">Email</label>
                    <input type="email" name="email" value="<?php echo "{$info['email']}"; ?> ">
                </div>
                <div>
                    <label for="">Phone</label>
                    <input type="text" name="phone" value="<?php echo "{$info['phone']}"; ?> ">
                </div>
                <div>
                    <label for="">Password</label>
                    <input type="text" name="password" value="<?php echo "{$info['password']}"; ?> ">
                </div>
                <div>
                    <input type="submit" name="update" value="Update" class="btn btn-success">
                </div>
            </form>
        </div>
        </center>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

