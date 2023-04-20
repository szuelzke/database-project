<?php

require_once "index.php";
require_once "session.php";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    
    $customer_email = trim($_POST['customer_email']);
    $card_number = trim($_POST['card_number']);
    $payment_id = trim($_POST['payment_id']);
    $purchase_date = date('y:m:d', strtotime('-1 day'));

    if($query = $pdo->prepare("SELECT * FROM payment WHERE payment_id = ? ")) {
        $error = '';

        //$query->bind_param('s', $order_number);
        $query->execute(array($payment_id));
        //$query->store_result();

        if($query->num_rows > 0) {
            $error .= '<p class="Error">Payment already given!</p>';
        } else {
            if (empty($error) ) {
                echo "test";

                $insertQuery = $pdo->prepare("INSERT INTO payment (payment_id, customer_email, card_number, payment_date) VALUE (?, ?, ?, ?)");

                //$insertQuery->bind_param("sssssss", $customer_email, $order_number, $num_of_items, $total_price, $employee_email, $purchase_date, $arrival_date);
                $result = $insertQuery->execute(array($payment_id, $customer_email, $card_number, $purchase_date));
                if($result) {
                    header("location: success.html");
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
                    <h2>Payment details</h2>
                    <p>Please fill this form to finish your order</p>
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Customer Email</label>
                            <input type="email" name="customer email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Card Number</label>
                            <input type="text" name="card number" class="form-control" required>
                        </div>
                        </div>
                        <div class="form-group">
                            <label>Payment Date</label>
                            <span class="price"><?=date("y/m/d")?></span>
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