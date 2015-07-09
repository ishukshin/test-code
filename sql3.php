<?php

$pdo = new PDO('mysql:host=localhost;dbname=ocr', 'ocr', 'ocr');

$stmt = $pdo->prepare('SELECT DISTINCT(s.id), s.name, s.surname FROM student s '. 
        ' INNER JOIN student_status st ON st.student_id = s.id ' . 
        ' INNER JOIN ( '.
        ' SELECT student_id, MAX( `datetime` ) as `datetime` ' . 
        ' FROM  `student_status` GROUP BY student_id) st2 ' . 
        ' ON st2.datetime = st.datetime ' . 
        ' WHERE s.gender = :gender AND st.status = :status' . 
        ' AND (SELECT count(*) FROM payments p WHERE p.amount > 0 AND p.student_id = s.id) <= 3');

$stmt->execute([
    'gender' => 'unknown',
    'status' => 'lost',
]);

foreach($stmt->fetchAll() as $row){
    echo "Student ".$row['name'].", ".$row['surname']." <br>\n";
}

