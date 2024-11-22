<?php
    error_reporting(0);
    session_start();
    session_destroy();
    if($_SESSION['message']){
        $message=$_SESSION['message'];
        echo "<script type='text/javascript'>
            alert('$message');
        </script>";
    }

    // connect with db 
    include('db_connection.php');

    $sql = "SELECT * FROM teacher";
    $result = mysqli_query($data, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <nav>
        <!-- <label class="logo">Sutudent Management System</label> -->
        <img class="logo" src="./img/logo.png" alt="">
        <ul class="nav-btn">
            <li><a href="">Home</a></li>
            <li><a href="">Contact</a></li>
            <li><a href="">Admission</a></li>
            <li><a href="login.php" class="btn btn-success" >Login</a></li>
        </ul>
    </nav>

    <div class="section1">
        <img src="./img/section1.jpeg" class="main-img" alt="">
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="./img/school1.jpeg"class="welcome-img" alt="">
            </div>
            <div class="col-md-8">
                <h1>Welcome to LPU</h1>
                <p>
                Lovely Professional University (LPU) is a premier private institution located in Phagwara, Punjab, and is recognized for its expansive campus, comprehensive academic offerings, and global outlook. Founded in 2005 by the Lovely International Trust, LPU has grown to become one of India's largest universities in terms of both campus size and student population. It covers over 600 acres and offers a wide array of facilities, including modern classrooms, advanced laboratories, digital libraries, sports arenas, and fully equipped residential areas. The university emphasizes providing students with a holistic learning experience, combining academic rigor with extracurricular engagement.
                </p>
            </div>
        </div>
    </div>

    <!-- Teacher section -->
    <center>
        <h1>Our Teachers</h1>
    </center>

    <div class="container">
        <div class="row">
            <?php
                while($info = $result->fetch_assoc()){
            ?>
            <div class="col-md-4">
                <img class="teacher"src="<?php echo "{$info['image']}" ?>" style="object-fit:contain;">
                <h3><?php echo "{$info['name']}" ?></h3>
                <h5><?php echo "{$info['description']}" ?></h5>
            </div>
            <?php
                }
            ?>
            
        </div>
    </div>

    <!-- Our Courses -->
    <center>
        <h1>Our Courses</h1>
    </center>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img class="course teacher"src="./img/WebDev.png" alt="">
                <h3>Web Developer</h3>
            </div>
            <div class="col-md-4">
                <img class="course teacher" src="./img/Graphic.jpg" alt="">
                <h3>Graphics Designer</h3>
            </div>
            <div class="col-md-4">
                <img class="course teacher" src="./img/Marketing.png" alt="">
                <h3>Marketing</h3>
            </div>
        </div>
    </div>

    <!-- Admission form -->

    <center>
        <h1 class="adm">Admission form</h1>
    </center>

    <div class="admission-form" align="center">
        <form action="Admission_form_data.php" method="POST">
            <div class="admission-input">
                <label class="label-text">Name</label>
                <input type="text" class="input" name="name">
            </div>
            <div class="admission-input">
                <label class="label-text">Email</label>
                <input type="email" class="input" name="email">
            </div>
            <div class="admission-input">
                <label class="label-text">Phone</label>
                <input type="text" class="input" name="phone">
            </div>
            <div class="admission-input">
                <label class="label-text">Message</label>
                <textarea name="message"class="textarea" name="message"></textarea>
            </div>
            <div class="admission-input">
                <input type="submit" value="Apply" class="btn btn-primary" id="submit" name="apply">
            </div>
        </form>
    </div>

    <!-- Footer -->

    <footer>
        <h3 class="footer-text">All @copyright reserved by LPU Student </h3>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>