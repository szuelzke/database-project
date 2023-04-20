<?php

require_once "index.php";
require_once "session.php";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $email = trim($_POST['email']);
    if($query = $pdo->prepare("SELECT * FROM customers WHERE customer_email = ? ")) {

        $error = '';

        //$query->bind_param('s', $email);
        $query->execute(array($email));
        //$query->store_result();

        if($query->num_rows < 0) {
            echo "msg";
            $error .= '<p class="Error">err</p>';
        } else {
            echo "debug";
            $update = $pdo->prepare("DELETE FROM customers WHERE customer_email = ?");
            //$update->bind_param('s', $email);
            $result = $update->execute(array($email));
            if($result){
                echo "Customer Successfully removed!";
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
		<title>Remove Customer</title>
	</head>

	<body style="background-color: #e1e1e1">

		<nav style="text-align: left">
			<ul>
				<li><a href= "/database-project/employee.html"> Back</a></li>
			</ul>
		</nav>
		
		<form method="POST">
			<div class="text-block">
			 <div class="col-25"><label>Customer Email: </label></div><div class="col-75"><input type="email" name="email" required /></div>
			 <br/><br/>
                <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                </div>
            </div>
		</form>
	</body>
</html>