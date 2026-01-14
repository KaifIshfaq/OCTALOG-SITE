<?php
// submit_contact.php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

require_once 'db_connection.php';

// Get JSON input from React
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->name) && !empty($data->email)) {
    try {
        // Prepare selected services as a string
        $selected_services = [];
        if (isset($data->services)) {
            foreach ($data->services as $key => $value) {
                if ($value) $selected_services[] = $key;
            }
        }
        $services_str = implode(", ", $selected_services);

        $sql = "INSERT INTO contact_queries (name, email, services, message) VALUES (:name, :email, :services, :message)";
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':name', $data->name);
        $stmt->bindParam(':email', $data->email);
        $stmt->bindParam(':services', $services_str);
        $stmt->bindParam(':message', $data->message);

        if ($stmt->execute()) {
            http_response_code(201);
            echo json_encode(["message" => "Query submitted successfully."]);
        } else {
            http_response_code(503);
            echo json_encode(["message" => "Unable to submit query."]);
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["message" => "Error: " . $e->getMessage()]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Incomplete data."]);
}
?>