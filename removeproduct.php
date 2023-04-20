<?php

require_once "index.php";
require_once "session.php";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $itemName = trim($_POST['name']);
    if($query = $pdo->prepare("SELECT * FROM merch WHERE itemName = ? ")) {

        $error = '';

        //$query->bind_param('s', $product_name);
        $query->execute(array($itemName));
        //$query->store_result();

        if($query->num_rows < 0) {
            echo "msg";
            $error .= '<p class="Error">err</p>';
        } else {
            echo "debug";
            $update = $pdo->prepare("DELETE FROM merch WHERE itemName = ?");
            //$update->bind_param('s', $product_name);
            $result = $update->execute(array($itemName));
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
		<title>Remove Product</title>
	</head>

	<body style="background-color: #e1e1e1">

		<nav style="text-align: left">
			<ul>
				<li><a href= "/database-project/employee.html"> Back</a></li>
			</ul>
		</nav>
		
		<form method="POST">
			<div class="text-block">
			 <div class="col-25"><label>Product Name: </label></div><div class="col-75"><input type="text" name="name" required /></div>
			 <br/><br/>
                <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                </div>
            </div>
		</form>
	</body>
</html>