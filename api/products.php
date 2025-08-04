<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../db.php';

$sql = "
    SELECT 
        p.id AS product_id,
        p.name AS product_name,
        cp.name AS category_name
    FROM product p
    LEFT JOIN category_product cp ON cp.product_id = p.id
    ORDER BY p.id
";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$result = [];

foreach ($rows as $row) {
    $id = $row['product_id'];
    if (!isset($result[$id])) {
        $result[$id] = [
            'id' => $id,
            'name' => $row['product_name'],
            'categories' => []
        ];
    }
    $result[$id]['categories'][] = $row['category_name'];
}

echo json_encode(array_values($result));
