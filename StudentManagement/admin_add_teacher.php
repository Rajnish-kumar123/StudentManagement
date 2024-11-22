<?php
session_start();

    if(!isset($_SESSION['username'])){
        header("location:login.php");
    }elseif($_SESSION['usertype']=='student'){
        header("location:login.php");
    }

    include('db_connection.php');

    if(isset($_POST['add_teacher'])){
        $t_name = $_POST['name'];
        $t_description = $_POST['description'];

        $file = $_FILES['image']['name'];
        $dst="./teacher_img/".$file;
        $dst_db = "./teacher_img/".$file;
        move_uploaded_file($_FILES['image']['tmp_name'], $dst);

        $sql = "INSERT INTO teacher (name, description, image) VALUE('$t_name','$t_description', '$dst_db')";

        $result = mysqli_query($data, $sql);

        if($result){
            header('location:admin_add_teacher.php');
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
        .div_deg{
            background-color: skyblue;
            width: 500px;
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
            <h1>Add Teacher</h1>
            <br><br>
            <div class="div_deg">
                <form action="#" method="POST" enctype="multipart/form-data">
                    <div>
                        <label for="">Teacher Name : </label>
                        <input type="text" name="name">
                    </div><br>
                    <div>
                        <label for="">Description : </label>
                        <textarea name="description" ></textarea>
                    </div><br>
                    <div>
                        <label for="">Image : </label>
                        <input type="file" name="image">
                    </div><br>
                    <div>
                        <input type="submit" name="add_teacher" value="Add Teacher" class="btn btn-primary">
                    </div>
                </form>
            </div>

        </center>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>