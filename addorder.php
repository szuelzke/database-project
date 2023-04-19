<?php

require_once "config.php";
require_once "session.php";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    
    $customer_email = trim($_POST['customer_email']);
    $order_number = trim($_POST['order_number']);
    $num_of_items = trim($_POST['num_of_items']);
    $total_price = trim($_POST['total_price']);
    $employee_email = trim($_POST['employee_email']);
    $purchase_date = trim($_POST['purchase_date']);
    $arrival_date = trim($_POST['arrival_date']);

    if($query = $db->prepare("SELECT * FROM order_info WHERE order_number = ? ")) {
        $error = '';

        $query->bind_param('s', $order_number);
        $query->execute();
        $query->store_result();

        if($query->num_rows > 0) {
            $error .= '<p class="Error">Order already registered!</p>';
        } else {
            if (empty($error) ) {
                echo "test";

                $insertQuery = $db->prepare("INSERT INTO order_info (customer_email, order_number, num_of_items, total_price, employee_email, purchase_date, arrival_date) VALUE (?, ?, ?, ?, ?, ?, ?)");

                $insertQuery->bind_param("sssssss", $customer_email, $order_number, $num_of_items, $total_price, $employee_email, $purchase_date, $arrival_date);
                $result = $insertQuery->execute();
                if($result) {
                    $error .= '<p class="success">Order successfully added!</p>';
                    echo "Order Successfully added!";
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
        <title>Add Order</title>
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
                    <h2>Add Order</h2>
                    <p>Please fill this form to add an order</p>
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Customer Email</label>
                            <input type="email" name="customer email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Number of Items</label>
                            <input type="int" name="num of items" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Total Price</label>
                            <input type="text" name="total price" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Employee Email</label>
                            <input type="email" name="employee email" class="form-control" required>
                        </div>
                        </div>
                        <div class="form-group">
                            <label>Purchase Date</label>
                            <input type="date" name="purchase date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Arrival Date</label>
                            <input type="date" name="arrival date" class="form-control" required>
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
