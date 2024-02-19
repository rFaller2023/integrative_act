<?php

header('Content-type: application/json; charset=UTF-8');

class apartmentMs 
{
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli('localhost', 'root', '', 'apartmentms');
    }

    public function create()
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            return json_encode([
                "code" => 201,
                "message" => $_SERVER['REQUEST_METHOD']. " Method is not allowed, Only POST Method is allowed",
            ]);
        }

        $data = json_decode(file_get_contents("php://input"), true);

        $role = $data['role'];
        $name = $data['name'];
        $email = $data['email'];
    

        $isInserted = $this->conn->query("INSERT INTO users (role, name, email) values ('$role', '$name','$email')");

        if($isInserted){
            $id = $this->conn->insert_id;
            $row = $this->conn->query("SELECT * FROM users where id = $id");
            $response = $row->fetch_assoc();

            echo json_encode($response);
        } else {
            echo json_encode([
                'message' => 'Failed to Insert Data',
                'code' => 422,
            ]);
        }
    }
}
$create = new apartmentMs();

echo $create->create($_POST);
?>