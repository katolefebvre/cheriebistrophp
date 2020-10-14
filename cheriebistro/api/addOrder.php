<?php

require_once '../includes/dboperation.php';

$response = array();

$table_id = $_POST['table_id'];
$price_total = $_POST['price_total'];
$status = $_POST['status'];


$db = new DbOperation();
$result = $db->createOrder($table_id, $price_total, $status);

if ($result != ORDER_NOT_CREATED) {
    $addedId = $result;

    $response['error'] = "false";
    $response['message'] = 'Test created successfully.';
    $response['addedId'] = strval($addedId);
} elseif ($result == ORDER_NOT_CREATED) {
    $response['error'] = "true";
    $response['message'] = $result;
}

echo json_encode($response);

mysqli_close($db);

?>