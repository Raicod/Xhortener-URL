<?php
    require_once('connection.php');
    if(isset($_POST['register'])){
        $username = mysqli_real_escape_string($connect, $_POST['username']);
        $password   = mysqli_real_escape_string($connect, $_POST['password']);
        if(strlen($password)<7){
            echo '<script> alert("Password should be more than 6 char!")</script>';
            header("refresh:0;url=register.php");
            exit;
        }

        $query0 = "SELECT * FROM users WHERE Username ='$username'";
        $result0 = mysqli_query($connect, $query0);

        if(mysqli_num_rows($result0)>0){
            echo '<script> alert("Username already taken") </script>';
            header("refresh:0;url=register.php");
            exit;
        }

        $password_sha1 = sha1($password);
        $san_username  = strip_tags($username, FILTER_SANITIZE_STRING);
        $query = "INSERT INTO users (`Username`, `Password`) VALUES (?,?);";
        $stmt = mysqli_prepare($connect, $query);
        mysqli_stmt_bind_param($stmt,"ss",$username,$password_sha1);
        if(mysqli_stmt_execute($stmt)){
            header('Location:index.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
</head>
<body>
    <form action="" method="POST">
        <h2>Register</h2>
        <label>Username</label>
        <input type="text" name="username"><br>
        <label>Password</label>
        <input type="password" name="password"><br>
        <input type="submit" name="register" value="Register"><br>
        <label>Already have account?</label>
        <a href="index.php">Go to login</a>
    </form>
</body>
</html>