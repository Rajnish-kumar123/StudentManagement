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

    $sql = "SELECT * from admissionform";
    $result = mysqli_query($data, $sql);
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
        table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        }
</style>
</head>
<body>
   <?php
        include 'admin_sidebar.php';
   ?>

    <div class="content">
        <center>
            <h1>Applied For Admission</h1>
            <br>

            <table>
                <tr>
                    <th style="padding: 20px; font-size: 15px;">Name</th>
                    <th style="padding: 20px; font-size: 15px;">Email</th>
                    <th style="padding: 20px; font-size: 15px;">Phone</th>
                    <th style="padding: 20px; font-size: 15px;">Message</th>
                </tr>
                <?php
                    while($info = $result -> fetch_assoc()){
                ?>
                <tr>
                    <td style="padding: 20px;">
                        <?php echo "{$info['name']}"; ?>
                    </td>
                    <td style="padding: 20px;">
                    <?php echo "{$info['email']}"; ?>
                    </td>
                    <td style="padding: 20px;">
                    <?php echo "{$info['phone']}"; ?>
                    </td>
                    <td style="padding: 20px;">
                    <?php echo "{$info['message']}"; ?>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </table>
        </center>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>