<?php

require_once "config.php";
require_once "session.php";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $email = trim($_POST['email']);
    if($query = $db->prepare("SELECT * FROM employees WHERE employee_email = ? ")) {

        $error = '';

        $query->bind_param('s', $email);
        $query->execute();
        $query->store_result();

        if($query->num_rows < 0) {
            echo "msg";
            $error .= '<p class="Error">err</p>';
        } else {
            echo "debug";
            $update = $db->prepare("DELETE FROM employees WHERE employee_email = ?");
            $update->bind_param('s', $email);
            $result = $update->execute();
            if($result){
                echo "Employee Successfully removed!";
                header("location: employee.html");
            }
        } 
    }
}


?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Remove Employee</title>
	</head>

	<body style="background-color: #e1e1e1">

		<nav style="text-align: left">
			<ul>
				<li><a href= "/database-project/employee.html"> Back</a></li>
			</ul>
		</nav>
		
		<form method="POST">
			<div class="text-block">
			 <div class="col-25"><label>Employee Email: </label></div><div class="col-75"><input type="email" name="email" required /></div>
			 <br/><br/>
                <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                </div>
            </div>
		</form>
	</body>
</html>