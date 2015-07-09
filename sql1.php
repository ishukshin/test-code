<?php

$pdo = new PDO('mysql:host=localhost;dbname=ocr', 'ocr', 'ocr');

$stmt = $pdo->prepare('SELECT student_id, SUM(amount) as sumpayments FROM payments GROUP BY student_id LIMIT 1,1');
$stmt->execute();

$second = $stmt->fetch();

echo "The second is #" . $second['student_id']; 