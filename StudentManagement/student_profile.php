<?php
session_start();

    if(!isset($_SESSION['username'])){
        header("location:login.php");
    }elseif($_SESSION['usertype']=='admin'){
        header("location:login.php");
    }
    // connect with db 
    include('db_connection.php');

    $name = $_SESSION['username'];
    $sql = "SELECT * FROM user WHERE username='$name' ";
    $result = mysqli_query($data, $sql);

    $info = mysqli_fetch_assoc($result);

    if(isset ($_POST['update_profile'])){
        $s_email = $_POST['email'];
        $s_phone = $_POST['phone'];
        $s_password = $_POST['password'];
    
        // Corrected SQL query
        $sql2 = "UPDATE user SET email='$s_email', phone='$s_phone', password='$s_password' WHERE username='$name'";
    
        $result2 = mysqli_query($data, $sql2);
        if($result2){
            header('location:student_profile.php');
        } else {
            echo "Update failed: ";
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
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
            width: 500px;
            padding: 70px 0;
        }
    </style>
</head>
<body>
    <?php
        include('student_sidebar.php');
    ?>

    <div class="content">
        <center>
            <h1>Update Profile</h1>
            <br><br>
            <form action="#" method="POST">
                <div class="div_deg">
                    <div>
                        <label for="">Email</label>
                        <input type="email" name="email" value="<?php echo "{$info['email']}" ?>">
                    </div>
                    <div>
                        <label for="">Phone</label>
                        <input type="text" name="phone" value="<?php echo "{$info['phone']}" ?>">
                    </div>
                    <div>
                        <label for="">Password</label>
                        <input type="text" name="password" value="<?php echo "{$info['password']}" ?>">
                    </div>
                    <div>
                        <input type="submit" name="update_profile" value="Update" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </center>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></>
</body>
</html>