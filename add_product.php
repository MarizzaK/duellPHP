<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];

    $data = [
        'name' => $name,
        'price' => $price
    ];

    // Skicka POST-förfrågan till Express-servern
    $ch = curl_init('https://din-vercel-url/api/products');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $response = curl_exec($ch);
    curl_close($ch);

    // Om du vill omdirigera till startsidan efter tillägg
    header('Location: index.php');
}
