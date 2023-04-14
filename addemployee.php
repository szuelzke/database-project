<?php

require_once "config.php";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    
    $fullname = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    $date_of_birth = trim($_POST['date_of_birth']);
    $department = trim($_POST['department']);
    $start_date = trim($_POST['start_date']);
    $salary = trim($_POST['salary']);

    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    if($query = $db->prepare("SELECT * FROM employees WHERE employee_email = ? ")) {
        $error = '';

        $query->bind_param('s', $email);
        $query->execute();
        $query->store_result();

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

                $insertQuery = $db->prepare("INSERT INTO employees (employee_name, employee_email, date_of_birth, department, start_date, salary, password) VALUES (?, ?, ?, ?, ?, ?, ?);");

                $insertQuery->bind_param("sssssss", $fullname, $email, $date_of_birth, $department, $start_date, $salary, $password_hash);
                $result = $insertQuery->execute();
                if($result) {
                    $error .= '<p class="success">Employee succesfully added!</p>';
                    echo "Employee succesfully added!";
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
    mysqli_close($db);
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset = "UTF-8">
        <title>Add Employee</title>
        <link rel="stylesheet" href = "https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Register</h2>
                    <p>Please fill this form to create an account</p>
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
                            <label>Date of Birth</label>
                            <input type="date" name="date of birth" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Department</label>
                            <input type="text" name="department" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" name="start date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Salary</label>
                            <input type="text" name="salary" class="form-control" required>
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

