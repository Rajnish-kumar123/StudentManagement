<?php
error_reporting(0);
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

    $sql = "SELECT * FROM user WHERE usertype='student'";
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
        table, th, td{
            border: 1px solid black;
            border-collapse: collapse;
        }
        .table_th{
            padding: 20px;
            font-size: 20px;
            
        }
        .table_td{
            padding: 20px;
            background-color: skyblue;
        }
    </style>
</head>
<body>
    <?php
        include 'admin_sidebar.php';
    ?>

    <div class="content">
        <center>
            <h1>Student Data</h1>
            <?php
                if($_SESSION['message']){
                    echo $_SESSION['message'];
                }
                unset($_SESSION['message']);
            ?>
            <br><br>
            <table>
                <tr>
                    <th class="table_th">Username</th>
                    <th class="table_th">Email</th>
                    <th class="table_th">Phone</th>
                    <th class="table_th">Password</th>
                    <th class="table_th">Delete</th>
                    <th class="table_th">Update</th>
                </tr>

                <?php
                    while($info=$result ->fetch_assoc()){
                ?>
                <tr>
                    <td class="table_td">
                        <?php echo "{$info['username']}"; ?>
                    </td>
                    <td class="table_td">
                        <?php echo "{$info['email']}"; ?>
                    </td>
                    <td class="table_td">
                        <?php echo "{$info['phone']}"; ?>
                    </td>
                    <td class="table_td">
                        <?php echo "{$info['password']}"; ?>
                    </td>
                    <td class="table_td">
                        <?php echo "<a onClick=\" javascript:return confirm('Are You Sure to Delete');\" href='delete_student.php?student_id={$info['id']}' class='btn btn-danger'>Delete</a>"; ?>
                    </td>
                    <td class="table_td">
                        <?php echo "<a href='update_student.php?student_id={$info['id']}' class='btn btn-success'>Update</a>"; ?>
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