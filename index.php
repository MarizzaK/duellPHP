<?php

$products = json_decode(file_get_contents('https://din-vercel-url/api/products'), true);
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produkter</title>
</head>
<body>
    <h1>Produkter</h1>
    <ul>
        <?php foreach ($products as $product): ?>
            <li><?php echo $product['name']; ?> - <?php echo $product['price']; ?> SEK</li>
        <?php endforeach; ?>
    </ul>

    <h2>Lägg till produkt</h2>
    <form method="POST" action="add_product.php">
        <input type="text" name="name" placeholder="Produktnamn" required>
        <input type="number" name="price" placeholder="Pris" required>
        <button type="submit">Lägg till</button>
    </form>
</body>
</html>
