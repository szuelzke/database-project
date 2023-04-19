<?php
require_once 'index.php';
//retrieving the 4 most recently added products from the merch_inventory database

$stmt = $pdo->prepare('SELECT * FROM merch ORDER BY date_added DESC LIMIT 3');
$stmt->execute();
$recently_added_products = $stmt->fetchALL(PDO::FETCH_ASSOC);
?>

<?=template_header('Home')?>
		<div class="featured">
		<link rel="style" type="text/css" href="stylepage.css">
			<h2>Welcome to The Accessory Store</h2>
			<p>Shop our latest collection of accessories now.</p>
			<a href="/database-project/products.php">Shop Now</a>
		</div>

			<div class="recentlyadded content-wrapper">
    			<h2>Featured Prodcuts</h2>
   				<div class="products">
        			<?php foreach ($recently_added_products as $product): ?>
        			<a href="index.php?page=product&id=<?=$product['itemID']?>" class="product">
						<img src="imgs/<?=$product['itemImg']?>" width="200" height="200" alt="<?=$product['itemName']?>">
            			<figcaption>
						<span class="name"><?=$product['itemName']?></span>
            			<span class="price">
            	    		&dollar;<?=$product['itemPrice']?>
            			</span>
						</figcaption>
        			</a>
        			<?php endforeach; ?>
    			</div>
			</div>
		
</main>	
	<footer>
		<p>&copy; 2023 The Accessory Store. All Rights Reserved.</p>
	</footer>
</body>
