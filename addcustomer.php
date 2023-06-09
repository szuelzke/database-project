<?php

require_once "index.php";
require_once "session.php";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    
    $fullname = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    $phone_number = trim($_POST['phone_number']);
    //$card_number = trim($_POST['card_number']);
    $address = trim($_POST['address_line']);
    $city = trim($_POST['city']);
    $state = trim($_POST['state']);
    $zip_code = trim($_POST['zip_code']);

    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    if($query = $pdo->prepare("SELECT * FROM customers WHERE customer_email = ? ")) {
        $error = '';

        //$query->bind_param('s', $email);
        $query->execute(array($email));

        if($query->num_rows > 0) {
            $error .= '<p class="Error">The email address is already registered!</p>';
        } else {
            if (strlen($password) < 6) {
                echo "debug";
                $error .= '<p class="error">Password must have at least 6 characters.</p>';
                echo $error;
            }
            if(empty($confirm_password)) {
                $error .= '<p class="error">Please enter confirm password.</p>';
            } else {
                if(empty($error) && ($password != $confirm_password)) {
                    $error .= '<p class="error">Password did not match.</p>';
                }
            }
            if (empty($error) ) {
                echo "test";

                $insertQuery = $pdo->prepare("INSERT INTO customers (customer_name, customer_email, phone_number, address, city, state, zip_code, password) VALUE (?, ?, ?, ?, ?, ?, ?, ?)");

                //$insertQuery->bind_param("sssssssss", $fullname, $email, $phone_number, $card_number, $address, $city, $state, $zip_code, $password_hash);
                $result = $insertQuery->execute(array($fullname, $email, $phone_number, $address, $city, $state, $zip_code, $password_hash));
                if($result) {
                    $error .= '<p class="success">Customer successfully added!</p>';
                    echo "Customer Successfully added!";
                    header("location: employee.html");
                    exit;
                } else {
                    $error .= '<p class="error">Something went wrong!</p>';
                }
            } 
        }
    }

    $query->close();
    //$insertQuery->close();
    $pdo = null;
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset = "UTF-8">
        <title>Add Customer</title>
        <link rel="stylesheet" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    </head>
    <body>
        <nav style="text-align: left">
			<ul>
				<li><a href= "/database-project/employee.html"> Back</a></li>
			</ul>
		</nav>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Add Customer</h2>
                    <p>Please fill this form to add a customer</p>
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="confirm password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="phone number" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Address Line</label>
                            <input type="text" name="address line" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" name="city" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" name="state" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Zip Code</label>
                            <input type="text" name="zip code" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

