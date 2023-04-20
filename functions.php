<?php
function pdo_connect_mysql() {
    // Update the details below with your MySQL details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'database_proj';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// Error Handling
    	exit('Failed to connect to database!');
    }
}

function template_header($title) {
    echo <<<EOT
    <!DOCTYPE html>
    <html>
        <head>
            <link rel="stylesheet" href="page.css">
        </head>
        <body>
        <header>
            <header class="logoHead">
                <img class="logo" src="https://th.bing.com/th?id=OIP.-xf4eNCR1IKEaj4KNY07UAHaHa&w=250&h=250&c=8&rs=1&qlt=90&o=6&dpr=1.5&pid=3.1&rm=2">  
            <nav>
                <ul>
                    <li><a href="/database-project/home.php">Home</a></li>
                    <li><a href="/database-project/products.php">Shop</a></li>
                    <li><a href="/database-project/AboutUs.html">About Us</a></li>
                    <li><a href="/database-project/logout.php">Logout</a></li>
                    <a href="#"><img src="https://th.bing.com/th/id/OIP.wSF1rtzcFeEgwEBNxJUiPQHaHa?w=213&h=193&c=7&r=0&o=5&dpr=1.5&pid=1.7" width="30" height="30" alt=""></a>
                </ul>
        </header>
        </body>
        <main>
    EOT;
    }

?>