<?php
require_once 'index.php';
$num_products_on_each_page = 4;
// current page will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
// select clause pulls prodcuts from merch and orders by date_added
$stmt = $pdo->prepare('SELECT * FROM merch ORDER BY date_added DESC LIMIT ?,?');
// bindValue will allow us to use an integer in the SQL statement, which we need to use for the LIMIT clause
$stmt->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the products from the database and return the result as an Array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_products = $pdo->query('SELECT * FROM merch')->rowCount();
?>

<?=template_header('Products')?>

<link rel='stylsheet' type='text/css' href='stylepage.css'>
<div class="products content-wrapper">
    <h1>Products</h1>
    <p><?=$total_products?> Products</p>
    <div class="products-wrapper">
        <?php foreach ($products as $product): ?>
        <a href="index.php?page=product&id=<?=$product['itemID']?>" class="product">
            <img src="imgs/<?=$product['itemImg']?>" width="200" height="200" alt="<?=$product['itemName']?>">
            <span class="name"><?=$product['itemName']?></span>
            <span class="price">
                &dollar;<?=$product['itemPrice']?>
            </span>
        </a>
        <?php endforeach; ?>
    </div>
    <div class="buttons">
        <?php if ($current_page > 1): ?>
        <a href="index.php?page=products&p=<?=$current_page-1?>">Prev</a>
        <?php endif; ?>
        <?php if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($products)): ?>
        <a href="index.php?page=products&p=<?=$current_page+1?>">Next</a>
        <?php endif; ?>
    </div>
</div>

</main>
    <footer>
      <p>&copy; 2023 Online Shop. All rights reserved.</p>
    </footer>
</html>