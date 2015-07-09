<?php

$pdo = new PDO('mysql:host=localhost;dbname=ocr', 'ocr', 'ocr');

$stmt = $pdo->prepare('SELECT s.name, s.surname FROM student s '. 
        ' INNER JOIN student_status st ON st.student_id = s.id ' . 
        'INNER JOIN ( '.
        ' SELECT student_id, MAX( `datetime` ) as `datetime` ' . 
        ' FROM  `student_status` GROUP BY student_id) st2 ' . 
        ' ON st2.datetime = st.datetime AND st.student_id = st2.student_id WHERE s.gender = :gender AND st.status = :status');

$stmt->execute([
    'gender' => 'unknown',
    'status' => 'vacation',
]);

var_dump($stmt->fetchAll());

