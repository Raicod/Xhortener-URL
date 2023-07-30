<?php
    require_once("connection.php");

    if(isset($_POST['login'])){
        
        $username = mysqli_real_escape_string($connect, $_POST['username']);
        $password   = mysqli_real_escape_string($connect, $_POST['password']);
        $san_username  = filter_var($username, FILTER_SANITIZE_STRING);
        
        $password_sha1 = sha1($password);

        $query_login = "SELECT * FROM users WHERE Username = '$san_username' AND Password = '$password_sha1';";
        echo $san_username.$password_sha1;
        $q1 = mysqli_query($connect,$query_login);
        $r1 = mysqli_fetch_array($q1);
        
        $id = "SELECT id FROM users WHERE Username = '$username' AND Password = '$password_sha1';";
        $qid = mysqli_query($connect,$id);
        
        if($q1->num_rows > 0){
            $_SESSION['is_Login'] = true;
            header("Location:home.php");
        }
        else{
            echo '<script type="text/javascript">alert("Email or Password is Incorrect")</script>';
            header("refresh:0;url=index.php");
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
        <h2>Login</h2>
        <label>Username</label>
        <input type="text" name="username"><br>
        <label>Password</label>
        <input type="password" name="password"><br>
        <input type="submit" name="login" value="Login"><br>
        <label>Dont have account?</label>
        <a href="register.php">Create Account</a>
    </form>
</body>
</html>