<?php

require_once "index.php";
require_once "session.php";

$error = '';
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $password_hash = password_hash($password, PASSWORD_BCRYPT);


    if(empty($email)) {
        $error .= '<p class="error">Please enter email.</p>';
    }

    if(empty($password)) {
        $error .= '<p class="error">Please enter your password.</p>';
    }

    if(empty($error)) {
        if($query = $pdo->prepare("SELECT * FROM customers WHERE customer_email = ?")) {
            //query->bindParam('customer_email', $email);

            $query->execute(array($email));
            $row = $query->fetch();

            if($row) {
                if(password_verify($password, $password_hash)) {
                    $_SESSION["userid"] = $row['id'];
                    $_SESSION["user"] = $row;
                    echo "test";
                    header("location: home.php");
                    exit;
                } else {
                    $error .= '<p class="error">Password is not valid.</p>';
                    //echo "test1";

                }
            } else {
                $error .= '<p class="error">No User exist with that email address.</p>';
            }
        }
    }
    $query->close();
    $pdo = null;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset = "UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Login</h2>
                    <p>Please fill in your email and password.</p>
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                        </div>
                        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
