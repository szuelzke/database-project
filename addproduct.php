<?php

require_once "index.php";
require_once "session.php";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    
    $product_name = trim($_POST['name']);
    $cost = trim($_POST['cost']);
    $category = trim($_POST['category']);
    $availability = trim($_POST['availability']);
    $material = trim($_POST['material']);
    $color = trim($_POST['color']);
    $size = trim($_POST['size']);

    if($query = $pdo->prepare("SELECT * FROM products WHERE product_name = ? ")) {
        $error = '';

        //$query->bind_param('s', $product_name);
        $query->execute(array($product_name));
        //$query->store_result();

        if($query->num_rows > 0) {
            $error .= '<p class="Error">Product already registered!</p>';
        } else {
            if (empty($error) ) {
                echo "test";

                $insertQuery = $pdo->prepare("INSERT INTO products (cost, product_name, category, availability, material, color, size) VALUE (?, ?, ?, ?, ?, ?, ?)");

                //$insertQuery->bind_param("sssssss", $cost, $product_name, $category, $availability, $material, $color, $size);
                $result = $insertQuery->execute(array($cost, $product_name, $category, $availability, $material, $color, $size));
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
                            <label>Product Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Cost</label>
                            <input type="text" name="cost" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" name="category" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>availability</label>
                            <input type="int" name="availability" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Material</label>
                            <input type="text" name="material" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Color</label>
                            <input type="text" name="color" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Size</label>
                            <input type="text" name="size" class="form-control" required>
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
