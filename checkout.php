<?php

require_once "index.php";
require_once "session.php";
require_once "cart.php";


if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    
    if ($products_in_cart) {
        foreach ($products_in_cart as $k => $v) {
            $stmt = $pdo->prepare('UPDATE merch SET itemQuantity = itemQuantity - ? WHERE itemID = ?');
            $stmt->execute([ $v, $k ]);
        }
        // remove items from cart as no longer needed
        unset($_SESSION['cart']);
    } else {
        exit('There are no items in cart!');
    }

    $customer_email = trim($_POST['customer_email']);
    $order_number = trim($_POST['order_number']);
    $num_of_items = count($products_in_cart);
    $total_price = $subtotal;
    $employee_email = trim($_POST['employee_email']);
    $purchase_date = date("y/m/d");
    $arrival_date = date('y:m:d', strtotime('+3 days'));

    if($query = $pdo->prepare("SELECT * FROM order_info WHERE order_number = ? ")) {
        $error = '';

        //$query->bind_param('s', $order_number);
        $query->execute(array($order_number));
        //$query->store_result();

        if($query->num_rows > 0) {
            $error .= '<p class="Error">Order already registered!</p>';
        } else {
            if (empty($error) ) {
                echo "test";

                $insertQuery = $pdo->prepare("INSERT INTO order_info (customer_email, order_number, num_of_items, total_price, employee_email, purchase_date, arrival_date) VALUE (?, ?, ?, ?, ?, ?, ?)");

                //$insertQuery->bind_param("sssssss", $customer_email, $order_number, $num_of_items, $total_price, $employee_email, $purchase_date, $arrival_date);
                $result = $insertQuery->execute(array($customer_email, $order_number, $num_of_items, $total_price, $employee_email, $purchase_date, $arrival_date));
                if($result) {
                    header("location: payment.php");
                    exit;
                } else {
                    $error .= '<p class="error">Something went wrong!</p>';
                }
            } 
        }
    }

    $query->close();
    //$insertQuery->close();
    mysqli_close($pdo);
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
        <!--
        <nav style="text-align: left">
			<ul>
				<li><a href= "/database-project/employee.html"> Back</a></li>
			</ul>
		</nav>
-->
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
                            <span class="text">Total number of items</span>
                            <span class="price"><?=count($products_in_cart)?></span>
                        </div>
                        <div class="subtotal">
                            <span class="text">Subtotal</span>
                            <span class="price">&dollar;<?=$subtotal?></span>
                        </div>
                        <div class="form-group">
                            <label>Employee Email (optional)</label>
                            <input type="email" name="employee email" class="form-control">
                        </div>
                        </div>
                        <div class="form-group">
                            <label>Purchase Date</label>
                            <span class="price"><?=date("y/m/d")?></span>
                        </div>
                        <div class="form-group">
                            <label>Arrival Date</label>
                            <span class="price"><?=date('y/m/d', strtotime('+3 days'))?></span>
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
