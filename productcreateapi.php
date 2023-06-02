<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Shopify API credentials
      $shopifyStore = 'quick-start-105b2654.myshopify.com';
$apiKey = '484485bba58714f19d3352eb9584b86f';
$password = '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';
    // API endpoint
    $url = "https://$shopifyStore/admin/api/2021-07/products.json";

    // Read form data
    $title = $_POST['title'];
    $bodyHtml = $_POST['body_html'];
    $vendor = $_POST['vendor'];
    $productType = $_POST['product_type'];
    $price = $_POST['price'];
    $sku = $_POST['sku'];

    // Create product data
    $productData = array(
        'product' => array(
            'title' => $title,
            'body_html' => $bodyHtml,
            'vendor' => $vendor,
            'product_type' => $productType,
            'variants' => array(
                array(
                    'price' => $price,
                    'sku' => $sku
                )
            )
        )
    );

    // Convert product data to JSON
    $jsonData = json_encode($productData);

    // Set up the cURL request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, "$apiKey:$password");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonData)
    ));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

    // Execute the request
    $response = curl_exec($ch);

    // Check for errors
    if ($response === false) {
        echo 'Error: ' . curl_error($ch);
    } else {
        $responseData = json_decode($response, true);
        // Check the response for any errors
        if (isset($responseData['errors'])) {
            echo 'Error creating product: ' . $responseData['errors'];
        } else {
            echo 'Product created successfully! Product ID: ' . $responseData['product']['id'];
        }
    }

    // Close the cURL request
    curl_close($ch);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
</head>
<body>
    <form method="POST">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
        <br>
        <label for="body_html">Body HTML:</label>
        <textarea name="body_html" id="body_html" required></textarea>
        <br>
        <label for="vendor">Vendor:</label>
        <input type="text" name="vendor" id="vendor" required>
        <br>
        <label for="product_type">Product Type:</label>
        <input type="text" name="product_type" id="product_type" required>
        <br>
        <label for="price">Price:</label>
        <input type="text" name="price" id="price" required>
        <br>
        <label for="sku">SKU:</label>
        <input type="text" name="sku" id="sku" required>
        <br>
        <input type="submit" value="Create Product">
    </form>
</body


