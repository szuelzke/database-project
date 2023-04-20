<?php

require_once "index.php";
require_once "session.php";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    echo 'test';
    $itemName = trim($_POST['name']);
    $itemDesc = trim($_POST['itemDesc']);
    $itemPrice = trim($_POST['itemPrice']);
    $rrp = trim($_POST['rrp']);
    $itemQuantity = trim($_POST['itemQuantity']);
    $itemImg = trim($_POST['itemImg']);
    $date_added = trim($_POST['date_added']);

    if($query = $pdo->prepare("SELECT * FROM merch WHERE itemName = ? ")) {
        $error = '';

        //$query->bind_param('s', $itemName);
        $query->execute(array($itemName));
        //$query->store_result();

        if($query->num_rows > 0) {
            $error .= '<p class="Error">Product already registered!</p>';
        } else {
            if (empty($error) ) {
                echo "test";

                $insertQuery = $pdo->prepare("INSERT INTO merch (itemName, itemDesc, itemPrice, rrp, itemQuantity, itemImg, date_added) VALUE (?, ?, ?, ?, ?, ?, ?)");

                //$insertQuery->bind_param("sssssss", $cost, $product_name, $category, $availability, $material, $color, $size);
                $result = $insertQuery->execute(array($itemName, $itemDesc, $itemPrice, $rrp, $itemQuantity, $itemImg, $date_added));
                if($result) {
                    $error .= '<p class="success">Product successfully added!</p>';
                    echo "Product Successfully added!";
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
    mysqli_close($pdo);
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset = "UTF-8">
        <title>Add Product</title>
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
                    <h2>Add Product</h2>
                    <p>Please fill this form to add a product</p>
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Item Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Item Description</label>
                            <input type="text" name="itemDesc" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Item Price</label>
                            <input type="decimal" name="itemPrice" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>rrp</label>
                            <input type="decimal" name="rrp" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Item Quantity</label>
                            <input type="text" name="itemQuantity" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>itemImg</label>
                            <input type="text" name="itemImg" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Date Added</label>
                            <input type="date" name="date_added" class="form-control" required>
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
