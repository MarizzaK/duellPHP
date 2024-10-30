<?php
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="produkter.csv"');

$products = json_decode(file_get_contents('http://localhost:3000/api/products'), true);

$output = fopen('php://output', 'w');
fputcsv($output, ['ID', 'Namn', 'Pris']);

foreach ($products as $product) {
    fputcsv($output, [$product['id'], $product['name'], $product['price']]);
}

fclose($output);
exit();
