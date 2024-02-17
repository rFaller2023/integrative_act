<?php

header('Content-Type: apllication/json');
$data =json_decode(file_get_contents("php://input"), true);
$role= $data['role'];
$name= $data['name'];
$email= $data['email'];


$conn= new mysqli('localhost', 'root', '', 'apartmentms');
$isInserted = $conn->query("INSERT INTO users (role, name, email)
    values ('$role', '$name', '$email')");

if ($isInserted) {
    $id = $conn->insert_id;
    $row =$conn->query("SELECT * FROM users where id = $id");
    $response = $row->fetch_assoc();

    // var_dump($response);
}else {
    echo json_encode([
        'message'=> 'failed to insert data',
        'code' => 422,
    ]);
}
?>